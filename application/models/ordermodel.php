<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordermodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
    public function Getlist_oder($limit,$offset){
        $this->db->select('order.*,province.name as provin_name,district.name as distric_name,ward.name as ward_name');
        $this->db->join('province','order.province=province.provinceid','left');
        $this->db->join('district','order.district=district.districtid','left');
        $this->db->join('ward','order.ward=ward.wardid','left');
        $this->db->limit($limit,$offset);
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

    public function getsearch_result($data,$limit = 0, $offset = 0)
    {
        if(!empty($data))
        {
            if($data['code']==null&&$data['cutommer']==null&&$data['email']==null&&$data['phone']==null){
                return array();
            }$this->db->select('order.*,province.name as provin_name,district.name as distric_name,ward.name as ward_name');
            $this->db->join('province','order.province=province.provinceid','left');
            $this->db->join('district','order.district=district.districtid','left');
            $this->db->join('ward','order.ward=ward.wardid','left');

            if($data['code'] !=''){
                $this->db->like('order.code',$data['code']);
            }
            if($data['cutommer'] !=''){
                $this->db->like('order.fullname',$data['cutommer']);
            }
            if($data['phone'] !=''){
                $this->db->like('order.phone',$data['phone']);
            }
            if($data['email'] !=''){
                $this->db->like('order.email',$data['email']);
            }

             if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->order_by('order.id', 'desc');
            $q = $this->db->get('order');
            return $q->result();
        }
    }

    public function countsearch_result($data)
    {
        if(!empty($data))
        {
            if($data['code']==null&&$data['cutommer']==null&&$data['email']==null&&$data['phone']==null){
                return 0;
            }
            $this->db->select('order.*');


            if($data['code'] !=''){
                $this->db->like('order.code',$data['code']);
            }
            if($data['cutommer'] !=''){
                $this->db->like('order.fullname',$data['cutommer']);
            }
            if($data['phone'] !=''){
                $this->db->like('order.phone',$data['phone']);
            }
            if($data['email'] !=''){
                $this->db->like('order.email',$data['email']);
            }

            $q = $this->db->get('order');
            return $q->num_rows();
        }
    }
    public function getListPrints($data){
        $this->db->select('order.*,order_item.*,product.name');
        $this->db->join('order_item','order_item.order_id = order.id','left');
        $this->db->join('product','product.id = order_item.item_id','left');
        if($data['status'] !=''){
            $this->db->where('order.status',$data['status']);
        }
        if(($data['date_start'] !='')&&($data['date_end'] !='')){
            $this->db->where('order.time >=',$data['date_start']);
            $this->db->where('order.time <=',$data['date_end']);
        }
        $q = $this->db->get('order');
        return $q->result();
    }
}
