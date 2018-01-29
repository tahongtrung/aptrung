<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Imagemodel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function getBannerList($where,$limit,$offset){
        $this->db->select('images.*,product_category.name as cat_name');
        $this->db->join('product_category','product_category.id=images.cate','left');
        $this->db->where('type !=','');
        if(isset($where['title'])){
            $this->db->like('images.title',$where['title']);
        }
        if(isset($where['p'])){
            $this->db->where('images.type',$where['p']);
        }
        if(isset($where['lang'])){
            $this->db->where('images.lang',$where['lang']);
        }
        $this->db->order_by('id','desc');
        if($limit||$offset){
            $this->db->limit($limit,$offset);
        }
        $this->db->order_by('id','desc');
        //echo $this->db->last_query();
        $q=$this->db->get('images');
        return $q->result();
    }
    public function countBanner($where){
        $this->db->select('images.*,product_category.name as cat_name');
        $this->db->join('product_category','product_category.id=images.cate','left');
        $this->db->where('type !=','');
        if(isset($where['title'])){
            $this->db->like('title',$where['title']);
        }
        if(isset($where['p'])){
            $this->db->where('type',$where['p']);
        }
        if(isset($where['lang'])){
            $this->db->where('lang',$where['lang']);
        }
        $q=$this->db->get('images');
        return $q->num_rows();
    }

}