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
    public function index($alias,$id){
        $this->pro_bycategory($alias,$id);
    }

    public function pro_bycategory($id,$alias){
        $data = array();
        $config['base_url'] = base_url($id.'-'.$alias);
        $config['total_rows'] = $this->f_productmodel->CountProByCategory($id); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
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
        $order = array();
        if($this->input->get('order') && $this->input->get('direction')){
            $order = array(
                'order' => $this->input->get('order'),
                'direction' => $this->input->get('direction')
            );
        }
        $data['lists'] = $this->f_productmodel->ProductBycategory($id,$order,$config['per_page'],
            $this->uri->segment(2));
        $data['cate_curent'] = $this->f_productmodel->getFirstRowWhere('product_category',array('id'=>$id));
        $data['cate_all']=$this->f_productmodel->get_data('product_category');
        $data['cate']=$data['cate_all'];
        //echo "<pre>";var_dump($data['lists']);die();
        //$data['viewsearch'] = $this->load->widget('blksearch');
        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
            'image'=>@$data['cate_curent']->image,
            'type'=>'products');
        $this->LoadHeader(null,$seo,true);
        $this->LoadLeft();
        $this->load->view('pro_bycategory',$data);
        $this->LoadFooter();
    }
    public function productdetail($calias,$cid,$pid,$palias){
        $data['pro_first'] = $this->f_productmodel->get_data('product',array(
            'id'=>$pid,
        ),array(),true);
        if(!$this->session->userdata('session_pro_'.$data['pro_first']->id)){
            $this->session->set_userdata('session_pro_'.$data['pro_first']->id,1);
            $view = 1;
        }
        else{
            $view = 0;
        }
        //echo "<pre>"; print_r($data['pro_first'] );die();
        $view = $data['pro_first']->view + $view;
        $this->f_productmodel->Update('product',$data['pro_first']->id,array(
            'view' => $view
        ));
        //echo "<pre>";print_r($data['pro_first']);die();
        $data['cate_current']=$this->f_productmodel->getFirstRowWhere('product_category',array('id'=>$cid));
        @$data['cate_sub']=$this->f_productmodel->Get_where('product_category',array('parent_id'=>$data['cate']->id));
        $data['cate_all']=$this->f_productmodel->get_data('product_category',null);
        $data['cate']=$data['cate_all'];
        $data['product_img'] = $this->f_productmodel->get_data('file',array('id_item'=>$pid,),array(),true);
        //echo "<pre>";print_r($data['product_img']);die();
        //$data['tour_day']=$this->f_productmodel->get_data('tour_day_content',array('product_id'=>$pid));
        $data['product_similar'] = $this->f_productmodel->getProductSimilar2($data['pro_first']->category_id,12,0);
        //echo "<pre>";var_dump($data['product_similar']);die();
        $seo=array('title'=>@$data['pro_first']->title_seo==''
            || @$data['pro_first']->title_seo== '0' ?$data['pro_first']->name:$data['pro_first']->title_seo,
            'description'=>@$data['pro_first']->description_seo,
            'keyword'=>@$data['pro_first']->keyword_seo,
            'image'=>@$data['pro_first']->product_image,
            'type'=>'products');

        //$view_head = 'header_test';
        //$view_footer = 'footer_test';
        $this->LoadHeader(null,$seo,false);
        // $this->LoadLeft();
        $this->load->view('pro_detail',$data);
        $this->LoadFooter();
    }
    public function search(){
        $where=array();
        if($this->input->get()){
            $where = array(
                'cat' => $this->input->get('cat'),
                'q' => $this->input->get('q'),
            );
        }
        else{
            redirect(base_url());
        }

        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url'] = base_url('search?category='.$this->input->get('category')
            .'&travelstyle='.$this->input->get('travelstyle')
            .'&season='.$this->input->get('season')
        );
        $config['total_rows'] = $this->f_productmodel->count_search_result($where);
        $config['per_page'] = 10;
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

        $data = array();
        $data['lists'] = $this->f_productmodel->get_search_result($where,$config['per_page'],
            $this->input->get('per_page'));
        //echo "<pre>";var_dump($data['lists']);die();
        $seo=array('title'=>'Tìm kiếm',
            'description'=>'',
            'keyword'=>'',
            'image'=>'',
            'type'=>'');

        $this->LoadHeader(null,$seo,false);
        $this->LoadLeft();
        $this->load->view('products_search',$data);
        $this->LoadFooter();
    }
    public function advancedSearch()
    {
        $where=array();
        if($this->input->get()){
            $where = array(
                'category' => $this->input->get('category'),
                'startplace' => $this->input->get('places'),
                'finish'    => $this->input->get('finish'),
                'duration' => $this->input->get('duration'),
            );
        }
        else{
            redirect(base_url());
        }
        //var_dump($where);die();
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url'] = base_url('advanced-search?category='.$this->input->get('category')
            .'&startplace='.$this->input->get('startplace')
            .'&duration='.$this->input->get('duration')
        );
        $config['total_rows'] = $this->f_productmodel->count_search_advanced($where);
        $config['per_page'] = 6;
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

        $data = array();
        $data['lists'] = $this->f_productmodel->get_search_advanced($where,$config['per_page'],
            $this->input->get('per_page'));
        //echo "<pre>";var_dump($where);die();
        $data['viewsearch'] = $this->load->widget('blksearch');
        $seo=array('title'=>'Tìm kiếm',
            'description'=>'',
            'keyword'=>'',
            'image'=>'',
            'type'=>'');

        $this->LoadHeader(null,$seo,false);
        $this->LoadLeft();
        $this->load->view('search_advanced',$data);
        $this->LoadFooter();
    }
    /// search ////
    public function Search_pro()
    {
        $ma_hang = $this->input->get('name');
        $where = array(
            'lang' => $this->language,
            'mahang' => $ma_hang,
        );
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url']    = base_url('search-tour?name=' . $ma_hang );
        $config['total_rows']  = $this->f_productmodel->Count_search_rs($where); // xác d?nh t?ng s? record
        $config['per_page']    = 6 ; // xác d?nh s? record ? m?i trang
        $config['uri_segment'] = 3; // xác d?nh segment ch?a page number
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
        $data = array();
        $data['viewsearch'] = $this->load->widget('blksearch');
        $data['lists'] = $this->f_productmodel->Search_rs($where, $config['per_page'], $this->input->get('per_page'));
        $data['tenhang'] = $this->uri->segment(3);

        $title=$this->site_name.'| Kết quả tìm kiếm';
        $keyword=$this->site_keyword;
        $description=@$this->site_description;
        $seo = array(
            'title' => $title,
            'keyword' => $keyword,
            'description' => $description,
        );
        $this->LoadHeader(null,$seo,true);
        /*$this->LoadRight();*/
        $this->load->view('Search_pro', $data);
        $this->LoadFooter();
    }
    public function like(){

        if(isset($_POST['id'])){

            $id=$this->input->post('id');
            $user=$this->f_productmodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));

            if($user->liked !=null){
                $liked=(array)json_decode($user->liked);
            }else  $liked=array();
            $rs['status']=false;
            if(!in_array($id,$liked)){
                $liked[]=$id;
                $rs['status']=true;
            }

            $this->f_productmodel->Update_Where('users',array('id'=>$this->session->userdata('userid')),
                array('liked'=>json_encode($liked)));
            echo json_encode($rs);
        }
    }
    public function countview()
    {
        if($this->input->post('id')){
            $item = $this->f_productmodel->getItemByID('product',$this->input->post('id'));
            $view = $item->view + 1;
            $this->f_productmodel->Update('product',$this->input->post('id'),array(
                'view' => $view
            ));
        }
        echo '1';
    }
    public function productcoments($product_id,$limit=10){
        $data['comments']=$this->f_productmodel->getComments($product_id,$limit);
        $data['comments_sub']=$this->f_productmodel->getComments_desc($product_id);
        $data['product_id']=$product_id;
        $this->load->view('productcoments', $data);
    }

    public function typeDetail()
    {
        $data = array();
        $title=@$data['pro_first']->name;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;

        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('type_detail',$data);
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
    public function products_brand($alias,$id)
    {
        $data = array();
        $config['base_url'] = base_url($alias.'-tp' . $id);
        $config['total_rows'] = $this->f_productmodel->count_product_by_brand($id); // xác định tổng số record
        $config['per_page'] = 6; // xác định số record ở mỗi trang
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
        $order = array();
        if($this->input->get('order') && $this->input->get('direction')){
            $order = array(
                'order' => $this->input->get('order'),
                'direction' => $this->input->get('direction')
            );
        }
        $data['lists'] = $this->f_productmodel->get_product_by_brand($id,$order,$config['per_page'],
            $this->uri->segment(2));
        $data['cate_curent'] = $this->f_productmodel->getFirstRowWhere('product_hangsx',array('id'=>$id));
        $data['cate_all']=$this->f_productmodel->get_data('product_hangsx',null);
        //$data['type']=$data['cate_all'];
        //echo "<pre>";var_dump($data['lists']);die();
        $data['viewsearch'] = $this->load->widget('blksearch');
        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
            'image'=>@$data['cate_curent']->image,
            'type'=>'products');
        $this->LoadHeader(null,$seo,true);
        $this->load->view('pro_bycategory',$data);
        $this->LoadFooter();
    }
    public function products_style($alias,$id)
    {
        $data = array();
        $config['base_url'] = base_url($alias.'-ts' . $id);
        $config['total_rows'] = $this->f_productmodel->count_product_by_style($id); // xác định tổng số record
        $config['per_page'] = 6; // xác định số record ở mỗi trang
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
        $order = array();
        if($this->input->get('order') && $this->input->get('direction')){
            $order = array(
                'order' => $this->input->get('order'),
                'direction' => $this->input->get('direction')
            );
        }
        $data['lists'] = $this->f_productmodel->get_product_by_style($id,$order,$config['per_page'],
            $this->uri->segment(2));
        $data['cate_curent'] = $this->f_productmodel->getFirstRowWhere('travel_style',array('id'=>$id));
        $data['cate_all']=$this->f_productmodel->get_data('travel_style',null);
        //echo "<pre>";var_dump($data['lists']);die();
        $data['viewsearch'] = $this->load->widget('blksearch');
        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
            'image'=>@$data['cate_curent']->image,
            'type'=>'products');
        $this->LoadHeader(null,$seo,true);
        $this->load->view('pro_bycategory',$data);
        $this->LoadFooter();
    }
    function downloadFile($file){
        $file_name = $file;
        $mime = 'application/force-download';
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private',false);
        header('Content-Type: '.$mime);
        header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: close');
        readfile($file_name);
        exit();
    }
}