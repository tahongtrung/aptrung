<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_comment');
        $this->load->library('pagination');
    }
    public function printer(){

    }
}