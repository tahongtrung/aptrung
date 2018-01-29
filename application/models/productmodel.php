<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productmodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }


    function lookup($keyword)
    {
        $this->db->select('*')->from('product');
        $this->db->like('name', $keyword);
        $query = $this->db->get();
        return $query->result();
    }
    public function DeleteCategory($id)
    {
        $arrs = $this->getArrayChildCate($id);
        if(count($arrs)){
            foreach($arrs as $val){
                if((int)$val > 0){
                    $q1 = $this->db->query("SELECT id,alias,image FROM product_category where id = '" . $val . "'");
                    $item = @$q1->first_row();
                    $this->db->where('id',$val);
                    $this->db->delete('product_category');
                    if(file_exists(@$item->image)){
                        @unlink($item->image);
                    }
                    $q2 = $this->db->query("SELECT id FROM alias where pro_cat = '" . $val . "'");
                    $item_alias = $q2->first_row();
                    if(!empty($item_alias)){
                        $this->db->where('pro_cat',$val);
                        $this->db->delete('alias');
                    }
                }
            }
        }
        else return false;
    }
    public function getArrayChildCate($id,$recursive=false)
    {
        $arr[]=$id;

        $q1 = $this->db->query("SELECT id FROM product_category where parent_id = '" . $id . "'")->result();
        if (isset($q1) && !empty($q1)) {
            foreach ($q1 as $v) {
                $arr[] = $v->id;
                if($recursive=true){
                    $arr=array_unique(array_merge($arr,$this->getArrayChildCate($v->id,true)));
                }

            }
        }
        return $arr;
    }


    public function getsearch_result($data,$limit = 0, $offset = 0)
    {
        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['view']==null&&$data['code']==null&&$data['lang']==null){
                return array();
            }
            $this->db->select('product.*,product_category.name as cat_name,product_to_category.id_product,product_to_category.id_category');
            $this->db->from('product');
            $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
            $this->db->join('product_category', 'product_category.id=product_to_category.id_category','left');
            $this->db->join('users', 'users.id=product.user','left');

            if($data['name'] !=''){
                $this->db->like('product.name',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('product.'.$data['view'],'1');
            }
            if($data['code'] !=''){
                $this->db->where('product.code',$data['code']);
            }
            if($data['lang'] !=''){
                $this->db->where('product.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('product_category.alias',$data['cate']);
            }
            if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by('product.id');
            $this->db->order_by('product.id', 'desc');
            $q = $this->db->get();

            return $q->result();
        }
    }
    public function countsearch_result($data)
    {
        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['view']==null&&$data['code']==null&&$data['lang']==null){
                return 0;
            }
            $this->db->select('product.*,product_category.name as cat_name,product_to_category.id_product,product_to_category.id_category');
            $this->db->from('product');
            $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
            $this->db->join('product_category', 'product_category.id=product_to_category.id_category','left');
            $this->db->join('users', 'users.id=product.user','left');

            if($data['name'] !=''){
                $this->db->like('product.name',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('product.'.$data['view'],'1');
            }
            if($data['code'] !=''){
                $this->db->where('product.code',$data['code']);
            }
            if($data['lang'] !=''){
                $this->db->where('product.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('product_category.alias',$data['cate']);
            }
            $this->db->group_by('product.id');
            $this->db->order_by('product.id', 'desc');
            $q = $this->db->get();
            return $q->num_rows();
        }
        else{
            return 0;
        }
    }


        //====================================================================================================================
    public function getListProduct($where,$limit,$offset){

        $this->db->select('product.*,
        product_category.id as cat_id,
        product_category.name as cat_name,
        product_category.alias as cat_alias,
        product_to_category.id_product,
        product_to_category.id_category');
        $this->db->from('product');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->where($where);
            if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('product.id', 'desc');
            $this->db->group_by('product.id');
            $q = $this->db->get();
            return $q->result();
    }
    public function countByLang($where){
        $this->db->select('product.id');
        $this->db->from('product');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->where($where);
        $this->db->order_by('product.id', 'desc');
        //$this->db->group_by('product.id');
        $q = $this->db->get();
        return $q->num_rows();
    }
/*    public function getProImage($id){
        $this->db->select('product.id as pro_id, product.name as pro_name,file.*, file.id as img_id ');
        $this->db->join('product','product.id=file.id_item','left');
        $this->db->where('product.id',$id);
        $q=$this->db->get('file');
        return $q->result();
    }*/
    public function getProImage($id){
        $this->db->select('product.id as pro_id, product.name as pro_name,images.*, images.id as img_id ');
        $this->db->join('product','product.id=images.id_item','left');
        $this->db->where('product.id',$id);
        $q=$this->db->get('images');
        return $q->result();
    }
    public function ProductBycategory($id,$limit,$offset){
        $q= $this->db->select('product.id as pro_id, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.id_product,product_to_category.id_category')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',$id)
            ->order_by('product.id','desc')
            ->group_by('product.id')
            ->limit($limit,$offset)
            ->get('product');
//        echo $q->last_query();

        return $q->result();
    }

    /*count  news by category*/
    public function countProByCategory($id){

        $q= $this->db->select('product.id as pro_id, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.id_product,product_to_category.id_category')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',$id)
            ->group_by('product.id')
            ->get('product');
        return $q->num_rows();
    }

    public function getListRoot(){
        $this->db->select('*');
        $this->db->where('parent_id =',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getListChil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function Deltete_cate($id_pro){
        if(is_numeric($id_pro)){
            $this->db->where('id_product',$id_pro);
            $this->db->delete('product_to_category');
        }else return false;
    }

    public function Getdata_search($table,$where = null,$order=null, $limit = null, $offset = null)
    {
        $this->db->select(' product.*,product.id as pro_id,  product_category.id as cate_id, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id','left');

        if (is_array($where)||$where!=null) {
            $this->db->like($where);
        }

        if ($limit || $offset) {
            $this->db->limit($limit, $offset);
        }
        if (is_array($order)) {
            $this->db->order_by($order[0],$order[1]);
        }

        $q = $this->db->get($table);
        return $q->result();
    }
    public function Count_search($table,$where= null)
    {
        $this->db->select(' product.*,product.id as pro_id,  product_category.id as cate_id, product_category.name as cate_name');
        $this->db->join('product_category','product.category_id=product_category.id','left');

        if (is_array($where)||$where!=null) {
            $this->db->like($where);
        }
        $q= $this->db->get($table);
        return $q->num_rows();
    }
}