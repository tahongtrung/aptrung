<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chat_frontend extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('chat_model');
        
    }

    public function get_message(){
         $convoID = $this->input->post('convoID');
         $array_msg = $this->chat_model->get_message_byConvoId($convoID);
         echo json_encode($array_msg);
    }
     public  function create_session(){
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $location = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

            if(isset($location->city)){
                $address = $location->city;
            }
            else{
                $address = "";
            }
            
            
            $salt = rand(100,999);
            $userID = "khach". $ip . $salt;
            $_SESSION['name'] = "khach".time();
            $_SESSION['userID'] = $userID;
            $_SESSION['email'] = "Not Set";
            $message = $this->input->post('message');

            $arr=array('userID' => $userID,
                'convoID' => "",
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email'],
                'initiated' => time(),
                'status' => "open",
                'ended' => "",
                'updated' => "",
                'answered' => "",
                'contact' => "yes",
                'hide' => "",
                'loginTime' => date('Y-m-d H:i:s'),
                'location'=>$address                   
            );

            $session_just = $this->chat_model->Add_tran_session($arr,$message);

            $_SESSION['convoID'] = $session_just->convoID;

            echo json_encode($session_just);
        }

        public function insert_message(){

            $name = $this->input->post('name');
            if (strpos($name,'khach') !== false) {
                $class="user";
            }
            else{
                 $class="admin";
            }
            $message = $this->input->post('message');
            $userID = $this->input->post('userID');
            $convoID = $this->input->post('convoID');
            
            $arr = array('name' => $name,
                'message' => $message,
                'user' => $userID,
                'convoID' => $convoID,
                'time' => time(),
                'class' => $class,
                'time_chat' => date('Y-m-d H:i:s')
                                   
            );
            $id = $this->chat_model->insert_message_tran_sess($arr);
        
        }
        public function insert_message_off(){

            $name = $this->input->post('name');
            $message = $this->input->post('message');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            
            $ip = $_SERVER['REMOTE_ADDR'];
            $location = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            if(isset($location->city)  && is_object($location->city)){
                $location_detail = $location->city;
            }
            else{
                $location_detail = "";
            }


            $arr = array('name' => $name,
                        'message' => $message,
                        'email' => $email,
                        'address' => $address,
                        'location' => $location_detail,
                        'time_chat'=> date('Y-m-d H:i:s'),
                        'ip_khachhang'=>$ip
                                   
            );

            $id = $this->chat_model->Add('chat_transcript_offline',$arr); 
            if($id){
                echo "success";
            }
            else{
                echo "failed";
            }
        
        }
        public function remove_session(){
             $convoID = $this->input->post('convoID');
             $name = $this->input->post('name');
             $user = $this->input->post('user');
             
             $array = array('name' => $name, 'message'=>'Khách hàng đăng xuất', 'user'=>$user,'convoID'=>$convoID, 'time'=>time(),'class'=>'notice');
             $id = $this->chat_model->remove_session($convoID,$array);
             session_destroy();

        }
   

   
}