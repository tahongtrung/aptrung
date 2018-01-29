<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Captchacode extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('comment_model');
    }
    public function getCaptcha()
    {
        $sess = $_POST['code_captcha'];
        if($sess == 1)
        {
            $this->ci =& get_instance();
            @unlink($this->session->userdata('sessionPathCaptchaPostAds1'));
            #BEGIN: Create captcha post ads
            $this->load->library('captcha');
            $codeCaptcha = $this->captcha->code(5);
            //$this->session->set_flashdata('sessionCaptchaPostAds', $codeCaptcha);
            $imageCaptcha = 'assets/captcha/'.md5(microtime()).'posa.jpg';
            $this->ci->session->set_userdata('sessionPathCaptchaPostAds1', $imageCaptcha);
            $this->captcha->create($codeCaptcha, $imageCaptcha);
            if(file_exists($imageCaptcha))
            {
                $data['imageCaptchaPostAds'] = $imageCaptcha;
            }
            $data['code_captcha'] = $codeCaptcha;
        }
        $this->load->view('captcha/view_captcha',$data);
        //echo json_decode($data);
    }
    function _valid_captcha_post($str)
    {
        if($this->session->flashdata('sessionCaptchaPostAds') && $this->session->flashdata('sessionCaptchaPostAds') === $str)
        {
            return true;
        }
        return false;
    }
    function checkCaptcha()
    {
        $code_captcha = $_POST['code_captcha'];
        $captcha_user = $_POST['captch_user'];
        if($code_captcha !=''){
            $rs['check'] = false;
            $rs['ms'] = 'Mã nhập không chính xác';
            //$rs['code'] = $this->session->flashdata('sessionCaptchaPostAds');
            if($captcha_user == $code_captcha)
            {
                $rs['ms'] = '';
                $rs['check'] = true;
            }
        }else{
            $rs['ms'] = 'Mã xác nhận không được để trống';
        }
        echo json_encode($rs);
    }
    function checkCaptchaUser()
    {
        $code_captcha = $_POST['code_captcha'];
        $captcha_check = $_POST['captcha_check'];
        if($code_captcha !=''){
            $rs['check'] = false;
            $rs['ms'] = 'Mã nhập không chính xác';
            if($captcha_check == $code_captcha)
            {
                $rs['ms'] = '';
                $rs['check'] = true;
            }
        }else{
            $rs['ms'] = 'Mã xác nhận không được để trống';
        }
        echo json_encode($rs);
    }
}