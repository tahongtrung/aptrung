<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blkcat_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        //$this->load->helper('webcounter_helper');
        $this->load->model('f_homemodel');
        $data['cate_news'] = $this->f_homemodel->get_data('news_category',array('lang'=>$this->language,'home'=>1));
        $data['newfocus'] = $this->f_homemodel->get_data('news',array('lang'=>$this->language,'focus'=>1));
        $data['supports'] = $this->f_homemodel->get_data('support_online',null);
        $data['doitac'] = $this->f_homemodel->get_data('images',array('type'=>'ads_right'));
        $data['product_focus']=$this->f_homemodel->get_data('product',array('focus'=>1,'lang'=>$this->language),1,0);
        //echo "<pre>";print_r($data['product_focus']);die();
        $data['cate_root'] = $this->f_homemodel->get_data('product_category',array('lang'=>$this->language,'parent_id'=>0,'home'=>1));
        $data['cate_sub'] = $this->f_homemodel->get_data('product_category',array('lang'=>$this->language,'parent_id !='=>0,'home'=>1));
        $data['cate_sub1'] = $this->f_homemodel->get_data('product_category',array('lang'=>$this->language,'parent_id !='=>0));
        /*echo "<pre>";print_r($data['cate_sub1']);die();*/
        $data['tags'] = $this->f_homemodel->get_data('product_tag',array());
        $this->load->view('view',$data);
    }
}