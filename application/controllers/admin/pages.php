<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller
{
    protected $module_name="Pages";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('staticpagemodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }
    public function pagelist(){
        $this->check_acl();
        $config['base_url'] = base_url('adminvn/pages/pages');
        $config['total_rows'] = $this->staticpagemodel->Count2('staticpage',array(
            'lang' => $this->language
        )); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['pagelist'] = $this->staticpagemodel->GetData('staticpage',array(
                'lang' => $this->language
            ),array('id','desc'),$config['per_page'],$this->uri->segment(4));
        $data['headerTitle']="Pages";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/pages/list',$data);
        $this->load->view('admin/footer');
    }

    public function add($id=null){
        $this->check_acl();
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['description']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'description',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => 'Full',
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
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
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '5000';
        $config['max_width']  = '5000';
        $config['max_height']  = '4000';
        $this->load->library('upload', $config);


        $data['btn_name']='Thêm';
        if($id){
            //get news item
            $item=$this->staticpagemodel->get_data('staticpage',array('id'=>$id),array(),true);
            $data['edit']=$item;
            $data['btn_name']='Cập nhật';
        }

        if (isset($_POST['addnews'])) {
            $alias = make_alias($this->input->post('alias'));
            $arr=array(
                'name'=>$this->input->post('name'),
                'description'=>$this->input->post('description'),
                'alias' => $alias,
                'home'=>$this->input->post('home'),
                'content'=>$this->input->post('content'),
                'title_seo'=>$this->input->post('title_seo'),
                'keyword_seo'=>$this->input->post('keyword_seo'),
                'description_seo'=>$this->input->post('description_seo'),
                'lang'           => $this->language
            );

            $id = $this->staticpagemodel->Add('staticpage', $arr);
            
            $this->staticpagemodel->Add('alias',array(
                'type' => 'page',
                'page' => $id,
                'alias' => $alias,
            ));
            //update news image
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload('userfile')) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                    $this->staticpagemodel->Update_where('staticpage', array('id'=>$id), array('icon'=>$image));
                }
            }

            //end

            redirect(base_url('adminvn/pages/pagelist'));

        }
        $data['headerTitle']="Nội dung";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/pages/add',$data);
        $this->load->view('admin/footer');
    }
    public function edit($id){
        $this->check_acl();
        //$this->add($id);
        $this->load->helper('ckeditor_helper');
        $this->load->helper('model_helper');
        $data['description']        = array(
            //ID of the textarea that will be replaced
            'id'     => 'description',
            'path'   => 'assets/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => 'Full',
                'width'   => "100%", //Setting a custom width
                'height'  => '200px', //Setting a custom height
            ));
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
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '5000';
        $config['max_width']  = '5000';
        $config['max_height']  = '4000';
        $this->load->library('upload', $config);
        if($id){
            //get news item
            $item=$this->staticpagemodel->get_data('staticpage',array('id'=>$id),array(),true);
            $data['edit']=$item;
            $data['btn_name']='Cập nhật';
            if (isset($_POST['addnews'])){
                $alias = make_alias($this->input->post('alias'));
                $arr=array(
                    'name'=>$this->input->post('name'),
                    'alias' => $alias,
                    'description'=>$this->input->post('description'),
                    'home'=>$this->input->post('home'),
                    'content'=>$this->input->post('content'),
                    'title_seo'=>$this->input->post('title_seo'),
                    'keyword_seo'=>$this->input->post('keyword_seo'),
                    'description_seo'=>$this->input->post('description_seo'),
                    'lang'           => $this->language
                );
                $this->staticpagemodel->Update_where('staticpage', array('id'=>$id),$arr);
                $checkAlias = $this->staticpagemodel->getFirstRowWhere('alias',array(
                    'page'  =>  $id
                ));
                if(empty($checkAlias)){
                    $this->staticpagemodel->Add('alias',array(
                        'alias' => make_alias($this->input->post('alias')),
                        'page' => $id,
                        'type' => 'page',
                    ));
                }else{
                    $this->staticpagemodel->Update_where('alias',array('page'=>$id),array(
                        'alias' => $this->input->post('alias')
                    ));
                }
                //update news image
                if ($_FILES['userfile']['name'] != '') {
                    if (!$this->upload->do_upload('userfile')) {
                        $data['error'] = 'Ảnh không hợp lệ!';
                    } else {
                        $upload = array('upload_data' => $this->upload->data());
                        $image  = 'upload/img/' . $upload['upload_data']['file_name'];
                        $this->staticpagemodel->Update_where('staticpage', array('id'=>$id), array('icon'=>$image));
                    }
                }
                redirect(base_url('adminvn/pages/pagelist'));
            }
        }
        $data['headerTitle']="Sửa trang nội dung";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/pages/edit',$data);
        $this->load->view('admin/footer');
    }
    public function deletes(){
        $this->check_acl();
        $ids = $this->input->post('checkone');
        //echo "<pre>";var_dump($ids);die();
        foreach($ids as $id)
        {
            $this->delete_once($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete_once($id)
    {
        $item = $this->staticpagemodel->getFirstRowWhere('staticpage',array(
            'id' => $id
        ));

        $this->staticpagemodel->Delete('staticpage',$id);
        if(file_exists($item->icon)){
            @unlink($item->icon);
        }
        $item_alias =$this->staticpagemodel->getFirstRowWhere('alias',array('page'=>$id));
        if(!empty($item_alias)){
            $this->staticpagemodel->Delete_where('alias',array('page' => $id));
        }
    }
    public function delete($id){
        $this->check_acl();
        $item = $this->staticpagemodel->getFirstRowWhere('staticpage',array(
            'id' => $id
        ));
        $this->staticpagemodel->Delete('staticpage',$id);
        if(file_exists($item->icon)){
            @unlink($item->icon);
        }
        $item_alias =$this->staticpagemodel->getFirstRowWhere('alias',array('page'=>$id));
        if(!empty($item_alias)){
            $this->staticpagemodel->Delete_where('alias',array('page' => $id));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_view()
    {
        if ($this->input->post('id')) {
            $id=$this->input->post('id');
            $view=$this->input->post('view');

            $item        = $this->staticpagemodel->getFirstRowWhere('staticpage', array('id' => $id));

            if($item->$view==0){
                $this->staticpagemodel->Update_where('staticpage',array('id'=>$id),array($view=>1,));
            }
            if($item->$view==1){
                $this->staticpagemodel->Update_where('staticpage',array('id'=>$id),array($view=>0,));
            }
        }
    }
}