<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counter_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->helper('webcounter_helper');
        $this->load->view('view');
    }
}