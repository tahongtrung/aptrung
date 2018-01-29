<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shoppingcart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('f_shoppingcartmodel');
        /*if(!isset($_SESSION))
        {
            session_start();
        }
        else
        {
            session_destroy();
            session_start();
        }*/
    }

    //index
    public function check_out()
    {
        $this->load->helper('model_helper');
        $this->load->helper('unlink');
        unlink_captcha($this->session->flashdata('sessionPathCaptchaPostAds'));
        #BEGIN: Create captcha post ads
        $this->load->library('captcha');
        $codeCaptcha = $this->captcha->code(6);
        $this->session->set_flashdata('sessionCaptchaPostAds', $codeCaptcha);
        $_SESSION['code'] = $codeCaptcha;
        $imageCaptcha = 'assets/captcha/'.md5(microtime()).'posa.jpg';
        $this->session->set_flashdata('sessionPathCaptchaPostAds', $imageCaptcha);
        $this->captcha->create($codeCaptcha, $imageCaptcha);
        if(file_exists($imageCaptcha))
        {
            $data['imageCaptchaPostAds'] = $imageCaptcha;
        }
        if(@$_POST['cart_token']){
            $arr=array(
                'fullname' => $this->input->post('fullname'),
                /*'province' => $this->input->post('province'),
                'district' => $this->input->post('district'),
                'ward' => $this->input->post('ward'),*/
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'note' => $this->input->post('note'),
                'time' => time(),
                /*'user_id' => $this->session->userdata('userid'),*/
            );

            $id=$this->f_shoppingcartmodel->Add('order',$arr);
            if($id)
            {

                $code = 'DH_'.date('d').$id;
                $this->f_shoppingcartmodel->Update_where('order',array(
                        'id' => $id
                    ),
                    array(
                        'code' => $code
                    )
                );
                $htm = '<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr><td>Stt</td><td>Tên sản phẩm</td>
                <td width="20%">Ảnh</td><td>Số lượng</td><td>Đơn giá(vnđ)</td><td>Thành tiền(vnđ)</td></tr></thead><tbody>';
                $subtotal = 0;
                $total = 0;
                $stt = 0;
                foreach($_SESSION['cart'] as $key => $tcat){
                    $stt ++;
                    $subtotal = $tcat['price']*$tcat['qty'];
                    $total +=$subtotal;
                    $htm .='<tr>';
                    $htm .='<td>'.($stt).'</td>';
                    $htm .='<td>'.$tcat['name'].'</td>';
                    $htm .='<td><img src="'.base_url($tcat['image']).'" width="100%">'.'</td>';
                    $htm .='<td>'.$tcat['qty'].'</td>';
                    $htm .='<td>'.number_format($tcat['price']).'</td>';
                    $htm .='<td>'.number_format($tcat['price']*$tcat['qty']).'</td>';
                    $htm .='</tr>';
                }
                $htm .='<tr><td colspan="5">Tổng tiền thanh toán là:'.number_format($total).'&nbsp;vnđ</td></tr>';
                $htm .='</tbody>';
                $htm .='</table>';
                $config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'web.hoatuoi123@gmail.com', // change it to yours
                    'smtp_pass' => 'guimailhoatuoi123', // change it to yours
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'wordwrap'  => TRUE
                );
                $this->load->library('email', $config);
                $subject = $this->site_name.' - Thông tin đặt hoa';
                $message = '<p><h1>Thông tin khách hàng đặt hoa : </h1></p>';
                $message .= '<p><h3><u>Thông tin người gửi :</u></h3></p>';
                $message .= '<p><b>Họ tên người gửi :</b>'.$this->input->post('fullname');
                $message .= '<p><b>Số điện thoại người gửi :</b>'.$this->input->post('phone').'</p>';
                $message .= '<p><b>Email :</b>'.$this->input->post('email').'</p>';
                $message .= '<p><h3><u>Thông tin người nhận :</u></h3></p>';
                $message .= '<p><b>Họ tên người nhận :</b>'.$this->input->post('name_get').'</p>';
                $message .= '<p><b>Số điện thoại người nhận :</b>'.$this->input->post('phone_person_get').'</p>';
                $message .= '<p><b>Địa chỉ người nhận :</b>'.$this->input->post('address').'</p>';
                $message .= '<p><b>Nội dung :</b>'.$this->input->post('note').'</p>';
                $message .= '<p><h3>Thông tin đơn hàng :</h3></p>';
                $message .= $htm;
                $message .= '<p>The end !</p>';
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
                $this->email->from('dai.itbk@gmail.com',$this->site_name); // change it to yours
                //$this->email->from('dai.itbk@gmail.com','Dai Nguyen');
                $this->email->to(@$this->option->site_email); // change it to yours
                $this->email->subject($subject);
                $this->email->message($body);
                //$this->email->send();
                //$admin_email = "trantrung129@gmail.com";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <web.hoatuoi123@gmail.com>' . "\r\n";
                /*$headers .= 'Cc: myboss@example.com' . "\r\n";*/
                mail(@$this->option->site_email, "$subject", $body,$headers);
            }
            foreach ($_SESSION['cart'] as $v) {
                $detai_order=array(
                    'order_id'=>$id,
                    'item_id'=>$v['rowid'],
                    'count'=>$v['qty'],
                    'price'=>$v['price'],
                    //'address'=>$v['address'],
                    /* 'color'=>$_POST['color'][$i],
                     'size'=>$_POST['size'][$i],*/
                );
                /*$this->f_shoppingcartmodel->Update('product',$temp_item->id,array(
                                                                                 'bought' => $buyted
                                                                            ));*/
                $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
            }
            unset($_SESSION['cart']);
            redirect(base_url('thanh-toan-dat-hang'));
        }

        $data['cart'] = @$_SESSION['cart'];
        $count        = 0;
        $total        = 0;
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $v) {
                $count += $v['qty'];
                $total += ($v['qty'] * $v['price_sale']);
            }
        }

        $data['count'] = $count;
        $data['total'] = $total;
        $data['fullname'] = $this->session->userdata('fullname');
        $data['user_mail'] = $this->session->userdata('usermail');
        $data['shipping'] =  $this->f_shoppingcartmodel->getFirstRowWhere('site_option');
        $data['user'] =  $this->f_shoppingcartmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
