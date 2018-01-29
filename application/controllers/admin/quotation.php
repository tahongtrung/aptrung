<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation extends MY_Controller
{
    protected $module_name="Quotation";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('quotationmodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
//        $this->Check_module($this->module_name);
    }

   public function index()
    {

        $config['base_url'] = base_url('adminvn/ds-bao-gia');
        $config['total_rows'] = $this->quotationmodel->count_All('quotation'); // xác định tổng số record
        $config['per_page'] = 20; // xác định số record ở mỗi trang
        $config['uri_segment'] = 3; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data['list'] = $this->quotationmodel->GetData('quotation',null,null, $config['per_page'], $this->uri->segment(3));


        $data['headerTitle'] = "Báo giá";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_list', $data);
        $this->load->view('admin/footer');
    }

    public function add($id_edit=null)
    {
        $this->load->helper('ckeditor_helper');

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
        if($id_edit!=null){
            $data['edit']=$this->quotationmodel->getFirstRowWhere('quotation',array('id'=>$id_edit));
            $data['btn_name']='Cập nhật';

        }

        $pro = array('name' => $this->input->post('name'),
                     'alias' => make_alias($this->input->post('name')),
                     'item' => $this->input->post('item'),
                     'detail' => $this->input->post('detail'),
                     'price' => str_replace(array(',','.',';'),'',$this->input->post('price')),
                     'home' => $this->input->post('home'),
                     'hot' => $this->input->post('hot'),
                     'title_seo' => $this->input->post('title_seo'),
                     'desc_seo' => $this->input->post('desc_seo'),
                     'keyword_seo' => $this->input->post('keyword_seo'),
        );
        if (isset($_POST['addnews'])) {
            if($_POST['edit']){
                $this->quotationmodel->Update('quotation',$id_edit,$pro);
            }else{
                $id = $this->quotationmodel->Add('quotation', $pro);

            }

            if($id_edit!=null){$id=$id_edit;}else $id=$id;


            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không hợp lệ!';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];
                    $this->quotationmodel->Update('quotation', $id, array('image' => $image,));
                    if(isset($data['edit'])&&file_exists($data['edit']->image)){
                        unlink($data['edit']->image);
                    }
                }
            }
            redirect(base_url('adminvn/ds-bao-gia'));

        }

        $data['headerTitle'] = "Báo giá";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/quotation_add', $data);
        $this->load->view('admin/footer');
    }



    //Xóa
    public function delete($id)
    {
        if (is_numeric($id)) {
            $item=$this->quotationmodel->getFirstRowWhere('quotation',array('id'=>$id));
            if(isset($item->image)&&file_exists($item->image)) {unlink($item->image);}
            $this->quotationmodel->Delete('quotation', $id);
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    ///category
    public function categoryList()
    {
        $data['cate'] = $this->quotationmodel->GetData('product_category',null,array('sort','esc'));

        $data['headerTitle'] = 'Danh mục sản phẩm';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_list', $data);
        $this->load->view('admin/footer');
    }

    public function addprocategory($id_edit=null)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $data['btn_name']='Thêm';
        $data['max_sort']=$this->quotationmodel->SelectMax('product_category','sort')+1;

        if($id_edit!=null){
            $data['edit']=$this->quotationmodel->getFirstRowWhere('product_category',array('id'=>$id_edit));
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

                $id = $this->quotationmodel->Update_where('product_category',array('id'=>$id_edit),$cate);
            }else{
                //add product category
                $id = $this->quotationmodel->Add('product_category', $cate);
            }

            if($id_edit!=null){$id=$id_edit;}else $id=$id;
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $this->quotationmodel->Update_where('product_category',array('id'=>$id),array('image'=>$image));
                }
            }

            redirect(base_url('adminvn/danh-muc-san-pham'));
        }
        $data['cate'] = $this->quotationmodel->getList('product_category');

        $data['headerTitle'] = "Thêm danh mục sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_add', $data);
        $this->load->view('admin/footer');
    }

    public function editcategory($id)
    {
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
        $config['max_size'] = '4000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $this->load->library('upload', $config);

        $item = $this->quotationmodel->getItemByID('product_category', $id);
        if (isset($_POST['editcate_pro'])) {
            $name = $this->input->post('name');
            $parent = $this->input->post('parent');
            $description = $this->input->post('description');
            $alias = make_alias($name);
            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];

                    $cate = array('name' => $name, 'description' => $description, 'parent_id' => $parent, 'image' => $image, 'alias' => $alias);

                    $this->quotationmodel->Update('product_category', $id, $cate);

                    redirect(base_url('adminvn/danh-muc-san-pham'));
                }
            } else {
                $cate = array('name' => $name, 'description' => $description, 'parent_id' => $parent, 'alias' => $alias);

                $this->quotationmodel->Update('product_category', $id, $cate);

                redirect(base_url('adminvn/danh-muc-san-pham'));
            }
        }
        $catelist = $this->quotationmodel->getList('product_category');
        $data['cate'] = $catelist;
        $data['item'] = $item;
        $data['headerTitle'] = "Sửa sản danh mục sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_cate_edit', $data);
        $this->load->view('admin/footer');
    }

    public function deletecategory($id)
    {
        if (is_numeric($id)) {
            $this->quotationmodel->Delete('product_category', $id);
            $this->quotationmodel->Delete_Where('product_category', array('parent_id'=>$id));
            redirect($_SERVER['HTTP_REFERER']);
        } else return false;
    }


    //Them anh cho san pham===========================
    public function productimages($id)
    {
        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '5000';
        $config['max_width'] = '3500';
        $config['max_height'] = '3000';

        $this->load->library('upload', $config);

        $pro=$this->quotationmodel->getFirstRowWhere('product',array('id'=>$id));
        $data['product_name'] = $pro->name;

        if(isset($_POST['Upload'])){

            $db_data = array(
                             'link' => '',
                             'title' => $this->input->post('title'),
                             'id_item' => $id
            );
            if(isset($_POST['edit'])&&$_POST['edit']!=null){
                $this->quotationmodel->Update_where('images',array('id'=>$_POST['edit']),array('title' => $this->input->post('title'),));
                $id_img=$_POST['edit'];
            }else{
                $id_img=$this->quotationmodel->Add('images',$db_data);
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

                            $id_i = $this->quotationmodel->Update_where('images',array('id'=>$id_img),array('link' => $link,));

                        }
                    }
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }



        $data['pro_image'] = $this->quotationmodel->getProImage($id);
        $data['id'] = $id;

        $data['headerTitle'] = "Ảnh sản phẩm";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/product_images', $data);
        $this->load->view('admin/footer');
    }

    //ajax
    public function popupdata()
    {
        if (isset($_POST['id'])) {
            $item        = $this->quotationmodel->getFirstRowWhere('images', array('id' => $_POST['id']));
            $arr         = (array)$item;
        }
        echo json_encode(@$arr);

    }

    //ajax
    public function getdistric()
    {
        if (isset($_POST['id'])) {
            $list        = $this->quotationmodel->Get_where('district', array('provinceid' => $_POST['id']));
            echo json_encode($list);
        }
    }

}