<?php

class Member extends CI_Model
{
	function __construct()
    {
		parent::__construct();
	}

    /**
     * 회원정보 저장
     * @param array $memberInfo
     */
	function insertMember($memberInfo)
    {
		return $this->db->insert('member', $memberInfo);
	}

    /**
     * 회원정보 중복 여부
     * @param string $type (memberId)
     * @param string $value
     * @return bool
     */
	function isDuplicated($type = 'memberId', $value)
    {
        $sql = "SELECT * FROM member WHERE ? = ?";

        $query = $this->db->query($sql, [
            $this->db->escape($type),
            $this->db->escape($value),
        ]);

        return (($query->num_rows() > 0) ? true : false);
    }

    /**
     * 회원 찾기
     * @param string $memberId
     * @param string $password
     * @return array
     */
    function findMember($memberId, $password)
    {
        $sql = "SELECT * FROM member WHERE memberId = ?";

        $query = $this->db->query($sql, [$memberId]);
        $member = $query->row_array();

        if($member === null) {
            return [
                'code' => -1,
                'message' => '존재하지 않는 아이디입니다'
            ];
        }

        if(!password_verify($password, $member['password'])) {
            return [
                'code' => -2,
                'message' => '비밀번호를 다시한번 확인해주세요'
            ];
        }

        return [
            'code' => 1,
            'message' => '',
            'result' => $member,
        ];
    }
}