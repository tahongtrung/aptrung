<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_homemodel');
        $this->load->library('pagination');
        $this->load->model('f_newsmodel');
    }
    public function searchPro(){

        $data = array();

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
        $key=$this->input->get('timkiem');
        $id = $this->input->get('itemId');
        $where=array();
        if($this->input->get()){
            $where = array(
                'id' => $this->input->get('cat'),
                'key' => $this->input->get('timkiem'),
            );
        }
        else{
            redirect(base_url());
        }
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url'] = base_url('search?s='.$this->input->get('timkiem'));
        $config['total_rows'] = $this->f_homemodel->countPoduct_search($where); // xác định tổng số record
        $config['per_page'] =16;
        $config['uri_segment'] =3;
        $this->pagination->initialize($config);
        $data['lists'] = $this->f_homemodel->getPoduct_search($where,$config['per_page'],
            $this->input->get('per_page'));

        $data['toal_item'] = $config['total_rows'];
        //var_dump($data['toal_item']);die();
        //$data['slidebar'] = $this->load->widget('blkcat');
        $data['sliders'] = $this->load->widget('slide');
        $data['sidebar'] = $this->load->widget('blkcat');
        $title='Kết quả tìm kiếm';
        $seo = array(
            'title' => $title
        );
        $this->LoadHeader(null,$seo,false);
        $this->load->view('searchs/pro_search',$data);
        $this->LoadFooter();
    }
    public function search_news(){
        $data = array();
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
        $key=$this->input->get('tk');
        /*$id = $this->input->get('catId');*/
        $where=array();
        if($this->input->get()){
            $where = array(
                /*'id' => $this->input->get('catId'),*/
                'key' => $this->input->get('tk'),
                'news.lang'=> $this->language,
            );
        }
        else{
            redirect(base_url());
        }
        $config['page_query_string'] = TRUE;
        $config['enable_query_strings'] = TRUE;
        $config['base_url'] = base_url('search-news?s='.$this->input->get('s'));
        $config['total_rows'] = $this->f_homemodel->countPoduct_searchn($where); // xác định tổng số record
        //echo "<pre>"; print_r($config['total_rows']);die();
        $config['per_page'] =10;
        $config['uri_segment'] =3;
        $this->pagination->initialize($config);
        $data['lists'] = $this->f_homemodel->getPoduct_searchn($where,$config['per_page'],
            $this->input->get('per_page'));
        $data['toal_item'] = $config['total_rows'];
        //echo "<pre>";var_dump($data['lists']);die();
        /*$data['left'] = $this->load->widget('blkcat');*/
        $data['right'] = $this->load->widget('right');

        $title='Kết quả tìm kiếm';
        $seo = array(
            'title' => $title
        );
        $this->LoadHeader(null,$seo,false);
        $this->load->view('searchs/search_news',$data);
        $this->LoadFooter();
    }
}