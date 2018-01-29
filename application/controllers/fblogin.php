<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/facebook.php';
class Fblogin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('f_usersmodel');
        $this->load->helper('url');
        $this->config->load('facebook');
        //$this->load->library('session');
    }
    public function login(){
        //$this->load->library('facebook',$faceConfig);
        $facebook = new Facebook(array(
            'appId'  => '1058195500877761',
            'secret' => '79bd813dd2c110c4cca88f0880b59fbc',
            'cookie' => true
        ));
        $user =  $facebook->getUser();
        //echo "<pre>";var_dump($user);die();
        if($user) {
            try {
                $user_profile =  $facebook->api('/me',array('fields' => 'id,email,first_name,last_name,picture,gender,birthday,languages'));
                $data['user_profile'] = @$user_profile;
                $user_info = $this->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['picture']['data']['url']);
                $this->auth->loginUser($user_info);
                redirect(base_url());
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
    }
    public function checkUser($oauth_provider,$oauth_uid,$fname,$lname,$email,$gender,$picture){
        $fullname = $fname.$lname;
        $prev_query = $this->f_usersmodel->getFirstRowWhere('users',array(
            'provider' => $oauth_provider,
            'profile_id' => $oauth_uid
        ));

        if(!empty($prev_query)){
            $this->f_usersmodel->Update_where('users',array(
                'provider' => $oauth_provider,
                'profile_id' => $oauth_uid,
            ),array(
                'provider' => $oauth_provider,
                'profile_id' => $oauth_uid,
                'fullname' => $fullname,
                'email' => $email,
                'gender' => $gender,
                'avatar' => $picture
            ));
        }else{
            $this->f_usersmodel->Add('users',array(
                'provider' => $oauth_provider,
                'profile_id' => $oauth_uid,
                'fullname' => $fullname,
                'email' => $email,
                'gender' => $gender,
                'avatar' => $picture,
                'signup_date' => time()
            ));
        }

        $result = $this->f_usersmodel->getFirstRowWhere('users',array(
            'provider' => $oauth_provider,
            'profile_id' => $oauth_uid
        ));
        return $result;
    }
}