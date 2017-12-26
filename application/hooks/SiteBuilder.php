<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteBuilder extends CI_Controller
{
	private $CI;

	public function __construct()
    {
		// & get_instance() : CI 내부 객체를 컨트롤러, 모델, 뷰 이외에서 사용할 수 있도록 하기 위함
		$this->CI =& get_instance();

		// Check if session lib is loaded or not
		if(!isset($this->CI->session)){
			$this->CI->load->library('session');
		}
	}

	public function loadHeader()
    {
        $memberId = $this->CI->session->userdata('memberId');

		$css = loadAssets([
		    // '/assets/css/site/style.css'
        ], 'css');
		$view = $this->CI->load->view('header', [
			'css' => $css,
            'memberId' => $memberId,
		], true);

		echo $view;
	}

	public function loadFooter()
    {
		$js = loadAssets([
			'/assets/js/jquery-3.2.0.js',
			'/assets/js/common.js'
		], 'js');
		$view = $this->CI->load->view('footer', [
			'js' => $js
		], true);

		echo $view;
	}

    public function checkPermission()
    {
        $this->CI->load->library('session');
        $this->CI->load->helper('url');

        if(isset($this->CI->allow) &&
           (is_array($this->CI->allow) === false ||
           in_array($this->CI->router->method, $this->CI->allow) === false))
        {
            if(!$this->CI->session->userdata('memberId')) {
                redirect('/login');
            }
        }
    }
}