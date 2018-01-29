<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class F_productmodel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('model');
    }

    public function getCateRoot()
    {
        $this->db->select('*');
        $this->db->where('parent_id',0);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getCateChild($where){
        $this->db->select('*,product_category.id as cat_id');
        $this->db->where($where);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getMenu_Center(){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $this->db->where('position','top');
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuTopRoot(){
        $this->db->select('*');
        $this->db->where('position','top');
        $this->db->where('parent_id',0);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }

    public function getarr_idcategory($product_id){
        $q2 = $this->db->query("SELECT category_id FROM product where id = '" . $product_id . "'")->first_row();
        $q1 = $this->db->query("SELECT id_category FROM product_to_category where id_product = '" . $product_id . "' and id_category <>$q2->category_id")->result();
        $arr=array();
        foreach($q1 as $v){
            $arr[]=$v->id_category;
        }
        return $arr;
    }
    public function Product_comment_binhluan($id_sanpham){
        $q=$this->db->query("SELECT sum(giatri) as tong_giatri from comments_binhluan where  id_sanpham = '".$id_sanpham."' and review = 1");


        //echo $this->db->last_query().'</br>';
        return $q->result();
    }
    public function get_products($where,$limit,$offset){
        $this->db->select('product.id as pro_id,
                            product.location,
                            product.alias as pro_alias,
                            product.location,
                            product.caption_1,
                            product.multi_image,
                            product.pro_dir,
                            product.img_dir,
                            product.price as pro_price,
                            product.price_sale as pro_price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.alias as pro_alias,
                            product.view,
                            product.image as pro_img,
                            product.description as pro_des,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            product_to_category.id_product,
                            product_to_category.id_category');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');

        $this->db->where($where);
        if($limit !=null && $offset !=null){
            $this->db->limit($limit,$offset);
        }
        /*$this->db->group_by('product.id');*/
        $this->db->order_by('product.id');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getProductSimilar($product_id, $limit, $offset)
    {
        $arr_in=$this->getarr_idcategory($product_id);
        $query = $this->db->select('product.id,product_category.id,product.alias as pro_alias,product.image as pro_image,product.caption_1,
                                product.category_id, product.code,product.price,product.price_sale,product_category.name as cate_name,
                                product.name as product_name,product.description,product.price as pro_price,product.multi_image,product.pro_dir,product.img_dir,
                                product_category.alias,product_category.alias as cate_alias,product_category.parent_id,
                                product_to_category.id as product_to_category_id ')
            ->from('product')
            ->join('product_to_category', 'product_to_category.id_product = product.id')
            ->join('product_category', 'product_to_category.id_category = product_category.id')
            /*->where_in('product_category.id',$arr_in)*/
            ->where('product.id !=', $product_id)
            ->group_by('product.id')
            ->get('', $limit, $offset);
        return $query->result();
    }
    public function getProductSimilar2($category_id, $limit, $offset)    {
        $query = $this->db->select('product.id as pro_id,
                            product.alias as pro_alias,
                            product.name as pro_name,
                            product.view,
                            product.downloaded,
                            product.category_id,
                            product.alias as pro_alias,
                            product.image as pro_img,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            ')
            ->from('product')
            ->join('product_category', 'product.category_id = product_category.id')
            ->where('product.category_id',$category_id)
            ->get('', $limit, $offset);
        return $query->result();
    }
    public function getProbyCate_focus($where)
    {
        $query = $this->db->select('product.id as pro_id,
                            product.location,
                            product.alias as pro_alias,
                            product.location,
                            product.caption_1,
                            product.multi_image,
                            product.pro_dir,
                            product.img_dir,
                            product.price,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.alias as pro_alias,
                            product.view,
                            product.code,
                            product.image as pro_img,
                            product.description as pro_des,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            product_to_category.id_product,
                            product_to_category.id_category')
            ->join('product_to_category', 'product_to_category.id_product=product.id','left')
            ->join('product_category', 'product_category.id=product.category_id','left')
            ->from('product')
            ->where($where)
            ->order_by('product.id', 'desc')
            ->get();

        return $query->result();
    }
    public function getProbyCate($where, $limit, $offset)
    {
        /*$q1 = $this->db->query("SELECT id,alias FROM product_category where alias = '" . $alias . "'");*/
        $query = $this->db->select('product.id as pro_id,product.name as pro_name,product_category.id as cat_id,product.alias as pro_alias,
        product.image as pro_image,product.code,product.price,product.price_sale,product_category.alias,
        product.multi_image,product.pro_dir,product.img_dir,product.category_id,
        product_category.alias as cate_alias,product_category.parent_id,product_to_category.id_product,
                            product_to_category.id_category')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id', 'left')
            ->join('product_to_category', 'product_to_category.id_product=product.id','left')
            ->where($where)

            /*->or_where('product_category.parent_id', @$q1->first_row()->id)*/

            ->limit($limit, $offset)
            /*->group_by('product.id')*/
            ->order_by('product.id', 'desc')
            ->get();

        return $query->result();
    }
    public function count_ProbyCate_focus($where)
    {
        $query = $this->db->select('product.id as pro_id,
                            product.location,
                            product.alias as pro_alias,
                            product.location,
                            product.caption_1,
                            product.multi_image,
                            product.pro_dir,
                            product.img_dir,
                            product.price as pro_price,
                            product.price_sale as pro_price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.alias as pro_alias,
                            product.view,
                            product.image as pro_img,
                            product.description as pro_des,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            product_to_category.id_product,
                            product_to_category.id_category')
            ->join('product_to_category', 'product_to_category.id_product=product.id','left')
            ->join('product_category', 'product_category.id=product.category_id','left')
            ->from('product')
            ->where($where)
            ->order_by('product.id', 'desc')
            ->get();
        return $query->num_rows();
    }
    /*public function cate_pro($where){

    }*/
    public function count_ProbyCate($where)
    {
        /*$q1 = $this->db->query("SELECT id,alias FROM product_category where alias = '" . $alias . "'");*/

        $query = $this->db->select('product.id,product.name as pro_name,product_category.id as cat_id,product.alias as pro_alias,
        product.image as pro_image,product.code,product.price,product.price_sale,product_category.alias,
        product.multi_image,product.pro_dir,product.img_dir,
        product_category.alias as cate_alias,product_category.parent_id,product_to_category.id_product,
                            product_to_category.id_category')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id', 'left')
            ->join('product_to_category', 'product.id=product_to_category.id_product','left')
            ->where($where)
            /*->or_where('product_category.parent_id', @$q1->first_row()->id)*/
            /*->group_by('product.id')*/
            ->order_by('product.id', 'desc')
            ->get();

        return $query->num_rows();
    }
    public function count_Probyhangsx($id_hang)
    {
        $query = $this->db->select('product.id')
            ->from('product')
            ->join('product_hangsx', 'product_hangsx.id=product.style', 'left')
            ->where('product_hangsx.id', $id_hang)
            ->order_by('product.id', 'desc')
            ->get();
    }
    public function getProbyHangsx($id_hang)
    {
        $query = $this->db->select('product.id,product.name as pro_name,product.price_sale,
        product.price as pro_price,product.alias as pro_alias,product.price,product.id,product.pro_dir,
        product.image as pro_image,product_hangsx.id as hang_id,product_hangsx.alias as cate_alias')
            ->from('product')
            ->join('product_hangsx', 'product_hangsx.id=product.style', 'left')
            ->where('product_hangsx.id', $id_hang)
            ->order_by('product.id', 'desc')
            ->get();

        return $query->result();
    }
    public function ProductBycategory($id,$order,$limit,$offset){
         $this->db->select('product.id as pro_id,
                            product.alias as pro_alias,
                            product.description as pro_des,
                            product.price,
                            product.start,
                            product.view,
                            product.finish,
                            product.itinerary,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.season,
                            product.destination,
                            product.alias as pro_alias,
                            product.home,
                            product.image as pro_img,
                            product.hot,
                            product.focus,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            travel_style.name as style_name,
                            travel_style.alias as style_alias,
                            travel_style.id as style_id,
                            ');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->join('travel_style','travel_style.id=product.style','left');
        /*$this->db->join('product_to_season','product_to_season.id_product=product.id','left');
        $this->db->join('season','product_to_season.id_season=season.id','left');*/
        $this->db->where('product_to_category.id_category',$id);
        $this->db->or_where('product_category.parent_id',$id);
        /*$this->db->where('product_to_category.id_category',$id);*/
        /*$this->db->where('product.active',1);*/
        $this->db->group_by('product.id');
        if(count($order))
        {
            $this->db->order_by($order['order'],$order['direction']);
        }
        else{
            $this->db->order_by('product.id','desc');
        }
        $this->db->limit($limit,$offset);
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getProductById($id)
    {
        $this->db->select('product.id as pro_id,
                            product.alias as pro_alias,
                            product.description as pro_des,
                            product.detail,
                            product.code,
                            product.price,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.season,
                            product.destination,
                            product.alias as pro_alias,
                            product.home,
                            product.groupsize,
                            product.image as pro_img,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            ');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->where_in('product_category.id',$id);
        $this->db->group_by('product.id');
        $q=$this->db->get('product');
        return $q->result();
    }
    /*count  news by category*/
    public function CountProByCategory($id){
        $this->db->select('product.id as pro_id');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->join('travel_style','travel_style.id=product.style','left');
        $this->db->where('product_category.id',$id);
        $this->db->or_where('product_category.parent_id',$id);
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('product');
        return $q->num_rows();
    }


    public function getproduct_detail($pid,$alias){
        $query = $this->db->select('product.*')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id','left')
            ->where('product.id', $pid)
            ->where('product.alias', $alias)
            ->get();
        return $query->first_row();
    }


    //=============================end Location

    public function getProImages($proId)
    {
        $this->db->select('product.id, product.alias, product.image, images.id as image_id,images.id_item ,images.link ');
        $this->db->join('product', 'product.id=images.id_item', 'left');
        $this->db->where('images.id_item', $proId);
        $q = $this->db->get('images');
        return $q->result();
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
    public function getComments($product_id,$limit){
        $this->db->select('comments.*, users.fullname,users.avatar');
        $this->db->join('users','users.id=comments.user');
        $this->db->where('comments.item_id',$product_id);
        $this->db->order_by('comments.id','desc');
        $n=$this->db->get('comments',$limit);
        return $n->result();
    }
    public function getComments_desc($product_id){
        $this->db->select('comments.*, users.fullname, users.avatar');
        $this->db->join('users','users.id=comments.user');
        $this->db->where('comments.item_id',$product_id);
        $n=$this->db->get('comments');
        return $n->result();
    }

    public function countAllPro($where)
    {
        $this->db->select('product.id as pro_id');
        $this->db->join('product_category', 'product_category.id=product.category_id');
        $this->db->where($where);
        $q = $this->db->get('product');
        return $q->num_rows();
    }
    public function getAllPro($where,$limit,$offset)
    {
        $this->db->select('product.id as pro_id,
                            product.location,
                            product.alias as pro_alias,
                            product.location,
                            product.caption_1,
                            product.price,
                            product.multi_image,
                            product.pro_dir,
                            product.img_dir,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.alias as pro_alias,
                            product.view,product.bought,
                            product.home,
                            product.image as pro_img,
                            product.hot,
                            product.focus,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            ');
        $this->db->join('product_category', 'product_category.id=product.category_id');
        $this->db->where($where);
        $this->db->order_by('product.sort', 'asc');
        $this->db->limit($limit,$offset);
        $q = $this->db->get('product');
        return $q->result();
    }

    public function getItemByCateId($where,$order,$offset,$limit)
    {
        $this->db->select('product.id as pro_id,
                            product.alias as pro_alias,
                            product.description as pro_des,
                            product.price,
                            product.downloaded,
                            product.view,
                            product.finish,
                            product.itinerary,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.season,
                            product.destination,
                            product.alias as pro_alias,
                            product.home,
                            product.image as pro_img,
                            product.hot,
                            product.focus,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            ');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        if($where['filter_type'] !='')
        {
            $this->db->where('product.'.$where['filter_type'],$where['filter_value']);
        }
        if($where['catid'] !=''){
            $this->db->where('product_to_category.id_category',$where['catid']);
            $this->db->or_where('product_category.parent_id',$where['catid']);
        }
        //var_dump($order);die();
        if(count($order))
        {
            $this->db->order_by('product.'.$order['order_type'],$order['order_value']);
        }
        else{
            $this->db->order_by('product.id','desc');
        }
        $this->db->group_by('product.id');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('product');
        return $q->result();
    }
    public function countItemByCateId($where)
    {
        $this->db->select('product.id');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        if($where['filter_type'] !='')
        {
            $this->db->where('product.'.$where['filter_type'],$where['filter_value']);
        }
        if($where['catid'] !=''){
            $this->db->where('product_to_category.id_category',$where['catid']);
            $this->db->or_where('product_category.parent_id',$where['catid']);
        }
        $this->db->group_by('product.id');
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('product');
        return $q->num_rows();
    }
    public function countItemByTagId($arrId)
    {
        $query = $this->db->select('product.id,product.name as pro_name,product_category.id,product.alias as pro_alias,
        product.image as pro_image,product.price as pro_price,product_category.alias,product_category.alias as cate_alias,product_category.parent_id ')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id', 'left')
            ->where_in('product.id', $arrId)
            ->order_by('product.id', 'desc')
            ->get();

        return $query->num_rows();
    }
    public function getItemByTagId($arrId,$limit,$offset)
    {
        $query = $this->db->select('product.id as pro_id,
                            product.alias as pro_alias,
                            product.description as pro_des,
                            product.price,
                            product.downloaded,
                            product.view,
                            product.finish,
                            product.itinerary,
                            product.pro_dir,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.season,
                            product.destination,
                            product.alias as pro_alias,
                            product.home,
                            product.image as pro_img,
                            product.hot,
                            product.focus,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            ')
            ->from('product')
            ->join('product_category', 'product_category.id=product.category_id', 'left')
            ->where_in('product.id', $arrId)
            ->order_by('product.id', 'desc')
            ->get('', $limit, $offset);

        return $query->result();
    }
    public function getProByView($id,$view)
    {
        $this->db->select('product.id as pro_id,
                            product.location,
                            product.alias as pro_alias,
                            product.location,
                            product.caption_1,
                            product.multi_image,
                            product.pro_dir,
                            product.img_dir,
                            product.price,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.alias as pro_alias,
                            product.view,
                            product.image as pro_image,
                            product.description as pro_des,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            product_to_category.id_product,
                            product_to_category.id_category');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        if($view !=''){
            $this->db->where('product.'.$view,1);
        }

        $this->db->where('product_category.id',$id);
        $this->db->or_where('product_category.parent_id',$id);

        $this->db->group_by('product.id');
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getComments_All($product_id,$limit){
        $this->db->select('comments_binhluan.*, comments_binhluan.user_name as fullname');
        $this->db->where('comments_binhluan.review',1);
        $this->db->where('comments_binhluan.id_sanpham',$product_id);
        $this->db->order_by('comments_binhluan.id','desc');
        $n=$this->db->get('comments_binhluan',$limit);
//        echo $this->db->last_query();
        return $n->result();
    }

}