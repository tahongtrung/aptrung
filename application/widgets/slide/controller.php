<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slide_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $data = array();
        $this->load->model('f_homemodel');
        $data['slides'] = $this->f_homemodel->getSlider1(array(
            'type' => 'slide',
//            'lang' => $this->language
        ));
        //echo "<pre>";var_dump($data['slides']);
        $this->load->view('view',$data);
    }
}