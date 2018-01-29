<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inuser_model extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }

    public function getArrayChildCate($id,$recursive=false)
    {
        $arr[]=$id;

        $q1 = $this->db->query("SELECT id FROM inuser_category where parent_id = '" . $id . "'")->result();
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
            if($data['name']==null&&$data['cate']==null&&$data['view']==null&&$data['lang']==null){
                return array();
            }
            $this->db->select('inuser.*,inuser_category.name as cat_name,inuser_to_category.id_inuser,inuser_to_category.id_category');
            $this->db->from('inuser');
            $this->db->join('inuser_to_category', 'inuser.id=inuser_to_category.id_inuser','left');
            $this->db->join('inuser_category', 'inuser_category.id=inuser_to_category.id_category','left');

            if($data['name'] !=''){
                $this->db->like('inuser.title',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('inuser.'.$data['view'],'1');
            }
            if($data['lang'] !=''){
                $this->db->where('inuser.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('inuser_category.alias',$data['cate']);
            }
            if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by('inuser.id');
            $this->db->order_by('inuser.id', 'desc');
            $q = $this->db->get();
            return $q->result();
        }
    }
    public function countsearch_result($data)
    {
        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['view']==null&&$data['lang']==null){
                return 0;
            }
            $this->db->select('inuser.*,inuser_category.name as cat_name,inuser_to_category.id_inuser,inuser_to_category.id_category');
            $this->db->from('inuser');
            $this->db->join('inuser_to_category', 'inuser.id=inuser_to_category.id_inuser','left');
            $this->db->join('inuser_category', 'inuser_category.id=inuser_to_category.id_category','left');

            if($data['name'] !=''){
                $this->db->like('inuser.title',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('inuser.'.$data['view'],'1');
            }
            if($data['lang'] !=''){
                $this->db->where('inuser.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('inuser_category.alias',$data['cate']);
            }
            $this->db->group_by('inuser.id');
            $q = $this->db->get();
            //echo  $this->db->last_query();
            return $q->num_rows();
        }
        else{
            return 0;
        }
    }
    public function getList($table){
        $this->db->select('*');
        $q=$this->db->get($table);
        return $q->result();
    }
    public function inuserListAll($limit,$offset){
        $this->db->select('inuser.*, inuser_category.id as cate_id, inuser_category.name as cat_name ');
        $this->db->join('inuser_category','inuser.category_id=inuser_category.id','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('inuser.id','desc');
        $q=$this->db->get('inuser');
        return $q->result();
    }

    public function inuserBycategory($alias,$limit,$offset){
        $this->db->select('inuser.id as inuser_id, inuser.title, inuser.alias,inuser.category_id,inuser.home,inuser.hot,inuser.focus,inuser.image, inuser_category.id as cate_id,
         inuser_category.name as cate_name,inuser_category.alias as cate_alias');
        $this->db->join('inuser_category','inuser.category_id=inuser_category.id','left');
        $this->db->where('inuser_category.alias',$alias);

        $this->db->limit($limit,$offset);

        $q=$this->db->get('inuser');
        return $q->result();
    }
    /*count  inuser by category*/
    public function countinuserByCategory($alias){
        $this->db->select('inuser.id as inuser_id, inuser.category_id,inuser.home,inuser.hot,inuser.focus,inuser.image, inuser_category.id as cate_id,
         inuser_category.name as cate_name,inuser_category.alias as cate_alias');
        $this->db->join('inuser_category','inuser.category_id=inuser_category.id','left');
        $this->db->where('inuser_category.alias',$alias);;
        $q=$this->db->get('inuser');
        return $q->num_rows();
    }
    public function getinuserByID($id){
        $this->db->where('id',$id);
        $q=$this->db->get('inuser');
        return $q->first_row();
    }

    public function getListRoot(){
        $this->db->select('*');
        $this->db->where('parent_id =',0);
        $q=$this->db->get('inuser_category');
        return $q->result();
    }
    public function getListChil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('inuser_category');
        return $q->result();
    }

    public function get_order_dashboard(){
        $this->db->select('order.*,province.name as provin_name,district.name as distric_name,ward.name as ward_name');
        $this->db->join('province','order.province=province.provinceid','left');
        $this->db->join('district','order.district=district.districtid','left');
        $this->db->join('ward','order.ward=ward.wardid','left');
        $this->db->where('order.status','0');
        $this->db->order_by('id','desc');
        $q=$this->db->get('order');
        return $q->result();
    }

    public function order_detail($order_id){
        $this->db->select('product.id as product_id,product.name,order_item.*');
        $this->db->join('product','product.id=order_item.item_id');
        $this->db->where_in('order_item.order_id',$order_id);
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('order_item');
        return $q->result();
    }



    public function contact_dashboard(){
        $this->db->where('show','0');
        $this->db->order_by('id','desc');
        $q=$this->db->get('contact');
        return $q->result();
    }

    public function countByLang($where)
    {
        $this->db->select('inuser.*,inuser_category.name as cat_name,inuser_to_category.id_inuser,inuser_to_category.id_category');
        $this->db->from('inuser');
        $this->db->join('inuser_to_category', 'inuser.id=inuser_to_category.id_inuser','left');
        $this->db->join('inuser_category', 'inuser_category.id=inuser_to_category.id_category','left');
        $this->db->where($where);
        $q = $this->db->get();
        //echo  $this->db->last_query();
        return $q->num_rows();
    }
    public function getNewByLang($where,$limit,$offset)
    {
        $this->db->select('inuser.*,inuser_category.name as cat_name,inuser_to_category.id_inuser,inuser_to_category.id_category');
        $this->db->from('inuser');
        $this->db->join('inuser_to_category', 'inuser.id=inuser_to_category.id_inuser','left');
        $this->db->join('inuser_category', 'inuser_category.id=inuser_to_category.id_category','left');
        $this->db->where($where);
        $this->db->limit($limit,$offset);
        $q = $this->db->get();
        //echo  $this->db->last_query();
        return $q->result();
    }
}
