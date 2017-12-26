<?php

class Common {

	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function test() {
		echo 'asd';
	}
}