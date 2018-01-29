<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller
{
    protected $module_name="Products";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('productmodel');
        $this->load->library('pagination');
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
        $this->datalang  = $this->productmodel->get_data('language');
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
//    ======================================================================================================================
    public function products()
    {
        $this->check_acl();
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
            $config['total_rows']           = $this->productmodel->countsearch_result($where);
            $config['per_page']             = 20;
            $config['uri_segment'] = 3;

            $config=array_merge($config,$this->pagination_config);

            $this->pagination->initialize($config);
            $data['prolist'] = $this->productmodel->getsearch_result($where, $config['per_page'], $this->input->get('per_page'));

            $data['total_rows']=$config['total_rows'];
            $data['cate'] = $this->productmodel->get_data('product_category');
        }else{
            $where = array(
                'product.lang' => $this->language
            );
            $config['base_url'] = base_url('adminvn/product/products');
            $config['total_rows'] = $this->productmodel->countByLang($where); // xác định tổng số record
            $config['per_page'] = 20; // xác định số record ở mỗi trang
            $config['uri_segment'] = 4; // xác định segment chứa page number
            $config=array_merge($config,$this->pagination_config);
            $this->pagination->initialize($config);
            $data['prolist'] = $this->productmodel->getListProduct($where, $config['per_page'],
                $this->uri->segment(4));
            //echo "<pre>";var_dump($config['total_rows']);die();
        }
        //        die();

        $data['datalang'] = $this->datalang;
        $data['cate'] = $this->productmodel->getList('product_category');
        $data['cate_root'] = $this->productmodel->getListRoot('product_category');
        $data['cate_chil'] = $this->productmodel->getListChil('product_category');
        $data['headerTitle'] = "Sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/list_pro', $data);
        $this->load->view('admin/footer');
    }

    public function add($id_edit=null)
    {
        $this->check_acl();
        $this->load->helper('thumbnail_helper');
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
        $data['pricing'] = array(
            //ID of the textarea that will be replaced
            'id' => 'pricing',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $data['ckeditor1'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor1',
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
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $data['btn_name']='Thêm';
        $data['btn_demo'] = "Upload file demo";
        $data['btn_download'] = "Cập nhật file download";
        $data['max_order']=$this->productmodel->SelectMax('product','sort')+1;
        if (isset($_POST['addnews'])) {
            $id_start  = (int)$this->input->post('downloaded');
            //var_dump($id_finish);die();
            $arrTags = explode(",",$this->input->post('tags'));
            $price       = str_replace(array(';','.',',',' '),'',$this->input->post('price'));
            $price_sale      = str_replace(array(';','.',',',' '),'',$this->input->post('price_sale'));
            $alias = make_alias($this->input->post('alias'));
            $pro = array(
                'name'            => $this->input->post('name'),
                'alias'           => $alias,
                'description'     => $this->input->post('description'),
                'code'            => $this->input->post('code'),
                'detail'          => $this->input->post('detail'),
                'price'           => $price,
                'price_sale'      => $price_sale,
                'tinhtrang'       => $this->input->post('tinhtrang'),
                'home'            => $this->input->post('home'),
                'hot'             => $this->input->post('hot'),
                'focus'           => $this->input->post('focus'),
                'coupon'          => $this->input->post('coupon'),
                'note'            => $this->input->post('note'),
                'description_seo' => $this->input->post('description_seo'),
                'title_seo'       => $this->input->post('title_seo'),
                'keyword_seo'     => $this->input->post('keyword_seo'),
                'destination'     => $this->input->post('destination'),
                'type'            => $this->input->post('type'),
                'style'           => $this->input->post('style'),
                'dksudung'        => $this->input->post('dksudung'),
                'number'         => $this->input->post('number'),
                'view'            => $this->input->post('view'),
                'sort'            => $this->input->post('order'),
                'bought'          => $this->input->post('bought'),
                'counter'         => $this->input->post('counter'),
                'groupsize'       => $this->input->post('groupsize'),
                'pricing'         => $this->input->post('pricing'),
                'lang'            => $this->language,
                'tags'          => $this->input->post('tags'),
                'time'=>time(),
            );
            $id = $this->productmodel->Add('product', $pro);
            $transaction=array(
                'product_id'=>$id,
                'time'=>time(),
                'counter'=>$this->input->post('counter'),
                'type'=>1, //type=1: nhap hang type=2: ban hang
            );

            $this->productmodel->Add('product_transaction', $transaction);
            $this->productmodel->Add('alias', array(
                'type' => 'pro',
                'alias' => $alias,
                'pro' => $id
            ));
            foreach ($arrTags as $tag)
            {
                $tag = trim($tag);
                if($tag !='')
                {
                    $this->productmodel->Add('product_tag',array(
                        'product_id' => $id,
                        'tag' => $tag,
                        'alias' => make_alias($tag)
                    ));
                }
            }
            if (isset($_POST['category']) && sizeof($_POST['category']) > 0) {
                $post_cat = $_POST['category'];
                //print_r($post_cat);die();
                $this->productmodel->Delete_where('product_to_category', array('id_product' => $id));
                for ($i = 0; $i < sizeof($post_cat); $i++) {
                    $ca = array('id_product' => $id, 'id_category' => $post_cat[$i]);
                    $this->productmodel->Add('product_to_category', $ca);
                }
                $this->productmodel->Update_where('product', array('id'=>$id), array('category_id' => end($post_cat)));
            }

            /**
             * Upload images and files
             */
            //upload images
            $this->load->library('upload');
            $pathImage = "upload/img/products/";
            #Create folder
            $dir_image = date('dmY');
            if(!is_dir($pathImage.$dir_image))
            {
                @mkdir($pathImage.$dir_image);
                $this->load->helper('file');
                @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
            }
            //$dir_image = $data['edit']->pro_dir;

            $config['upload_path'] = $pathImage.$dir_image.'/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
            $config['max_size'] = '5000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            $image = '';
            if($this->upload->do_upload('userfile'))
            {
                $uploadData = $this->upload->data();
                if($uploadData['is_image'] == TRUE)
                {
                    $image = $uploadData['file_name'];
                }
                elseif(file_exists($pathImage.$dir_image.'/'.$uploadData['file_name']))
                {
                    @unlink($pathImage.$dir_image.'/'.$uploadData['file_name']);
                }
                unset($uploadData);
            }
            if($image !='')
            {
                #BEGIN: Create thumbnail
                $this->load->library('image_lib');
                if(file_exists($pathImage.$dir_image.'/'.$image))
                {
                    for($j = 1; $j <= 3; $j++)
                    {
                        switch($j)
                        {
                            case 1:
                                $maxWidth = 300;#px
                                $maxHeight = 300;#px
                                break;
                            case 3:
                                $maxWidth = 63;#px
                                $maxHeight = 63;#px
                                break;
                            default:
                                $maxWidth = 600;#px
                                $maxHeight = 600;#px
                        }
                        $sizeImage = size_thumbnail($pathImage.$dir_image.'/'.$image, $maxWidth, $maxHeight);
                        $configImage['source_image'] = $pathImage.$dir_image.'/'.$image;
                        $configImage['new_image'] = $pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image;
                        $configImage['maintain_ratio'] = TRUE;
                        $configImage['width'] = $sizeImage['width'];
                        $configImage['height'] = $sizeImage['height'];
                        $this->image_lib->initialize($configImage);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                #END Create thumbnail
            }
            if(@$image == 'none.gif')
            {
                #Remove dir
                $this->load->library('file');
                if(trim($dir_image) != '' && trim($dir_image) != 'default' && is_dir('upload/img/product/'.$dir_image) && count($this->file->load('upload/img/product/'.$dir_image,'index.html')) == 0)
                {
                    if(file_exists('upload/img/product/'.$dir_image.'/index.html'))
                    {
                        @unlink('upload/img/product/'.$dir_image.'/index.html');
                    }
                    @rmdir('upload/img/product/'.$dir_image);
                }
                $dir_image = 'default';
            }
            $this->productmodel->Update('product', $id, array(
                'image' => @$image,
                'pro_dir' => $dir_image,
            ));
            /*$config2['upload_path'] = './upload/file/view/';
            $config2['allowed_types'] = 'doc|pdf|docx';
            $config2['max_size'] = '0';
            $config2['max_width'] = '5000';
            $config2['max_height'] = '5100';
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);
            if ($this->upload->do_upload('file_demo')){
                $upload1 = array('upload_data' => $this->upload->data());
                $filedemo = 'upload/file/view/' .$upload1['upload_data']['file_name'];
                $this->productmodel->Update('product', $id, array('filedemo' => $filedemo,));
                if(isset($data['edit'])&&file_exists($data['edit']->filedemo)){
                    unlink($data['edit']->filedemo);
                }
            }*/
            redirect(base_url('adminvn/product/products'));
        }
        $data['cate'] = $this->productmodel->get_data('product_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $data['types'] = $this->productmodel->get_data('product_hangsx',array(
            'lang' => $this->language
        ),null);
        $data['places'] = $this->productmodel->get_data('places',null);
        /*echo "<pre>";
        var_dump($data['seasons']);die();*/
        $data['headerTitle'] = "Thêm mới file";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/add', $data);
        $this->load->view('admin/footer');
    }

    public function edit($id_edit){
        $this->check_acl();
        $this->load->helper('thumbnail_helper');
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
        $data['pricing'] = array(
            //ID of the textarea that will be replaced
            'id' => 'pricing',
            'path' => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        $data['ckeditor1'] = array(
            //ID of the textarea that will be replaced
            'id' => 'ckeditor1',
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
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "100%", //Setting a custom width
                'height' => '300px', //Setting a custom height
            ));
        if($id_edit!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('product',array('id'=>$id_edit));
            $data['cate_selected'] = $this->productmodel->getField_array('product_to_category','id_category',
                array('id_product'=>$id_edit));
            $data['season_selected'] = $this->productmodel->getField_array('product_to_season','id_season',
                array('id_product'=>$id_edit));
            //echo "<pre>";var_dump($data['cate_selected']);die();
            $data['btn_name']='Cập nhật';
            $data['btn_demo'] = "Cập nhật file demo";
            $data['btn_download'] = "File download";
            /*if(!empty($data['edit']->filedemo)){
                $arr1 = explode('/',$data['edit']->filedemo);
                $data['file_demo'] = @$arr1[3];
            }*/
            /*if(!empty($data['edit']->file_download)){
                $arr2 = explode('/',$data['edit']->file_download);
                $data['file_download'] = @$arr2[3];
            }*/
            $data['max_order'] = $data['edit']->order;
        }
        if (isset($_POST['editnews'])) {
            $id_start  = (int)$this->input->post('downloaded');
            $alias = make_alias($this->input->post('alias'));
            $arrTags = explode(",",$this->input->post('tags'));
            $price       = str_replace(array(';','.',',',' '),'',$this->input->post('price'));
            $price_sale      = str_replace(array(';','.',',',' '),'',$this->input->post('price_sale'));
            $pro = array(
                'name'            => $this->input->post('name'),
                'alias'           => $alias,
                'description'     => $this->input->post('description'),
                'code'            => $this->input->post('code'),
                'detail'          => $this->input->post('detail'),
                'price'           => $price,
                'price_sale'      => $price_sale,
                'tinhtrang'       => $this->input->post('tinhtrang'),
                'home'            => $this->input->post('home'),
                'hot'             => $this->input->post('hot'),
                'focus'           => $this->input->post('focus'),
                'coupon'          => $this->input->post('coupon'),
                'location'        => $this->input->post('location'),
                'note'            => $this->input->post('note'),
                'description_seo' => $this->input->post('description_seo'),
                'title_seo'       => $this->input->post('title_seo'),
                'keyword_seo'     => $this->input->post('keyword_seo'),
                'destination'     => $this->input->post('destination'),
                'type'            => $this->input->post('type'),
                'style'           => $this->input->post('style'),
                'dksudung'        => $this->input->post('dksudung'),
                'number'          => $this->input->post('number'),
                'view'            => $this->input->post('view'),
                'itinerary'       => $this->input->post('itinerary'),
                'sort'            => $this->input->post('order'),
                'bought'          => $this->input->post('bought'),
                'counter'         => $this->input->post('counter'),
                'groupsize'       => $this->input->post('groupsize'),
                'pricing'         => $this->input->post('pricing'),
                'lang'            => $this->language,
                'tags'          => $this->input->post('tags'),
                'time'=>time(),
            );
            $this->productmodel->Update('product',$id_edit,$pro);
            /**
             * alias
             */
            $checkAlias = $this->productmodel->getFirstRowWhere('alias',array(
                'pro' => $id_edit
            ));
            if(empty($checkAlias)){
                $this->productmodel->Add('alias',array(
                    'pro' => $id_edit,
                    'type' => 'pro',
                    'alias' => $alias
                ));
            }else{
                $this->productmodel->Update_where('alias',array('pro' => $id_edit),array(
                    'alias' => $alias
                ));
            }
            /*
             * tags
             */
            $this->productmodel->Delete_where('product_tag',array(
                'product_id' => $id_edit
            ));
            foreach($arrTags as $tag)
            {
                $tag = trim($tag);
                if($tag !=='')
                {
                    $this->productmodel->Add('product_tag',array(
                        'product_id' => $id_edit,
                        'tag' => $tag,
                        'alias' => make_alias($tag)
                    ));
                }
            }
            if (isset($_POST['category']) && sizeof($_POST['category']) > 0) {
                $post_cat = $_POST['category'];
                //print_r($post_cat);die();
                $this->productmodel->Delete_where('product_to_category', array('id_product' => $id_edit));
                for ($i = 0; $i < sizeof($post_cat); $i++) {
                    $ca = array('id_product' => $id_edit, 'id_category' => $post_cat[$i]);
                    $this->productmodel->Add('product_to_category', $ca);
                }
                $this->productmodel->Update_where('product', array('id'=>$id_edit), array('category_id' => end($post_cat)));
            }
            #BEGIN: Upload image
            $this->load->library('upload');
            $pathImage = "upload/img/products/";
            #Create folder
            $dir_image = date('dmY');
            if(!is_dir($pathImage.$dir_image))
            {
                @mkdir($pathImage.$dir_image);
                $this->load->helper('file');
                @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
            }
            //$dir_image = $data['edit']->pro_dir;
            if($dir_image == 'default')
            {
                $dir_image = date('dmY');
            }
            $image = $data['edit']->image;
            if(!is_dir($pathImage.$dir_image))
            {
                @mkdir($pathImage.$dir_image);
                $this->load->helper('file');
                @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
            }
            $config['upload_path'] = $pathImage.$dir_image.'/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF|pdf|docx';
            $config['max_size'] = '5000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            $imageArray = '';

            if($this->upload->do_upload('userfile'))
            {
                $uploadData = $this->upload->data();
                if($uploadData['is_image'] == TRUE)
                {
                    $imageArray = $uploadData['file_name'];
                }
                elseif(file_exists($pathImage.$dir_image.'/'.$uploadData['file_name']))
                {
                    @unlink($pathImage.$dir_image.'/'.$uploadData['file_name']);
                }
                unset($uploadData);
            }
            //echo "<pre>";var_dump($imageArray);die();
            if($imageArray !='')
            {
                if(file_exists($pathImage.$dir_image.'/'.$image))
                {
                    @unlink($pathImage.$dir_image.'/'.$image);
                }
                for($j = 1; $j <= 3; $j++)
                {
                    if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image))
                    {
                        @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image);
                    }
                }
                $this->load->library('image_lib');
                if(file_exists($pathImage.$dir_image.'/'.$imageArray))
                {
                    for($j = 1; $j <= 3; $j++)
                    {
                        switch($j)
                        {
                            case 1:
                                $maxWidth = 300;#px
                                $maxHeight = 300;#px
                                break;
                            case 3:
                                $maxWidth = 63;#px
                                $maxHeight = 63;#px
                                break;
                            default:
                                $maxWidth = 600;#px
                                $maxHeight = 600;#px
                        }
                        $sizeImage = size_thumbnail($pathImage.$dir_image.'/'.$imageArray, $maxWidth, $maxHeight);
                        $configImage['source_image'] = $pathImage.$dir_image.'/'.$imageArray;
                        $configImage['new_image'] = $pathImage.$dir_image.'/thumbnail_'.$j.'_'.$imageArray;
                        $configImage['maintain_ratio'] = TRUE;
                        $configImage['width'] = $sizeImage['width'];
                        $configImage['height'] = $sizeImage['height'];
                        $this->image_lib->initialize($configImage);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                }
                #END Create thumbnail
            }
            if($imageArray == 'none.gif')
            {
                #Remove dir
                $this->load->library('file');
                if(trim($dir_image) != '' && trim($dir_image) != 'default' && is_dir('upload/img/product/'.$dir_image) && count($this->file->load('upload/img/product/'.$dir_image,'index.html')) == 0)
                {
                    if(file_exists('upload/img/product/'.$dir_image.'/index.html'))
                    {
                        @unlink('upload/img/product/'.$dir_image.'/index.html');
                    }
                    @rmdir('upload/img/product/'.$dir_image);
                }
                $dir_image = 'default';
            }
            if($imageArray !='')
            {
                $this->productmodel->Update('product',$id_edit,array(
                    'image' => $imageArray,
                    'pro_dir' => $dir_image
                ));
            }

            //upload files
            /*$config2['upload_path'] = './upload/file/view/';
            $config2['allowed_types'] = 'doc|pdf|docx';
            $config2['max_size'] = '0';
            $config2['max_width'] = '5000';
            $config2['max_height'] = '5100';
            $this->load->library('upload', $config2);

            $this->upload->initialize($config2);
            if ($this->upload->do_upload('file_demo')){
                $upload1 = array('upload_data' => $this->upload->data());
                $filedemo = 'upload/file/view/' .$upload1['upload_data']['file_name'];
                $this->productmodel->Update('product', $id_edit, array('filedemo' => $filedemo,));
                if(isset($data['edit'])&&file_exists($data['edit']->filedemo)){
                    unlink($data['edit']->filedemo);
                }
            }*/
            redirect(base_url('adminvn/product/products'));
        }
        $data['cate'] = $this->productmodel->get_data('product_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $data['types'] = $this->productmodel->get_data('product_hangsx',array(
            'lang' => $this->language
        ),null);
        $data['styles'] = $this->productmodel->get_data('travel_style',array(
            'lang' => $this->language
        ),null);
        $data['places'] = $this->productmodel->get_data('places',null);
        $data['headerTitle'] = "Sửa file";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/edit', $data);
        $this->load->view('admin/footer');
    }
    //Xóa
    public function deletes()
    {
        $this->check_acl();
        if($this->input->post('checkone') && is_array($this->input->post('checkone')) && count($this->input->post('checkone')) > 0)
        {
            $ids = $this->input->post('checkone');
            foreach($ids as $id)
            {
                $this->delete_once($id);
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete_once($id){
        if (is_numeric($id)) {
            $item=$this->productmodel->getFirstRowWhere('product',array('id'=>$id));

            $pathImage = "upload/img/products/";
            $dir_image = $item->pro_dir;
            /*if(isset($item->image)&&file_exists($item->image)) {unlink($item->image);}*/
            if(file_exists($pathImage.$dir_image.'/'.$item->image))
            {
                @unlink($pathImage.$dir_image.'/'.$item->image);
            }
            for($j = 1; $j <= 3; $j++)
            {
                if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$item->image))
                {
                    @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$item->image);
                }
            }
            $this->productmodel->Delete('product', $id);

            $item_alias =$this->productmodel->getFirstRowWhere('alias',array('pro'=>$id));
            if(!empty($item_alias)){
                $this->productmodel->Delete_where('alias',array('pro' => $id));
            }
            $this->productmodel->Delete_where('product_to_category',array('id_product'=>$id));

        } else return false;
    }
    public function delete($id)
    {
        $this->check_acl();
        if (is_numeric($id)) {
            $item=$this->productmodel->getFirstRowWhere('product',array('id'=>$id));

            $pathImage = "upload/img/products/";
            $dir_image = $item->pro_dir;
            /*if(isset($item->image)&&file_exists($item->image)) {unlink($item->image);}*/
            if(file_exists($pathImage.$dir_image.'/'.$item->image))
            {
                @unlink($pathImage.$dir_image.'/'.$item->image);
            }
            for($j = 1; $j <= 3; $j++)
            {
                if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$item->image))
                {
                    @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$item->image);
                }
            }
            $this->productmodel->Delete('product', $id);

            $item_alias =$this->productmodel->getFirstRowWhere('alias',array('pro'=>$id));
            if(!empty($item_alias)){
                $this->productmodel->Delete_where('alias',array('pro' => $id));
            }

            $this->productmodel->Delete_where('product_to_category',array('id_product'=>$id));
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }

    //product categories
    public function categories()
    {
        $this->check_acl();
        $data['cate'] = $this->productmodel->get_data('product_category',array(
            'lang' => $this->language
        ),array('sort'=>''));

        $data['headerTitle'] = 'Danh mục sản phẩm';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/list_cate', $data);
        $this->load->view('admin/footer');
    }


    public function cat_add()
    {
        $this->check_acl();
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
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->productmodel->SelectMax('product_category','sort')+1;

        if (isset($_POST['addcate'])) {
            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            if($this->input->post('alias') !='')
            {
                $alias = $this->input->post('alias');
            }else{
                $alias = make_alias($title);
            }
            $cate = array(
                'name' => $title,
                'description' => $description,
                'parent_id' => $parent,
                'alias' => $alias,
                'home' => $this->input->post('home'),
                'hot' => $this->input->post('hot'),
                'focus' => $this->input->post('focus'),
                'coupon' => $this->input->post('coupon'),
                'sort' => $this->input->post('sort'),
                'title_seo' => $this->input->post('title_seo'),
                'keyword_seo' => $this->input->post('keyword'),
                'description_seo' => $this->input->post('description_seo'),
                'lang'            => $this->language,
            );

            $id = $this->productmodel->Add('product_category', $cate);
            if($id){
                $this->productmodel->Add('alias', array(
                    'alias' => $alias,
                    'pro_cat' => $id,
                    'type'  => 'cate-pro'
                ));
            }
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->productmodel->Update_where('product_category',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/product/categories'));
        }

        $data['cate'] = $this->productmodel->get_data('product_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $data['headerTitle'] = $data['btn_name']." danh mục file";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/cat_add', $data);
        $this->load->view('admin/footer');
    }

    public function cat_edit($id){
        $this->check_acl();
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
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);
        $id_edit = (int)$id;
        $data['edit']=$this->productmodel->getFirstRowWhere('product_category',array('id'=>$id_edit));
        if (isset($_POST['editcate'])) {

            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            if($this->input->post('alias') !='')
            {
                $alias = $this->input->post('alias');
            }else{
                $alias = make_alias($title);
            }
            $cate = array(
                'name' => $title,
                'description' => $description,
                'parent_id' => $parent,
                'alias' => $alias,
                'home' => $this->input->post('home'),
                'hot' => $this->input->post('hot'),
                'focus' => $this->input->post('focus'),
                'coupon' => $this->input->post('coupon'),
                'sort' => $this->input->post('sort'),
                'title_seo' => $this->input->post('title_seo'),
                'keyword_seo' => $this->input->post('keyword'),
                'description_seo' => $this->input->post('description_seo'),
                'lang'            => $this->language,
            );

            $this->productmodel->Update_where('product_category',array('id'=>$id_edit),$cate);

            $checkAlias = $this->productmodel->getFirstRowWhere('alias',array(
                'pro_cat'=> $id_edit
            ));
            if(empty($checkAlias)){
                $this->productmodel->Add('alias',array(
                    'alias' => make_alias($this->input->post('alias')),
                    'pro_cat' => $id_edit,
                    'type' => 'cate-pro',
                ));
            }else{
                $this->productmodel->Update_where('alias',array('pro_cat'=>$id_edit),array(
                    'alias' => $this->input->post('alias')
                ));
            }
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->productmodel->Update_where('product_category',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/product/categories'));
        }
        $data['cate'] = $this->productmodel->get_data('product_category',array(
            'lang' => $this->language
        ),array('sort'=>''));
        $data['btn_name']='Cập nhật';
        $data['max_sort']=@$data['edit']->sort;
        $data['headerTitle'] = $data['btn_name']." danh mục file";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/cat_edit', $data);
        $this->load->view('admin/footer');
    }
    public function cat_deletes(){
        $this->check_acl();
        $ids = $this->input->post('checkone');
        foreach($ids as $id)
        {
            $this->del_cat_once($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function del_cat_once($id){
        $this->productmodel->DeleteCategory($id);
    }
    public function deletecategory($id)
    {
        $this->check_acl();
        if (is_numeric($id)&&$id>1) {
            $cat=$this->productmodel->get_data('product_category',array('id'=>$id),array(),true);
            if($cat){
                if(file_exists($cat->image)) {unlink($cat->image);}
                $this->productmodel->Delete_Where('product_category', array('id'=>$id));
                $this->productmodel->Delete_Where('product_category', array('parent_id'=>$id));
            }
            $item_alias =$this->productmodel->getFirstRowWhere('alias',array('pro_cat'=>$id));
            if(!empty($item_alias)){
                $this->productmodel->Delete_where('alias',array('pro_cat' => $id));
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function deletehangsx($id)
    {
        $this->check_acl();
        if (is_numeric($id)) {
            $this->productmodel->Delete('product_hangsx', $id);
            $this->productmodel->Delete_Where('product_hangsx', array('parent_id'=>$id));
            $item_alias =$this->productmodel->getFirstRowWhere('alias',array('hangsx'=>$id));
            if(!empty($item_alias)){
                $this->productmodel->Delete_where('alias',array('hangsx' => $id));
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    //Them anh cho san pham===========================

    public function images($id)
    {
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';

        $this->load->library('upload', $config);

        $pro=$this->productmodel->getFirstRowWhere('product',array('id'=>$id));
        $data['product_name'] = $pro->name;

        if(isset($_POST['Upload'])){

            $db_data = array(
                'link' => '',
                'title' => $this->input->post('title'),
                'id_item' => $id
            );
            if(isset($_POST['edit'])&&$_POST['edit']!=null){
                $this->productmodel->Update_where('images',array('id'=>$_POST['edit']),array('title' => $this->input->post('title'),));
                $id_img=$_POST['edit'];
            }else{
                $id_img=$this->productmodel->Add('images',$db_data);
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
                            $link = 'upload/img/' . $data['file_name'];

                            $id_i = $this->productmodel->Update_where('images',array('id'=>$id_img),array('link' => $link,));

                        }
                    }
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['pro_image'] = $this->productmodel->getProImage($id);
        //echo "<pre>";print_r($data['pro_image']);die();
        $data['id'] = $id;

        $data['headerTitle'] = "Sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_images', $data);
        $this->load->view('admin/footer');
    }
    public function deleteImgPro()
    {

        $img = trim($this->input->get('img'));
        $idPro = $this->input->get('id');
        $pro = $this->productmodel->getFirstRowWhere('product',array('id'=>$idPro));
        $pathImage = "upload/img/products/";
        $dir_image = $pro->img_dir;
        $images = explode(',',$pro->multi_image);
        $newImg = array();
        foreach($images as $image){
            if($image == $img){
                if(file_exists($pathImage.$dir_image.'/'.$img))
                {
                    @unlink($pathImage.$dir_image.'/'.$img);
                }
                for($j = 1; $j <= 3; $j++)
                {
                    if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$img))
                    {
                        @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$img);
                    }
                }
            }else{
                $newImg[] = $image;
            }
        }
        $proImg = implode(',',$newImg);
        $this->productmodel->Update('product', $idPro, array('multi_image'=>$proImg));
        redirect($_SERVER['HTTP_REFERER']);
        //echo "<pre>";var_dump($img);die();
    }




    /*public function images($id)
    {
        $this->check_acl();
        $this->load->helper('thumbnail_helper');

        $pro = $this->productmodel->getFirstRowWhere('product',array('id'=>$id));
        //$data['product_name'] = $pro->name;

        if(isset($_POST['Upload'])){
            if(isset($_POST['edit'])&&$_POST['edit']!=null){
                //$this->productmodel->Update_where('file',array('id'=>$_POST['edit']),array('tenfile' => $this->input->post('title'),));
                $this->load->library('upload');
                $pathImage = "upload/img/products/";
                #Create folder
                $dir_image = date('dmY');
                if(!is_dir($pathImage.$dir_image))
                {
                    @mkdir($pathImage.$dir_image);
                    $this->load->helper('file');
                    @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
                }
                //$dir_image = $data['edit']->pro_dir;
                if($dir_image == 'default')
                {
                    $dir_image = date('dmY');
                }
                $image = explode(',',$pro->multi_image);
                if(!is_dir($pathImage.$dir_image))
                {
                    @mkdir($pathImage.$dir_image);
                    $this->load->helper('file');
                    @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
                }
                $config['upload_path'] = $pathImage.$dir_image.'/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                $imageArray = '';
                if($this->upload->do_upload('userfile'))
                {
                    $uploadData = $this->upload->data();
                    if($uploadData['is_image'] == TRUE)
                    {
                        $imageArray = $uploadData['file_name'];
                    }
                    elseif(file_exists($pathImage.$dir_image.'/'.$uploadData['file_name']))
                    {
                        @unlink($pathImage.$dir_image.'/'.$uploadData['file_name']);
                    }
                    unset($uploadData);
                }
                if(isset($imageArray))
                {
                    if(file_exists($pathImage.$dir_image.'/'.$image))
                    {
                        @unlink($pathImage.$dir_image.'/'.$image);
                    }
                    for($j = 1; $j <= 3; $j++)
                    {
                        if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image))
                        {
                            @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image);
                        }
                    }
                    $this->load->library('image_lib');
                    if(file_exists($pathImage.$dir_image.'/'.$imageArray))
                    {
                        for($j = 1; $j <= 3; $j++)
                        {
                            switch($j)
                            {
                                case 1:
                                    $maxWidth = 120;#px
                                    $maxHeight = 120;#px
                                    break;
                                case 3:
                                    $maxWidth = 220;#px
                                    $maxHeight = 250;#px
                                    break;
                                default:
                                    $maxWidth = 125;#px
                                    $maxHeight = 90;#px
                            }
                            $sizeImage = size_thumbnail($pathImage.$dir_image.'/'.$imageArray, $maxWidth, $maxHeight);
                            $configImage['source_image'] = $pathImage.$dir_image.'/'.$imageArray;
                            $configImage['new_image'] = $pathImage.$dir_image.'/thumbnail_'.$j.'_'.$imageArray;
                            $configImage['maintain_ratio'] = TRUE;
                            $configImage['width'] = $sizeImage['width'];
                            $configImage['height'] = $sizeImage['height'];
                            $this->image_lib->initialize($configImage);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                    }
                    #END Create thumbnail
                }
                if($imageArray == 'none.gif')
                {
                    #Remove dir
                    $this->load->library('file');
                    if(trim($dir_image) != '' && trim($dir_image) != 'default' && is_dir('upload/img/product/'.$dir_image) && count($this->file->load('upload/img/product/'.$dir_image,'index.html')) == 0)
                    {
                        if(file_exists('upload/img/product/'.$dir_image.'/index.html'))
                        {
                            @unlink('upload/img/product/'.$dir_image.'/index.html');
                        }
                        @rmdir('upload/img/product/'.$dir_image);
                    }
                    $dir_image = 'default';
                }
            }else{
                //$id_img=$this->productmodel->Add('file',$db_data);
                #BEGIN: Upload image
                $this->load->library('upload');
                $pathImage = "upload/img/products/";
                #Create folder
                $dir_image = date('dmY');
                $image = 'none.gif';
                if(!is_dir($pathImage.$dir_image))
                {
                    @mkdir($pathImage.$dir_image);
                    $this->load->helper('file');
                    @write_file($pathImage.$dir_image.'/index.html', '<p>Directory access is forbidden.</p>');
                }
                //$config['upload_path'] = './upload/img/products/';
                $config['upload_path'] = $pathImage.$dir_image.'/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
                $config['max_size'] = '5000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                //$imageArray = array();
                if($this->upload->do_upload('userfile'))
                {
                    $uploadData = $this->upload->data();
                    if($uploadData['is_image'] == TRUE)
                    {
                        $image = $uploadData['file_name'];
                    }
                    elseif(file_exists($pathImage.$dir_image.'/'.$uploadData['file_name']))
                    {
                        @unlink($pathImage.$dir_image.'/'.$uploadData['file_name']);
                    }
                    unset($uploadData);
                }
                if(isset($image))
                {
                    #BEGIN: Create thumbnail
                    $this->load->library('image_lib');
                    if(file_exists($pathImage.$dir_image.'/'.$image))
                    {
                        for($j = 1; $j <= 3; $j++)
                        {
                            switch($j)
                            {
                                case 1:
                                    $maxWidth = 300;#px
                                    $maxHeight = 300;#px
                                    break;
                                case 3:
                                    $maxWidth = 63;#px
                                    $maxHeight = 63;#px
                                    break;
                                default:
                                    $maxWidth = 600;#px
                                    $maxHeight = 600;#px
                            }
                            $sizeImage = size_thumbnail($pathImage.$dir_image.'/'.$image, $maxWidth, $maxHeight);
                            $configImage['source_image'] = $pathImage.$dir_image.'/'.$image;
                            $configImage['new_image'] = $pathImage.$dir_image.'/thumbnail_'.$j.'_'.$image;
                            $configImage['maintain_ratio'] = TRUE;
                            $configImage['width'] = $sizeImage['width'];
                            $configImage['height'] = $sizeImage['height'];
                            $this->image_lib->initialize($configImage);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                    }
                    #END Create thumbnail
                }
                if($image == 'none.gif')
                {
                    #Remove dir
                    $this->load->library('file');
                    if(trim($dir_image) != '' && trim($dir_image) != 'default' && is_dir('upload/img/product/'.$dir_image) && count($this->file->load('upload/img/product/'.$dir_image,'index.html')) == 0)
                    {
                        if(file_exists('upload/img/product/'.$dir_image.'/index.html'))
                        {
                            @unlink('upload/img/product/'.$dir_image.'/index.html');
                        }
                        @rmdir('upload/img/product/'.$dir_image);
                    }
                    $dir_image = 'default';
                }
                if($pro->multi_image !=''){
                    $temp_img = $pro->multi_image . ',' . $image;
                }
                else{
                    $temp_img = $image;
                }
                //var_dump($image);die();
                $this->productmodel->Update('product',$id,array(
                    'multi_image' => $temp_img,
                    'img_dir' => $dir_image
                ));
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $arrImages = array();
        if($pro->multi_image !='')
        {
            $arrImages = explode(',',$pro->multi_image);
        }
        //echo "<pre>";var_dump($arrImages);die();
        $data['pro_image'] = $arrImages;
        $data['id'] = $id;
        $data['link'] = 'upload/img/products/'.$pro->img_dir.'/';

        $data['headerTitle'] = "Sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_images', $data);
        $this->load->view('admin/footer');
    }
    public function deleteImgPro()
    {

        $img = trim($this->input->get('img'));
        $idPro = $this->input->get('id');
        $pro = $this->productmodel->getFirstRowWhere('product',array('id'=>$idPro));
        $pathImage = "upload/img/products/";
        $dir_image = $pro->img_dir;
        $images = explode(',',$pro->multi_image);
        $newImg = array();
        foreach($images as $image){
            if($image == $img){
                if(file_exists($pathImage.$dir_image.'/'.$img))
                {
                    @unlink($pathImage.$dir_image.'/'.$img);
                }
                for($j = 1; $j <= 3; $j++)
                {
                    if(file_exists($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$img))
                    {
                        @unlink($pathImage.$dir_image.'/thumbnail_'.$j.'_'.$img);
                    }
                }
            }else{
                $newImg[] = $image;
            }
        }
        $proImg = implode(',',$newImg);
        $this->productmodel->Update('product', $idPro, array('multi_image'=>$proImg));
        redirect($_SERVER['HTTP_REFERER']);
        //echo "<pre>";var_dump($img);die();
    }*/
    public function get_product_data(){
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $item = $this->productmodel->get_data('product',array('id'=>$id),array(),true);
            echo json_encode($item);
        }
    }

    public function update_counter(){
        if ($this->input->post('counter')) {
            $id=$this->input->post('id');

            $item = $this->productmodel->get_data('product',array('id'=>$id),array(),true);
            $counter=(int)$item->counter+(int)$this->input->post('counter');
            $first_quantity=(int)$item->first_quantity+(int)$this->input->post('counter');
            $rs= $this->productmodel->Update_where('product',array('id'=>$id),array('counter'=>$counter,'first_quantity'=>$first_quantity));

            $transaction=array(
                'product_id'=>$id,
                'time'=>time(),
                'counter'=>$this->input->post('counter'),
                'type'=>1, //type=1: nhap hang type=2: ban hang
            );
            $this->productmodel->Add('product_transaction', $transaction);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    //ajax
    public function popupdata()
    {
        if (isset($_POST['id'])) {
            $item        = $this->productmodel->getFirstRowWhere('images', array('id' => $_POST['id']));
            $arr         = (array)$item;
        }
        echo json_encode(@$arr);

    }  //ajax
    public function update_view()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $view=$this->input->post('view');

            $item        = $this->productmodel->getFirstRowWhere('product', array('id' => $id));

            if($item->$view==0){
                $this->productmodel->Update_where('product',array('id'=>$id),array($view=>1,));
            }
            if($item->$view==1){
                $this->productmodel->Update_where('product',array('id'=>$id),array($view=>0,));
            }
        }
    }
     //ajax
    public function update_cat_view()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $view=$this->input->post('view');

            $item        = $this->productmodel->getFirstRowWhere('product_category', array('id' => $id));

            if($item->$view==0){
                $this->productmodel->Update_where('product_category',array('id'=>$id),array($view=>1,));
            }
            if($item->$view==1){
                $this->productmodel->Update_where('product_category',array('id'=>$id),array($view=>0,));
            }
        }
    }

    public function getrow(){
        if ($this->input->post('id')) {
            $id=$this->input->post('id');

            $item        = $this->productmodel->getFirstRowWhere('product', array('id' => $id));
            echo json_encode($item);
        }
    }
    //ajax
    public function cat_sort()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $sort=$this->input->post('sort');

            $item        = $this->productmodel->get_data('product_category', array('id' => $id),array(),true);

            if($item){
                $this->productmodel->Update_where('product_category',array('id'=>$id),array('sort'=>$sort,));
            }
        }
    }



    public function lookup()
    { // process posted form data

        $keyword          = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query            = $this->productmodel->lookup($keyword); //Search DB
        if (!empty($query)) {
            $data['response'] = 'true'; //Set response
            $data['message']  = array(); //Create array
            foreach ($query as $row) {
                $data['message'][] = array(
                    'id'    => $row->id,
                    'value' => $row->name,
                    'tenhang' => $row->name); //Add a row to array
            }
        }
        if ('IS_AJAX') {
            echo json_encode($data); //echo json string if ajax request
        }
    }

    public function configCard($id = null)
    {
        $this->load->helper('ckeditor_helper');
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
        $row=$this->productmodel->getFirstRow('card');
        if($this->input->post()){
            $arr=array(
                'card20'            => $this->input->post('card20'),
                'card50'            => $this->input->post('card50'),
                'card100'            => $this->input->post('card100'),
                'card200'            => $this->input->post('card200'),
                'content'           => $this->input->post('content')
            );
            if($row == null)
            {
                $rs=$this->productmodel->Add('card',$arr);
            }
            else{
                $rs=$this->productmodel->Update_where('card',array('id'=> $row->id,),$arr);
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['row']=$row;
        $data['headerTitle'] = 'Cấu hình thẻ cào';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/config_card', $data);
        $this->load->view('admin/footer');
    }
    public function checkCatAlias()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $item = $this->productmodel->getFirstRowWhere('product_category',array(
            'alias' => $alias
        ));
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;

       echo json_encode($data);
    }
    public function checkCatAliasEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('product_category',array(
            'alias' => $alias,
            'id !=' => $id
        ));
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    //code sale
    public function listCodeSale()
    {
        $data = array();
        $config['base_url'] = base_url('adminvn/list-code-sale');
        $config['total_rows'] = $this->productmodel->count_All('code_sale'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data['code'] = $this->productmodel->listAll('code_sale',$config['per_page'], $this->uri->segment(3));
        $data['headerTitle']="Danh sách mã giảm giá";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/products/code_sale_list',$data);
        $this->load->view('admin/footer');
    }
    public function addCodeSale($id_edit = null)
    {
        $data = array();
        if($id_edit!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('code_sale',array('id'=>$id_edit));
            $data['btn_name']='Cập nhật';
            //$data['max_sort'] =$data['edit']->sort;
            //            $data['max_sort']=$data['edit']->sort;
        }

        if (isset($_POST['addshipping'])) {

            $name = $this->input->post('name');
            $code = $this->input->post('code');
            $price = $this->input->post('price');
            $cate = array(
                'name' => $name,
                'price' => $price,
                'code' => $code,
            );

            if(!empty($_POST['edit'])){
                //edit product category

                $id = $this->productmodel->Update_where('code_sale',array('id'=>$id_edit),$cate);
            }else{
                //add product category
                $id = $this->productmodel->Add('code_sale', $cate);
            }
            redirect(base_url('adminvn/list-code-sale'));
        }
        $this->load->view('admin/header',$data);
        $this->load->view('admin/products/code_sale_add',$data);
        $this->load->view('admin/footer');
    }
    public function deleteCodeSale($id = null)
    {
        $this->productmodel->Delete('code_sale',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function price()
    {
        $data = array();
        $id = $_POST['id'];
        $item = $this->productmodel->Get_where('pro_price',array(
            'item_id' => $id
        ));

        /*$jd=date("Y-m-d H:i:s");
        $day=jddayofweek($jd,0);*/
        /*switch($day)
        {
            case 0:
                $thu="Chủ Nhật";
            break;
                        case 1:
                            $thu="Thứ Hai";
            break;
                        case 2:
                            $thu="Thứ Ba";
            break;
                        case 3:
                            $thu="Thứ Tư";
            break;
                        case 4:
                            $thu="Thứ Năm";
            break;
                        case 5:
                            $thu="Thứ Sáu";
            break;
                        case 6:
                            $thu="Thứ 7";
            break;
        }*/
        /*$data['thus'] = $thu;*/
        //var_dump($item);die();
        $data['item'] = $item;
        $data['id'] = $id;
        $this->load->view('admin/modal/modal_price',$data);
    }

    /*-----------------------Hang sản xuât ------------------*/
    public function hangsxList()
    {
        $data['cate'] = $this->productmodel->GetData('product_hangsx',null,array('sort','esc'));

        $data['headerTitle'] = 'Danh sách hãng SX';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/product_hangsx_list', $data);
        $this->load->view('admin/footer');
    }
    public function addprohangsx($id_edit=null)
    {
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
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->productmodel->SelectMax('product_hangsx','sort')+1;

        if($id_edit!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('product_hangsx',array('id'=>$id_edit));
            $data['btn_name']='Cập nhật';
//            $data['max_sort']=$data['edit']->sort;
        }

        if (isset($_POST['addcate'])) {

            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            if($this->input->post('alias') !='')
            {
                $alias = $this->input->post('alias');
            }else{
                $alias = make_alias($title);
            }

            $cate = array('name' => $title,
                'description' => $description,
                'parent_id' => $parent,
                'alias' => $alias,
                'home' => $this->input->post('home'),
                'hot' => $this->input->post('hot'),
                'focus' => $this->input->post('focus'),
                'sort' => $this->input->post('sort'),
                'lang' => $this->language
            );

            $id = $this->productmodel->Add('product_hangsx', $cate);
            if($id){
                $this->productmodel->Add('alias', array(
                    'alias' => $alias,
                    'hangsx' => $id,
                    'type'  => 'hangsx'
                ));
            }

            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->productmodel->Update_where('product_hangsx',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/product/hangsxList'));
        }
        $data['cate'] = $this->productmodel->getList('product_hangsx');

        $data['headerTitle'] = "Thêm danh hãng sản xuất";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/product_hangsx_add', $data);
        $this->load->view('admin/footer');
    }
    public function editprohangsx($id=null)
    {
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
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->productmodel->SelectMax('product_hangsx','sort')+1;

        if($id!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('product_hangsx',array('id'=>$id));
            $data['btn_name']='Cập nhật';
//            $data['max_sort']=$data['edit']->sort;
        }

        if (isset($_POST['edit_hsx'])){

            $title = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $alias = make_alias($title);

            $cate = array('name' => $title,
                'description' => $description,
                'parent_id' => $parent,
                'alias' => $alias,
                'home' => $this->input->post('home'),
                'hot' => $this->input->post('hot'),
                'focus' => $this->input->post('focus'),
                'sort' => $this->input->post('sort'),
            );

            $this->productmodel->Update_where('product_hangsx',array('id'=>$id),$cate);

            $checkAlias = $this->productmodel->getFirstRowWhere('alias',array(
                'hangsx'=> $id
            ));
            if(empty($checkAlias)){
                $this->productmodel->Add('alias',array(
                    'alias' => make_alias($this->input->post('alias')),
                    'hangsx' => $id,
                    'type' => 'hangsx',
                ));
            }else{
                $this->productmodel->Update_where('alias',array('hangsx'=>$id),array(
                    'alias' => $this->input->post('alias')
                ));
            }
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->productmodel->Update_where('product_hangsx',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/product/hangsxList'));
        }
        $data['cate'] = $this->productmodel->getList('product_hangsx');

        $data['headerTitle'] = "Thêm danh hãng sản xuất";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/products/product_hangsx_edit', $data);
        $this->load->view('admin/footer');
    }
    /*********************Shipping*******************/
    public function listShipping()
    {
        $data = array();
        $config['base_url'] = base_url('adminvn/list-shipping');
        $config['total_rows'] = $this->productmodel->count_All('shipping'); // xác định tổng số record
        $config['per_page'] = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data['shipping'] = $this->productmodel->listAll('shipping',$config['per_page'], $this->uri->segment(3));
        $data['headerTitle']="Danh sách trang tĩnh";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/shipping/shipping_list',$data);
        $this->load->view('admin/footer');
    }
    public function addShipping($id_edit = null)
    {
        $data['headerTitle']="shipping info";

        if($id_edit!=null){
            $data['edit']=$this->productmodel->getFirstRowWhere('shipping',array('id'=>$id_edit));
            $data['btn_name']='Cập nhật';
            $data['max_sort'] =$data['edit']->sort;
            //            $data['max_sort']=$data['edit']->sort;
        }
        else{
            $data['max_sort']=$this->productmodel->SelectMax('shipping','sort')+1;
        }

        if (isset($_POST['addshipping'])) {

            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $sort = $this->input->post('sort');
            $cate = array(
                'name' => $name,
                'price' => $price,
                'sort'  => $sort
            );

            if(!empty($_POST['edit'])){
                //edit product category

                $id = $this->productmodel->Update_where('shipping',array('id'=>$id_edit),$cate);
            }else{
                //add product category
                $id = $this->productmodel->Add('shipping', $cate);
            }
            redirect(base_url('adminvn/list-shipping'));
        }
        $this->load->view('admin/header',$data);
        $this->load->view('admin/shipping/shipping_add',$data);
        $this->load->view('admin/footer');
    }
    public function deleteShipping($id)
    {
        $this->productmodel->Delete('shipping',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }
}