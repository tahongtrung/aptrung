<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_comment extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function listAllComment($limit,$offset)
    {
        $this->db->select('comments_binhluan.*,comments_binhluan.id as id_comment,
        product.name as pro_name,
        product.id as pro_id,
        product.alias as pro_alias,
        product.category_id as cate_id,
        product.alias');
        $this->db->join('product','product.id=comments_binhluan.id_sanpham','left');
        $this->db->join('users','users.id=comments_binhluan.userid','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('comments_binhluan.id','desc');
        $this->db->group_by('comments_binhluan.id');
        $q = $this->db->get('comments_binhluan');
        return $q->result();
    }
    public function countComment()
    {
        $this->db->select('comments_binhluan.*,users.fullname as user_name,product.name as pro_name, product.alias');
        $this->db->join('product','product.id=comments_binhluan.id_sanpham','left');
        $this->db->join('users','users.id=comments_binhluan.userid','left');
        $q = $this->db->get('comments_binhluan');
        return $q->num_rows();
    }
}