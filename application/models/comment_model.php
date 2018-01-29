<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class comment_model extends MY_Model{
        function __construct() {
            parent::__construct();
            $this->load->helper('model');
        }


        public function AddContact(){

        }
        /*banner 1*/
        public function getBanner($type,$offset){
            $this->db->select('*');
            $this->db->where('type',$type);
            $this->db->limit(1, $offset);
            $this->db->order_by('sort','esc');
            $q = $this->db->get('images');
            return $q->result();
        }

    }