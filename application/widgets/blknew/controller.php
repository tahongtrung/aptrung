<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blknew_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->view('view');
    }
}