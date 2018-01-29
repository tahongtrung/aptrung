<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contact_model');
    }
    //index
    public function index(){
        $data = array();
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
            $id=$this->contact_model->Add('contact',$arr);

            if($id){
                $config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'trantrung129@vnnetsoft.com', // change it to yours
                    'smtp_pass' => 'trungtrung129@@', // change it to yours
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'wordwrap'  => TRUE
                );
                $this->load->library('email', $config);
                $subject = 'Thông tin báo giá - '.$this->input->post('full_name');
                $message = '<p><h2>Kính gủi ban lãnh đạo CÔNG TY TNHH TDN VIỆT NAM!</h2></p>';
                $message .= '<p>Thông tin của khách hàng liên hệ như sau:</p>';
                $message .='<p>Họ và tên :'.$this->input->post('full_name').',<p>';
                $message .='<p>Số điện thoại :'.$this->input->post('phone').'</p>';
                $message .='<p>Email :'.$this->input->post('email').'</p>';
                $message .='<p>Địa chỉ :'.$this->input->post('address').'</p>';
                $message .='<p>Nội dung liên hệ</p>';
                $message .='<p>'.$this->input->post('comment').'</p>';
                // Get full html:
                $body =
                    '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
                        <style type="text/css">
                            body {
                                font-family: Arial, Verdana, Helvetica, sans-serif;
                                font-size: 16px;
                            }
                        </style>
                    </head>
                    <body>
                    ' . $message . '
                    </body>
                    </html>';

                $this->email->set_newline("\r\n");
                $this->email->from($this->input->post('email'),$this->input->post('full_name')); // change it to yours
                $this->email->to('congthanh@atsland.vn'); // change it to yours
                $this->email->subject($subject);
                $this->email->message($body);
                $this->email->send();
                $_SESSION['message']="Bạn đã gửi thông tin thành công!!!";
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['right'] = $this->load->widget('right');
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $site_name='Liên Hệ';
        $site_keyword='Liên Hệ';
        $site_description='';
        //$data['cates'] = $this->load->widget('blkcat');
        $seo = array(
            'title' => 'Liên Hệ'
        );
        $this->LoadHeader(null,$seo,true);
        $this->LoadLeft();
        $this->load->view('contact/view_contact',$data);
        $this->LoadFooter();
    }

}