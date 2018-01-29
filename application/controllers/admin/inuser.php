<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class inuser extends MY_Controller
{
    protected $module_name = "inuser";

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('inuser_model');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->datalang  = $this->inuser_model->get_data('language');

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

    public function inuserlist()
    {
        $this->Check_module($this->module_name);
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
            $config['base_url']             = base_url('adminvn/inuser/inuserlist?name='
                . $this->input->get('name')
                . '&cate=' . $this->input->get('cate')
                . '&view=' . $this->input->get('view')
                . '&lang=' . $this->input->get('lang')
            );
            $config['total_rows']           = $this->inuser_model->countsearch_result($where);
            $config['per_page']             = 20;
            $config['uri_segment'] = 4;

            $config=array_merge($config,$this->pagination_config);

            $this->pagination->initialize($config);
            $data['inuserlist'] = $this->inuser_model->getsearch_result($where, $config['per_page'], $this->input->get('per_page'));


        }else{
            $where = array(
                'inuser.lang' => $this->language
            );
            $config['base_url']    = base_url('adminvn/inuser/inuserlist');
            $config['total_rows']  = $this->inuser_model->countByLang($where); // xác định tổng số record
            $config['per_page']    = 20; // xác định số record ở mỗi trang
            $config['uri_segment'] = 4; // xác định segment chứa page number
            $this->pagination->initialize($config);
            $data              = array();
            $data['inuserlist']  = $this->inuser_model->GetNewByLang($where,$config['per_page'],$this->uri->segment(4));
            //echo "<pre>";var_dump($data['inuserlist']);die();
        }


        $data['datalang'] = $this->datalang;

        $data['cate'] = $this->inuser_model->get_data('inuser_category');

        $data['headerTitle'] = "Tin tức";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/inusers/inuser_list', $data);
        $this->load->view('admin/footer');
    }

    //add inuser
    public function add($id=null)
    {
        $this->Check_module($this->module_name);
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
        $config['upload_path']   = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|PNG|JPG|GIF';
        $config['max_size']      = '5000';
        $config['max_width']     = '3000';
        $config['max_height']    = '2000';
        $this->load->library('upload', $config);


        $data['btn_name']='Thêm';
        if($id){
            //get inuser item
            $item=$this->inuser_model->get_data('inuser',array('id'=>$id),array(),true);
            $data['edit']=$item;
            $data['btn_name']='Cập nhật';
            $data['cate_selected']=$this->inuser_model->getField_array('inuser_to_category','id_category',array('id_inuser'=>$id));
        }

        if (isset($_POST['addinuser'])) {
            if($this->input->post('alias') == '')
            {
                $alias = make_alias($this->input->post('title'));
            }else{
                $alias = make_alias($this->input->post('alias'));
            }
            $arr = array(
                'title'           => $this->input->post('title'),
                'alias'           => $alias,
                'description'     => $this->input->post('description'),
                'hot'             => $this->input->post('hot'),
                'home'            => $this->input->post('home'),
                'focus'           => $this->input->post('focus'),
                'content'         => $this->input->post('content'),
                'lang'            => $this->language,
                'tag'             => $this->input->post('tag'),
                'time'            => time(),
                'category_id'     => $this->input->post('category_id'),
                'title_seo'       => $this->input->post('title_seo'),
                'keyword_seo'     => $this->input->post('keyword_seo'),
                'description_seo' => $this->input->post('description_seo'),
            );


            if($this->input->post('edit')){
                //update inuser
                $this->inuser_model->Update_where('inuser', array('id'=>$id),$arr);
            }else{
                //add inuser
                $rs = $this->inuser_model->Add('inuser', $arr);
            }

            isset($rs)?$id=$rs:$id=$id;


            if ($this->input->post('category') && sizeof($this->input->post('category')) > 0) {

                $post_cat = $this->input->post('category');

                $this->inuser_model->Delete_where('inuser_to_category', array('id_inuser' => $id));
                for ($i = 0; $i < sizeof($post_cat); $i++) {
                    $ca = array('id_inuser' => $id, 'id_category' => $post_cat[$i]);
                    $this->inuser_model->Add('inuser_to_category', $ca);
                }
                $this->inuser_model->Update_where('inuser', array('id'=>$id), array('category_id' => end($post_cat)));
            }

            //update inuser image
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                    $this->inuser_model->Update_where('inuser', array('id'=>$id), array('image'=>$image));
                }
            }


            //end
            redirect(base_url('adminvn/inuser/inuserlist'));

        }


