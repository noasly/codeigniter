<?php

class Cron extends CI_Controller {

    // 실행 방법 : php index.php cron message
    public function message($to = 'World')
    {
        echo "Hello {$to}!" . PHP_EOL;
    }

    /*
     * 스포츠 뉴스 기사 목록을 가져온다
     */
    public function crawlSportNews() {
        $this->load->model('news');

        $url = 'http://www.sportalkorea.com/news/';
        $query = 'news.php?section_code=20&page=1';
        $contents = file_get_contents($url . $query);

        if($contents === false) {
            echo 'file_get_contents false';
            exit;
        }

        $dom = new DOMDocument();
        if(@$dom->loadHTML($contents)) {
            $xpath = new DOMXPath($dom);

            // 기사 엘리먼트 패턴
            $elements = $xpath->query('//span[@class=\'txt_14\']');
            $results = [];
            foreach($elements as $element) {
                preg_match('/gisa_uniq=([0-9]+)/', $element->parentNode->getAttribute('href'), $matches);
                $uniqSeq = $matches[1];
                if(!preg_match('/^[0-9]{16}/', $uniqSeq)) {
                    continue;
                }

                // 기사 작성 날짜
                $regDate = strtotime(substr($uniqSeq, 0, 12));
                if(!preg_match('/^[0-9]{12}/', $uniqSeq)) {
                    continue;
                }

                $result = [
                    'title' => $element->nodeValue,
                    'url' => $url . $element->parentNode->getAttribute('href'),
                    'regDate' => $regDate,
                    'ref' => 'sportalkorea',
                    'refSeq' => $uniqSeq,
                ];

                if(!$this->news->isDuplicated($uniqSeq)) {
                    array_push($results, $result);
                }
            }

            // 뉴스 저장
            if(count($results) > 0) {
                $this->news->insertNews($results);
            }
        }
    }
}