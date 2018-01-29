<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media extends MY_Controller
{
    protected $module_name="Media";
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
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('m_media');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }
    public function categories()
    {
        $cate = $this->m_media->get_data('media_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $var1 = (array) $cate;
        $data['cate'] = $var1;
        //echo "<pre>";var_dump($cate);die();
        $data['headerTitle'] = "Media";
        $data['headerTitle'] = 'Quản lý media';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/media_category', $data);
        $this->load->view('admin/footer');
    }


    public function cat_add($id_edit=null)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/media/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->m_media->SelectMax('media_category','sort')+1;
        if (isset($_POST['addcate'])) {

            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $alias = make_alias($this->input->post('alias'));
            $cate = array(
                'name' => $title,
                'description' => $description,
                'parent_id' => $parent,
                'alias' => $alias,
                'home' => $this->input->post('home'),
                'hot' => $this->input->post('hot'),
                'focus' => $this->input->post('focus'),
                'sort' => $this->input->post('sort'),
                'title_seo' => $this->input->post('title_seo'),
                'keyword' => $this->input->post('keyword'),
                'description_seo' => $this->input->post('description_seo'),
                'lang'            => $this->language,
            );
            $id = $this->m_media->Add('media_category', $cate);
            $this->m_media->Add('alias',array(
                'alias' => $alias,
                'm_cat' => $id,
                'type' => 'm-cat',
            ));
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/media/' . $upload['upload_data']['file_name'];

                    $this->m_media->Update_where('media_category',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/media/categories'));
        }
        //$data['cate'] = $this->m_media->getList('media_category');
        $data['cate'] = $this->m_media->get_data('media_category',array(
            'lang' => $this->language
        ),array('sort'=>''));

        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/media_cat_add', $data);
        $this->load->view('admin/footer');
    }

    public function cat_edit($id){
        /*$this->cat_add($id);*/
        $data = array();
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/media/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);
        if($id!=null){
            $data['edit']=$this->m_media->getFirstRowWhere('media_category',array('id'=>$id));
            $data['btn_name']='Cập nhật';
            $data['max_sort']=@$data['edit']->sort;
            if (isset($_POST['editcate'])) {
                $title = $this->input->post('name');
                $parent = $this->input->post('parent');
                $description = $this->input->post('description');
                $alias = make_alias($title);

                $cate = array(
                    'name' => $title,
                    'description' => $description,
                    'parent_id' => $parent,
                    'alias' => $alias,
                    'home' => $this->input->post('home'),
                    'hot' => $this->input->post('hot'),
                    'focus' => $this->input->post('focus'),
                    'sort' => $this->input->post('sort'),
                    'title_seo' => $this->input->post('title_seo'),
                    'keyword' => $this->input->post('keyword'),
                    'description_seo' => $this->input->post('description_seo'),
                    'lang'            => $this->language,
                );
                $this->m_media->Update_where('media_category',array('id'=>$id),$cate);
                $checkAlias = $this->m_media->getFirstRowWhere('alias',array(
                    'm_cat' => $id
                ));
                if(empty($checkAlias)){
                    $this->m_media->Add('alias',array(
                        'm_cat' => $id,
                        'type' => 'm-cat',
                        'alias' => $alias
                    ));
                }else{
                    $this->m_media->Update_where('alias',array('m_cat' => $id),array(
                        'alias' => $alias
                    ));
                }
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không thỏa mãn';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image = 'upload/img/media/' . $upload['upload_data']['file_name'];

                        $this->m_media->Update_where('media_category',array('id'=>$id),array('image'=>$image));
                    }
                }
                redirect(base_url('adminvn/media/categories'));
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/cat_edit', $data);
        $this->load->view('admin/footer');
    }
    public function deletecategory($id)
    {
        if (is_numeric($id)&&$id>1) {
            $cat=$this->m_media->get_data('media_category',array('id'=>$id),array(),true);
            if($cat){
                if(file_exists($cat->image)) {unlink($cat->image);}
                $this->m_media->Delete_Where('media_category', array('id'=>$id));
                $this->m_media->Delete_Where('media_category', array('parent_id'=>$id));
            }
            $item_alias =$this->m_media->getFirstRowWhere('alias',array('m_cat'=>$id));
            if(!empty($item_alias)){
                $this->m_media->Delete_where('alias',array('m_cat' => $id));
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function update_cat_view()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $view=$this->input->post('view');

            $item        = $this->m_media->getFirstRowWhere('media_category', array('id' => $id));

            if($item->$view==0){
                $this->m_media->Update_where('media_category',array('id'=>$id),array($view=>1,));
            }
            if($item->$view==1){
                $this->m_media->Update_where('media_category',array('id'=>$id),array($view=>0,));
            }
        }
    }
    public function cat_sort()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $sort=$this->input->post('sort');

            $item = $this->m_media->get_data('media_category', array('id' => $id),array(),true);

            if($item){
                $this->m_media->Update_where('media_category',array('id'=>$id),array('sort'=>$sort,));
            }
        }
    }
    public function listAll()
    {
        if($this->input->get()){

            $where = array(
                'code' => $this->input->get('code'),
                'name' => $this->input->get('name'),
                'cate' => $this->input->get('cate'),
                'view' => $this->input->get('view'),
                'lang' => $this->input->get('lang'),
            );
            $config['page_query_string']    = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['base_url']             = base_url('adminvn/product/products?code='
                . $this->input->get('code')
                . '&name=' . $this->input->get('name')
                . '&cate=' . $this->input->get('cate')
                . '&view=' . $this->input->get('view')
                . '&lang=' . $this->input->get('lang')
            );
            $config['total_rows']           = $this->m_media->countsearch_result($where);
            $config['per_page']             = 20;
            $config['uri_segment'] = 3;

            $config=array_merge($config,$this->pagination_config);

            $this->pagination->initialize($config);
            $data['prolist'] = $this->m_media->getsearch_result($where, $config['per_page'], $this->input->get('per_page'));

            $data['total_rows']=$config['total_rows'];
            $data['cate'] = $this->m_media->get_data('media_category');


        }else{
            $where = array(
                /*'media.lang' => $this->language*/
            );
            $config['base_url'] = base_url('adminvn/product/products');
            $config['total_rows'] = $this->m_media->countByLang($where); // xác định tổng số record
            $config['per_page'] = 20; // xác định số record ở mỗi trang
            $config['uri_segment'] = 4; // xác định segment chứa page number
            $config=array_merge($config,$this->pagination_config);
            $this->pagination->initialize($config);
            $data['prolist'] = $this->m_media->getListMedia($where, $config['per_page'],
                $this->uri->segment(4));
            
            //echo "<pre>";var_dump($config['total_rows']);die();
        }

        //        die();

        //$data['datalang'] = $this->datalang;
        $data['cate'] = $this->m_media->getList('media_category');
        //$data['cate_root'] = $this->m_media->getListRoot('media_category');
        //$data['cate_chil'] = $this->m_media->getListChil('media_category');
        $data['headerTitle'] = "Danh sách media";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/media_list', $data);
        $this->load->view('admin/footer');
    }

    public function add($id_edit=null)
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');

        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $data['ckeditor2'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor2',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' =>  array(
                    //                    array( 'Source','NumberedList','BulletedList', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor')
                    array( 'Bold', 'Italic', 'Underline', 'Strike' ,)
                ), //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '100', //Setting a custom height
            ));

        $config['upload_path'] = './upload/img/media/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_order']=$this->m_media->SelectMax('media','sort')+1;
        if (isset($_POST['addnews'])) {
            $video='';
            if($this->input->post('video')){
                $video=explode('=',$this->input->post('video'));
            }

            $alias = make_alias($this->input->post('alias'));
           $pro = array('name'            => $this->input->post('name'),
                'alias'                 => $alias,
                'description'     => $this->input->post('description'),
                'content'          => $this->input->post('detail'),
                'home'            => $this->input->post('home'),
                'hot'             => $this->input->post('hot'),
                'focus'           => $this->input->post('focus'),
                'video'             => @$video[1],
                'description_seo' => $this->input->post('description_seo'),
                'title_seo'       => $this->input->post('title_seo'),
                'keyword'     => $this->input->post('keyword_seo'),
                'sort'            => $this->input->post('order'),
                'counter'          => $this->input->post('counter'),
                'category_id'       => $this->input->post('category')
            );
            $id = $this->m_media->Add('media', $pro);
            $this->m_media->Add('alias', array(
                'type' => 'media',
                'alias' => $alias,
                'media' => $id
            ));
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không hợp lệ';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/media/' . $upload['upload_data']['file_name'];
                    $this->m_media->Update('media', $id, array('image' => $image,));
                    if(isset($data['edit'])&&file_exists($data['edit']->image)){
                        unlink($data['edit']->image);
                    }
                }
            }
            redirect(base_url('adminvn/media/listAll'));

        }
        $data['cate'] = $this->m_media->get_data('media_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $data['headerTitle'] = "Media";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/media_add', $data);
        $this->load->view('admin/footer');
    }
    public function edit($id){
        /*$this->add($id);*/
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');

        $data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $data['ckeditor2'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor2',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' =>  array(
                    //                    array( 'Source','NumberedList','BulletedList', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor')
                    array( 'Bold', 'Italic', 'Underline', 'Strike' ,)
                ), //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '100', //Setting a custom height
            ));

        $config['upload_path'] = './upload/img/media/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);
        if($id!=null){
            $data['edit']=$this->m_media->getFirstRowWhere('media',array('id'=>$id));
            $data['btn_name']='Cập nhật';
            $data['max_order'] = $data['edit']->sort;
            if (isset($_POST['editmedia'])) {
                $video='';
                if($this->input->post('video')){
                    $video=explode('=',$this->input->post('video'));
                }
                $alias = make_alias($this->input->post('alias'));
                $pro = array('name'            => $this->input->post('name'),
                    'alias'                     => $alias,
                    'description'     => $this->input->post('description'),
                    'content'          => $this->input->post('detail'),
                    'home'            => $this->input->post('home'),
                    'hot'             => $this->input->post('hot'),
                    'focus'           => $this->input->post('focus'),
                    'video'             => @$video[1],
                    'description_seo' => $this->input->post('description_seo'),
                    'title_seo'       => $this->input->post('title_seo'),
                    'keyword'     => $this->input->post('keyword_seo'),
                    'sort'            => $this->input->post('order'),
                    'counter'          => $this->input->post('counter'),
                    'category_id'       => $this->input->post('category')
                );
                $this->m_media->Update('media',$id,$pro);
                $checkAlias = $this->m_media->getFirstRowWhere('alias',array(
                    'media' => $id
                ));
                if(empty($checkAlias)){
                    $this->m_media->Add('alias',array(
                        'media' => $id,
                        'type' => 'media',
                        'alias' => $alias
                    ));
                }else{
                    $this->m_media->Update_where('alias',array('media' => $id),array(
                        'alias' => $alias
                    ));
                }
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload()) {
                        $data['error'] = 'Ảnh không hợp lệ';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image = 'upload/img/media/' . $upload['upload_data']['file_name'];
                        $this->m_media->Update('media', $id, array('image' => $image,));
                        if(isset($data['edit'])&&file_exists($data['edit']->image)){
                            unlink($data['edit']->image);
                        }
                    }
                }
                redirect(base_url('adminvn/media/listAll'));
            }
        }
        $data['cate'] = $this->m_media->get_data('media_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $data['headerTitle'] = "Media";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/media_edit', $data);
        $this->load->view('admin/footer');

    }
    public function deleteMedia($id)
    {
        $imgs = $this->m_media->Get_where('images', array(
            'id_item' => $id
        ));
        foreach($imgs as $img){
            if(file_exists($img->link)){
                unlink(($img->link));
            }
            $this->m_media->Delete('images', $img->id);
        }
        $item = $this->m_media->getFirstRowWhere('media',array(
            'id' => $id
        ));
        if(file_exists($item->image)){
            unlink(($item->image));
        }

        $this->m_media->Delete('media', $id);
        $item_alias =$this->m_media->getFirstRowWhere('alias',array('media'=>$id));
        if(!empty($item_alias)){
            $this->m_media->Delete_where('alias',array('media' => $id));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function images($id)
    {
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'ckeditor',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(	//Setting a custom toolbar
                    array('Source'),
                    array('Bold', 'Italic','Underline', 'Strike', 'FontSize'),
                    array('JustifyLeft', 'JustifyCenter', 'JustifyRight'),
                    array('TextColor', 'BGColor',),
                    '/'
                ),
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
        $data['ckeditor2']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'ckeditor2',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(	//Setting a custom toolbar
                    array('Source'),
                    array('Bold', 'Italic','Underline', 'Strike', 'FontSize'),
                    array('JustifyLeft', 'JustifyCenter', 'JustifyRight'),
                    array('TextColor', 'BGColor',),
                    '/'
                ),
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
        $config['upload_path'] = './upload/img/media/';
        $config['allowed_types'] = 'jpg|png|PNG|jpeg|gif';
        $config['max_size'] = '5000';

        $this->load->library('upload', $config);

        /*$pro=$this->news_model->getFirstRowWhere('news',array('id'=>$id));
        $data['product_name'] = $pro->title;*/
        $data['max_sort']=$this->m_media->selectMaxCol('images','sort',$id)+1;
        if(isset($_POST['Upload'])){

            $db_data = array(
                'link' => '',
                'title' => $this->input->post('title'),
                'id_item' => $id,
                'content' => $this->input->post('content'),
                'name'    => $this->input->post('name'),
                'sort'    => $this->input->post('sort'),
            );
            if(isset($_POST['edit'])&&$_POST['edit']!=null){
                $this->m_media->Update_where('images',array(
                        'id'=>$_POST['edit']),
                    array(
                        'title' => $this->input->post('title'),
                        'content' => $this->input->post('content'),
                        'name'    => $this->input->post('name'),
                        'sort'    => $this->input->post('sort'),
                    )
                );
                $id_img=$_POST['edit'];
            }else{
                $id_img=$this->m_media->Add('images',$db_data);
            }
            if(!empty($_FILES['userfile'])){
                $name_array = array();
                $count = count(@$_FILES['userfile']['size']);
                foreach ($_FILES as $key => $value) {

                    for ($s = 0; $s <= $count - 1; $s++) {
                        $_FILES['userfile']['name'] = $value['name'][$s];
                        $_FILES['userfile']['type'] = $value['type'][$s];
                        $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                        $_FILES['userfile']['error'] = $value['error'][$s];
                        $_FILES['userfile']['size'] = $value['size'][$s];

                        $this->upload->do_upload();

                        $data = $this->upload->data();
                        $name_array[] = $data['file_name'];
                        if ($data['file_name'] != null) {
                            //$name=make_alias($data['file_name']);
                            $link = 'upload/img/media/' . $data['file_name'];

                            $id_i = $this->m_media->Update_where('images',array('id'=>$id_img),array('link' => $link,
                            ));

                        }
                    }
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

        //$data['pro_image'] = $this->news_model->getProImage($id);
        $data['pro_image'] = $this->m_media->getMediaImage($id);
        $data['id'] = $id;

        $data['headerTitle'] = "Thêm tài liệu";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/medias/media_images', $data);
        $this->load->view('admin/footer');
    }
    public function getImagePopup()
    {
        $data = array();
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['ckeditor']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'ckeditor',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => array(	//Setting a custom toolbar
                    array('Source'),
                    array('Bold', 'Italic','Underline', 'Strike', 'FontSize'),
                    array('JustifyLeft', 'JustifyCenter', 'JustifyRight'),
                    array('TextColor', 'BGColor',),
                    '/'
                ),
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
        $id = $_POST['id'];
        $data['id'] = $id;
        $item = $this->m_media->getFirstRowWhere('images',array(
            'id' => $id
        ));
        $data['item'] = $item;
        $this->load->view('admin/medias/media_image_popup', $data);
    }
    public function delete($id)
    {
        $img = $this->m_media->getItemByID('images', $id);

        if(file_exists($img->link)){
            unlink(($img->link));
        }

        $this->m_media->Delete('images', $id);

        redirect($_SERVER['HTTP_REFERER']);
    }
}