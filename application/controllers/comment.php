<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('comment_model');
    }
    //index
    public function index(){
        if(isset($_POST['sendcontact'])){

            $arr=array('full_name' => $this->input->post('full_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'comment' => $this->input->post('comment'),
                'time' => time(),
            );
            $id=$this->comment_model->Add('contact',$arr);

            if($id){
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data['slide']=$this->comment_model->getBanner('banner',0);
        $data['slide_2']=$this->comment_model->getBanner('banner',1);


        $site_name='Góp ý Khách Hàng';
        $site_keyword='Góp ý Khách Hàng';
        $site_description='';

        $this->LoadHeader($site_name,$site_keyword,$site_description);
        $this->load->view('comment',$data);
        $this->LoadFooter();
    }

}