<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_usersmodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function getPage($alias){
        $this->db->select('*');
        $this->db->where('alias',$alias);
        $q=$this->db->get('staticpage');
        return $q->first_row();
    }
    public function loginUser($username,$password){
        if($username==null || $password==null)
            return false;
        $this->db->where('email',$username);
        $user = $this->db->get('users');
        if($user->num_rows<=0|| $user->num_rows>1)
            return false;
        $user=$user->first_row();

        for($i =1; $i <=5; $i++)
            $password = md5($password);

        if($user->password === $password){
            $datauser = array(
                'last_login' => time()
            );
            $this->db->where('id',$user->id);
            $this->db->update('users',$datauser);

            return $user;
        }
    }
    public function update_pass_user($id,$array){
        if(isset($id)&&is_array($array)){
            $this->db->where('id',$id);
            $this->db->update('users', $array);
            return $id;
        }else return false;
    }
    public function coutnUserOrder($uId){
        $this->db->select('order.id');
        $this->db->join('province','order.province=province.provinceid','left');
        $this->db->join('district','order.district=district.districtid','left');
        $this->db->join('users','order.user_id=users.id','left');
        $this->db->join('ward','order.ward=ward.wardid','left');
        $this->db->where('users.id',$uId);
        $this->db->order_by('id','desc');
        $q=$this->db->get('order');
        return $q->num_rows();
    }
    public function Getlist_oder($uId,$limit,$offset){
        $this->db->select('order.*,province.name as provin_name,district.name as distric_name,ward.name as ward_name');
        $this->db->join('province','order.province=province.provinceid','left');
        $this->db->join('district','order.district=district.districtid','left');
        $this->db->join('users','order.user_id=users.id','left');
        $this->db->join('ward','order.ward=ward.wardid','left');
        $this->db->where('users.id',$uId);
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $q=$this->db->get('order');
        return $q->result();
    }
    public function order_detail($order_id){
        $this->db->select('product.id as product_id,product.name,product.pro_dir,product.image,order_item.*,order.id as or_id,order.price_ship');
        $this->db->join('product','product.id=order_item.item_id');
        $this->db->join('order','order.id=order_item.order_id');
        $this->db->where_in('order_item.order_id',$order_id);
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('order_item');
        return $q->result();
    }
    public function getUserListOrder($where,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->where('user_id',$where);
        $this->db->where('view','1');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $q=$this->db->get('order');
        return $q->result();
    }
    public function countUserListOrder($where)
    {
        $this->db->select('*');
        $this->db->where('user_id',$where);
        $this->db->where('view','1');
        //$this->db->limit($limit,$offset);
        $this->db->order_by('id','desc');
        $q=$this->db->get('order');
        return $q->num_rows();
    }
    public function UserOderDetail($where)
    {
        $this->db->select('product.id as product_id,product.name,order_item.*');
        $this->db->join('product','product.id=order_item.item_id');
        $this->db->join('order','order.id=order_item.order_id');
        $this->db->where('order.user_id',$where);
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('order_item');
        return $q->result();
    }

    public function getListProLike($where,$limit,$offset)
    {
        if(is_array($where)&&!empty($where))
        {
            $this->db->select('id,name,alias,image,price');
            $this->db->where_in('id',$where);
            $this->db->order_by('name');
            $this->db->limit($limit,$offset);
            $q = $this->db->get('product');
            return $q->result();
        }else{
            return array();
        }
    }

    public function countListProLike($where)
    {
        if(is_array($where)&&!empty($where))
        {
            $this->db->select('id');
            $this->db->where_in('id',$where);
            $q = $this->db->get('product');
            return $q->num_rows();
        }else{
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
            $this->db->select('product.*,product_category.name as cat_name,product_to_category.id_product,product_to_category.id_category');
            $this->db->from('product');
            $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
            $this->db->join('product_category', 'product_category.id=product_to_category.id_category','left');

            $this->db->where('product.user',$data['user']);
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

            $this->db->where('product.user',$data['user']);
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

    public function get_user_orders($user,$limit,$offset){
        $this->db->select('
            order.*,
            order_item.shop,
            order_item.order_id,
            order_item.item_id
        ');
        $this->db->from('order');
        $this->db->join('order_item','order_item.order_id=order.id','left');
        $this->db->where('order_item.shop',$user);
        $this->db->group_by('order.id');
        $this->db->order_by('order.id','desc');
        $q= $this->db->get('',$limit,$offset);
        return $q->result();
    }
    public function count_user_orders($user){
        $this->db->select('
            order.*,
            order_item.shop,
            order_item.order_id,
            order_item.item_id
        ');
        $this->db->from('order');
        $this->db->join('order_item','order_item.order_id=order.id','left');
        $this->db->where('order_item.shop',$user);
        $this->db->group_by('order.id');
        $this->db->order_by('order.id','desc');
        $q= $this->db->get('');
        return $q->num_rows();
    }
    public function get_user_orders_item($orderid){
        $this->db->select('
            order_item.*,
            product.name,
        ');
        $this->db->join('product','order_item.item_id=product.id');
        $this->db->where_in('order_id',$orderid);
        $q= $this->db->get('order_item');
        return $q->result();
    }
}