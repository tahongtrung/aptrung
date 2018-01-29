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
        $config['base_url'] = base_url($alias.'?');
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['total_rows'] = $this->f_productmodel->count_ProbyCate(array('product.lang'=>$this->language,'product_to_category.id_category'=>$id));
        $config['per_page'] = 16; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['cate_all1']=$this->f_productmodel->getCateChild(array(
            'lang' => $this->language,'parent_id'=>$data['cate_curent']->id
        ));
        $data['cate_all']=$this->f_productmodel->getCateChild(array(
            'lang' => $this->language
        ));
        $data['cate']=$data['cate_all'];
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $data['lists'] = $this->f_productmodel->getProbyCate(array('product.lang'=>$this->language,'product_to_category.id_category'=>$id),$config['per_page'], $this->input->get('per_page'));
        $data['lists1'] = $this->f_productmodel->getProbyCate(array('product.lang'=>$this->language),1000,0);
//echo "<pre>";print_r($data['lists1']);die();
        $data['banners'] = $this->f_productmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        if($data['cate_curent']->home==1){$pagefocus='products/category';}else{$pagefocus='products/pro_bycategory';}
        $data['types'] = $this->f_productmodel->get_data('product_hangsx');
        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
                   'description'=>@$data['cate_curent']->description_seo,
                   'keyword'=>@$data['cate_curent']->keyword_seo,
                   'image'=>@$data['cate_curent']->image,
                   'type'=>'products');
        $this->LoadHeader(null,$seo,false);
        $this->load->view('products/pro_bycategory',$data);
        $this->LoadFooter();
    }
    public function pro_focus(){
        $config['base_url'] = base_url('tour-noi-bat/'.$_GET['id']);
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['total_rows'] = $this->f_productmodel->count_ProbyCate_focus(array('product.lang'=>$this->language,'product.focus'=>1,'product_to_category.id_category'=>$_GET['id']));

        $config['per_page'] = 16; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['lists'] = $this->f_productmodel->getProbyCate_focus(array('product.lang'=>$this->language,'product.focus'=>1,'product_to_category.id_category'=>$_GET['id']));
        $data['banners'] = $this->f_productmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $data['types'] = $this->f_productmodel->get_data('product_hangsx');
        //echo "<pre>";var_dump($data['lists']);die();
        //$data['sidebar'] = $this->load->widget('blkcat');
        /*$seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
                   'description'=>@$data['cate_curent']->description_seo,
                   'keyword'=>@$data['cate_curent']->keyword_seo,
                   'image'=>@$data['cate_curent']->image,
                   'type'=>'products');*/

        $this->LoadHeader(null,null,false);

        //$this->LoadLeft();
        $this->load->view('products/product_focus',$data);
        $this->LoadFooter();
    }
    public function pro_home(){
        $config['base_url'] = base_url('tour-noi-bat/'.$_GET['id']);
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['total_rows'] = $this->f_productmodel->count_ProbyCate_focus(array('product.lang'=>$this->language,'product.home'=>1,'product_to_category.id_category'=>$_GET['id']));

        $config['per_page'] = 16; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['lists'] = $this->f_productmodel->getProbyCate_focus(array('product.lang'=>$this->language,'product.home'=>1,'product_to_category.id_category'=>$_GET['id']));
        $data['banners'] = $this->f_productmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $data['types'] = $this->f_productmodel->get_data('product_hangsx');
        //echo "<pre>";var_dump($data['lists']);die();
        //$data['sidebar'] = $this->load->widget('blkcat');
        /*$seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
                   'description'=>@$data['cate_curent']->description_seo,
                   'keyword'=>@$data['cate_curent']->keyword_seo,
                   'image'=>@$data['cate_curent']->image,
                   'type'=>'products');*/

        $this->LoadHeader(null,null,false);

        //$this->LoadLeft();
        $this->load->view('products/product_focus',$data);
        $this->LoadFooter();
    }
    public function pro_hot(){
        $config['base_url'] = base_url('tour-noi-bat/'.$_GET['id']);
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['total_rows'] = $this->f_productmodel->count_ProbyCate_focus(array('product.lang'=>$this->language,'product.home'=>1,'product_to_category.id_category'=>$_GET['id']));

        $config['per_page'] = 16; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $data['lists'] = $this->f_productmodel->getProbyCate_focus(array('product.lang'=>$this->language,'product.home'=>1,'product_to_category.id_category'=>$_GET['id']));
        $data['banners'] = $this->f_productmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $data['types'] = $this->f_productmodel->get_data('product_hangsx');
        //echo "<pre>";var_dump($data['lists']);die();
        //$data['sidebar'] = $this->load->widget('blkcat');
        /*$seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
                   'description'=>@$data['cate_curent']->description_seo,
                   'keyword'=>@$data['cate_curent']->keyword_seo,
                   'image'=>@$data['cate_curent']->image,
                   'type'=>'products');*/

        $this->LoadHeader(null,null,false);

        //$this->LoadLeft();
        $this->load->view('products/product_focus',$data);
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
        $this->ci =& get_instance();
         $item = $this->f_productmodel->get_data('product',array(
            'alias'=>$var2,
        ),array(),true);
        //echo "<pre>";var_dump($item);die();
        $data['pro_first'] = $item;
        //echo "<pre>";var_dump($item);die();
        if(!$this->session->userdata('session_pro_'.$data['pro_first']->id)){
            $this->session->set_userdata('session_pro_'.$data['pro_first']->id,1);
            $view = 1;
        }
        else{
            $view = 0;
        }
        $view = $data['pro_first']->view + $view;
        $this->f_productmodel->Update('product',$data['pro_first']->id,array(
            'view' => $view
        ));
        $data['cate_current']=$this->f_productmodel->getFirstRowWhere('product_category',array(
            'id' => $item->category_id
        ));
        $data['lists'] = $this->f_homemodel->GetData('product',array(
            'lang' => $this->language,
            'category_id' => $data['cate_current']->id
        ),array('id','desc'),null);

        $data['cate_all']=$this->f_productmodel->get_data('product_category',array(
            'lang' => $this->language
        ),null);
        //$data['images'] = $this->f_productmodel->get_data('file',array('id_item'=>$item->id,),array(),true);
        $data['tags'] = $this->f_productmodel->get_data('product_tag',array(
            'product_id' => $item->id
        ));
        //echo "<pre>";print_r($data['tags']);die();
        $data['pro_image'] = $this->f_productmodel->getProImages($var1);
        
        //echo "<pre>";print_r($data['pro_image']);die();
        $data['pros'] = $this->f_productmodel->getProductSimilar($item->id,8,0);
        $data['banners'] = $this->f_productmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        //echo "<pre>";var_dump($data['pros']);die();
        //==================Bắt đầu tính bình luận============
        $pid = $item->id;
        $data['binh_luan_1'] =   $this->f_productmodel->Count('comments_binhluan',array('id_sanpham'=>$pid,'review'=>1,'giatri'=>1));
        $data['binh_luan_2'] =   $this->f_productmodel->Count('comments_binhluan',array('id_sanpham'=>$pid,'review'=>1,'giatri'=>2));
        $data['binh_luan_3'] =   $this->f_productmodel->Count('comments_binhluan',array('id_sanpham'=>$pid,'review'=>1,'giatri'=>3));
        $data['binh_luan_4'] =   $this->f_productmodel->Count('comments_binhluan',array('id_sanpham'=>$pid,'review'=>1,'giatri'=>4));
        $data['binh_luan_5'] =   $this->f_productmodel->Count('comments_binhluan',array('id_sanpham'=>$pid,'review'=>1,'giatri'=>5));

        $data['binhluan_all']= $this->f_productmodel->Count('comments_binhluan',array('id_sanpham'=>$pid,'review'=>1));

        $data['tong_binhluan_all']= $this->f_productmodel->Product_comment_binhluan($pid);


        if($data['binhluan_all'] > 0){
            $data['trung_binh'] = round($data['tong_binhluan_all'][0]->tong_giatri/$data['binhluan_all'],1);
            $data['pt_bl_1'] = round(($data['binh_luan_1']/$data['binhluan_all'])*100,1);
            $data['pt_bl_2'] = round(($data['binh_luan_2']/$data['binhluan_all'])*100,1);
            $data['pt_bl_3'] = round(($data['binh_luan_3']/$data['binhluan_all'])*100,1);
            $data['pt_bl_4'] = round(($data['binh_luan_4']/$data['binhluan_all'])*100,1);
            $data['pt_bl_5'] = round(($data['binh_luan_5']/$data['binhluan_all'])*100,1);
        }else{
            $data['trung_binh'] = '0.0';
            $data['pt_bl_1'] = 0;
            $data['pt_bl_2'] = 0;
            $data['pt_bl_3'] = 0;
            $data['pt_bl_4'] = 0;
            $data['pt_bl_5'] = 0;
        }
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $data['types'] = $this->f_productmodel->get_data('product_hangsx');
        //echo "<pre>";var_dump($data['trung_binh']);die();
        //$data['sidebar'] = $this->load->widget('blkcat');
        $seo=array('title'=>@$data['pro_first']->title_seo==''
            || @$data['pro_first']->title_seo== '0' ?$data['pro_first']->name:$data['pro_first']->title_seo,
            'description'=>@$data['pro_first']->description_seo,
            'keyword'=>@$data['pro_first']->keyword_seo,
            'image'=>@$data['pro_first']->product_image,
            'type'=>'products');
        $this->LoadHeader(null,$seo,false);
        $this->load->view('products/detail',$data);
        $this->LoadFooter();
    }
    public function hangsx($alias)
    {
        $data['cate_curent'] = $current = $this->f_productmodel->getFirstRowWhere('product_hangsx',array('alias'=>$alias));
        $config['base_url'] = base_url($alias.'?');
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['total_rows'] = $this->f_productmodel->count_Probyhangsx($current->id);
        $config['per_page'] = 15; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['lists'] = $this->f_productmodel->getProbyHangsx($current->id,$config['per_page'], $this->input->get('per_page'));
        //$data['sidebar'] = $this->load->widget('blkcat');
        $data['cate_all']=$this->f_productmodel->get_data('product_category',array(
            'lang' => $this->language
        ));
        $data['banners'] = $this->f_productmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $data['types'] = $this->f_productmodel->get_data('product_hangsx');
        $seo=array('title'=>@$data['cate_curent']->title_seo==''
            || @$data['cate_curent']->title_seo== '0' ?$data['cate_curent']->name:$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
            'image'=>@$data['cate_curent']->product_image,
            'type'=>'products');
        $this->LoadHeader(null,$seo,true);
        $this->load->view('products/hangsx',$data);
        $this->LoadFooter();
    }
    public function allProduct(){
        $data = array();
        $where = array(
            'product_category.lang' => $this->language
        );
        $config['base_url'] = base_url('san-pham/');
        $config['total_rows'] = $this->f_productmodel->countAllPro($where); // xác định tổng số record
        $config['per_page'] = 24; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
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
        $data['list'] = $this->f_productmodel->getAllPro($where,$config['per_page'], $this->input->get('per_page'));
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
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
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
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
    public function getData()
    {
        $catId = (int) $_POST['cat_id'];
        $view = $_POST['view_cat'];
        //var_dump($catId);die();
        $data = array();
        $data['lists'] = $this->f_productmodel->getProByView($catId,$view);

        $this->load->view('products/view_room',$data);
    }
    public function Add_comment_binhluan(){
        $comment = $_POST['comment'];
        $user_name = $_POST['name_users'];
        $user_email = $_POST['email_users'];
        $giatri = $_POST['giatri'];
        $id_sanpham = $_POST['id'];
        $rs= $this->f_productmodel->Add('comments_binhluan',array(
            'id_sanpham'=>$id_sanpham,
            'comment'=>$comment,
            'user_name'=>$user_name,
            'user_email'=>$user_email,
            'giatri'=>$giatri,
            'time'=>time(),
            'date' =>date("Y-m-d"),
        ));
        $_SESSION['messege']='Sản phẩm đã cập nhật vào giỏ hàng của bạn!';
        echo 1;
    }
    public function getcomments(){
        $product_id = $_POST['product_id'];
        $limit = $_POST['limit_cmt'];
        $data['comments']=$this->f_productmodel->getComments_All($product_id,$limit);
        $data['comments_sub']=$this->f_productmodel->getComments_desc($product_id);
        $data['product_id']=$product_id;
//        echo '<pre>';
//        print_r($product_id); die();
        $this->load->view('products/productcoments', $data);
    }
}