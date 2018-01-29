<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
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
        $data['cat_id'] = $idType = $this->input->get('loaiphong');
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
        $prices = $this->f_homemodel->Get_where('pro_price',array(
            'item_id' => $idType
        ));
        $total = 0;
        if(count($prices))
        {
            for($i=1;$i<=$day;$i++){
                $onceday = date('w',strtotime($data['ngayden']) + ($i*60*60*24));

                foreach($prices as $price){
                    if((int)$price->day == (int)$onceday){
                        $total +=$price->price;
                    }
                }
            }
        }else{
            $total = $data['item']->price;
        }
        $data['nations'] = $this->f_homemodel->getList('gc_countries');
        //die();
        $data['total'] = $total * $data['sophong'];
        $this->LoadHeader('headers/view_header',$seo,true);
        $this->load->view('booking/view_book',$data);
        $this->LoadFooter();
    }
    public function caculatePrice()
    {
        $sophong = $_POST['sophong'];
        $loaiphong = $_POST['loaiphong'];
        $ngayden = $_POST['ngayden'];
        $ngaydi = $_POST['ngaydi'];
        $item = $this->f_homemodel->getFirstRowWhere('product',array(
            'id' => $loaiphong,
            'lang' => $this->language
        ));
        $day = (strtotime($ngaydi) - strtotime($ngayden))/(60*60*24);
        $prices = $this->f_homemodel->Get_where('pro_price',array(
            'item_id' => $loaiphong
        ));
        $total = 0;
        if(count($prices))
        {
            for($i=1;$i<=$day;$i++){
                $onceday = date('w',strtotime($ngayden) + ($i*60*60*24));

                foreach($prices as $price){
                    if((int)$price->day == (int)$onceday){
                        $total +=$price->price;
                    }
                }
            }
        }else{
            $total = $item->price;
        }
        $data['night'] = $day;
        $data['img'] = '<img src="'.base_url($item->image).'" alt="'.$item->name.'" style="width: 100%"/>';
        $data['total'] = number_format($total * $sophong);
        echo json_encode($data);
    }
    public function addBooking(){
        $data = array();
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $national = $_POST['national'];
        $comment = $_POST['comment'];
        $ngaydi = $_POST['ngaydi'];
        $ngayden = $_POST['ngayden'];
        $loaiphong = $_POST['loaiphong'];
        $sophong = $_POST['sophong'];
        $person = $_POST['person'];
        $child = $_POST['child'];
        $total       = str_replace(array(';','.',',',' '),'',$_POST['total']);
        $check = false;
        $item_code = $this->m_booking->getFirstRowWhere('code_sale',array(
            'code' => $code
        ));
        $code_sale  ='';
        $price_sale = 0;
        if(!empty($item_code)){
            $code_sale = $item_code->code;
            $price_sale = $item_code->price;
        }
        $arr=array(
            'fullname' => $name,
            'address' => $address,
            'code_sale' => $code_sale,
            'price_sale' => $price_sale,
            //'user_id' => $userInfo->id,
            'phone' => $phone,
            'email' => $email,
            'other_note' => $national,
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
                'child' => $child,
                'price' => $total
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
            $this->email->to(@$this->option->site_email); // change it to yours
            $this->email->subject($subject);
            $this->email->message($body);


            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <trantrung129@vnnetsoft.com>' . "\r\n";
            mail(@$this->option->site_email, "$subject", $body,$headers);


            $_SESSION['message']="Bạn đã đăng ký thành công !!!";
            if($this->language = 'vi'){$_SESSION['currentcy'] = 'vnđ';}else{$_SESSION['currentcy']='usd';}
            @$arr_sesion_bk=array(
                'payer_name' => $name,
                'payer_phone_no' => $phone,
                'payer_email' => $email,
                'address' => $address,
                'tongtienthanhtoan' => $total,
                'madon_hang' => $code,
            );
            @$madon_hang = @$code;
            $info_baokim = array(
                $data['madon_hang'] = $madon_hang,
                $payer_name = @$arr_sesion_bk['payer_name'],
                $payer_phone_no = @$arr_sesion_bk['payer_phone_no'],
                $payer_email = @$arr_sesion_bk['payer_email'],
                $address = @$arr_sesion_bk['address'],
                $total_amount = @$arr_sesion_bk['tongtienthanhtoan'],
                $madon_hang = @$arr_sesion_bk['madon_hang']
            );
            if (!array_key_exists($madon_hang,$info_baokim)) {
                $_SESSION['info_baokim'][$madon_hang]=$info_baokim;
            }
        }

        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkCode()
    {
        $code = trim($_POST['cs']);
        $price = str_replace(array(';','.',',',' '),'',$_POST['price']);
        $check = false;
        $item = $this->m_booking->getFirstRowWhere('code_sale',array(
            'code' => $code
        ));
        if(!empty($item)){
            $check = true;
            $total = $price - ($price * ($item->price/100));
        }else{
            $total = $price;
        }
        $data['check'] = $check;
        $data['total'] = number_format($total);
        echo json_encode($data);
    }
    public function getModal()
    {
        $this->load->view('modal/view_dksd');
    }
}