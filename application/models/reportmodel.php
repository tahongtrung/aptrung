<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportmodel extends MY_Model{
    function __construct() {
        parent::__construct();
    }


    public function get_soldout($num,$limit=0,$offset=0){
        $this->db->select('product.*,product_category.name as cat_name');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.id=product.category_id', 'left');
        $this->db->where('product.counter <=', $num);

        $this->db->order_by('product.counter', 'asc');
        $q = $this->db->get('',$limit, $offset);
        return $q->result();
    }

    public function count_soldout($num){
        $this->db->select('product.*,product_category.name as cat_name');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.id=product.category_id', 'left');
        $this->db->where('product.counter <=', $num);

        $q = $this->db->get('');
        return $q->num_rows();
    }


    public function getsearch_soldout($num,$data,$limit = 0, $offset = 0)
    {


        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['code']==null){
                return array();
            }
            $this->db->select('product.*,product_category.name as cat_name');
            $this->db->from('product');
            $this->db->join('product_category', 'product_category.id=product.category_id', 'left');
            $this->db->where('product.counter <=',$num);
            if($data['name'] !=''){
                $this->db->like('product.name',$data['name']);
            }
            if($data['code'] !=''){
                $this->db->where('product.code',$data['code']);
            }
            if($data['cate'] !=''){
                $q1 = $this->db->query("SELECT id,alias FROM product_category where alias = '" . $data['cate'] . "'")->first_row();
                $this->db->where_in('product.category_id', $this->getArrayChildCate($q1->id,true));
            }
            if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('product.id', 'desc');
            $q = $this->db->get();

            return $q->result();
        }
    }
    public function countsearch_soldout($num,$data)
    {
        if(!empty($data))
        {
            if($data['name']==null&&$data['cate']==null&&$data['code']==null){
                return 0;
            }
            $this->db->select('product.*,product_category.name as cat_name');
            $this->db->from('product');
            $this->db->join('product_category', 'product_category.id=product.category_id', 'left');
            $this->db->where('product.counter <=',$num);
            if($data['name'] !=''){
                $this->db->like('product.name',$data['name']);
            }
            if($data['code'] !=''){
                $this->db->where('product.code',$data['code']);
            }
            if($data['cate'] !=''){
                $q1 = $this->db->query("SELECT id,alias FROM product_category where alias = '" . $data['cate'] . "'")->first_row();
                $this->db->where_in('product.category_id', $this->getArrayChildCate($q1->id,true));
            }
            $q = $this->db->get();

            return $q->num_rows();
        }
    }



    public function get_bestsellers($from,$to){

        $this->db->select('order.id,order.time as ordertime,sum(order_item.count) as soluongban,
        product.name,product.first_quantity,product.counter,
        product_category.name as cat_name');
        $this->db->join('order','order.id=order_item.order_id');
        $this->db->join('product','product.id=order_item.item_id');
        $this->db->join('product_category','product.category_id=product_category.id','left');
        if($from!=null&&$to!=null){
            $this->db->where(array('order.time >='=>$from,'order.time <='=>$to,));
        }
        $this->db->where(array('order.status'=>1));
        $this->db->group_by('order_item.item_id');
        $this->db->order_by('soluongban','desc');
        $this->db->limit(20);
        $q2= $this->db->get('order_item');
//        echo  $this->db->last_query();
        return $q2->result();
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

}