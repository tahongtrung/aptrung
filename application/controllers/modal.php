<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/facebook.php';

class Modal extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        //$this->config->load('facebook');
        $this->load->library('session');
    }
    public function login(){
        $homeurl = base_url().'fblogin/login';  //return to home
        /*$facebook = new Facebook(array(
            'appId'  => '1058195500877761',
            'secret' => '79bd813dd2c110c4cca88f0880b59fbc',
            'cookie' => true
        ));*/
       /* $loginUrl = $facebook->getLoginUrl(array(
            'scope' => 'email,publish_actions',
            'redirect_uri' => $homeurl,
        ));*/
        //$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
        //$data['loginUrl'] = $loginUrl;
        $data = array();
        $this->load->view('modal/view_login',$data);
    }
    public function register(){
        $this->load->helper('unlink');
        unlink_captcha($this->session->flashdata('sessionPathCaptchaPostAds'));
        #BEGIN: Create captcha post ads
        $this->load->library('captcha');
        $codeCaptcha = $this->captcha->code(5);
        $this->session->set_flashdata('sessionCaptchaPostAds', $codeCaptcha);
        $imageCaptcha = 'assets/captcha/'.md5(microtime()).'posa.jpg';
        $this->session->set_flashdata('sessionPathCaptchaPostAds', $imageCaptcha);
        $this->captcha->create($codeCaptcha, $imageCaptcha);
        if(file_exists($imageCaptcha))
        {
            $data['imageCaptchaPostAds'] = $imageCaptcha;
            $data['captcha_check'] = $codeCaptcha;
        }
        $data['code_captcha'] = $codeCaptcha;
        $this->load->view('modal/view_register',$data);
    }
    public function changePass()
    {
        $this->load->view('modal/view_changepass');
    }
    public function userInfo()
    {
        if($this->session->userdata('userid')){
            @$u=$this->f_homemodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['user_item'] = $u;
        }
        $this->load->view('modal/view_userinfo',$data);
    }
    public function product(){
        $data = array();
        $id = $_POST['id'];
        $data['item'] = $this->f_homemodel->getFirstRowWhere('product',array(
            'id' => $id
        ));
        $this->load->view('modal/modal_product',$data);
    }
}