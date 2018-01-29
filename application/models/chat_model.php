<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
  public function getConfig_Chat()
    {
        $this->db->select('*');
        $q = $this->db->get('chat_config');
        return $q->first_row();
    }
    public function get_message_byConvoId($convoID){
         $this->db->select('*');
         $this->db->where('chat_transcript.convoID',$convoID);
         $this->db->order_by('chat_transcript.id','asc');
         $q = $this->db->get('chat_transcript');
         return $q->result();
    }
    public function Add_tran_session($array,$message)
    {
        
         if (isset($array) && $array != NULL) {
            $this->db->insert("chat_sessions", $array);
            $sessionID = $this->db->insert_id();

            $datachat = array(
                'convoID' => $sessionID
            );
            $this->db->where('chat_sessions.id',$sessionID);
            $this->db->update('chat_sessions',$datachat);

            $this->db->where('chat_sessions.id',$sessionID);
            $q = $this->db->get('chat_sessions');

            $arrayTrans = array('name' => 'Nhân viên tư vấn',
                'message'=>$message,
                'convoID'=>$sessionID,
                'time'=>date('g:i a'),
                'class'=>'admin',
                'time_chat'=>$array['loginTime']
                 );
            $this->db->insert("chat_transcript", $arrayTrans);

            return $q->first_row();
         
        }
    }
    public function insert_message_tran_sess($array)
    {
        
         if (isset($array) && $array != NULL) {
            $this->db->insert("chat_transcript", $array);
            $uid =  $array['user'];
            
           
            $datachat = array(
                'updated' => time()
            );
            $this->db->where('chat_sessions.userID',$uid);
            $this->db->update('chat_sessions',$datachat);
            return $uid;
        }
    }
    public function remove_session($convoID,$array){
        if($convoID){
            $datachat = array(
                'status' => 'closed',
                'ended'=>time()
            );
            $this->db->where('chat_sessions.convoID',$convoID);
            $this->db->update('chat_sessions',$datachat);
             
            $this->db->insert("chat_transcript", $array);
        }
        
    }
     public function update($id,$data,$table){
        if(isset($data) && $data != NULL){
            $this->db->where('id',$id);
            $this->db->update($table,$data);
        }
    }
     public function update_byField($id,$field,$data,$table){
        if(isset($data) && $data != NULL){
            $this->db->where($field,$id);
            $q = $this->db->update($table,$data);
            
        }
    }
     public function Delete_table_by_field($table,$id,$field)
    {
        if (is_numeric($id)) {
            $this->db->where($field, $id);
            $this->db->delete($table);
        } else return false;
    }
     public function Get_transcript($limit,$offset){

            $query = $this->db->select('chat_transcript.id as trans_id,chat_transcript.message as msg, chat_transcript.name,chat_transcript.user,chat_transcript.convoID,chat_sessions.location,chat_sessions.loginTime')
            ->from('chat_transcript')
            ->join('chat_sessions', 'chat_sessions.id = chat_transcript.convoID',"left")
            ->where('chat_transcript.user !=',"")
            ->group_by('chat_transcript.convoID')
            ->order_by('msg','desc')
            ->get('', $limit, $offset);

             return $query->result();
     }
     
    public function count_group_by($table){
        $q = $this->db->select('*')
            ->from($table)
             ->where('chat_transcript.user !=',"")
             ->group_by('chat_transcript.convoID')
            ->get();
        return $q->num_rows();
    }
       public function count_unread_message($id){
        $q = $this->db->select('*')
            ->from('chat_transcript')
             ->where('chat_transcript.convoID',$id)
             ->where('chat_transcript.has_read',0)
              ->where('chat_transcript.class !=','admin')
            ->get();
        return $q->num_rows();
    }
   
}