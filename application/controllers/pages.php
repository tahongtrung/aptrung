<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Pages extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('f_pagesmodel');
            $this->load->library('pagination');
        }
        public function page_content($alias){
            $data['page']=$this->f_pagesmodel->get_data('staticpage',array(
                'alias'=>$alias,
                'lang' => $this->language
            ),array(),true);
            $data['banners'] = $this->f_pagesmodel->get_data('images',array(
                'type' => 'page'
            ),array('sort' => 'asc'));
            //$data['menu_right'] = $this->f_pagesmodel->getMenuRightRoot();
            $data['right'] = $this->load->widget('right');
            $data['sliders'] = $this->load->widget('slide');
            $data['sidebar'] = $this->load->widget('blkcat');
            $data['left'] = $this->load->widget('blkcat');
            $data['leftmb'] = $this->load->widget('blkcatmb');
            $title=@$data['page']->name;
            $keyword=@$data['page']->keyword;
            $description=@$data['page']->description;
            $seo = array();
            $this->LoadHeader(null,$seo,true);
            //$this->LoadLeft();
            $this->load->view('pages/view_page',$data);
            $this->LoadFooter();
        }
    }