<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller
{
    public $css = '';
    public $js = '';
    public $allow = ['index', 'login', 'doLogin', 'signUp', 'doJoin'];

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['common', 'url']);
        $this->load->library('common');
    }

    /**
     * 메인 페이지
     */
    public function index()
    {
        $this->load->view('/board/index');
    }
}
