<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 검증 클래스
 */
class Validation
{
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    /**
     * 회원 아이디 검증
     * @param string $memberId : 영문(소문자)과 숫자를 포함한 4 ~ 13자
     * @return array
     */
    public function memberId($memberId)
    {
        $result = [
            'message' => '',
            'code' => 1,
        ];

        try {
            if(strlen($memberId) === 0) {
                throw new Exception('아이디를 입력 해 주세요', -1);
            }

            $pattern = '/^[a-z0-9]{4,13}$/';
            if(!preg_match($pattern, $memberId)) {
                throw new Exception('아이디는 영문(소문자), 숫자를 포함한 4 ~ 13자를 입력 해 주세요', -2);
            }

            // 중복 검사
            $this->CI->load->model('member');
            if($this->CI->member->isDuplicated('memberId', $memberId)) {
                throw new Exception('이미 존재하는 아이디 입니다. 다른 아이디를 입력 해 주세요', -3);
            }

        } catch(Exception $exception) {
            $result['message'] = $exception->getMessage();
            $result['code'] = $exception->getCode();

            return $result;
        }

        return $result;
    }

    /**
     * 비밀번호 검증
     * @param string $password : 최소 5자 이상
     * @return array
     */
    public function password($password)
    {
        $result = [
            'message' => '',
            'code' => 1,
        ];

        try {
            if(strlen($password) === 0) {
                throw new Exception('비밀번호를 입력 해 주세요', -1);
            }

            $pattern = '/^.{5,}$/';
            if(!preg_match($pattern, $password)) {
                throw new Exception('비밀번호는 5자 이상을 입력 해 주세요', -2);
            }

        } catch(Exception $exception) {
            $result['message'] = $exception->getMessage();
            $result['code'] = $exception->getCode();

            return $result;
        }

        return $result;
    }

    /**
     * 로그인 검증
     * @param string $memberId
     * @param string $password
     * @return array
     */
    public function login($memberId, $password)
    {
        $result = [
            'message' => '',
            'code' => 1,
            'result' => [],
        ];

        $memberId = trim($memberId);
        $password = trim($password);

        try {
            if(strlen($memberId) === 0) {
                throw new Exception('아이디를 입력 해 주세요', -1);
            }

            if(strlen($password) === 0) {
                throw new Exception('비밀번호를 입력 해 주세요', -2);
            }

            $this->CI->load->model('member');
            $results = $this->CI->member->findMember($memberId, $password);
            if($results['code'] !== 1) {
                throw new Exception($results['message'], -3);
            }

            $result['result'] = $results['result'];

        } catch(Exception $exception) {
            $result['message'] = $exception->getMessage();
            $result['code'] = $exception->getCode();

            return $result;
        }

        return $result;
    }
}
