<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blkbook_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->model('f_homemodel');
        $data = array();
        $data['cats'] = $this->f_homemodel->get_products(array(
            'product_category.hot' => 1,
            'product.lang' => $this->language
        ),10,0);
        //echo "<pre>";var_dump($data['cats']);die();
        $this->load->view('view',$data);
    }
}