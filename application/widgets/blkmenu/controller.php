<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blkmenu_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $where = array(
            'position' => 'top',
            'lang' => $this->language
        );
        $data['menu_root'] = $this->f_homemodel->getMenuTopRoot($where);
        $data['menu_sub'] = $this->f_homemodel->getMenu_chil($where);
        $this->load->view('view',$data);
    }
}