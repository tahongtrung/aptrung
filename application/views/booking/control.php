<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_booking');
        $this->load->model('f_homemodel');
        $this->load->library('pagination');
        $this->load->model('contact_model');
    }
    public function book(){
        $data = array();
        $seo = array(
            'title' => 'Đặt phòng'
        );
        $data['cats'] = $this->f_homemodel->get_products(array(
            'product_category.hot' => 1,
            'product.lang' => $this->language
        ),10,0);
        $data['cat_id'] = $this->input->get('loaiphong');
        $data['item'] = $this->f_homemodel->getFirstRowWhere('product',array(
            'id' => $data['cat_id'],
            'lang' => $this->language
        ));
        $data['child'] = $this->input->get('child');
        $data['sophong'] = $this->input->get('sophong');
        $data['person'] = $this->input->get('person');
        $data['ngayden'] = $this->input->get('ngayden');
        $data['ngaydi'] = $this->input->get('ngaydi');
        $day = (strtotime($data['ngaydi']) - strtotime($data['ngayden']))/(60*60*24);
        for($i=1;$i<=4;$i++){
            $onceday = date('Y-m-d',strtotime($data['ngayden']) + ($i*60*60*24));
            //echo  jddayofweek($onceday,0);
            //echo $onceday."<br>";
        }
        echo jddayofweek($data['ngayden'],0);
        die();
        $this->LoadHeader('headers/view_header',$seo,true);
        $this->load->view('booking/view_book',$data);
        $this->LoadFooter();
    }
    public function addBooking(){
        $data = array();
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $note = $_POST['note'];
        $comment = $_POST['comment'];
        $ngaydi = $_POST['ngaydi'];
        $ngayden = $_POST['ngayden'];
        $loaiphong = $_POST['loaiphong'];
        $sophong = $_POST['sophong'];
        $person = $_POST['person'];
        $child = $_POST['child'];
        $check = false;
        $arr=array(
            'fullname' => $name,
            'address' => $address,
            //'user_id' => $userInfo->id,
            'code_sale' => $code,
            'phone' => $phone,
            'email' => $email,
            'other_note' => $note,
            'note' => $comment,
            'time' => time(),
        );
        $id=$this->m_booking->Add('order',$arr);
        if($id)
        {
            $check = true;
            $code = 'DH_'.date('d').$id;
            $this->m_booking->Update_where('order',array('id' => $id ),array('code' => $code));
            $detai_order=array(
                'order_id'=>$id,
                'item_id'=> $_POST['loaiphong'],
                'date_start' => $ngayden,
                'date_end'=> $ngaydi,
                'number'=> $sophong,
                'person' => $person,
                'child' => $child
            );
            $id_order_item=$this->m_booking->Add('order_item',$detai_order);
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
            $subject = $this->site_name.' - Thông tin đặt tour (Khách sạn)';
            $message = '<p><h1>Thông tin khách hàng đặt tua : </h1></p>';
            $message .= '<p><h3>Thông tin người đặt :</h3></p>';
            $message .= '<p><b>Họ tên :</b>'.$name.'</p>';
            $message .= '<p><b>Email :</b>'.$email.'</p>';
            $message .= '<p><b>Phone :</b>'.$phone.'</p>';
            $message .= '<p><b>Địa chỉ :</b>'.$address.'</p>';
            $message .= '<p><b>Nội dung :</b>'.$comment.'</p>';
            $message .= '<p><h3>Thông tin phòng :</h3></p>';
            $message .= '<p><b>Loại phòng :</b>'.$loaiphong.'</p>';
            $message .= '<p><b>Số lượng phòng :</b>'.$sophong.'<p>';
            $message .= '<p><b>Ngày đến :</b>'.$ngayden.'</p>';
            $message .= '<p><b>Ngày đi :</b>'.$ngaydi.'</p>';
            $message .= '<p><h4>Số người :</h4></p>';
            $message .= '<p><b>Người lớn:</b>'.$person.'</p>';
            $message .= '<p><b>Trẻ em :</b>'.$child.'<p>';
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
            $this->email->from($this->input->post('text_mail'),$this->site_name); // change it to yours
            //$this->email->from('dai.itbk@gmail.com','Dai Nguyen');
            $this->email->to('daibkz@gmail.com'); // change it to yours
            $this->email->subject($subject);
            $this->email->message($body);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <trantrung129@vnnetsoft.com>' . "\r\n";
            mail('daibkz@gmail.com', "$subject", $body,$headers);
            $_SESSION['message']="Bạn đã đăng ký thành công !!!";
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkCode()
    {
        $code = trim($_POST['cs']);
        $check = false;
        $item = $this->m_booking->getFirstRowWhere('code_sale',array(
            'code' => $code
        ));
        if(!empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function getModal()
    {
        $this->load->view('modal/view_dksd');
    }
}