<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller
{
    protected $module_name="Admin";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
        $this->auth = new auth();
        $this->ci =& get_instance();
    }
    public function lang($lang){
        if($lang!=null){
            //$_SESSION['lang']=$lang;
            $this->ci->session->set_userdata('lang',$lang);
            redirect(base_url('adminvn'));
        }
    }
    //admin Login
    public function login()
    {
        if ($this->input->post('email')) {
            $username = $this->input->post('email');
            $pass     = $this->input->post('pass');
            $admin    = $this->adminmodel->loginAdmin($username, $pass);
            if (isset($admin->id)) {
                $this->auth->login($admin);
                //session_start();
                $_SESSION['ck_access']=true;
                $lastlogin = array('lastlogin' => time());
                $this->adminmodel->update($admin->id, $lastlogin);
                redirect(base_url('adminvn'));
            }
        }
        $this->load->view('admin/login');
    } //admin Change Password

    public function admin_change_password()
    {
        //die( $this->session->userdata['adminid']);
        $mss = '';
        if ($this->input->post('old_pass')) {
            $old_pass = $this->input->post('old_pass');
            $new_pass = $this->input->post('new_pass');
            $re_pass  = $this->input->post('re_pass');
            $id       = $this->session->userdata['adminid'];
            $admin    = $this->adminmodel->getItemByID('nt_admin', $id);

            for ($i = 0; $i < 5; $i++) {
                $old_pass = md5($old_pass);
            }


            if ($old_pass == $admin->password) {
                $mss = '';

                if ($new_pass && $re_pass) {
                    if ($new_pass == $re_pass) {
                        for ($i = 0; $i < 5; $i++) {
                            $new_pass = md5($new_pass);
                        }
                        $arr = array('password' => $new_pass);

                        $this->adminmodel->update($id, $arr);
                        $mss = '<span style="color: #3cdb45; font-weight: bold"> Đổi mật khẩu thành công!</span>';
                    } else {
                        $mss = '<span style="color: red"> Nhập lại mật khẩu mới không chính xác!</span>';
                    }
                } else {
                    $mss = '<span style="color: red"> Vui lòng nhập mật khẩu mới!</span>';
                }

            } else {
                $mss = '<span style="color: red"> Nhập sai mật khẩu hiện tại!</span>';
            }
        }

        $data        = array();
        $data['mss'] = @$mss;
        $this->load->view('admin/header', $data);
        $this->load->view('admin/admin_change_password', @$data);
        $this->load->view('admin/footer');
    }

    // admin logout
    public function logout()
    {
        $this->auth->logout();
        redirect(base_url('adminvn'));
    }

    public function admin_permission($id = null)
    {
        $this->auth->check();
        $this->Check_module($this->module_name);
        if ($id > 0) {

            $data['id']   = $id;
            $data['disable']   = 'disabled';
            $data['edit'] = $this->adminmodel->getItemByID('nt_admin', $id);

            $module= @$this->adminmodel->get_user_modules($id);

            $data['module'] =explode(';',@$module->module_name);

        }

        if (isset($_POST['add_submit'])) {
            $fullname = $this->input->post('fullname');
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
//                $check    = $_POST['check'];



            for($j=0; $j<5; $j++){
                $password=md5($password);
            }
//                die($password);

            $data_array = array('fullname' => $fullname,
                'password' => $password,
                'email'    => $email,
                'level'    => 0);

            if ($_POST['id']) {

                $data_update= array('fullname' => $fullname,
                    'email'    => $email);
//                    print_r($data_update); die();

                if (isset($_POST['check']) && sizeof($_POST['check']) > 0) {

                    $string      = implode(";", $_POST['check']);

                    $arr_permiss = array('module_name' => $string);

                    $this->adminmodel->Update_usermodules('user_modules',$id,$arr_permiss);
                }

                $this->adminmodel->update($id,$data_update);
                redirect (base_url('adminvn/admin-permission'));

            } else {

                $id_user = $this->adminmodel->Add('nt_admin', $data_array);

                if (isset($_POST['check'])&&sizeof($_POST['check']) > 0) {


                    $string      = implode(";", $_POST['check']);
                    $arr_permiss = array('module_name' => $string, 'user_id' => $id_user);

                    $this->adminmodel->Add('user_modules', $arr_permiss);
                }else{
                    $arr_permiss = array('module_name' => '', 'user_id' => $id_user);

                    $this->adminmodel->Add('user_modules', $arr_permiss);
                }

                redirect($_SERVER['HTTP_REFERER']);
            }

        }

        $data['modules_list'] = $this->adminmodel->listAll('modules');
//            $data['admin_list']   = $this->adminmodel->Get_where('nt_admin', array('level <>' => 1));

//            $data['admin_list']   = $this->adminmodel->Get_multi_table('nt_admin', array('level <>' => 1),array(array('user_modules','user_id','nt_admin','id','left')));

        $data['admin_list']   = $this->adminmodel->get_user_list();



        $data['headerTitle'] = "Phân quyền quản trị";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/admin_permission', $data);
        $this->load->view('admin/footer');
    }

    public  function reset_pass($id){
        $this->auth->check();
        $this->Check_module($this->module_name);
        if($id>0){
            $password=_PASSWORD_RESET;
            for($j=0; $j<5; $j++){
                $password=md5($password);
            }
            $this->adminmodel->Update_where('nt_admin',array('id'=>$id),array('password'=>$password));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public  function delete_acc($id){
        $this->Check_module($this->module_name);
        if($id>0){
            $this->adminmodel->Delete('nt_admin',$id);
            $this->adminmodel->Delete_where('user_modules',array('user_id'=>$id));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function site_option($id=null){
        $this->load->helper('ckeditor_helper');
        $data['ckeditor']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'ckeditor',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(	//Setting a custom toolbar
                    array('Source'),
                    array('Bold', 'Italic','Underline', 'Strike', 'FontSize'),
                    array('JustifyLeft', 'JustifyCenter', 'JustifyRight'),
                    array('TextColor', 'BGColor',),
                    '/'
                ),
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
        $data['ckeditor2']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'ckeditor2',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(	//Setting a custom toolbar
                    array('Source'),
                    array('Bold', 'Italic','Underline', 'Strike', 'FontSize'),
                    array('JustifyLeft', 'JustifyCenter', 'JustifyRight'),
                    array('TextColor', 'BGColor',),
                    '/'
                ),
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '40000000';
        $config['max_width'] = '3024';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        /*$row = null;
        if($id !==null)
        {

        }*/
        $row=$this->adminmodel->getFirstRowWhere('site_option',array(
            'lang' => $this->language
        ));
        if($this->input->post()){
            $video='';
            if($this->input->post('site_video')){
                $video=explode('=',$this->input->post('site_video'));
            }
            $arr=array(
                'site_url'            => $this->input->post('site_url'),
                'site_name'           => $this->input->post('site_name'),
                'site_name_en'        => $this->input->post('site_name_en'),
//                    'site_logo'           => $this->input->post('site_logo'),
                'shipping'            =>$this->input->post('shipping'),
                'site_keyword'        => $this->input->post('site_keyword'),
                //'site_keyword_en'     => $this->input->post('site_keyword_en'),
                'site_title'          => $this->input->post('site_title'),
                'site_title_en'       => $this->input->post('site_title_en'),
                'site_description'    => $this->input->post('site_description'),
                'link_sky' => $this->input->post('link_sky'),
                'admin_account'       => $this->input->post('admin_account'),
                'admin_password'      => $this->input->post('admin_password'),
                'hotline1'            => $this->input->post('hotline1'),
                'hotline2'            => $this->input->post('hotline2'),
                'hotline3'            => $this->input->post('hotline3'),
                'address'             => $this->input->post('address'),
                'link_tt'             => $this->input->post('link_tt'),
                'favicon'             => $this->input->post('favicon'),
                'slogan'             => $this->input->post('slogan'),
                'site_email'             => $this->input->post('site_email'),
                'site_video'             => @$video[1],
                'site_fanpage'         => $this->input->post('site_fanpage'),
                'site_promo'          => $this->input->post('site_promo'),
                'link_gg'          => $this->input->post('link_gg'),
                'link_youtube'          => $this->input->post('link_youtube'),
                'face_id'               => $this->input->post('face_id'),
                'lang'                => $this->language,
            );
            if($row == null)
            {
                $rs=$this->adminmodel->Add('site_option',$arr);
            }
            else{
                $rs=$this->adminmodel->Update_where('site_option',array('id'=> $row->id,),$arr);
            }

            if ($_FILES['userfile']['size'] >0) {
                if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không hợp lệ';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                    $this->adminmodel->Update_where('site_option', array('id'=>$row->id), array('site_logo'=>$image));
                }
            }
            /*if($rs){
                $this->creat_mess('success', 'C?p nh?t thành công!');
            }*/
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['row']=$row;
        $data['headerTitle'] = 'Option';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/site_option', $data);
        $this->load->view('admin/footer');
    }
    public function count_comments(){
        $c=$this->adminmodel->Count('comments',array('review'=>0));
        echo json_encode($c);
    }
    public function count_post(){
        $c=$this->adminmodel->Count('user_post',array('view'=>0));
        echo json_encode($c);
    }
    public function count_order(){
        $c=$this->adminmodel->Count('order',array('show'=>0));
        echo json_encode($c);
    }
    public function bando_map($id=null){

        $row=$this->adminmodel->getFirstRowWhere('site_option',array(
            'lang' => $this->language
        ));

        if($this->input->post()){



            $arr=array(

                'hdfMap'            => $this->input->post('hdfMap'),
                'map_title'            => $this->input->post('map_title'),
                'map_adrdress'            => $this->input->post('map_adrdress'),
                'map_phone'            => $this->input->post('map_phone'),
                'dia_chi_timkiem'            => $this->input->post('dia_chi_timkiem'),
                'lang'                => $this->language,
            );
            $rs=$this->adminmodel->Update_where('site_option',array('id'=> $row->id,),$arr);




            /*if($rs){
                $this->creat_mess('success', 'C?p nh?t thành công!');
            }*/


            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['row']=$row;

        $data['headerTitle'] = 'Cấu hình bản đồ web';



        $this->load->view('admin/header', $data);
        $this->load->view('admin/bando_map', $data);
        $this->load->view('admin/footer');
    }
    public function users(){
        $this->check_acl();
        $data['users'] = $this->adminmodel->get_data('nt_admin',array('id >'=>'1'),array('id'=>'esc'));

        $data['headerTitle'] = 'Quản trị viên';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/users/users', @$data);
        $this->load->view('admin/footer');
    }
    public function permission($id = null)
    {
        $this->check_acl();
        $user=$this->adminmodel->get_data('access',array('user_id'=>$id),array(),true);

        if ($this->input->post()) {
            $controller = $this->input->post('controller');
            $action     = $this->input->post('action');
            $access     = array();
            foreach ($controller as $c2) {
                //$access[$c2]=null;
                foreach ($action as $a) {
                    $item = explode(';', $a);

                    if ($item[0] == $c2) {
                        $access[$c2][] = $item[1];
                    }
                }
            }
            // print_r($access);die();
            $str_access = json_encode($access);
            $arr        = array('user_id' => $id, 'access' => $str_access);

            if(!empty($user)){
                $this->adminmodel->Update_where('access',array('user_id'=>$id), $arr);
            }else{
                $this->adminmodel->Add('access', $arr);
            }
            redirect(base_url('admin/admin/users'));
        }
        $data['resources'] = $this->adminmodel->get_data('resources',array(),array('sort'=>''));
        $data['u_access'] = (array)json_decode(@$user->access);
        $data['user'] = $this->adminmodel->get_data('nt_admin',array('id'=>$id),array(),true);
        $data['headerTitle'] = 'Phân quyền quản trị';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/users/permission', $data);
        $this->load->view('admin/footer');
    }
    public function useractive(){
        $u=$this->adminmodel->get_data('nt_admin',array('id'=>$_POST['id']),array(),true);

        if($u->block==1){
            $this->adminmodel->Update_where('nt_admin', array('id' => $_POST['id']), array('block'=>0));

        }else if($u->block==0){
            $this->adminmodel->Update_where('nt_admin', array('id' => $_POST['id']), array('block'=>1));
        }
        echo 1;
    }
    public function user_delete($id){
        $this->check_acl();
        $this->adminmodel->Delete_where('nt_admin',array('id'=>$id));
        $this->adminmodel->Delete_where('access',array('user_id'=>$id));
        //            $this->creat_mess('success','<i class="fa fa-exclamation-circle"></i> Thao tác thành công!');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function user_edit($id){
        $this->check_acl();
        $this->user_add($id);
    }
    public function user_add($id = null)
    {
        //die('here');
        $this->check_acl();
        $data['btn_name'] = 'Thêm';
        if ($id != null) {
            $edit             = $this->adminmodel->get_data('nt_admin', array('id' => $id, 'id !=' => 1), array(), true);
            $data['edit']     = $edit;
            $data['btn_name'] = 'Cập nhật';
        }
        if ($this->input->post()) {
            $pass=$this->input->post('password');
            for($i=0;$i<5;$i++){
                $pass=md5($pass);
            }
            $arr = array(
                'username' => $this->input->post('username'),
                'fullname' => $this->input->post('fullname'),
                'email'    => $this->input->post('email'),
                'password' => $pass,
                //                    'active'   => $this->input->post('active'),
                'block'    => $this->input->post('block'),
                'level'    => '2',
            );
            if ($this->input->post('edit')) { // edit user
                if($this->input->post('password')==''||$this->input->post('password')==0){
                    unset($arr['password']);
                }
                $u = $this->adminmodel->Update_where('nt_admin', array('id' => $id), $arr);

            } else { // add user
                $rs = $this->adminmodel->Add('nt_admin', $arr);

                $id=$rs;
            }

            redirect(base_url('admin/admin/permission/'.$id));
        }
        $data['headerTitle'] = 'Quản trị viên';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/users/user_add', @$data);
        $this->load->view('admin/footer');
    }
}