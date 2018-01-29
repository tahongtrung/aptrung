<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_productmodel');
        $this->load->library('pagination');
    }
    function test($id=nulll){
        echo $id;
    }

    public function pro_bycategory($id,$alias){
        $id = (int) $id;

        $data['cate_curent'] = $current = $this->f_productmodel->getFirstRowWhere('product_category',array('id'=>$id));
        //var_dump($id);die();
        $data['lists'] = $this->f_homemodel->GetData('product_category',array(
            'lang' => $this->language,
            'hot' => '1',
            'parent_id !=' => '0'
        ),array('sort','asc'),null);
        $idpro = array();
        foreach($data['lists'] as $list){
            $idpro[] = $list->id;
        }
        $data['pros'] = $this->f_productmodel->getProductById($idpro);
        //echo "<pre>";var_dump($data['pros']);die();
        $data['cate_all']=$this->f_productmodel->get_data('product_category');
        $data['cate']=$data['cate_all'];

        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
            'image'=>@$data['cate_curent']->image,
            'type'=>'products');
        if($current->hot == 1){
            $view = 'products/view_room';
            $this->LoadHeader('headers/view_header',$seo,false);
        }else{
            $view = 'products/pro_bycategory';
            $this->LoadHeader(null,$seo,true);
        }

        //$this->LoadLeft();
        $this->load->view($view,$data);
        $this->LoadFooter();
    }
    public function getCategory()
    {
        $data = array();
        $this->load->library('pagination_ajax');
        $catId = $_POST['id'];
        $page =  $_POST['page'];
        $limit= $_POST['number_per_page'];
        $offset = ($page - 1) * $limit;
        $number_per_page= $_POST['number_per_page'];
        $where = array();
        $where['catid'] = $catId;
        if($_POST['filter_type'] !='' && $_POST['filter_value'] !=''){
            $where['filter_type'] = @$_POST['filter_type'];
            $where['filter_value'] = @$_POST['filter_value'];
        }else{
            $where['filter_type'] = '';
            $where['filter_value'] = '';
        }
        $order = array();
        if($_POST['order_type'] !='' && $_POST['order_value'] !=''){
            $order = array(
                'order_type' => @$_POST['order_type'],
                'order_value' => @$_POST['order_value'],
            );
        }
        $data['lists'] = $this->f_productmodel->getItemByCateId($where,$order,$offset,$limit);
        $data['total_rows'] = $this->f_productmodel->countItemByCateId($where);

        $data['phantrang'] = $this->pagination_ajax->create($data['total_rows'], $number_per_page, $page);
        //echo "<pre>";var_dump($data['lists']);
        $this->load->view('products/category',$data);
    }
    public function detail($var1,$var2)
    {
        $item = $this->f_productmodel->get_data('product',array(
            'alias'=>$var2,
        ),array(),true);
        //echo "<pre>";var_dump($item);die();
        $data['pro_first'] = $item;
        if(!$this->session->userdata('session_pro_'.$data['pro_first']->id)){
            $this->session->set_userdata('session_pro_'.$data['pro_first']->id,1);
            $view = 1;
        }
        else{
            $view = 0;
        }
        $data['cate_current'] = $current = $this->f_productmodel->getFirstRowWhere('product_category',array(
            'id' => $item->category_id
        ));
        $data['lists'] = $this->f_homemodel->GetData('product_category',array(
            'lang' => $this->language,
            'hot' => '1',
            'parent_id !=' => '0'
        ),array('sort','asc'),null);
        $idpro = array();
        foreach($data['lists'] as $list){
            $idpro[] = $list->id;
        }

        $data['cate_all']=$this->f_productmodel->get_data('product_category',null);
        $data['product_img'] = $this->f_productmodel->get_data('file',array('id_item'=>$item->id,),array(),true);

        $seo=array('title'=>@$data['pro_first']->title_seo==''
            || @$data['pro_first']->title_seo== '0' ?$data['pro_first']->name:$data['pro_first']->title_seo,
            'description'=>@$data['pro_first']->description_seo,
            'keyword'=>@$data['pro_first']->keyword_seo,
            'image'=>@$data['pro_first']->product_image,
            'type'=>'products');
        //var_dump($current);die();
        if($current->hot == 1){
            $view = 'products/detail_room';
            $this->LoadHeader(null,$seo,true);
        }else{
            $view = 'products/detail';
            $this->LoadHeader(null,$seo,true);
        }
        $this->load->view($view,$data);
        $this->LoadFooter();
    }
    public function allProduct(){
        $data = array();
        $where = array(
            'product_category.lang' => $this->language
        );
        $config['base_url'] = base_url('san-pham/');
        $config['total_rows'] = $this->f_productmodel->countAllPro($where); // xác định tổng số record
        $config['per_page'] = 18; // xác định số record ở mỗi trang
        $config['uri_segment'] = 2; // xác định segment chứa page number
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $data['list'] = $this->f_productmodel->getAllPro($where,$config['per_page'], $this->uri->segment(2));

        $seo=array('title'=>@$data['cate_curent']->title_seo==''?@$data['cate_curent']->name:@$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
            'image'=>@$data['cate_curent']->product_image,
            'type'=>'products');
        $view_head = 'header_test';
        $view_footer = 'footer_test';
        $this->LoadHeader(null,$seo,true);
        $this->LoadLeft();
        $this->load->view('all_pro',$data);
        // $this->LoadRight();
        $this->LoadFooter($view_footer);
    }
    public function tags($alias)
    {
        $data = array();
        $itemTag = $this->f_productmodel->get_data('product_tag',array(
            'alias' => $alias
        ));
        $data['itemTags'] = $itemTag;
        $arrTagId = array();
        foreach($itemTag as $item){
            $arrTagId[] = (int)$item->product_id;
        }
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url'] = base_url('tags/'.$alias);
        $config['total_rows'] = $this->f_productmodel->countItemByTagId($arrTagId);
        $config['per_page'] = 20;
        //        $config['suffix'] = "?page=".($this->input->get('per_page')/$config['per_page']+2);
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $data['lists'] = $this->f_productmodel->getItemByTagId($arrTagId,$config['per_page'], $this->input->get('per_page'));
        $seo=array('title'=>'tags',
            'description'=>'tags',
            'keyword'=>'tags',
            'image'=>'tags',
            'type'=>'products'
        );
        $this->LoadHeader(null,$seo,true);
        $this->LoadLeft();
        $this->load->view('products/tags',$data);
        $this->LoadFooter();
    }
}