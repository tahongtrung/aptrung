<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_media extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }
    public function GetDocByItemId($arr)
    {
        if(count($arr))
        {
            $this->db->select('*');
            $this->db->where_in('id_item',$arr);
            $this->db->order_by('id','desc');
            $q = $this->db->get('images');
            return $q->result();
        }else{
            return null;
        }
    }
    public function selectMaxCol($table,$col,$pro_id)
    {
        if (($table && $col)) {
            $this->db->select_max($col);
            $this->db->where('id_item',$pro_id);
            return $this->db->get($table)->first_row()->$col;
        } else return false;
    }
    public function countByLang($where){
        $this->db->select('media.id');
        $this->db->from('media');
        $this->db->join('media_category', 'media_category.id=media.category_id','left');
        $this->db->where($where);
        $this->db->order_by('media.id', 'desc');
        //$this->db->group_by('media.id');
        $q = $this->db->get();
        return $q->num_rows();
    }

    public function getListMedia($where,$limit,$offset){

        $this->db->select('media.*,
        media_category.id as cat_id,
        media_category.name as cat_name,
        media_category.alias as cat_alias,');
        $this->db->from('media');
        $this->db->join('media_category', 'media_category.id=media.category_id','left');
        $this->db->where($where);
        if($limit||$offset){
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('media.id', 'desc');
        $this->db->group_by('media.id');
        $q = $this->db->get();
        return $q->result();
    }
    public function countsearch_result($data)
    {
        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['view']==null&&$data['code']==null&&$data['lang']==null){
                return 0;
            }
            $this->db->select('media_category.name as cat_name,');
            $this->db->from('media');
            $this->db->join('media_category', 'media_category.id=media.category_id','left');

            if($data['name'] !=''){
                $this->db->like('media.name',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('media.'.$data['view'],'1');
            }
            if($data['lang'] !=''){
                $this->db->where('media.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('media_category.alias',$data['cate']);
            }
            $this->db->group_by('media.id');
            $this->db->order_by('media.id', 'desc');
            $q = $this->db->get();
            return $q->num_rows();
        }
        else{
            return 0;
        }
    }
    public function getsearch_result($data,$limit = 0, $offset = 0)
    {
        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['view']==null&&$data['code']==null&&$data['lang']==null){
                return array();
            }
            $this->db->select('media.*,media_category.name as cat_name,');
            $this->db->from('media');
            $this->db->join('media_category', 'media_category.id=media.category_id','left');

            if($data['name'] !=''){
                $this->db->like('media.name',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('media.'.$data['view'],'1');
            }
            if($data['lang'] !=''){
                $this->db->where('media.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('media_category.alias',$data['cate']);
            }
            if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by('media.id');
            $this->db->order_by('media.id', 'desc');
            $q = $this->db->get();

            return $q->result();
        }
    }
    public function getMediaImage($id){
        $this->db->select('media.id as pro_id, media.name as pro_name,images.*, images.id as img_id ');
        $this->db->join('media','media.id=images.id_item','left');
        $this->db->where('media.id',$id);
        $q=$this->db->get('images');
        return $q->result();
    }
    public function getMediaByCategory($id,$limit,$offset){
        $id = (int)$id;
        $query = $this->db->select('media.id,
                                    media.name,
                                    media.description,
                                    media.alias,
                                    media.category_id,
                                    media.image,
                                    media_category.id as cat_id,
                                    media_category.name as cat_name,
                                    media_category.alias as cat_alias,
                                    media_category.parent_id,
                                    ')
            ->from('media')
            ->join('media_category', 'media_category.id = media.category_id')
            ->where('media_category.id',$id)
            ->group_by('media.id')
            ->limit($limit,$offset)
            ->get('');
        return $query->result();

    }
}