<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blkpro_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->view('view');
    }
}