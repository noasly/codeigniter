<?php

class News extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 뉴스 저장
     * @param array $news
     */
    function insertNews(array $news)
    {
        $this->db->insert_batch('news', $news);
    }

    /**
     * 뉴스 중복 여부
     * @param string $uniqSeq
     * @return bool
     */
    function isDuplicated($uniqSeq)
    {
        $sql = "SELECT newsSeq  FROM news WHERE refSeq = ?";

        $query = $this->db->query($sql, [$this->db->escape($uniqSeq)]);

        return (($query->num_rows() > 0) ? true : false);
    }
}