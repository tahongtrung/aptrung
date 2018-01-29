<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_newsmodel');
        $this->load->library('pagination');
        $this->load->helper('model_helper');
    }
    //News by category
    public function news_bycat($id,$alias){
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['base_url'] = base_url($alias.'?id='.$id);
        $config['total_rows'] = $this->f_newsmodel->countNewsByCategory($id); // xác định tổng số record
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
        $data = array();
        $data['news_bycate'] = $this->f_newsmodel->getNewsByCategory($id,$config['per_page'], $this->input->get('per_page'));

        $cate_curent = $this->f_newsmodel->get_data('news_category',array('id'=>$id),array(),true);

        $data['cate_curent'] =  $cate_curent;
        /*$data['left'] = $this->load->widget('blkcat');*/
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $data['banners'] = $this->f_newsmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $data['cate'] = $this->f_newsmodel->get_data('news_category');
        //echo "<pre>";var_dump($data['news_bycate']);die();
        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
                   'description'=>@$data['cate_curent']->description_seo,
                   'keyword'=>@$data['cate_curent']->keyword_seo,
                   'image'=>@$data['cate_curent']->product_image,
                   'type'=>'article');
        $this->LoadHeader(null,$seo,true);
        $this->load->view('news/category',@$data);
        $this->LoadFooter();
    }


    //News list
    public function news_content($cat_alias,$cid,$nid,$news_alias){

        $data['news']=$this->f_newsmodel->get_news_content($nid,$news_alias);
        //echo "<pre>";print_r($data['news']);die();
        $data['cate_current']=$this->f_newsmodel->get_data('news_category',array('id'=>$cid),array(),true);
        $data['cate']=$this->f_newsmodel->get_data('news_category');

        $data['banner_right'] = $this->f_newsmodel->Get_where('images',array('type'=>'ads_right'));
        $data['new_same'] = $this->f_newsmodel->getSimilar($cid,$nid,10,0);
        //echo "<pre>";var_dump($data['new_same']);die();
        $seo=array('title'=>@$data['news']->title_seo==''?$data['news']->title:$data['news']->title_seo,
                   'description'=>@$data['news']->description_seo,
                   'keyword'=>@$data['news']->keyword_seo,
                   'image'=>@$data['news']->product_image,
                   'type'=>'article');
        $this->LoadHeader(null,$seo,true);
        $this->LoadLeft();
        $this->load->view('news_content',$data);
        $this->LoadFooter();
    }
    public function detail($cate_alias,$new_alias)
    {
        $data['news']=$this->f_newsmodel->get_data('news',array(
            'alias'=>$new_alias,
        ),array(),true);

        $data['cate_current'] = $current = $this->f_newsmodel->get_data('news_category',array(
            'id'=>$data['news']->category_id),
            array(),true);
        $data['cate']=$this->f_newsmodel->get_data('news_category');

        $data['new_same'] = $this->f_newsmodel->getSimilar($data['cate_current']->id,$data['news']->id,10,0);
        
        if($data['news']->hot==1){
            $view = 'news/detail_file';
        }
        else{
            $view = 'news/detail';
        }
        $data['right'] = $this->load->widget('right');
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $data['left'] = $this->load->widget('blkcat');
        $data['leftmb'] = $this->load->widget('blkcatmb');
        $data['banners'] = $this->f_newsmodel->get_data('images',array(
            'type' => 'page'
        ),array('sort' => 'asc'));
        $seo=array('title'=>@$data['news']->title_seo==''?$data['news']->title:$data['news']->title_seo,
            'description'=>@$data['news']->description_seo,
            'keyword'=>@$data['news']->keyword_seo,
            'image'=>@$data['news']->product_image,
            'type'=>'article');
        $this->LoadHeader(null,$seo,true);
        //$this->LoadLeft();
        $this->load->view('news/detail',$data);
        $this->LoadFooter();
    }
    //News by category

}