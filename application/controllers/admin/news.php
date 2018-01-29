<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class News extends MY_Controller
    {
        protected $module_name = "News";

        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('news_model');
            $this->load->library('pagination');
            $this->auth = new Auth();
            $this->auth->check();
            $this->datalang  = $this->news_model->get_data('language');

        }
        protected $pagination_config= array(
            'full_tag_open'=>"<ul class='pagination'>",
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
        public function index()
        {
            $data['news']     = $this->news_model->count_All('news');
            $data['products'] = $this->news_model->count_All('product');
            $data['orders'] = $this->news_model->get_order_dashboard();

            $order_id=array();
            foreach($data['orders'] as $v){
                $order_id[]=$v->id;
            }

            if(empty($data['item_list'])){
                $data['detail_order']=array();
            }else{
                $data['detail_order'] = $this->news_model->order_detail($order_id);
            }
            $data['contacts'] = $this->news_model->contact_dashboard();
            $data['count_order'] = sizeof($data['orders']);
            $data['headerTitle'] = 'Admin CP';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('admin/footer');
        }
        public function newslist()
        {
            //$this->Check_module($this->module_name);
            $this->check_acl();
            if($this->input->get()){

                $where = array(
                    'name' => $this->input->get('name'),
                    'cate' => $this->input->get('cate'),
                    'view' => $this->input->get('view'),
                    'lang' => $this->language,
                );

                //var_dump($where);die();
                $config['page_query_string']    = TRUE;
                $config['enable_query_strings'] = TRUE;
                $config['base_url']             = base_url('adminvn/news/newslist?name='
                                                    . $this->input->get('name')
                                                    . '&cate=' . $this->input->get('cate')
                                                    . '&view=' . $this->input->get('view')
                                                    . '&lang=' . $this->input->get('lang')
                                                    );
                $config['total_rows']           = $this->news_model->countsearch_result($where);
                $config['per_page']             = 20;
                $config['uri_segment'] = 4;

                $config=array_merge($config,$this->pagination_config);

                $this->pagination->initialize($config);
                $data['newslist'] = $this->news_model->getsearch_result($where, $config['per_page'], $this->input->get('per_page'));


            }else{
                $where = array(
                    'news.lang' => $this->language
                );
                $config['base_url']    = base_url('adminvn/news/newslist');
                $config['total_rows']  = $this->news_model->countByLang($where); // xác định tổng số record
                $config['per_page']    = 20; // xác định số record ở mỗi trang
                $config['uri_segment'] = 4; // xác định segment chứa page number
                $this->pagination->initialize($config);
                $data              = array();
                $data['newslist']  = $this->news_model->GetNewByLang($where,$config['per_page'],$this->uri->segment(4));
                //echo "<pre>";var_dump($data['newslist']);die();
            }
            $data['datalang'] = $this->datalang;

            $data['cate'] = $this->news_model->get_data('news_category');

            $data['headerTitle'] = "Tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news/list_new', $data);
            $this->load->view('admin/footer');
        }

        //add News
        public function add($id=null)
        {
            $this->check_acl();
            //$this->Check_module($this->module_name);
            $this->load->helper('ckeditor_helper');
            $this->load->helper('model_helper');
            $data['ckeditor']        = array(
                //ID of the textarea that will be replaced
                'id'     => 'ckeditor',
                'path'   => 'assets/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width'   => "100%", //Setting a custom width
                    'height'  => '300px', //Setting a custom height
                ));
           
            $data['btn_name']='Thêm';
            if (isset($_POST['addnews'])) {
                $video='';
                if($this->input->post('video')){
                    $video=explode('=',$this->input->post('video'));
                    $video = $video[1];
                }
                $arr = array(
                    'title'           => $this->input->post('title'),
                    'alias'           => $this->input->post('alias'),
                    'description'     => $this->input->post('description'),
                    'hot'             => $this->input->post('hot'),
                    'home'            => $this->input->post('home'),
                    'focus'           => $this->input->post('focus'),
                    'content'         => $this->input->post('content'),
                    'lang'            => $this->language,
                    'tag'             => $this->input->post('tag'),
                    'video'           => $video,
                    'time'            => time(),
                    'category_id'     => $this->input->post('category_id'),
                    'title_seo'       => $this->input->post('title_seo'),
                    'keyword_seo'     => $this->input->post('keyword_seo'),
                    'description_seo' => $this->input->post('description_seo'),
                );
            
            $id = $this->news_model->Add('news', $arr);

                $config['upload_path']   = './upload/img/new/';
                $config['allowed_types'] = '*';
                $config['max_size']      = '5000';
                $config['max_width']     = '3000';
                $config['max_height']    = '2000';
                $this->load->library('upload',$config);
                $this->upload->initialize($config);   

               if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image  = 'upload/img/new/' . $upload['upload_data']['file_name'];
                    
                    $this->news_model->Update_where('news', array('id'=>$id), array('image'=>$image));

                }
                
                $config1['upload_path']   = './upload/img/file/';
                $config1['allowed_types'] = '*';
                $config1['max_size']      = '50000';
                $config1['max_width']     = '30000';
                $config1['max_height']    = '20000';
                $this->load->library('upload',$config1);
                $this->upload->initialize($config1);
                if (!$this->upload->do_upload('userfile1')) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image1  = 'upload/img/file/' . $upload['upload_data']['file_name'];
                    $this->news_model->Update_where('news', array('id'=>$id), array('link_file'=>$image1));
                }
                $this->news_model->Add('alias',array(
                    'new' => $id,
                    'alias' => $this->input->post('alias'),
                    'type' => 'new'
                ));
                if ($this->input->post('category') && sizeof($this->input->post('category')) > 0) {

                    $post_cat = $this->input->post('category');

                    $this->news_model->Delete_where('news_to_category', array('id_news' => $id));
                    for ($i = 0; $i < sizeof($post_cat); $i++) {
                        $ca = array('id_news' => $id, 'id_category' => $post_cat[$i]);
                        $this->news_model->Add('news_to_category', $ca);
                    }
                    $this->news_model->Update_where('news', array('id'=>$id), array('category_id' => end($post_cat)));
                }
                //update news image
              //end
                redirect(base_url('adminvn/news/newslist'));
            }
            $data['datalang'] = $this->datalang;
            $data['cate'] = $this->news_model->get_data('news_category',array(
                'lang' => $this->language
            ));
            $data['headerTitle'] = "Tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news/add', $data);
            $this->load->view('admin/footer');
        }

        public function edit($id){
            $this->check_acl();
            $this->load->helper('ckeditor_helper');
            $this->load->helper('model_helper');
            $data['ckeditor']        = array(
                //ID of the textarea that will be replaced
                'id'     => 'ckeditor',
                'path'   => 'assets/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' => "Full", //Using the Full toolbar
                    'width'   => "100%", //Setting a custom width
                    'height'  => '300px', //Setting a custom height
                ));
            if($id){
                //get news item
                $item=$this->news_model->get_data('news',array('id'=>$id),array(),true);
                $data['edit']=$item;
                $data['btn_name']='Cập nhật';
                $data['cate_selected']=$this->news_model->getField_array('news_to_category','id_category',array('id_news'=>$id));
                if (isset($_POST['editnew'])) {
                    $video='';
                    if($this->input->post('video')){
                        $video=explode('=',$this->input->post('video'));
                        $video = $video[1];
                    }
                    $arr = array(
                        'title'           => $this->input->post('title'),
                        'alias'           => make_alias($this->input->post('alias')),
                        'description'     => $this->input->post('description'),
                        'hot'             => $this->input->post('hot'),
                        'home'            => $this->input->post('home'),
                        'focus'           => $this->input->post('focus'),
                        'content'         => $this->input->post('content'),
                        'lang'            => $this->language,
                        'tag'             => $this->input->post('tag'),
                        'time'            => time(),
                        'video'           => $video,
                        'category_id'     => $this->input->post('category_id'),
                        'title_seo'       => $this->input->post('title_seo'),
                        'keyword_seo'     => $this->input->post('keyword_seo'),
                        'description_seo' => $this->input->post('description_seo'),
                    );
                    $this->news_model->Update_where('news', array('id'=>$id),$arr);
                    /*$this->news_model->Update_where('alias',array('new' => $id),array(
                        'alias' => $this->input->post('alias')
                    ));*/
                    $checkAlias = $this->news_model->getFirstRowWhere('alias',array(
                        'new'=>$id
                    ));
                    if(empty($checkAlias)){
                        $this->news_model->Add('alias',array(
                            'alias' => make_alias($this->input->post('alias')),
                            'new' => $id,
                            'type' => 'new',
                        ));
                    }else{
                        $this->news_model->Update_where('alias',array('new'=>$id),array(
                            'alias' => make_alias($this->input->post('alias'))
                        ));
                    }
                    if ($this->input->post('category') && sizeof($this->input->post('category')) > 0) {

                        $post_cat = $this->input->post('category');

                        $this->news_model->Delete_where('news_to_category', array('id_news' => $id));
                        for ($i = 0; $i < sizeof($post_cat); $i++) {
                            $ca = array('id_news' => $id, 'id_category' => $post_cat[$i]);
                            $this->news_model->Add('news_to_category', $ca);
                        }
                        $this->news_model->Update_where('news', array('id'=>$id), array('category_id' => end($post_cat)));
                    }
                    //upload image
                    $config['upload_path']   = './upload/img/new/';
                    $config['allowed_types'] = '*';
                    $config['max_size']      = '5000';
                    $config['max_width']     = '3000';
                    $config['max_height']    = '2000';
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('userfile')) {
                        $data['error'] = 'Ảnh không hợp lệ!';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image  = 'upload/img/new/' . $upload['upload_data']['file_name'];

                        $this->news_model->Update_where('news', array('id'=>$id), array('image'=>$image));

                    }

                    $config1['upload_path']   = './upload/img/file/';
                    $config1['allowed_types'] = '*';
                    $config1['max_size']      = '50000';
                    $config1['max_width']     = '3000';
                    $config1['max_height']    = '2000';
                    $this->load->library('upload',$config1);
                    $this->upload->initialize($config1);
                    if (!$this->upload->do_upload('userfile1')) {
                        $data['error'] = 'Ảnh không hợp lệ!';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image1  = 'upload/img/file/' . $upload['upload_data']['file_name'];
                        $this->news_model->Update_where('news', array('id'=>$id), array('link_file'=>$image1));
                    }
                    redirect(base_url('adminvn/news/newslist'));
                }
            }
            $data['datalang'] = $this->datalang;
            $data['cate'] = $this->news_model->get_data('news_category',array(
                'lang' => $this->language
            ));
            $data['headerTitle'] = "Sửa tin";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news/edit', $data);
            $this->load->view('admin/footer');
        }
        public function categories()
        {
            $this->check_acl();
            //$this->Check_module($this->module_name);
            $data['news_cate'] = $this->news_model->get_data('news_category',array(
                'lang' => $this->language
            ),array('sort'=>''));

            $data['headerTitle'] = 'Tin tức';
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news/list_cate', $data);
            $this->load->view('admin/footer');
        }
        //Delete News
        public function deletes(){
            $this->check_acl();
            $ids = $this->input->post('checkone');
            foreach($ids as $id)
            {
                $this->delete_once($id);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        public function delete_once($id)
        {
            $news=$this->news_model->get_data('news',array('id'=>$id),array(),true);
            $item_alias =$this->news_model->getFirstRowWhere('alias',array('new'=>$id));
            if(!empty($item_alias)){
                $this->news_model->Delete_where('alias',array('new' => $id));
            }
            if(file_exists($news->image));
            $this->news_model->Delete('news', $id);
        }
        public function delete($id)
        {
            $this->check_acl();
            //$this->Check_module($this->module_name);
            $news=$this->news_model->get_data('news',array('id'=>$id),array(),true);
            $item_alias =$this->news_model->getFirstRowWhere('alias',array('new'=>$id));
            if(!empty($item_alias)){
                $this->news_model->Delete_where('alias',array('new' => $id));
            }
            if(file_exists($news->image));
            $this->news_model->Delete('news', $id);
            redirect($_SERVER['HTTP_REFERER']);
        }

        //Add Category
        public function cat_add($id=null)
        {
            $this->check_acl();
            //$this->Check_module($this->module_name);
            $this->load->helper('model_helper');
            $this->load->helper('ckeditor_helper');
            $data['ckeditor2'] = array(
                //ID of the textarea that will be replaced
                'id' => 'ckeditor2',
                'path' => 'assets/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' =>  array(
//                    array( 'Source','NumberedList','BulletedList', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor')
                        array( 'Bold', 'Italic', 'Underline', 'Strike' ,'Source')
                    ), //Using the Full toolbar
                    'width' => "100%", //Setting a custom width
                    'height' => '200', //Setting a custom height
                ));
            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2000';
            $config['max_width']     = '1500';
            $config['max_height']    = '1000';
            $sort=$this->news_model->SelectMax('news_category','sort')+1;
            $this->load->library('upload', $config);
            if (isset($_POST['addcate'])) {
                $cate    = array(
                    'name'        => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'parent_id'   => $this->input->post('parent'),
                    'home'        => $this->input->post('home'),
                    'focus'       => $this->input->post('focus'),
                    'hot'         => $this->input->post('hot'),
                    'hinhanh'         => $this->input->post('hinhanh'),
                    'tour'         => $this->input->post('tour'),
                    'alias'       => make_alias($this->input->post('alias')),
                    'lang'        => $this->language,
                    'title_seo'   => $this->input->post('title_seo'),
                    'keyword'   => $this->input->post('keyword'),
                    'sort'       => $sort,
                    'description_seo'   => $this->input->post('description_seo')
                );
                $id = $this->news_model->Add('news_category', $cate);
                $this->news_model->Add('alias',array(
                    'alias' => make_alias($this->input->post('alias')),
                    'new_cat' => $id,
                    'type' => 'cate-new',
                ));
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không thỏa mãn';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image = 'upload/img/' . $upload['upload_data']['file_name'];

                        $this->news_model->Update_where('news_category',array('id'=>$id),array('icon'=>$image));
                    }
                }

                redirect(base_url('adminvn/news/categories'));
            }
            $data['category'] = $this->news_model->get_data('news_category',array(
                'lang' => $this->language
            ),array('sort'=>'s'));

            $data['headerTitle'] = "Tin tức";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news/cat_add', $data);
            $this->load->view('admin/footer');
        }

        public function cat_edit($id){
            $this->check_acl();
            $this->load->helper('model_helper');
            $this->load->helper('ckeditor_helper');
            $data['ckeditor2'] = array(
                //ID of the textarea that will be replaced
                'id' => 'ckeditor2',
                'path' => 'assets/ckeditor',
                //Optionnal values
                'config' => array(
                    'toolbar' =>  array(
//                    array( 'Source','NumberedList','BulletedList', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor')
                        array( 'Bold', 'Italic', 'Underline', 'Strike' ,'Source')
                    ), //Using the Full toolbar
                    'width' => "100%", //Setting a custom width
                    'height' => '200', //Setting a custom height
                ));
            $config['upload_path']   = './upload/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2000';
            $config['max_width']     = '1500';
            $config['max_height']    = '1000';
            $this->load->library('upload', $config);
            if($id!=null){
                $data['edit']=$this->news_model->get_data('news_category',array('id'=>$id),array(),true);
                $data['btn_name']='Cập nhật';
                if (isset($_POST['editcate'])) {
                    $cate    = array(
                        'name'        => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'parent_id'   => $this->input->post('parent'),
                        'home'        => $this->input->post('home'),
                        'focus'       => $this->input->post('focus'),
                        'hot'         => $this->input->post('hot'),
                        'hinhanh'         => $this->input->post('hinhanh'),
                        'tour'         => $this->input->post('tour'),
                        'alias'       => make_alias($this->input->post('alias')),
                        'lang'        => $this->language,
                        'title_seo'   => $this->input->post('title_seo'),
                        'keyword'   => $this->input->post('keyword'),
                        'description_seo'   => $this->input->post('description_seo')
                    );
                    $this->news_model->Update_where('news_category',array('id'=>$id),$cate);
                    $checkAlias = $this->news_model->getFirstRowWhere('alias',array(
                        'new_cat'=>$id
                    ));
                    if(empty($checkAlias)){
                        $this->news_model->Add('alias',array(
                            'alias' => make_alias($this->input->post('alias')),
                            'new_cat' => $id,
                            'type' => 'cate-new',
                        ));
                    }else{
                        $this->news_model->Update_where('alias',array('new_cat'=>$id),array(
                            'alias' => $this->input->post('alias')
                        ));
                    }
                    if ($_FILES['userfile']['name'] != '') {
                        if (!$this->upload->do_upload()) {
                            $data['error'] = 'Ảnh không thỏa mãn';
                        } else {
                            $upload = array('upload_data' => $this->upload->data());
                            $image = 'upload/img/' . $upload['upload_data']['file_name'];

                            $this->news_model->Update_where('news_category',array('id'=>$id),array('icon'=>$image));
                        }
                    }
                    redirect(base_url('adminvn/news/categories'));
                }
            }
            //$this->cat_add($id);
            $data['category'] = $this->news_model->get_data('news_category',array(
                'lang' => $this->language
            ),array('sort'=>'s'));
            $data['headerTitle'] = "Sửa danh mục tin";
            $this->load->view('admin/header', $data);
            $this->load->view('admin/news/cat_edit', $data);
            $this->load->view('admin/footer');
        }

        //Delete Cate News
        public function cat_deletes()
        {
            $this->check_acl();
            $ids = $this->input->post('checkone');
            foreach($ids as $id)
            {
                $this->del_cat_once($id);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        public function del_cat_once($id){
            $this->news_model->DeleteCategory($id);
        }
        public function deletecategory($id)
        {
            $this->news_model->DeleteCategory($id);
            redirect($_SERVER['HTTP_REFERER']);
        }
        /*public function deletecategory($id)
        {
            $this->check_acl();
            $this->news_model->Delete('news_category', $id);
            $item_alias =$this->news_model->getFirstRowWhere('alias',array('new_cat'=>$id));
            if(!empty($item_alias)){
                $this->news_model->Delete_where('alias',array('new_cat' => $id));
            }
            redirect($_SERVER['HTTP_REFERER']);
        }*/
        //ajax
        public function update_view()
        {
            if ($this->input->post('id')) {
                $id=$this->input->post('id');
                $view=$this->input->post('view');

                $item        = $this->news_model->getFirstRowWhere('news', array('id' => $id));

                if($item->$view==0){
                    $this->news_model->Update_where('news',array('id'=>$id),array($view=>1,));
                }
                if($item->$view==1){
                    $this->news_model->Update_where('news',array('id'=>$id),array($view=>0,));
                }
            }
        }
        //ajax
        public function update_cat_view()
        {
            if ($this->input->post('id')) {
                $id=$this->input->post('id');
                $view=$this->input->post('view');

                $item        = $this->news_model->getFirstRowWhere('news_category', array('id' => $id));

                if($item->$view==0){
                    $this->news_model->Update_where('news_category',array('id'=>$id),array($view=>1,));
                }
                if($item->$view==1){
                    $this->news_model->Update_where('news_category',array('id'=>$id),array($view=>0,));
                }
            }
        }
        //ajax
        public function cat_sort()
        {
            if ($this->input->post('id')) {
                $id=$this->input->post('id');
                $sort=$this->input->post('sort');

                $item        = $this->news_model->get_data('news_category', array('id' => $id),array(),true);

                if($item){
                    $this->news_model->Update_where('news_category',array('id'=>$id),array('sort'=>$sort,));
                }
            }
        }


        public function test()
        {
            $this->Check_module($this->module_name);
            $t     = "fsfs,gdgdg,uutu,fg";
            $array = explode(",", $t);
            foreach ($array as $v) {
                echo $v . ' -';
            }
        }
    }