<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index($content){
        $this->load->view('view', array(
            'supports' => $content));
    }
}