//            $data['widget'] = $this->widget();



        $data['datalang'] = $this->datalang;
        $data['cate'] = $this->inuser_model->get_data('inuser_category',array(
            'lang' => $this->language
        ));

        $data['headerTitle'] = "Tin tức";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/inusers/inuser_add', $data);
        $this->load->view('admin/footer');
    }

    public function edit($id){
        $this->add($id);
    }
    public function widget($name = "testwidget"){
        // print_r($data['last9']);
        $data=array();
        if($name == "testwidget"){
            return $this->load->view('admin/testwidget',$data,true);
        }
    }


    public function categories()
    {
        $this->Check_module($this->module_name);
        $data['inuser_cate'] = $this->inuser_model->get_data('inuser_category',array(
            'lang' => $this->language
        ),array('sort'=>''));


        $data['headerTitle'] = 'Tin tức';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/inusers/inuser_cat', $data);
        $this->load->view('admin/footer');
    }




    //Delete inuser
    public function delete($id)
    {
        $this->Check_module($this->module_name);
        $inuser=$this->inuser_model->get_data('inuser',array('id'=>$id),array(),true);
        if(file_exists($inuser->image));
        $this->inuser_model->Delete('inuser', $id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    //Add Category
    public function cat_add($id=null)
    {
        $this->Check_module($this->module_name);
        $this->load->helper('model_helper');
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
        $config['upload_path']   = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '2000';
        $config['max_width']     = '1500';
        $config['max_height']    = '1000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        if($id!=null){
            $data['edit']=$this->inuser_model->get_data('inuser_category',array('id'=>$id),array(),true);
            $data['btn_name']='Cập nhật';
        }


        if (isset($_POST['addcate'])) {
            if($this->input->post('alias') == '')
            {
                $alias = make_alias($this->input->post('title'));
            }else{
                $alias = make_alias($this->input->post('alias'));
            }
            $cate    = array(
                'name'        => $this->input->post('name'),
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'parent_id'   => $this->input->post('parent'),
                'home'        => $this->input->post('home'),
                'focus'       => $this->input->post('focus'),
                'hot'         => $this->input->post('hot'),
                'tour'         => $this->input->post('tour'),
                'alias'       => $alias,
                'lang'        => $this->language
            );


            if(!empty($_POST['edit'])){
                //edit inuser category

                $this->inuser_model->Update_where('inuser_category',array('id'=>$id),$cate);
            }else{
                //add inuser category
                $rs = $this->inuser_model->Add('inuser_category', $cate);
            }

            if($id!=null){$id=$id;}else $id=$rs;
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->inuser_model->Update_where('inuser_category',array('id'=>$id),array('icon'=>$image));
                }
            }

            redirect(base_url('adminvn/inuser/categories'));
        }


        $data['category'] = $this->inuser_model->get_data('inuser_category',array(
            'lang' => $this->language
        ),array('sort'=>'s'));

        $data['headerTitle'] = "Tin tức";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/inusers/inuser_cat_add', $data);
        $this->load->view('admin/footer');
    }

    public function cat_edit($id){
        $this->cat_add($id);
    }

    //Delete inuser
    public function deletecategory($id)
    {
        $this->Check_module($this->module_name);
        $this->inuser_model->Delete('inuser_category', $id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    //--------------------Quan ly Tags---------------------------
    public function taglist()
    {
        $this->Check_module($this->module_name);
        if (isset($_POST['addtags'])) {
            if ($this->input->post('hidden-tags') != '') {
                $tag   = $this->input->post('hidden-tags');
                $array = explode(",", $tag);
                foreach ($array as $v) {
                    $alias  = make_alias($v);
                    $tags   = array('tagname' => $v, 'tags_alias' => $alias);
                    $id_tag = $this->inuser_model->Add('tags', $tags);
                }

                if ($id_tag)
                    redirect($_SERVER['HTTP_REFERER']);
            } else $error = "Chưa có tag được thêm";
        }

        $data['error'] = @$error;

        $config['base_url']    = base_url('adminvn/quan-ly-tags');
        $config['total_rows']  = $this->inuser_model->count_All('tags'); // xác định tổng số record
        $config['per_page']    = 10; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data                = array();
        $data['tagslist']    = $this->inuser_model->listAll('tags', $config['per_page'], $this->uri->segment(3));
        $data['headerTitle'] = "Quản lý Tags";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/tags_list', $data);
        $this->load->view('admin/footer');
    }

    public function addtags()
    {
        $this->Check_module($this->module_name);
        if (isset($_POST['addtags'])) {
            if ($this->input->post('hidden-tags') != '') {
                $tag   = $this->input->post('hidden-tags');
                $array = explode(",", $tag);
                foreach ($array as $v) {
                    $alias  = make_alias($v);
                    $tags   = array('tagname' => $v, 'tags_alias' => $alias);
                    $id_tag = $this->inuser_model->Add('tags', $tags);
                }

                if ($id_tag)
                    redirect($_SERVER['HTTP_REFERER']);
            } else $error = "Chưa có tag được thêm";
        }

        $data['error']       = @$error;
        $data['headerTitle'] = "Thêm Tags";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/tags_add', $data);
        $this->load->view('admin/footer');
    }

    public function deletetags($id)
    {
        $this->Check_module($this->module_name);
        $this->inuser_model->Delete('tags', $id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    //ajax
    public function update_view()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $view=$this->input->post('view');

            $item        = $this->inuser_model->getFirstRowWhere('inuser', array('id' => $id));

            if($item->$view==0){
                $this->inuser_model->Update_where('inuser',array('id'=>$id),array($view=>1,));
            }
            if($item->$view==1){
                $this->inuser_model->Update_where('inuser',array('id'=>$id),array($view=>0,));
            }
        }
    }
    //ajax
    public function update_cat_view()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $view=$this->input->post('view');

            $item        = $this->inuser_model->getFirstRowWhere('inuser_category', array('id' => $id));

            if($item->$view==0){
                $this->inuser_model->Update_where('inuser_category',array('id'=>$id),array($view=>1,));
            }
            if($item->$view==1){
                $this->inuser_model->Update_where('inuser_category',array('id'=>$id),array($view=>0,));
            }
        }
    }
    //ajax
    public function cat_sort()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $sort=$this->input->post('sort');

            $item        = $this->inuser_model->get_data('inuser_category', array('id' => $id),array(),true);

            if($item){
                $this->inuser_model->Update_where('inuser_category',array('id'=>$id),array('sort'=>$sort,));
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