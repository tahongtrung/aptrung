<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_frontend extends MY_Controller
{
    private $b_Check = false;
    function __construct()
    {
        parent::__construct();
        $this->load->model('f_usersmodel');
        $this->load->helper(array('form', 'url'));
        //echo $this->lang->line('captcha_ads_label_post');die();
        $this->load->helper('unlink');
        $this->load->library('form_validation');
    }
    protected $pagination_config= array(
        'full_tag_open'=>"<ul class='pagination pagination-sm'>",
        'full_tag_close'=>"</ul>",
        'num_tag_open'=>'<li>',
        'num_tag_close'=>'</li>',
        'cur_tag_open'=>"<li class='disabled'><li class='active'><a href='#'>",
        'cur_tag_close'=>"<span class='sr-only'></span></a></li>",
        'next_tag_open'=>"<li>",
        'next_tagl_close'=>"</li>",
        'prev_tag_open'=>"<li>",
        'prev_tagl_close'=>"</li>",
        'first_tag_open'=>"<li>",
        'first_tagl_close'=>"</li>",
        'last_tag_open'=>"<li>",
        'last_tagl_close'=>"</li>",
    );
    public function acount()
    {
        $this->auth->checkUserLogin();
        $id = $this->session->userdata('userid');
        $config['upload_path'] = './upload/img/avatar/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);
        $data['user_item'] = $this->f_usersmodel->getItemByID('users',$id);
        if (isset($_POST['update_profiler'])) {
            //die();
            $arr = array(
                'fullname' => $this->input->post('fullname'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'province' => $this->input->post('province'),
                'district' => $this->input->post('district'),
                'ward' => $this->input->post('ward')
            );
            $this->f_usersmodel->Update('users',$id,$arr);
            /*if($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/avatar/' . $upload['upload_data']['file_name'];
                    $this->f_usersmodel->Update('users', $id, array('avatar' => $image,));
                    if(isset($data['edit'])&&file_exists($data['edit']->avatar)){
                        unlink($data['edit']->avatar);
                        $temp_thumb = explode('/',$data['edit']->avatar);
                        $link_thumb = 'upload/img/avatar/thumbs/'.$temp_thumb[3];
                        @unlink($link_thumb);

                    }
                    $config2['image_library'] = 'gd2';
                    $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                    $config2['new_image'] = './upload/img/avatar/thumbs';
                    $config2['width'] = 70;
                    $config2['height'] = 70;
                    $this->load->library('image_lib',$config2);
                    if ( !$this->image_lib->resize()){
                        $data['error'] = $this->image_lib->display_errors('', '');
                    }
                }
            }*/
            $_SESSION['mss_success']='Cập nhật thông tin thành công!';
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['province'] = $this->f_homemodel->get_data('province');
        $data['banners'] = $this->f_usersmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $seo = array(
            'title' => 'Thông tin tài khoản'
        );
        $this->LoadHeader(null,$seo);
        $this->load->view('users/acount',$data);
        $this->LoadFooter();

    }
    public function acount_order()
    {
        $this->auth->checkUserLogin();
        $uId = $this->session->userdata('userid');
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['base_url'] = base_url('acount-order?');
        $config['total_rows'] = $this->f_usersmodel->coutnUserOrder($uId); // xác định tổng số record
        $config['per_page'] = 9; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $data = array();

        $data['item_list'] = $this->f_usersmodel->Getlist_oder($uId,$config['per_page'], $this->input->get('per_page'));
        //echo "<pre>";print_r($data['item_list']); die();
        $order_id=array();
        foreach($data['item_list'] as $v){
            $order_id[]=$v->id;
        }
        if(empty($data['item_list'])){
            $data['detail']=array();
        }else{
            $data['detail'] = $this->f_usersmodel->order_detail($order_id);
        }
        $data['banners'] = $this->f_usersmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $seo = array(
            'title' => 'Quản lý đơn hàng'
        );
        $this->LoadHeader(null,$seo);
        $this->load->view('users/acount_order',$data);
        $this->LoadFooter();

    }
    public function signup()
    {
        if ($this->input->post()&&$this->input->post('status_check')=='1') {

            $arr=$this->f_usersmodel->getField_array('users','email');
            $input=array('email'=>$this->input->post('email'));
            $rs['check']=true;

            if(in_array($input,$arr)){
                $rs['check']=false;
                $rs['mss']='Email đã có người sử dụng';
            }

            //======
            if ($rs['check'] == true) {

                $password = $this->input->post('password');
                for ($i = 0; $i < 5; $i++) {
                    $password = md5($password);
                }
                $arr = array(
                    'fullname'    => $this->input->post('fullname'),
                    'email'       => $this->input->post('email'),
                    'password'    => $password,
                    'province'    => $this->input->post('location'),
                    'active'      => 0,
                    'deleted'     => 0,
                    'block'       => 0,
                    'signup_date' => date('Y-m-d'),
                    'phone' => $this->input->post('phone',TRUE),
                );
                $id  = $this->f_usersmodel->Add('users', $arr);
                $this->f_usersmodel->Update_Where('users', array('id' => $id),
                    array('md5_id' => md5($id), 'token' => md5($this->input->post('email') . $id),));

            }else{
                redirect($_SERVER['HTTP_REFERER']);
            }
            if (isset($id)) {
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

                $user=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$id));
                $subject = $this->site_name.' - Kích hoạt tài khoản';
                $message = '
                    <p>Nhấn vào link dưới đây để kích hoạt tài khoản:</p>
                    <a href="'.base_url('kick-hoat?id='.$user->md5_id.'&token='.$user->token).'">
                    '.base_url('kick-hoat?id='.$user->md5_id.'&token='.$user->token).'</a>';

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
                $this->email->from($user->email); // change it to yours
                $this->email->to($user->email); // change it to yours
                $this->email->subject($subject);
                $this->email->message($message);
                /*if ($this->email->send()) {
                    redirect(base_url('dang-ky-thanh-cong?u='.$user->md5_id));
                } else {
                    redirect(base_url('dang-ky-thanh-cong'));
                }*/
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <trantrung129@vnnetsoft.com>' . "\r\n";
                if(mail($this->input->post('email'), "$subject", $body,$headers))
                {
                    redirect(base_url('dang-ky-thanh-cong?u='.$user->md5_id));
                }else{
                    redirect(base_url('dang-ky-thanh-cong'));
                }
            }

        }
    }
    public function forgot_pass()
    {
        if (isset($_POST['email'])) {

            $email=$this->input->post('email');
            $pass=$this->randString(6);
            $new_pass=$pass;
            for($i=0;$i<5;$i++){
                $new_pass=md5($new_pass);
            }
            $user=$this->f_usersmodel->getFirstRowWhere('users',array('email'=>$email));
            $this->f_usersmodel->Update_where('users',array('email'=>$email),array('password'=>$new_pass));

            //======
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

            $subject = $this->site_name.' - Kích hoạt tài khoản';
            $message = '
                    <p>Mạt khẩu mới của bạn là: </p>'.$pass.'
                    <p>Vui lòng đăng nhập và đổi lại mật khẩu!</p>
                    ';

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
            $this->email->from($this->input->post('email')); // change it to yours
            $this->email->to($this->input->post('email')); // change it to yours
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
//                        echo 'Email sent.';
                redirect(base_url('cap-lai-mat-khau?reset=1&u='.$user->md5_id));
            } else {
                redirect(base_url('cap-lai-mat-khau'));
//                        show_error($this->email->print_debugger());
            }
        }
        if(isset($_GET['u'])){
            $data['u2']=$this->f_usersmodel->getFirstRowWhere('users',array('md5_id'=>$_GET['u']));
        }
        $data['banners'] = $this->f_usersmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        //$data['menu_right'] = $this->f_usersmodel->getMenuRightRoot();
        $seo = array('title' => 'Đăng ký thành công');
        $this->LoadHeader(null,$seo);
        $this->load->view('users/success_signup',$data);
        $this->LoadFooter();
    }

    public function signin(){
        $result = array();
        $result['login'] = false;
        $result['message'] = '';
        if ($this->input->post('user')) {
            $username = $this->input->post('user');
            $pass = $this->input->post('pass');
            if ($pass == 0) $result['message'] = 'Vui lòng nhập mật khẩu';

            $user = $this->f_usersmodel->loginUser($username, $pass);

//                print_r($user); die();
            if (isset($user->id)) {
                if($user->active==0){
                    $result['message'] = 'Tài khoản của bạn chưa được kích hoạt';
                }elseif($user->active==1&&$user->block==1){
                    $result['message'] = 'Tài khoản của bạn đang bị khóa';
                }else{
                    $this->auth->loginUser($user);
                    $result['login'] = true;
                    $_SESSION['ck_access']=true;
                    $_SESSION['user_folder']=$user->md5_id;
                    $_SESSION['mss_success']="Xin chào :<b>".$user->fullname." !</b> Bạn đã đăng nhập thành công !!!";
                    //redirect($_SERVER['HTTP_REFERER']);
                }

            } else {
                $result['message'] = 'Sai email hoặc mật khẩu!';
            }

        } else $result['message'] = 'Vui lòng nhập mail và mật khẩu!';
        echo json_encode($result);
        die();
    }
    public function check_email(){
        if ($this->input->post('email')) {
            $arr=$this->f_usersmodel->getField_array('users','email');
//                print_r($arr);echo '<br>';
            $input=array('email'=>$this->input->post('email'));
            $rs['check']=true;
            $rs['mss']='';
            if(in_array($input,$arr)){
                $rs['check']=false;
                $rs['mss']='Email đã có người sử dụng';
            }
            echo json_encode($rs);
        }
    }
    public function change_pass(){
        $this->auth->checkUserLogin();
        if ($this->input->post('pass_check')==1) {

            $password = $this->input->post('new_pass');
            for ($i = 0; $i < 5; $i++) {
                $password = md5($password);
            }
            $rs=$this->f_usersmodel->update_pass_user($this->session->userdata('userid'),
                array('password'    => $password,));
        }
        if($rs){
            $_SESSION['messege']='Đổi mật khẩu thành công!';
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function check_old_pass(){
        if ($this->input->post('pass')) {

            $user=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $rs['check']=false;
            $rs['mss']='Mật khẩu cũ không chính xác';
            $pass=$this->input->post('pass');
            for($i=0;$i<5;$i++){
                $pass=md5($pass);
            }
            if($pass==$user->password){
                $rs['check']=true;
                $rs['mss']='';
            }

            echo json_encode($rs);
        }
    }

    public function atuto_active_user(){
        if(isset($_GET['id'])&& isset($_GET['token'])){
            $id=$_GET['id'];
            $user=$this->f_usersmodel->getFirstRowWhere('users',array('md5_id'=>$id));
            if(@$user->token==@$_GET['token']){
                $this->f_usersmodel->Update_where('users',array('id'=>$user->id),array('active'=>1));
            }

            $data = array();
            $data['banners'] = $this->f_usersmodel->get_data('images',array(
                'type' => 'page'
            ),array('sort' => 'asc'));
            $seo = array(
                'title' => 'Kích hoạt tài khoản'
            );
            $this->LoadHeader(null,$seo);
            $this->load->view('users/success_active_user',$data);
            $this->LoadFooter();

        }else redirect(base_url());

    }
    public function success_signup(){
        if(isset($_GET['u'])){
            $data['u']=$this->f_usersmodel->getFirstRowWhere('users',array('md5_id'=>$_GET['u']));
        }
        $data['banners'] = $this->f_usersmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $seo = array(
            'title' => 'Đăng ký thành công'
        );

        $this->LoadHeader(null,$seo);
        $this->load->view('users/success_signup',$data);
        $this->LoadFooter();
    }
    public function success_active_user(){
        $seo = array(
            'title' => 'Kích hoạt tài khoản thành công'
        );
        $data['banners'] = $this->f_usersmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $this->load->LoadHeader(null,$seo);
        $this->load->view('users/success_active_user',$data);
        $this->load->LoadFooter();
    }
    public function signout(){
        $this->session->unset_userdata(array('userid'=>'','username'=>'','usermail'=>'',));
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function check_capcha(){
        $capcha=$this->input->post('capcha');
        $challenge=$this->input->post('challenge');
        $this->load->library('recaptcha');
        $this->recaptcha->recaptcha_check_answer(null,$challenge,$capcha);
    }
    function randString($length, $charset='abcdefghijklmnopqrstuvwxyz0123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

    public function updateProfile()
    {
        $this->lang->load('common');
        $id = $this->session->userdata('userid');
        $config['upload_path'] = './upload/img/avatar/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);
        $data['edit'] = $this->f_usersmodel->getItemByID('users',$id);

        if (isset($_POST['update_profiler'])) {
            $arr = array(
                'fullname' => $this->input->post('fullname'),
                'nam' => $this->input->post('nam'),
                'nu' => $this->input->post('nu'),
                'phone' => $this->input->post('phone'),
                /*'email' => $this->input->post('email'),*/
                'address' => $this->input->post('address'),
                /*'province' => $this->input->post('province'),
                'district' => $this->input->post('district'),
                'ward' => $this->input->post('ward')*/
                'description' => $this->input->post('description')
            );

            $this->f_usersmodel->Update('users',$id,$arr);

            if($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/avatar/' . $upload['upload_data']['file_name'];
                    $this->f_usersmodel->Update('users', $id, array('logo' => $image,));
                    if(isset($data['edit'])&&file_exists($data['edit']->logo)){
                        unlink($data['edit']->logo);
                    }
                    $config2['image_library'] = 'gd2';
                    $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                    $config2['new_image'] = './upload/img/avatar/thumbs';
                    $config2['maintain_ratio'] = TRUE;
                    $config2['create_thumb'] = TRUE;
                    $config2['thumb_marker'] = '_thumb';
                    $config2['width'] = 70;
                    $config2['height'] = 70;
                    $this->load->library('image_lib',$config2);
                    if ( !$this->image_lib->resize()){
                        $data['error'] = $this->image_lib->display_errors('', '');
                    }
                }
            }
            $_SESSION['mss_success']='Cập nhật thông tin thành công!';
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function listOrder()
    {
        $this->auth->checkUserLogin();
        $id = $this->session->userdata('userid');
        $data = array();
        $config['base_url'] = base_url('thong-tin-dat-hang');
        $config['total_rows'] = $this->f_usersmodel->countUserListOrder($id); // xác định tổng số record
        $config['per_page'] = 9; // xác định số record ở mỗi trang
        $config['uri_segment'] = 2; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data['orderlist'] = $this->f_usersmodel->getUserListOrder($id,$config['per_page'],$this->uri->segment(2));
        //echo "<pre>";var_dump($data['orderlist']);die();
        $data['detail'] = $this->f_usersmodel->UserOderDetail($id);
        //echo "<pre>";var_dump($data['detail']);die();
        $this->LoadHeader();
        $this->load->view('order_list',$data);
        $this->LoadFooter();
    }
    public function register()
    {
        unlink_captcha($this->session->flashdata('sessionPathCaptchaPostAds'));
        $data = array();
        if($this->input->post('captcha_ads') && time() - (int)$this->session->userdata('sessionTimePosted') > 10){
            $this->form_validation->set_message('required', $this->lang->line('required'));
            $this->form_validation->set_message('valid_email', $this->lang->line('invalid-email'));
            $this->form_validation->set_message('matches', $this->lang->line('matches'));
            $this->form_validation->set_message('_valid_captcha_post', $this->lang->line('_valid_captcha_post_message_post'));
            $this->form_validation->set_error_delimiters('<div class="div_errorpost">', '</div>');
            //Bat loi captcha
            $this->form_validation->set_rules('captcha_ads', 'lang:captcha_ads_label_post', 'required|callback__valid_captcha_post');
            if($this->form_validation->run() != FALSE)
            {
                $config['upload_path'] = './upload/img/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '40000000';
                $config['max_width'] = '3024';
                $config['max_height'] = '3000';
                $this->load->library('upload', $config);
                if ($this->input->post()&&$this->input->post('status_check')=='1') {
                    $arr=$this->f_usersmodel->getField_array('users','email');
                    $input=array('email'=>$this->input->post('email'));
                    $rs['check']=true;

                    if(in_array($input,$arr)){
                        $rs['check']=false;
                        $rs['mss']='Email đã có người sử dụng';
                    }

                    //======
                    if ($rs['check'] == true) {
                        $password = $this->input->post('password');
                        for ($i = 0; $i < 5; $i++) {
                            $password = md5($password);
                        }
                        $arr = array(
                            'fullname'    => $this->input->post('fullname'),
                            'email'       => $this->input->post('email'),
                            'password'    => $password,
                            'province'    => $this->input->post('location'),
                            'username'    => $this->input->post('username'),
                            'address'     => $this->input->post('address'),
                            /*'shop_name'   => $this->input->post('shop_name'),*/
                            /*'time'        => time(),*/
                            'active'      => 0,
                            'deleted'     => 0,
                            'block'       => 0,
                            'signup_date' => date('Y-m-d'),
                            'phone' => $this->input->post('phone',TRUE),
                            'description' => $this->input->post('description')
                        );
                        $id  = $this->f_usersmodel->Add('users', $arr);
                        $this->f_usersmodel->Update_Where('users', array('id' => $id),
                            array('md5_id' => md5($id), 'token' => md5($this->input->post('email') . $id),));
                        if ($_FILES['userfile']['size'] >0) {
                            if (!$this->upload->do_upload('userfile')) {
                                $data['error'] = 'Ảnh không hợp lệ!';
                            } else {
                                $upload = array('upload_data' => $this->upload->data());
                                $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                                $this->f_usersmodel->Update_where('users', array('id'=>$id), array('logo'=>$image));
                            }
                        }

                    }else{
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                    if (isset($id)) {
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

                        $user=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$id));
                        $subject = $this->site_name.' - Kích hoạt tài khoản';
                        $message = '
                    <p>Nhấn vào link dưới đây để kích hoạt tài khoản:</p>
                    <a href="'.base_url('kick-hoat?id='.$user->md5_id.'&token='.$user->token).'">
                    '.base_url('kick-hoat?id='.$user->md5_id.'&token='.$user->token).'</a>';

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
                        $this->email->from($user->email,'Thông tin user'); // change it to yours
                        $this->email->to($user->email); // change it to yours
                        $this->email->subject($subject);
                        $this->email->message($message);
                        if ($this->email->send()) {
                            $this->session->set_userdata('sessionTimePosted', time());
                            //                        echo 'Email sent.';
                            redirect(base_url('dang-ky-thanh-cong?u='.$user->md5_id));
                        } else {
                            $this->session->set_userdata('sessionTimePosted', time());
                            redirect(base_url('dang-ky-thanh-cong'));
                            //                        show_error($this->email->print_debugger());
                        }
                    }

                }
            }
            else{
                $data['fullname'] = $this->input->post('fullname');
                $data['username'] = $this->input->post('fullname');
                $data['email'] = $this->input->post('email');
                $data['phone'] = $this->input->post('phone');
                $data['address'] = $this->input->post('address');
                $data['phone'] = $this->input->post('phone');
                $data['password'] = $this->input->post('password');
                $data['repassword'] = $this->input->post('repassword');
                $data['description'] = $this->input->post('description');
            }
        }
        $tempnum = 123456;
        $this->load->library('captcha');
        $codeCaptcha = $this->captcha->code(6);
        $this->session->set_flashdata('sessionCaptchaPostAds', $codeCaptcha);
        $imageCaptcha = 'assets/captcha/'.md5(microtime()).'posa.jpg';
        $this->session->set_flashdata('sessionPathCaptchaPostAds', $imageCaptcha);
        $this->captcha->create($codeCaptcha, $imageCaptcha);
        if(file_exists($imageCaptcha))
        {
            $data['imageCaptchaPostAds'] = $imageCaptcha;
        }
        $title=@$data['pro_first']->name;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('user_register',$data);
        $this->LoadFooter();
    }
    function _valid_captcha_post($str)
    {
        if($this->session->flashdata('sessionCaptchaPostAds') && $this->session->flashdata('sessionCaptchaPostAds') === $str)
        {
            return true;
        }
        return false;
    }

    public function  checkRegisterUser()
    {
        if ($this->input->post('username')) {
            $arr=$this->f_usersmodel->getField_array('users','username');
            //                print_r($arr);echo '<br>';
            $input=array('username'=>$this->input->post('username'));
            $rs['check']=true;
            $rs['mss']='';
            if(in_array($input,$arr)){
                $rs['check']=false;
                $rs['mss']='Tên đăng nhập này đã có người sử dụng !';
            }
            echo json_encode($rs);
        }
    }
    public function changePass()
    {
        $this->auth->checkUserLogin();
        $data = array();
        $title='Thay đổi mật khẩu';
        $keyword=@$data['pro_first']->keyword;
        $data['widgets']=$this->widget_left();
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('user_change_pass',$data);
        $this->LoadFooter();
    }
    public function changProfiler()
    {
        $data = array();
        $this->load->helper('ckeditor_helper');
        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(	//Setting a custom toolbar
                    /*array('Source'),*/
                    array('Bold', 'Italic','Underline', 'Strike', 'FontSize'),
                    array('JustifyLeft', 'JustifyCenter', 'JustifyRight','JustifyBlock'),
                    array('TextColor', 'BGColor',),
                    '/'
                ),
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));

        $this->auth->checkUserLogin();
        if($this->session->userdata('userid')){
            @$u=$this->f_usersmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['user_item'] = $u;
        }
        //echo "<pre>";var_dump($data['user_item']);die();

        $seo=array();
        $this->LoadHeader($seo);
        $this->load->view('profiles/change_profiler',$data);
        $this->LoadFooter();
    }
    public function shopLocation()
    {
        $data = array();
        $title='Quản lý địa điểm';
        $keyword='Quản lý địa điểm';
        $data['lists'] = $this->f_usersmodel->getList('shop_address');
        $data['widgets']=$this->widget_left();
        $description=@$data['pro_first']->description_seo;

        $this->LoadHeader($title);
        $this->load->view('shop_location',$data);
        $this->LoadFooter();
    }
    public function user_orders()
    {
        $config['base_url'] = base_url('quan-ly-gio-hang');
        $config['total_rows'] = $this->f_usersmodel->count_user_orders($this->session->userdata('userid')); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 2; // xác định segment chứa page number
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);

        $data = array();
        $data['widgets']=$this->widget_left();

        $data['orders']=$this->f_usersmodel->get_user_orders($this->session->userdata('userid'),$config['per_page'], $this->uri->segment(2));
        $order_id=array(0);
        foreach($data['orders'] as $v){
            $order_id[]=$v->id;
        }
        $data['items']=$this->f_usersmodel->get_user_orders_item($order_id);

        $seo=array();
        $this->LoadHeader($seo);
        $this->load->view('user_manager_orders',$data);
        $this->LoadFooter();
    }

}