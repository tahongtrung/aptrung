<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_media');
        $this->load->helper('url');
    }
    protected $pagination_config= array(
        'full_tag_open'=>"<ul class='pagination pagination-sm'>",
        'full_tag_close'=>"</ul>",
        'num_tag_open'=>'<li>',
        'num_tag_close'=>'</li>',
        'cur_tag_open'=>"<li class='disabled'><li class='active'><a href='#'>",
        'cur_tag_close'=>"<span class='sr-only'></span></a></li>",
        'next_tag_open'=>"<li>",
        'next_tagl_close'=>"</li>",
        'prev_tag_open'=>"<li>",
        'prev_tagl_close'=>"</li>",
        'first_tag_open'=>"<li>",
        'first_tagl_close'=>"</li>",
        'last_tag_open'=>"<li>",
        'last_tagl_close'=>"</li>",
    );
    public function category($id,$alias)
    {
        $data = array();
        $config['page_query_string'] = TRUE;
        $config['enable_query_string'] = TRUE;
        $config['base_url'] = base_url($alias.'?id='.$id);
        $config['total_rows'] = $this->m_media->Count2('media_category',array(
            'id' => $id
        )); // xác định tổng số record
        $config['per_page'] = 6; // xác định số record ở mỗi trang
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

        $data['cate_curent'] = $this->m_media->getFirstRowWhere('media_category',array(
            'lang' => $this->language,
            'id' => $id
        ));
        $data['cate'] = $this->m_media->get_data('media_category');
        $data['news_bycate'] = $this->m_media->getMediaByCategory($id,$config['per_page'], $this->input->get('per_page'));
        $seo=array('title'=>@$data['cate_curent']->title_seo==''?$data['cate_curent']->name:$data['cate_curent']->title_seo,
            'description'=>@$data['cate_curent']->description_seo,
            'keyword'=>@$data['cate_curent']->keyword_seo,
        );
        $this->LoadHeader(null,$seo,true);
        $this->load->view('medias/category',$data);
        $this->LoadFooter();
    }
    public function detail($alias)
    {
        $data = array();
        $data['news']=$this->m_media->get_data('media',array(
            'alias'=> $alias,
        ),array(),true);
        $data['images'] = $this->m_media->get_data('images',array(
            'id_item' => $data['news']->id
        ));
        $data['cate_current']=$this->m_media->get_data('media_category',array(
                'id'=>$data['news']->category_id),
            array(),true);
        //var_dump($data['cate_current']);die();
        $data['cate']=$this->m_media->get_data('media_category');

        $seo=array('title'=>@$data['news']->title_seo==''?$data['news']->title:$data['news']->title_seo,
            'description'=>@$data['news']->description_seo,
            'keyword'=>@$data['news']->keyword_seo,
            'image'=>@$data['news']->product_image,
            'type'=>'article');
        $this->LoadHeader(null,$seo,true);
        $this->load->view('medias/detail',$data);
        $this->LoadFooter();
    }
}