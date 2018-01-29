<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
        $this->load->database();
    }

    public function getArrayChildCate($id,$recursive=false)
    {
        $arr[]=$id;

        $q1 = $this->db->query("SELECT id FROM news_category where parent_id = '" . $id . "'")->result();
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
            $this->db->select('news.*,news_category.name as cat_name,news_to_category.id_news,news_to_category.id_category');
            $this->db->from('news');
            $this->db->join('news_to_category', 'news.id=news_to_category.id_news','left');
            $this->db->join('news_category', 'news_category.id=news_to_category.id_category','left');

            if($data['name'] !=''){
                $this->db->like('news.title',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('news.'.$data['view'],'1');
            }
            if($data['lang'] !=''){
                $this->db->where('news.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('news_category.alias',$data['cate']);
            }
            if($limit||$offset){
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by('news.id');
            $this->db->order_by('news.id', 'desc');
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
            $this->db->select('news.*,news_category.name as cat_name,news_to_category.id_news,news_to_category.id_category');
            $this->db->from('news');
            $this->db->join('news_to_category', 'news.id=news_to_category.id_news','left');
            $this->db->join('news_category', 'news_category.id=news_to_category.id_category','left');

            if($data['name'] !=''){
                $this->db->like('news.title',$data['name']);
            }
            if($data['view'] !=''){
                $this->db->where('news.'.$data['view'],'1');
            }
            if($data['lang'] !=''){
                $this->db->where('news.lang',$data['lang']);
            }
            if($data['cate'] !=''){
                $this->db->where('news_category.alias',$data['cate']);
            }
            $this->db->group_by('news.id');
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
    public function newsListAll($limit,$offset){
        $this->db->select('news.*, news_category.id as cate_id, news_category.name as cat_name ');
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->limit($limit,$offset);
        $this->db->order_by('news.id','desc');
        $q=$this->db->get('news');
        return $q->result();
    }

    public function newsBycategory($alias,$limit,$offset){
        $this->db->select('news.id as news_id, news.title, news.alias,news.category_id,news.home,news.hot,news.focus,news.image, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias');
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->where('news_category.alias',$alias);

        $this->db->limit($limit,$offset);

        $q=$this->db->get('news');
        return $q->result();
    }
    /*count  news by category*/
    public function countNewsByCategory($alias){
        $this->db->select('news.id as news_id, news.category_id,news.home,news.hot,news.focus,news.image, news_category.id as cate_id,
         news_category.name as cate_name,news_category.alias as cate_alias');
        $this->db->join('news_category','news.category_id=news_category.id','left');
        $this->db->where('news_category.alias',$alias);;
        $q=$this->db->get('news');
        return $q->num_rows();
    }
    public function getNewsByID($id){
        $this->db->where('id',$id);
        $q=$this->db->get('news');
        return $q->first_row();
    }

    public function getListRoot(){
        $this->db->select('*');
        $this->db->where('parent_id =',0);
        $q=$this->db->get('news_category');
        return $q->result();
    }
    public function getListChil(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('news_category');
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
        $this->db->select('news.*,news_category.name as cat_name,news_to_category.id_news,news_to_category.id_category');
        $this->db->from('news');
        $this->db->join('news_to_category', 'news.id=news_to_category.id_news','left');
        $this->db->join('news_category', 'news_category.id=news_to_category.id_category','left');
        $this->db->where($where);
        $this->db->group_by('news.id');
        $q = $this->db->get();
        //echo  $this->db->last_query();
        return $q->num_rows();
    }
    public function getNewByLang($where,$limit,$offset)
    {
        $this->db->select('news.*,news_category.name as cat_name,news_to_category.id_news,news_to_category.id_category');
        $this->db->from('news');
        $this->db->join('news_to_category', 'news.id=news_to_category.id_news','left');
        $this->db->join('news_category', 'news_category.id=news_to_category.id_category','left');
        $this->db->where($where);
        $this->db->limit($limit,$offset);
        $this->db->order_by('news.id','desc');
        $this->db->group_by('news.id');
        $q = $this->db->get();
        //echo  $this->db->last_query();
        return $q->result();
    }
    public function DeleteCategory($id){
        $arrs = $this->getArrayCateChild($id);
        if(count($arrs)){
            foreach($arrs as $val){
                if((int)$val > 0){
                    $q1 = $this->db->query("SELECT id,alias,icon FROM news_category where id = '" . $val . "'");
                    $item = @$q1->first_row();

                    $this->db->where('id',$val);
                    $this->db->delete('news_category');
                    if(file_exists(@$item->icon)){
                        @unlink($item->icon);
                    }
                    $q2 = $this->db->query("SELECT id FROM alias where new_cat = '" . $val . "'");
                    //$item_alias =$this->news_model->getFirstRowWhere('alias',array('new_cat'=>$val));
                    $item_alias = $q2->first_row();
                    if(!empty($item_alias)){
                        $this->db->where('new_cat',$val);
                        $this->db->delete('alias');
                    }
                }
            }
        }
        else return false;
    }
    public function getArrayCateChild($id,$recursive=false)
    {
        $arr[]=$id;

        $q1 = $this->db->query("SELECT id FROM news_category where parent_id = '" . $id . "'")->result();
        if (isset($q1) && !empty($q1)) {
            foreach ($q1 as $v) {
                $arr[] = $v->id;
                if($recursive=true){
                    $arr=array_unique(array_merge($arr,$this->getArrayCateChild($v->id,true)));
                }
            }
        }
        return $arr;
    }
}
