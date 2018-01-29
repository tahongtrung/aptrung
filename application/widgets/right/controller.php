<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Right_widget extends MY_Widget
{
    // Nhận 2 biến truyền vào
    function index(){
        $this->load->model('f_homemodel');
        $data['cat_new_home'] = $this->f_homemodel->GetData('news_category',array('hot'=>1,'lang'=>$this->language));
        $data['news_home'] = $this->f_homemodel->get_news(array('news.focus'=>1,'news.lang'=>$this->language),100,0);
        $data['supports'] = $this->f_homemodel->get_data('support_online',null);
        $data['promos'] = $this->f_homemodel->get_data('product',array(
            'hot' => 1
        ),array('id' => ''),9,0);
        $data['quangcao'] = $this->f_homemodel->get_data('images',array('type'=>'ads_right','lang'=>$this->language));
        //echo "<pre>";var_dump($data['newfocus']);die();
        $this->load->view('view',$data);
    }
}