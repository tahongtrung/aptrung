<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->model('f_homemodel');
        $data['partners'] = $this->f_homemodel->get_data('images',array(
            'type' => 'partners'
        ));
        
        $this->load->view('view',$data);
    }
}