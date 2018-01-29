<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_homemodel');
        $this->load->library('pagination');
        $this->load->model('contact_model');
        $this->ci =& get_instance();
    }
    //index
    public function lang($lang){
        if($lang!=null){
            //$_SESSION['lang']=$lang;
            $this->ci->session->set_userdata('lang',$lang);
            redirect(base_url());
        }
    }
    public function index($var1 = null){
        //echo $var1."<br>";
        //echo $var2;
        if($var1 == null)
        {
            $this->home();
        }else{
            $item = $this->f_homemodel->getFirstRowWhere('alias',array(
                'alias' => $var1
            ));
            if(empty($item)){show_404('Trang này hiện không tồn tại');}
            $type = $item->type;
            switch($type){
                case 'cate-pro':
                    $this->load->_control('products');
                    $this->products->pro_bycategory($item->pro_cat,$var1);
                    break;
                case 'pro':
                    $this->load->_control('products');
                    $this->products->detail($item->pro,$var1);
                    break;
                case 'hangsx':
                    $this->load->_control('products');
                    $this->products->hangsx($var1);
                    break;
                case 'cate-new' :
                    $this->load->_control('news');
                    $this->news->news_bycat($item->new_cat,$var1);
                    break;
                case 'new':
                    $this->load->_control('news');
                    $this->news->detail($item->new_cat,$var1);
                    break;
                case 'm-cat':
                    $this->load->_control('media');
                    $this->media->category($item->m_cat,$var1);
                    break;
                case 'media':
                    $this->load->_control('media');
                    $this->media->detail($var1);
                    break;
                case 'page':
                    $this->load->_control('pages');
                    $this->pages->page_content($var1);
                    break;
            }
        }
    }
    public function home(){
       
        $data = array();

        $data['cate_home'] = $this->f_homemodel->get_data('news_category',array('hot'=>1,'lang'=>$this->language));
        $data['news_home'] = $this->f_homemodel->get_data('news',array('home'=>1,'lang'=>$this->language));
        $data['cate_news'] = $this->f_homemodel->get_data('news_category',array('focus'=>1,'lang'=>$this->language));
        
        $data['support'] = $this->f_homemodel->getData('support_online',array('lang'=>$this->language));
        $data['comment']= $this->f_homemodel->getData('inuser_category',array());
        $data['menuleft'] = $this->f_homemodel->get_data('menu',array('position'=>'left'));
        
        $data['cate_focus'] = $this->f_homemodel->get_data('product_category',array('lang'=>$this->language,'focus'=>1));
        $data['pro_home'] = $this->f_homemodel->get_products(array('product.home'=>1,'product.lang'=>$this->language),100,0);
        $data['pro_focus'] = $this->f_homemodel->get_data('product',array('focus'=>1,'lang'=>$this->language));
        $data['pagehome'] = $this->f_homemodel->getFirstRowWhere('staticpage',array('lang'=>$this->language,'home'=>1));
        $data['sliders'] = $this->load->widget('slide');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $data['right'] = $this->load->widget('right');
        //echo "<pre>";var_dump($data['pros']);die();
        $title = isset($this->option->site_title) ? $this->option->site_title : $this->option->site_title;
        $seo = array(
            'title' => $title
        );
        $this->LoadHeader(null,$seo,true);
        $this->LoadLeft();
        $this->load->view('home/view_home',$data);
        $this->LoadFooter();
    }
    function service(){
        $data = array();
        $data['menu_centers'] = $this->f_homemodel->GetData('menu',array(
            'lang' => $this->language,
            'position' => 'left'
        ),array('sort','asc'),null);
        $seo = array(
            'title' => 'Service'
        );
        $this->LoadHeader(null,$seo,true);
        $this->load->view('home/view_service',$data);
        $this->LoadFooter();
    }
    //Create bread crumb
    public function createBreadCrumb()
    {
        $catId = $_POST['id'];
        $type = $_POST['type'];
        $itemId = $_POST['item_id'];
        if($type == 'products'){
            $arr = $this->f_homemodel->get_data('product_category');
            $item = $this->f_homemodel->getFirstRowWhere('product',array(
                'id' => $itemId
            ));
            $name = $item->name;
        }else{
            $arr = $this->f_homemodel->get_data('news_category');
            $item = $this->f_homemodel->getFirstRowWhere('news',array(
                'id' => $itemId
            ));
            $name = $item->title;
        }
        $data['type'] = $type;
        $data['name'] = $name;
        $data['lists'] = $arr;
        $data['id'] = $item->category_id;
        $this->load->view('home/breadcrumb',$data);
    }
    public function getData()
    {
        $data = array();
        $option = $_POST['option_value'];
        switch($option){
            case 'san-pham-moi':
                $view = 'hot';
                break;
            case 'san-pham-ban-chay':
                $view = 'coupon';
                break;
            case 'san-pham-noi-bat':
                $view = 'focus';
                break;
            default :
                $view = 'home';
                break;
        }
        $data['lists'] = $this->f_homemodel->get_products(array(
            'product.'.$view => 1
        ),20,0);
        //echo "<pre>";var_dump($data['lists']);die();
        $this->load->view('home/home_data',$data);
    }
}