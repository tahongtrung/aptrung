<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_homemodel extends MY_Model{
    function __construct() {
        parent::__construct();
        $this->load->helper('model');
    }
     
    public function listAllMenu()
    {
        $this->db->select('*');
        $this->db->order_by('sort','asc');
        $this->db->where('position','top');
        $this->db->where('lang',$this->language);
        $q = $this->db->get('menu');
        return $q->result_array();
    }
    public function Home_support(){
        $this->db->select('support_online.name,support_online.phone,support_online.skype,support_online.yahoo');
        $this->db->where('support_online.active',1);
        $this->db->limit(3,0);
        $n=$this->db->get('support_online');
        return $n->result();
    }
    public function getCateHome()
    {
        $this->db->select('*');
//        $this->db->where('home','1');
        $this->db->order_by('sort');
        $q = $this->db->get('product_category');
        return $q->result_array();
    }
    public function countPoduct_search($where){
        $this->db->select('product.id');
        $this->db->join('product_category','product_category.id=product.category_id','left');
        $this->db->join('product_tag','product_tag.product_id=product.id','left');
        if($where['id'] != '') {
            $this->db->where('product_category.id',$where['id']);
        }
        if($where['key'] != '') {
            $this->db->like('product.name',$where['key']);
        }
        $this->db->group_by('product.id');
        $q=$this->db->get('product');
        return $q->num_rows();
    }
    public function getPoduct_search($where,$limit,$offset){
        $this->db->select('product.id,product.alias as pro_alias,
        product.price,product.price_sale,product.code,product.view,product.multi_image,product.pro_dir,img_dir,
        product.name as pro_name,product.category_id as cat_id,product.downloaded,
        product.home,product.image as pro_image,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,product.number
        ');
        $this->db->join('product_category','product_category.id=product.category_id','left');
        if($where['id'] != '') {
            $this->db->where('product_category.id',$where['id']);
            $this->db->or_where('product_category.parent_id',$where['id']);
        }
        if($where['key'] != '') {
            $this->db->like('product.name',$where['key']);
        }
        $this->db->group_by('product.id');
        $this->db->order_by('product.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getListProByCate($where)
    {
        $this->db->select('
                            product.name,
                            product_category.name,
                            ');
        $this->db->join('product', 'product_category.id=product.category_id','left');
        $this->db->where($where);
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getListProByStyle($where)
    {
        $this->db->select('
                            count(product.id) as total,
                            travel_style.id,
                            travel_style.name,
                            ');
        $this->db->join('travel_style', 'travel_style.id=product.style','left');
        $this->db->where($where);
        $this->db->group_by('travel_style.id');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getListProByCategogy($where)
    {
        $this->db->select('count(product.id) as total,
                            product_category.alias as cate_alias,
                            product_category.hot as hot,
                            product_category.focus as focus,
                            product_category.coupon as coupon,
                            product_category.home as home,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            ');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->where($where);
        $this->db->group_by('product_category.id');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getListProBySeason($where)
    {
        $this->db->select('count(product.id) as total,
                            season.id,
                            season.name,
                            ');
        $this->db->join('product_to_season', 'product.id=product_to_season.id_product');
        $this->db->join('season', 'season.id=product_to_season.id_season');
        $this->db->where($where);
        $this->db->group_by('season.id');
        $q=$this->db->get('product');
        return $q->result();
    }
    public function news_home($limit){
        $query = $this->db->select('news.id as news_id, news.title, news.description,news.alias as news_alias,
        news.category_id,news.image,news.time,
                            news_category.id as cate_id, news_category.name, news_category.alias as cate_alias,
                            news_category.name')
            ->from('news')
            ->join('news_category', 'news_category.id = news.category_id')
            ->where('news_category.home','1')
            ->order_by('news.id','desc')
            ->get('', $limit);

        return $query->result();
    }

    public function get_news($where,$limit,$offset){

        $query = $this->db->select('news.id,
                                    news.title,
                                    news.description,
                                    news.focus,
                                    news.home,
                                    news.alias,
                                    news.category_id,
                                    news.image,
                                    news.video,
                                    news.time,
                                    news_category.id as cat_id,
                                    news_category.name,
                                    news_category.alias as cat_alias,
                                    news_category.parent_id,
                                    news_to_category.id_category,
                                    news_to_category.id_news')
            ->from('news')
            ->join('news_to_category', 'news.id = news_to_category.id_news','left')
            ->join('news_category', 'news_category.id = news.category_id','left')
            ->where($where)
            ->group_by('news.id')
            ->order_by('news.id')
            ->get('', $limit, $offset);

        return $query->result();
    }

    public function get_products($where,$limit,$offset){
        $this->db->select('product.id as pro_id,
                            product.alias as pro_alias,
                            product.caption_1,
                            product.price,
                            product.price_sale,
                            product.name as pro_name,
                            product.category_id,
                            product.alias as pro_alias,
                            product.view,
                            product.code,
                            product.multi_image,
                            product.pro_dir,
                            product.img_dir,
                            product.image as pro_img,
                            product.description as pro_des,
                            product.detail,
                            product_category.hot,
                            product_category.id as cate_id,
                            product_category.name as cate_name,
                            product_category.alias as cate_alias,
                            product_to_category.id_product,
                            product_to_category.id_category,
                            ');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->where($where);
        $this->db->limit($limit,$offset);
        $this->db->order_by('product.id','desc');/*
        $this->db->group_by('product.id');*/
        $q=$this->db->get('product');
        return $q->result();
    }

    /*phan trang*/
        public function countprohome($where){
        $this->db->select('*');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('travel_style','travel_style.id=product.style','left');
        $this->db->where($where);
        
        $this->db->order_by('product.id','desc');
        $this->db->group_by('product.id');
        $q=$this->db->get('product');
        return $q->num_rows();
    }

    public function getCateRoot($where_root)
    {
        $this->db->select('*');
        $this->db->where($where_root);
        $this->db->order_by('sort','desc');
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function getCateChild($where_sub){
        $this->db->select('*');
        $this->db->where($where_sub);
        $this->db->order_by('sort','asc');
        $q=$this->db->get('product_category');
        return $q->result();
    }
    public function homeview_category($where,$limit){
        $this->db->select('product_category.*,images.type,images.url,images.target,images.link');
        //$this->db->where('product_category.home',1);
        $this->db->where($where);
        $this->db->join('images','product_category.id=images.cate','left');
        $this->db->order_by('product_category.sort');
        $this->db->limit($limit);
        $q=$this->db->get('product_category');
        return $q->result();

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
    public function gethome_products($cate_id=array()){
        if(empty($cate_id)){
            return array();
        }
        //echo "<pre>";var_dump($cate_id);die();
        $this->db->select('*');
        $this->db->where('home',1);
        $this->db->where_in('category_id',$cate_id);
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getMenuTopRoot($where){
        $this->db->select('*');
        //$this->db->where('position','top');
        $this->db->where('parent_id',0);
        $this->db->where($where);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuRightRoot(){
        $this->db->select('*');
        $this->db->where('position','bottom');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuBotRoot(){
        $this->db->select('*');
        $this->db->where('position','bottom');
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenu($where){
        $this->db->select('*');
        $this->db->where($where);
        $this->db->where('parent_id',0);
        $q=$this->db->get('menu');
        return $q->result();
    }
    public function getMenuchild($where){
        $this->db->select('*');
        $this->db->where($where);
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('menu');
        return $q->result();
    }

    public function getMenuBotsub(){
        $this->db->select('*');
        $this->db->where('position','bottom');
        $this->db->where('parent_id !=',0);
        $q=$this->db->get('menu');
        return $q->result();
    }
     public function getMenuLeftsub(){
        $this->db->select('*');
        $this->db->where('position','left');
        $this->db->where('parent_id=',0);
        $q=$this->db->get('menu');
        return $q->result();
    }


    public function getMenu_chil($where){
        $this->db->select('*');
        $this->db->where('parent_id !=',0);
        $this->db->where($where);
        $this->db->order_by('sort','esc');
        $q=$this->db->get('menu');
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

    public function getSlider(){
        $this->db->where('type','slide');
        $q=$this->db->get('images');
        return $q->result();

    }
    public function getSlider1($where){
        $this->db->where($where);
        $q=$this->db->get('images');
        return $q->result();
    }
    public function getSlider_partners(){
        $this->db->where('type','partners');
        $q=$this->db->get('images');
        return $q->result();
    }

    /**** menu main  bottom*****/
    public function Menu_home(){
        $this->db->select('product_category.name,product_category.alias,product_category.id,
        product_category.image as cate_image,product_category.parent_id');
//        $this->db->where('parent_id','0');
        $q=$this->db->get('product_category');
        return $q->result();
    }
    /**** menu main top *****/
    public function Menu_home_top(){
        $this->db->select('product_category.name,product_category.alias,product_category.id,
        product_category.image as cate_image,product_category.parent_id');
        $this->db->where('parent_id','0');
        $this->db->where('home !=',1);
        $q=$this->db->get('product_category');
        return $q->result();
    }

    /**** menu main top *****/
    public function Menu_home_child(){
        $this->db->select('product_category.name,product_category.alias,product_category.id,
        product_category.image as cate_image,product_category.parent_id');
        $q=$this->db->get('product_category');
        return $q->result();
    }


    public function array_cate($id_product){
        $this->db->select('product_to_category.id_category');
        $this->db->where('product_to_category.id_product',$id_product);
        $q=$this->db->get('product_to_category');
        $b=array();
         $rs=$q->result();
        foreach($rs as $v){
            $b[]=$v->id_category;
        }
        return $b;
    }
    public function Products_by_cate_home($cate){

        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,product.caption_1,product.category_id,
        product.price,product.price_sale,product.name,product.image,product.category_id,product_category.id,
        product_category.home, product_category.name as cate_name,
        product_to_category.id_category
        ');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->join('product_to_category','product.id=product_to_category.id_product');
        $this->db->where('product_to_category.id_category',$cate);
        $this->db->group_by('product.id');
        $q=$this->db->get('product',20);
        return $q->result();
    }
    public function getProSales()
    {
        $this->db->select('product.id as pro_id,product.alias  as pro_alias,product_category.alias,product.caption_1,product.category_id,
        product.price,product.price_sale,product.name as pro_name,product.image,product.category_id,product_category.id as cat_id,
        product_category.home, product_category.name as cate_name,product_category.alias as cat_alias,
        ');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where('product.hot',1);
        $this->db->order_by('product.sort','asc');
        $this->db->limit(10);
        $q=$this->db->get('product');
        return $q->result();
    }
    public function getProByView($where,$limit)
    {
        $this->db->select('product.id as pro_id,product.coupon as coupon,product.focus as focus,product.alias  as pro_alias,product_category.alias,product.caption_1,product.category_id,
        product.price,product.price_sale,product.name as pro_name,product.image,product.category_id,product_category.id as cat_id,
        product_category.home, product_category.name as cate_name,product_category.alias as cat_alias,product.image as img,product.itinerary as day,
        ');
        $this->db->join('product_category','product.category_id=product_category.id');
        $this->db->where($where);
        $this->db->order_by('product.id','desc');
        $this->db->limit($limit);
        $q=$this->db->get('product');
        return $q->result();
    }
    // search
    public function searchProduct($key)
    {
        $this->db->select('product.*,product.name as pro_name,product.alias as pro_alias,product.image as pro_image, product_category.*');
        $this->db->join('product_category','product_category.id=product.category_id');
        $this->db->like("product.name",$key);
        $q=$this->db->get('product');
        return $q->result();
    }
    /*deal noi bat*/
    public function ProductBycategory($alias,$limit,$offset){
        $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
//        print_r($cate);
        $q= $this->db->select('product.id as pro_id,product.location,product.alias as pro_alias,product.location,product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',$cate->id)
            ->order_by('product.id','desc')
            ->group_by('product.id')
            ->limit($limit,$offset)
            ->get('product');
//        echo $q->last_query();
        return $q->result();
    }

    /*count  news by category*/
    public function CountProByCategory($alias=null){
        if($alias){
            $cate=$this->getFirstRowWhere('product_category',array('alias'=>$alias));
        }


        $q= $this->db->select('product.id as pro_id,product.location,product.price as pro_price,product.price_sale as pro_price_sale, product.name as pro_name,product.category_id, product.alias as pro_alias,
        product.home,product.image as pro_img,product.hot,product.focus,product_category.id as cate_id,
        product_category.name as cate_name, product_category.alias as cate_alias,
        product_to_category.*')
            ->join('product_to_category','product_to_category.id_product=product.id')
            ->join('product_category','product_to_category.id_category=product_category.id','left')
            ->where('product_to_category.id_category',@$cate->id)
            ->group_by('product.id')
            ->get('product');
        return $q->num_rows();
    }

    public function getItemByView($where,$order,$offset,$limit)
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
        if($where['view'] !=''){
            $this->db->where('product.'.$where['view'],1);
        }
        if($where['filter_type'] !='')
        {
            $this->db->where('product.'.$where['filter_type'],$where['filter_value']);
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
    public function countItemByView($where)
    {
        $this->db->select('product.id');
        $this->db->join('product_to_category', 'product.id=product_to_category.id_product','left');
        $this->db->join('product_category', 'product_category.id=product.category_id','left');
        if($where['view'] !=''){
            $this->db->where('product.'.$where['view'],1);
        }
        if($where['filter_type'] !='')
        {
            $this->db->where('product.'.$where['filter_type'],$where['filter_value']);
        }
        $this->db->group_by('product.id');
        $this->db->order_by('product.id','desc');
        $q=$this->db->get('product');
        return $q->num_rows();
    }
    public function countPoduct_searchn($where){
        $this->db->select('*');
        $this->db->join('news_category','news_category.id=news.category_id','left');
        /*$this->db->join('news_tag','news_tag.news_id=news.id','left');*/
        /* if($where['id'] != '') {
             $this->db->where('news_category.id',$where['id']);
         }*/
        $this->db->where('news.lang',$this->language);
        if($where['key'] != '') {
            $this->db->like('news.title',$where['key']);
        }
        $this->db->group_by('news.id');
        $q=$this->db->get('news');
        return $q->num_rows();
    }
    public function getPoduct_searchn($where,$limit,$offset){
        $this->db->select('news.id,news.alias as pro_alias,
        news.image,news.lang,
        news.title,news.category_id as cat_id,news.time,news.description,
        news.home,news.image as pro_image,news.hot,news.focus,news_category.id as cate_id,
        news_category.name as cate_name, news_category.alias as cate_alias
        ');
        $this->db->join('news_category','news_category.id=news.category_id','left');
        /*if($where['id'] != '') {
            $this->db->where('news_category.id',$where['id']);
            $this->db->or_where('news_category.parent_id',$where['id']);
        }*/
        $this->db->where('news.lang',$this->language);
        if($where['key'] != '') {
            $this->db->like('news.title',$where['key']);
        }
        $this->db->group_by('news.id');
        $this->db->order_by('news.id','desc');
        $this->db->limit($limit,$offset);
        $q=$this->db->get('news');
        return $q->result();
    }
}