//        $data['province'] =  $this->f_shoppingcartmodel->GetData('province',null,null);

        $data['shopad'] =  $this->f_shoppingcartmodel->get_data('shop_address');
        if(!empty($data['user']->province))
        {
            $data['district'] = $this->f_homemodel->Get_where('district',array(
                'provinceid' => $data['user']->province
            ));
        }
        if(!empty($data['user']->district))
        {
            $data['ward'] = $this->f_homemodel->Get_where('ward',array(
                'districtid' => $data['user']->district
            ));
        }
        $seo = array(
            'title' => 'Giỏ hàng'
        );
        $data['banners'] = $this->f_homemodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        //$data['slidebar'] = $this->load->widget('blkcat');
        $this->LoadHeader(null,$seo,false);
        $this->load->view('carts/shoppingcart_checkout', $data);
        $this->LoadFooter();
    }
    public function quickbuy()
    {
        if(isset($_POST['sendcart'])){
            $arr = array(
                'fullname' => $this->input->post('fullname'),
                'phone'    => $this->input->post('phone'),
                'address'  => $this->input->post('address'),
                'note'     => $this->input->post('note'),
                'email'     => $this->input->post('email'),
                'name_get' => $this->input->post('name_get'),
                'phone_get' => $this->input->post('phone_get'),
                'time' => time(),
            );
            //echo "<pre>";var_dump($arr);die();
            $id=$this->f_shoppingcartmodel->Add('order',$arr);
        }
        if($id)
        {
            $_SESSION['mss_success']='Cảm ơn bạn! Đơn hàng của bạn đã được gửi đi !!!';
            $code = 'DH_'.date('d').$id;
            $_SESSION['madonhang'] = $code;
            $this->f_shoppingcartmodel->Update_where('order',array(
                    'id' => $id
                ),
                array(
                    'code' => $code
                )
            );
            //var_dump($this->input->post('quantity'));die();
            $detai_order=array(
                'order_id'=>$id,
                'item_id'=> $this->input->post('pro_id'),
                'count'=>  $this->input->post('quantity'),
                'price'=>  $this->input->post('price')
            );
            $tcat = $this->f_shoppingcartmodel->getFirstRowWhere('product',array(
                'id' => $this->input->post('pro_id')
            ));
            //var_dump($detai_order);die();
            $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
            $htm = '<table width="100%" border="1" cellpadding="0" cellspacing="0"><thead><tr><td>Stt</td><td>Tên sản phẩm</td>
                <td width="20%">Ảnh</td><td>Số lượng</td><td>Đơn giá(vnđ)</td><td>Thành tiền(vnđ)</td></tr></thead><tbody>';
            /*$subtotal = 0;
            $total = 0;
            $stt = 0;*/
            /*foreach($_SESSION['cart'] as $key => $tcat){
                $stt ++;
                $subtotal = $tcat['price']*$tcat['qty'];
                $total +=$subtotal;
                $htm .='<tr>';
                $htm .='<td>'.($stt).'</td>';
                $htm .='<td>'.$tcat['name'].'</td>';
                $htm .='<td>'.$tcat['qty'].'</td>';
                $htm .='<td>'.number_format($tcat['price']).'</td>';
                $htm .='<td>'.number_format($tcat['price']*$tcat['qty']).'</td>';
                $htm .='</tr>';
            }*/
            /*$subtotal = $tcat['price']*$tcat['qty'];
            $total +=$subtotal;*/
            $htm .='<tr>';
            $htm .='<td>1</td>';
            $htm .='<td>'.$tcat->name.'</td>';
            $htm .= '<td><img src="'.base_url($tcat->image).'" width="100%">'.'</td>';
            $htm .='<td>'.$this->input->post('quantity').'</td>';
            $htm .='<td>'.number_format($this->input->post('price')).'</td>';
            $htm .='<td>'.number_format($this->input->post('price')).'</td>';
            $htm .='</tr>';
            $htm .='<tr><td colspan="5">Tổng tiền thanh toán là:'.number_format($this->input->post('price')).'&nbsp;vnđ</td></tr>';
            $htm .='</tbody>';
            $htm .='</table>';
            $config = Array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'web.hoatuoi123@gmail.com', // change it to yours
                'smtp_pass' => 'guimailhoatuoi123', // change it to yours
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'wordwrap'  => TRUE
            );
            $this->load->library('email', $config);
            $subject = $this->site_name.' - Thông tin đặt hoa';
            $message = '<p><h1>Thông tin khách hàng đặt hoa : </h1></p>';
            $message .= '<p><h3><u>Thông tin người gửi :</u></h3></p>';
            $message .= '<p><b>Họ tên người gửi :</b>'.$this->input->post('fullname');
            $message .= '<p><b>Số điện thoại người gửi :</b>'.$this->input->post('phone').'</p>';
            $message .= '<p><b>Email :</b>'.$this->input->post('email').'</p>';
            $message .= '<p><h3><u>Thông tin người nhận :</u></h3></p>';
            $message .= '<p><b>Họ tên người nhận :</b>'.$this->input->post('name_get').'</p>';
            $message .= '<p><b>Số điện thoại người nhận :</b>'.$this->input->post('phone_get').'</p>';
            $message .= '<p><b>Địa chỉ người nhận :</b>'.$this->input->post('address').'</p>';
            $message .= '<p><b>Nội dung :</b>'.$this->input->post('note').'</p>';
            $message .= '<p><h3>Thông tin đơn hàng :</h3></p>';
            $message .= $htm;
            $message .= '<p>The end !</p>';
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
            $this->email->from('dai.itbk@gmail.com',$this->site_name); // change it to yours
            //$this->email->from('dai.itbk@gmail.com','Dai Nguyen');
            $this->email->to(@$this->option->site_email); // change it to yours
            $this->email->subject($subject);
            $this->email->message($body);
            //$this->email->send();
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <web.hoatuoi123@gmail.com>' . "\r\n";
            /*$headers .= 'Cc: myboss@example.com' . "\r\n";*/
            mail(@$this->option->site_email, "$subject", $body,$headers);
        }
        /*redirect(base_url('thanh-toan-dat-hang'));*/
        redirect($_SERVER['HTTP_REFERER']);
    }
    public  function Payment(){
        $seo = array(
            'title' => 'Thanh toán đặt hàng'
        );
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['banners'] = $this->f_shoppingcartmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $this->LoadHeader(null, $seo,true);
        //$this->LoadLeft();
        $this->load->view('carts/payment',$data);
        $this->LoadFooter();
    }
    //ajax
    public function add_cart()
    {
        $id=$this->input->get('id');
        $quantity = (int)$this->input->get('quantity');
        if($quantity < 1 || !is_numeric($quantity))
        {
            $quantity = 1;
        }
        $row = $this->f_shoppingcartmodel->get_data('product', array('id' => $id),array(),true);
        if(isset($row->price_sale)&&$row->price_sale !='')
        {
            $t_price = $row->price_sale;
        }else{
            $t_price = $row->price;
        }
        $cart_id=str_replace('#','-',$id);
//        print_r($row); die($id);

        $_SESSION['messege']='';
        $rs['status']=false;

        if (!empty($_SESSION['cart'])&&isset($_SESSION['cart'][$cart_id])&&in_array($_SESSION['cart'][$cart_id], $_SESSION['cart'])) {
            $old = $_SESSION['cart'][$cart_id];

            $_SESSION['cart'][$cart_id] = array(
                'rowid' => $id,
                'pro_dir' => $row->pro_dir,
                'name'  => $row->name,
                'qty'   => ($old['qty'] + $quantity),
                'price_sale' => $row->price_sale,
                'image' => $row->image,
            );
            $_SESSION['messege']='Sản phẩm đã cập nhật vào giỏ hàng của bạn!';
            $rs['status']=true;

        } else {
            $_SESSION['cart'][$cart_id] = array(
                'rowid' => $id,
                'name'  => $row->name,
                'qty'   => $quantity,
                'pro_dir' => $row->pro_dir,
                'price_sale' => $row->price_sale,
                'image' => $row->image,
            );
            $_SESSION['messege']='Sản phẩm đã thêm vào giỏ hàng của bạn!';
            $rs['status']=true;
        }
        $count = 0;
        foreach ($_SESSION['cart'] as $v) {
            $count += $v['qty'];
        }
        $rs['count']      = $count;
        $rs['mess']=$_SESSION['messege'];
        //echo  json_encode($rs);
        /*redirect($_SERVER['HTTP_REFERER']);*/
        redirect(base_url('gio-hang'));
    }

    public function add_cart2($id)
    {
        /*//du lieu luu vao gio hang
        $cart = array(
            array ('id'    => $row->id,
                   'qty'   => 1,
                   'price' => $row->price,
                   'name'  => $row->name) ,
        );
        //goi phương thức thêm vào giỏ hàng
        $this->cart->insert($cart);*/

        $row = $this->f_shoppingcartmodel->getFirstRowWhere('product', array('id' => $id));

        if (!empty($_SESSION['cart'])) {
            if(in_array($_SESSION['cart'][$id], $_SESSION['cart'])){
                $old = ($_SESSION['cart'][$id]);

                $_SESSION['cart'][$id] = array(
                    'rowid' => $id,
                    'name'  => $row->name,
                    'qty'   => ($old['qty'] + 1),
                    'price_sale' => $row->price_sale,
                    'image' => $row->image,
                );
            }

        } else {
            $_SESSION['cart'][$id] = array(
                'rowid' => $id,
                'name'  => $row->name,
                'qty'   => 1,
                'price_sale' => $row->price_sale,
                'image' => $row->image,
            );
        }
//            print_r($_SESSION['cart']);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_cart()
    {
        if (isset($_POST['id']) && isset($_POST['qty'])) {
            $old = $_SESSION['cart'][$_POST['id']];
            $new                            = array(
                'rowid' => $old['rowid'],
                'name'  => $old['name'],
                'pro_dir' => $old['pro_dir'],
                'qty'   => $_POST['qty'],
                'price_sale' => $old['price_sale'],
                'image' => $old['image'],
            );
            $_SESSION['cart'][$_POST['id']] = $new;


            $count = 0;
            $total = 0;
            foreach ($_SESSION['cart'] as $v) {
                $count += $v['qty'];
                $total += ($v['qty'] * $v['price_sale']);
            }
            $data['count']      = $count;
            $data['total']      = $total;
            $data['item_price'] = $old['price_sale'];
            $data['item_total'] = $old['price_sale'] * $_POST['qty'];
            echo json_encode($data);
        }


//            redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id)
    {
        unset($_SESSION['cart'][$id]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function destroy_cart()
    {
        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }
        redirect(base_url());
    }

    public function getdistric()
    {
        if (isset($_POST['id'])) {
            $list        = $this->f_shoppingcartmodel->Get_where('district', array('provinceid' => $_POST['id']));
            echo json_encode($list);
        }
    }

    public function getward()
    {
        if (isset($_POST['id'])) {
            $list        = $this->f_shoppingcartmodel->Get_where('ward', array('districtid' => $_POST['id']));
            echo json_encode($list);
        }
    }

    public function cartInfo()
    {
        $data = array();
        $title=@$data['pro_first']->name;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('cart_info',$data);
        $this->LoadFooter();
    }
    public  function order_payment(){
        $check_cart = @$_SESSION['cart'];
        if($check_cart == null){
            redirect(base_url());
        }
        $this->load->helper('model_helper');
        if(isset($_POST['sendcart'])){
            $arr=array(
                'fullname' => $this->input->post('fullname'),
                'address' => $this->input->post('address'),
                'user_id' => $this->input->post('user_id'),
                'total_price' => $this->input->post('total_price_add'),
                'code_sale' => $this->input->post('code_sale_all'),
                'price_ship' => $this->input->post('price_ship'),
                'province' => $this->input->post('province'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'note' => $this->input->post('note'),
                'time' => time(),
                'user_id' => $this->session->userdata('userid'),
            );
            $id=$this->f_shoppingcartmodel->Add('order',$arr);
            if($id)
            {
                $code = 'DH_'.date('d').$id;
                $this->f_shoppingcartmodel->Update_where('order',array('id' => $id ),array('code' => $code));
            }
            for($i=0; $i< sizeof($_POST['item_id']);$i++){
                $temp_item = $this->f_shoppingcartmodel->getFirstRowWhere('product',array('id'=>$_POST['item_id'][$i]));
                $buyted = $temp_item->bought + 1;
                $detai_order=array(
                    'order_id'=>$id,
                    'item_id'=>$_POST['item_id'][$i],
                    'count'=>$_POST['count'][$i],
                    'price_sale'=>$_POST['price_sale'][$i],
                    /* 'color'=>$_POST['color'][$i],
                     'size'=>$_POST['size'][$i],*/
                );
                $this->f_shoppingcartmodel->Update('product',$temp_item->id,array(
                    'bought' => $buyted
                ));
                $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
            }


            if($id){
                @$province = $this->f_shoppingcartmodel->getFirstRowWhere('province',array('provinceid'=>$this->input->post('province')));
                @$district = $this->f_shoppingcartmodel->getFirstRowWhere('district',array('districtid'=>$this->input->post('district')));
                @$ward = $this->f_shoppingcartmodel->getFirstRowWhere('ward',array('wardid	'=>$this->input->post('ward')));
                $this->load->library('email', @$config);
                $htm = '<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#caf6ea">
                            <thead>
                            <tr style="background:#92ddc9">
                                <td>Stt</td>
                                <td>Tên sản phẩm</td>
                                <td>Số lượng</td>
                                <td>Đơn giá(vnđ)</td>
                                <td>Thành tiền(vnđ)</td>
                            </tr>
                            </thead>
                            <tbody>';
                $subtotal = 0;
                $totals = 0;
                $tongtien = 0;
                $stt = 0;

                foreach($_SESSION['cart'] as $key => $tcat){
                    $stt ++;
                    $subtotal = $tcat['price_sale']*$tcat['qty'];
                    $code_sale = $this->input->post('code_sale_all');
                    $price_ship = $this->input->post('price_ship');
                    $total_sale= $subtotal*$code_sale/100;

                    $tongtien += $subtotal-$total_sale;
                    $totals += $subtotal-$total_sale ;
                    $htm .='<tr>';
                    $htm .='<td>'.($stt).'</td>';
                    $htm .='<td>'.$tcat['name'].'<br>';
//                    $htm .=$tcat['color']=='0'?'':'<div style="padding: 0px 5px ; float: left">Màu:</div> <div style="background:'.$tcat['color'].';width: 20px; height:20px;float:left; border:1px #ddd solid "></div> ';
//                    $htm .=$tcat['size']=='0'?'':'<div style="padding: 0px 5px ; float: left">Size:</div> <div style="">'.$tcat['size'].'</div> ';
                    $htm .='</td>';
                    $htm .='<td>'.$tcat['qty'].'</td>';
                    $htm .='<td>'.number_format($tcat['price_sale']).'</td>';
                    $htm .='<td>'.number_format($tcat['price_sale']*$tcat['qty']).'</td>';
                    $htm .='</tr>';
                }

                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Mã giảm giá: -'.$this->input->post('code_sale_all').'%</span></td></tr>';
                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Tổng tiền đơn hàng:'.number_format($tongtien).'&nbsp;vnđ</span></td></tr>';
                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Phí vận chuyển:'.number_format($price_ship).'&nbsp;vnđ</span></td></tr>';
                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Tổng tiền thanh toán là:'.number_format($totals + $this->input->post('price_ship')).'&nbsp;vnđ</span></td></tr>';
                $htm .='</tbody>';
                $htm .='</table>';


                $subject = $this->site_name.' - Thông tin đặt hàng';
                $img ='<p><img src="'.base_url(@$this->option->site_logo).'" alt=""/></p>';
                $img_footer ='<p style="float: right" class="pull-right"><img src="'.base_url(@$this->option->site_logo).'" alt=""/></p>';

                $message = '';
                $message .= $img;
                $message .= '<p><h2 style="color: green">EMAIL XÁC NHẬN ĐƠN HÀNG !</h2></p>';
                $message .='<p>Kính chào &nbsp;'.$this->input->post('fullname').',<p>';
                $message .='<p>'.@$this->option->site_name.' đã nhận được đơn đặt hàng của Qúy khách:<p></br>';

                $message .='<b>Thông tin khách hàng:</b></br>';
                $message .='<p>Họ tên:'.$this->input->post('fullname').'<p></br>';
                $message .='<p>Điện thoại:'.$this->input->post('phone').'<p></br>';
                $message .='<p>Địa chỉ nhận hàng:'.$this->input->post('address').'<p></br>';

                $message .='<p>Quí khách vui lòng thanh toán <span style="color:red">'.number_format($totals + $this->input->post('price_ship')).'vnđ</span>&nbsp;khi nhận hàng.</p>';
                $message .= '<p><b>Mã đơn hàng: </b>'.$code.'</p>';
                $message .='<p>Tình trạng : Chưa thanh toán.</p>';
                $message .='<p><b>Chi tiết đơn hàng :</b></p>';
                $message .=$htm;

                $message .='<br>Địa chỉ :&nbsp;&nbsp;'.$this->input->post('address').',&nbsp;'.@$ward->name.',&nbsp;'.@$district->name.'</p>';
                $message .='<p style="border: 1px solid #e7d17a;padding: 8px">Ngoài hình thức thanh toán và giao hàng tận nơi, Quí khách có thể đến văn
                    phòng giao dịch của '.@$this->option->site_name.' tại Hà Nội để thanh toán<br>';
                $message .=$this->address.'</p>';
                $message .='<p>Nếu quí khách cần hỗ trợ, vui lòng gọi <span style="color:red">'.@$this->option->hotline1.'</span> hoặc gửi đến mail :'.@$this->option->site_email.'</p>';
                $message .='<p>Cảm ơn quí khách đã mua sắm trên '.@$this->option->site_name.'</p>';
                $message .='<p><br><br><br>(<span style="color:red">*</span>)Đây là mail hệ thống tự động gửi, vui lòng không trả lời (Reply) lại mail này.</p>';
                $message .=$img_footer;
                // Get full html:
                $body ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                //$this->email->send();
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <trantrung129@vnnetsoft.com>' . "\r\n";
                /*$headers .= 'Cc: myboss@example.com' . "\r\n";*/
                //mail($this->input->post('email'), "$subject", $body,$headers);
                mail(@$this->option->site_email, "$subject", $body,$headers);
               /* mail('ductm@bnfvietnam.vn', "$subject", $body,$headers);
                mail('lannguyen@bnfvietnam.vn', "$subject", $body,$headers);
                mail('toannguyentqvn@gmail.com', "$subject", $body,$headers);*/
                $_SESSION['message']="Bạn đã đặt hàng thành công !";

                if(isset($_SESSION['cart'])){
                    unset($_SESSION['cart']);
                }
            }
            redirect(base_url('thanh-toan-dat-hang'));
            if(isset($_SESSION['cart'])){
                unset($_SESSION['cart']);
            }
        }
        $data['cart'] = @$_SESSION['cart'];
        $count        = 0;
        $total        = 0;
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $v) {
                $count += $v['qty'];
                $total += ($v['qty'] * $v['price_sale']);
            }
        }

        $data['count'] = $count;
        $data['total'] = $total;
        $data['fullname'] = $this->session->userdata('fullname');
        $data['user_mail'] = $this->session->userdata('usermail');
        $data['shipping'] =  $this->f_shoppingcartmodel->GetData('shipping');
        $data['user'] =  $this->f_shoppingcartmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
        $data['province'] =  $this->f_shoppingcartmodel->GetData('province',null,null);
        $data['product_cats']=$this->f_shoppingcartmodel->get_data('product_category',array('home' => 1));
        $data['last_news']=$this->f_shoppingcartmodel->get_data('news',array(),array('id'=>1),4 );
        $data['user_item'] = $this->f_shoppingcartmodel->getFirstRowWhere('users',array(
            'id' => $this->session->userdata('userid')
        ));
        //echo "<pre>";var_dump($this->session->userdata('userid'));die();
        if(!empty($data['user_item']->province))
        {
            $data['district'] = $this->f_homemodel->Get_where('district',array(
                'provinceid' => $data['user']->province
            ));
        }
        if(!empty($data['user_item']->district))
        {
            $data['ward'] = $this->f_homemodel->Get_where('ward',array(
                'districtid' => $data['user']->district
            ));
        }
        $data['banners'] = $this->f_homemodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $seo=array(
            'title'=>'Thanh toán đặt hàng',
            'description'=>'Thanh toán đặt hàng',
            'keyword'=>'Thanh toán đặt hàng',
            'type'=>'products');
//        $this->LoadHeader($this->site_name, $this->site_keyword, $this->site_description);
        $this->LoadHeader(null,$seo);
        $this->load->view('carts/order_payment', $data);
//        $this->load->view('shoppingcart_checkout', $data);
        $this->LoadFooter();
    }
    public  function order_baokim(){
        $this->load->helper('model_helper');
        if(isset($_POST['sendcart_bk'])){
            $arr=array(
                'fullname' => $this->input->post('payer_name'),
                'address' => $this->input->post('address_hidden'),
                'user_id' => $this->input->post('user_id'),
                'total_price' => $this->input->post('total_amount'),
                'code_sale' => $this->input->post('code_sale_all_hidden'),
                'price_ship' => $this->input->post('price_ship_hidden'),
                'province' => $this->input->post('province'),
                'phone' => $this->input->post('payer_phone_no'),
                'email' => $this->input->post('payer_email'),
                'note' => $this->input->post('note_hidden'),
                'time' => time(),
                'user_id' => $this->session->userdata('userid'),
            );

            $id=$this->f_shoppingcartmodel->Add('order',$arr);
            if($id)
            {
                $code = 'DH_'.date('d').$id;
                $this->f_shoppingcartmodel->Update_where('order',array('id' => $id ),array('code' => $code));
            }
            $madon_hang = $code;
            @$arr_sesion_bk=array(
                'payer_name' => $this->input->post('payer_name'),
                'payer_phone_no' => $this->input->post('payer_phone_no'),
                'payer_email' => $this->input->post('payer_email'),
                'address' => $this->input->post('address_hidden'),
                'tongtienthanhtoan' => $this->input->post('total_amount'),
                'madon_hang' => $madon_hang,
            );
            for($i=0; $i< sizeof($_POST['item_id']);$i++){
                $temp_item = $this->f_shoppingcartmodel->getFirstRowWhere('product',array('id'=>$_POST['item_id'][$i]));
                $buyted = $temp_item->bought + 1;
                $detai_order=array(
                    'order_id'=>$id,
                    'item_id'=>$_POST['item_id'][$i],
                    'count'=>$_POST['count'][$i],
                    'price_sale'=>$_POST['price_sale'][$i],
                    /* 'color'=>$_POST['color'][$i],
                    'size'=>$_POST['size'][$i],*/
                );
                $this->f_shoppingcartmodel->Update('product',$temp_item->id,array(
                    'bought' => $buyted
                ));
                $id_order_item=$this->f_shoppingcartmodel->Add('order_item',$detai_order);
            }
            if($id){
                @$province = $this->f_shoppingcartmodel->getFirstRowWhere('province',array('provinceid'=>$this->input->post('province')));
                @$district = $this->f_shoppingcartmodel->getFirstRowWhere('district',array('districtid'=>$this->input->post('district')));
                @$ward = $this->f_shoppingcartmodel->getFirstRowWhere('ward',array('wardid	'=>$this->input->post('ward')));
                $this->load->library('email', @$config);
                $htm = '<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#caf6ea">
    <thead>
    <tr style="background:#92ddc9">
        <td>Stt</td>
        <td>Tên sản phẩm</td>
        <td>Số lượng</td>
        <td>Đơn giá(vnđ)</td>
        <td>Thành tiền(vnđ)</td>
    </tr>
    </thead>
    <tbody>';
                $subtotal = 0;
                $totals = 0;
                $tongtien = 0;
                $stt = 0;

                foreach($_SESSION['cart'] as $key => $tcat){
                    $stt ++;
                    $subtotal = $tcat['price_sale']*$tcat['qty'];
                    $code_sale = $this->input->post('code_sale_all_hidden');
                    $price_ship = $this->input->post('price_ship_hidden');
                    $total_sale= $subtotal*$code_sale/100;
                    $tongtien += $subtotal-$total_sale;
                    $totals += $subtotal-$total_sale ;
                    $htm .='<tr>';
                    $htm .='<td>'.($stt).'</td>';
                    $htm .='<td>'.$tcat['name'].'<br>';
                    $htm .='</td>';
                    $htm .='<td>'.$tcat['qty'].'</td>';
                    $htm .='<td>'.number_format($tcat['price_sale']).'</td>';
                    $htm .='<td>'.number_format($tcat['price_sale']*$tcat['qty']).'</td>';
                    $htm .='</tr>';
                }

                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Mã giảm giá: -'.$this->input->post('code_sale_all_hidden').'%</span></td></tr>';
                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Tổng tiền đơn hàng:'.number_format($tongtien).'&nbsp;vnđ</span></td></tr>';
                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Phí vận chuyển:'.number_format(@$price_ship).'&nbsp;vnđ</span></td></tr>';
                $htm .='<tr><td colspan="5" align="right"><span style="color:red">Tổng tiền thanh toán là:'.number_format($totals + $this->input->post('price_ship_hidden')).'&nbsp;vnđ</span></td></tr>';
                $htm .='</tbody>';
                $htm .='</table>';
                $subject = $this->site_name.' - Thông tin đặt hàng';
                $img ='<p><img src="'.@$this->option->site_logo.'" alt=""/></p>';
                $img_footer ='<p style="float: right" class="pull-right"><img src="'.base_url(@$this->option->site_logo).'" alt=""/></p>';
                $message = '';
                $message .= $img;
                $message .= '<p><h2 style="color: green">EMAIL XÁC NHẬN ĐƠN HÀNG !</h2></p>';
                $message .='<p>Kính chào &nbsp;'.$this->input->post('fullname').',<p>';
                $message .='<p>'.@$this->option->site_name.' đã nhận được đơn đặt hàng của Qúy khách:<p></br>';

                $message .='<b>Thông tin khách hàng:</b></br>';
                $message .='<p>Họ tên:'.$this->input->post('payer_name').'<p></br>';
                $message .='<p>Điện thoại:'.$this->input->post('payer_phone_no').'<p></br>';
                $message .='<p>Địa chỉ nhận hàng:'.$this->input->post('address_hidden').'<p></br>';

                $message .='<p>Quí khách vui lòng thanh toán <span style="color:red">'.number_format($totals + $this->input->post('price_ship_hidden')).'vnđ</span>&nbsp;khi nhận hàng.</p>';
                $message .= '<p><b>Mã đơn hàng: </b>'.$code.'</p>';
//                $message .='<p>Tình trạng : Đã thanh toán.</p>';
                $message .='<p><b>Chi tiết đơn hàng :</b></p>';
                $message .=$htm;

                $message .='<br>Địa chỉ :&nbsp;&nbsp;'.$this->input->post('address_hidden').',&nbsp;'.@$ward->name.',&nbsp;'.@$district->name.'</p>';
                $message .='<p style="border: 1px solid #e7d17a;padding: 8px">Ngoài hình thức thanh toán và giao hàng tận nơi, Quí khách có thể đến văn
    phòng giao dịch của '.@$this->option->site_name.' tại Hà Nội để thanh toán<br>';
                $message .=$this->address.'</p>';
                $message .='<p>Nếu quí khách cần hỗ trợ, vui lòng gọi <span style="color:red">'.@$this->option->hotline1.'</span> hoặc gửi đến mail :'.@$this->option->site_email.'</p>';
                $message .='<p>Cảm ơn quí khách đã mua sắm trên '.@$this->option->site_name.'</p>';
                $message .='<p><br><br><br>(<span style="color:red">*</span>)Đây là mail hệ thống tự động gửi, vui lòng không trả lời (Reply) lại mail này.</p>';
                $message .=$img_footer;
// Get full html:
                $body ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
//$this->email->send();
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
                $headers .= 'From: <trantrung129@vnnetsoft.com>' . "\r\n";
               // mail($this->input->post('email'), "$subject", $body,$headers);
                mail(@$this->option->site_email, "$subject", $body,$headers);
                /*mail('ductm@bnfvietnam.vn', "$subject", $body,$headers);
                mail('lannguyen@bnfvietnam.vn', "$subject", $body,$headers);
                mail('toannguyentqvn@gmail.com', "$subject", $body,$headers);*/
                $_SESSION['message']="Bạn đã đặt hàng thành công !";
                if(isset($_SESSION['cart'])){
                    unset($_SESSION['cart']);
                }
            }
//            redirect(base_url('thanh-toan-dat-hang'));
            if(isset($_SESSION['cart'])){
                unset($_SESSION['cart']);
            }
        }
        @$madon_hang = @$madon_hang;
        $info_baokim = array(
            $data['madon_hang'] = $madon_hang,
            $payer_name = @$arr_sesion_bk['payer_name'],
            $payer_phone_no = @$arr_sesion_bk['payer_phone_no'],
            $payer_email = @$arr_sesion_bk['payer_email'],
            $address = @$arr_sesion_bk['address'],
            $total_amount = @$arr_sesion_bk['tongtienthanhtoan'],
            $madon_hang = @$arr_sesion_bk['madon_hang']
        );
        $_SESSION['info_baokim'] = '';
        if (!array_key_exists($madon_hang,$info_baokim)) {
            $_SESSION['info_baokim'][$madon_hang]=$info_baokim;
        }
        $data['list_info_baokim']=$_SESSION['info_baokim'];
//        echo'<pre>';
//        print_r($data['list_info_baokim']);
//
        $data['cart'] = @$_SESSION['cart'];
        $count        = 0;
        $total        = 0;
        if(isset($_SESSION['cart'])){
            foreach ($_SESSION['cart'] as $v) {
                $count += $v['qty'];
                $total += ($v['qty'] * $v['price_sale']);
            }
        }

        $data['count'] = $count;
        $data['total'] = $total;
        $data['fullname'] = $this->session->userdata('fullname');
        $data['user_mail'] = $this->session->userdata('usermail');
        $data['shipping'] =  $this->f_shoppingcartmodel->GetData('shipping');
        $data['user'] =  $this->f_shoppingcartmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
        $data['province'] =  $this->f_shoppingcartmodel->GetData('province',null,null);
        $data['product_cats']=$this->f_shoppingcartmodel->get_data('product_category',array('home' => 1));
        $data['last_news']=$this->f_shoppingcartmodel->get_data('news',array(),array('id'=>1),4 );

        if(!empty($data['user']->province))
        {
            $data['district'] = $this->f_homemodel->Get_where('district',array(
                'provinceid' => $data['user']->province
            ));
        }
        if(!empty($data['user']->district))
        {
            $data['ward'] = $this->f_homemodel->Get_where('ward',array(
                'districtid' => $data['user']->district
            ));
        }
        $seo=array(
            'title'=>'Thanh Toán Bảo Kim',
            'description'=>'Thanh  Toán Bảo Kim',
            'keyword'=>'Thanh  Toán Bảo Kim',
            'type'=>'products');
        redirect(base_url('baokim'));
        $this->LoadHeader($seo);
//        $this->Loadsubheader_old();
        $this->load->view('carts/order_baokim', $data);
        $this->LoadFooter();
    }

    public function update_shipping()
    {
        if (isset($_POST['price_sale'])) {
            $price_ship = $_POST['price_sale'];
            $count = 0;
            $total = 0;
            foreach ($_SESSION['cart'] as $v) {
                $count += $v['qty'];
                $total += ($v['qty'] * $v['price_sale']);
            }
            $_SESSION['shipping'] = $price_ship;
            $_SESSION['total_price'] = $total + $price_ship;
            $data['shipp'] = $price_ship;
            $data['total']      = $total + $price_ship;
            echo json_encode($data);
        }
        //            redirect($_SERVER['HTTP_REFERER']);
    }
    public function check_sale()
    {
        if (isset($_POST['code'])) {
            $data['check']=false;
            $item        = $this->f_shoppingcartmodel->getFirstRowWhere('code_sale', array('code' => $_POST['code']));
            if($item) {
                $data['check']=true;
                $data['item']=$item;
            }else{
                $data['check']=false;
            }
            echo json_encode($data);
        }
    }
}