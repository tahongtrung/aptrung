<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Raovat extends MY_Controller
{
    protected $module_name="Raovat";
    public function __construct() {
        parent::__construct();
        $this->load->model('raovat_model');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }

    public function raovat_list(){
        $config['base_url'] = base_url('adminvn/raovat/raovat_list');
        $config['total_rows'] = $this->raovat_model->count_All('user_post'); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data = array();
        $data['userslist'] = $this->raovat_model->User_post($config['per_page'], $this->uri->segment(4));

        $data['headerTitle']="Rao vặt";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/raovat_list',$data);
        $this->load->view('admin/footer');
    }
    ///category
    public function cat_raovat()
    {
        $data['cate'] = $this->raovat_model->GetData('post_cate',null,array('sort','esc'));
        $data['headerTitle'] = "Rao vặt";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/post_cate_list', $data);
        $this->load->view('admin/footer');
    }

    public function cat_raovat_add($id_edit=null)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->raovat_model->SelectMax('post_cate','sort')+1;

        if($id_edit!=null){
            $data['edit']=$this->raovat_model->getFirstRowWhere('post_cate',array('id'=>$id_edit));
            $data['btn_name']='Cập nhật';
            $data['max_sort']=$data['edit']->sort;
        }

        if (isset($_POST['addcate'])) {

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

            if(!empty($_POST['edit'])){
                //edit product category

                $id = $this->raovat_model->Update_where('post_cate',array('id'=>$id_edit),$cate);
            }else{
                //add product category
                $id = $this->raovat_model->Add('post_cate', $cate);
            }

            if($id_edit!=null){$id=$id_edit;}else $id=$id;
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->raovat_model->Update_where('post_cate',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/raovat/cat_raovat'));
        }
        $data['cate'] = $this->raovat_model->getList('post_cate');

        $data['headerTitle'] = "Rao vặt";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/post_cate_add', $data);
        $this->load->view('admin/footer');
    }
    public function cat_raovat_edit($id){
        $this->cat_raovat_add($id);
    }

    public function cat_raovat_delete($id)
    {
        if (is_numeric($id)) {
            $this->raovat_model->Delete('post_cate', $id);
            $this->raovat_model->Delete_Where('post_cate', array('parent_id'=>$id));
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    //Delete rao vat
    public function delete($id){
        $this->raovat_model->Delete('user_post',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function active_item(){
        //$this->auth->check();
        $u=$this->raovat_model->getFirstRowWhere('user_post',array('id'=>$_POST['id']));

        if($u->view==1){
            $this->raovat_model->Update_where('user_post', array('id' => $_POST['id']), array('view'=>0));

        }else if($u->view==0){
            $this->raovat_model->Update_where('user_post', array('id' => $_POST['id']), array('view'=>1));
        }
        echo 1;
    }
}