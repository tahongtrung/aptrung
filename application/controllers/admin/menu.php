<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{
    protected $module_name="Menu";
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('menu_model');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);

    }
    protected $module_link = array(
        'news'=>'tin-tuc',
        'products'=>'danh-muc',
        'types' => 'tour-types',
        'page'=>'page',
        'media' => 'travel-style'
    );

    public function menulist()
    {
        $this->check_acl();
        if(!isset($_SESSION['tab_active'])){
            $_SESSION['tab_active']='top';
        }
        $data['menu_top'] = $this->menu_model->GetData('menu',array(
            'position'=>'top',
            'lang' => $this->language
        ),array('sort','esc'));
        $data['menu_left'] = $this->menu_model->GetData('menu',array(
            'position'=>'left',
            'lang' => $this->language
        ),array('sort','esc'));
        $data['menu_right'] = $this->menu_model->GetData('menu',array(
            'position'=>'right',
            'lang' => $this->language),array('sort','esc'));
        $data['menu_bottom'] = $this->menu_model->GetData('menu',array(
            'position'=>'bottom',
            'lang' => $this->language
        ),array('sort','esc'));

        $data['menu_root'] = $this->menu_model->getListRoot();
        $data['menu_chil'] = $this->menu_model->getListChil();

        $data['headerTitle'] = 'Menu';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/menu_list', $data);
        $this->load->view('admin/footer');
    }
    //ajax==========
    public function get_subcat()
    {
        $cat=$this->input->post('name');
        $rs['cat']=$cat;
        $rs['lang']= $this->language;
        echo json_encode($rs);
    }
    public function cate_show($module,$lang,$edit=null){
        $data['edit']=$edit;
        if($module=='0'){
            $data['cate']=array();
        }
        if($module=='products'){
            $data['cate']=$this->menu_model->GetData('product_category',array('lang'=> $this->language),array('id','esc'));
        }
        if($module=='news'){
            $data['cate']=$this->menu_model->GetData('news_category',array('lang'=>$this->language),array('id','esc'));
        }
        if($module=='pages'){
            $data['cate']=$this->menu_model->GetData('staticpage',array('lang'=>$this->language),array('id','esc'));
        }
        if($module=='types'){
            $data['cate']=$this->menu_model->GetData('product_hangsx',array('lang'=>$this->language),array('id','esc'));
        }
        if($module=='media'){
            $data['cate']=$this->menu_model->GetData('media_category',array('lang'=>$this->language),array('id','esc'));
        }
        $this->load->view('admin/show_cate_menuadd', $data);
    }
    //save sort menu
    public function Save_menu(){

        if(isset($_POST['name'])){
            $a=str_replace("\\",'',$_POST['name']);
            $arr=json_decode($a);
            $this->sort_menu($arr);
            echo 1;
        }

    }
    public function sort_menu($arr,$parent=0)
    {
        if ($arr != null) {
            foreach ($arr as $k2 => $v2) {

                $this->menu_model->Update_where('menu', array('id_menu' => $v2->id), array('sort' => $k2,'parent_id' => $parent));
                unset($arr[$k2]);
                isset($v2->id)?$id=$v2->id:$id=0;

                if(isset($v2->children)){
                    $this->sort_menu($v2->children,$id);
                }
            }
        }
    }
    //Add menu====================================================================================
    public function add($id=null)
    {
        $this->check_acl();
        $this->load->helper('model_helper');
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
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        if($id!=null){
            $data['edit'] = $this->menu_model->get_data('menu',array('id_menu'=>$id),array(),true);
            $data['id_edit'] =$id;

            if($data['edit']->url){
                if($data['edit']->module=='news'){
                    $data['cate_edit'] = $this->menu_model->get_data('news_category',array(
                        'lang' => $this->language
                    ));
                }
                if($data['edit']->module=='pages'){
                    $data['cate_edit'] = $this->menu_model->get_data('staticpage',array(
                        'lang' => $this->language
                    ));
                }
                if($data['edit']->module=='products'){
                    $data['cate_edit'] = $this->menu_model->get_data('product_category',array(
                        'lang' => $this->language
                    ));
                }
                if($data['edit']->module=='types'){
                    $data['cate_edit'] = $this->menu_model->get_data('product_hangsx',array(
                        'lang' => $this->language
                    ));
                }
                if($data['edit']->module=='media'){
                    $data['cate_edit'] = $this->menu_model->get_data('media_category',array(
                        'lang' => $this->language
                    ));
                }
            }

        }

        if (isset($_POST['addmenu'])) {

            $title       = $this->input->post('title');
            $parent      = $this->input->post('parent');
            $description = $this->input->post('description');
            $position    = $this->input->post('position');
            $module      = $this->input->post('module');
            $alias       = make_alias($title);
            $link        = $this->input->post('subcat');
            $target        = $this->input->post('target');
            if($this->input->post('url')){
                $url = $this->input->post('url');
            }else {
                $url = $alias;
            }

            if ($_FILES['userfile']['name'] != '') {
                if (!$this->upload->do_upload()) {
                    $data['error'] = 'Ảnh không thỏa mãn';
                } else {
                    $upload = array('upload_data' => $this->upload->data());
                    $image = 'upload/img/' . $upload['upload_data']['file_name'];
                }
            } else { $image=$data['edit']->icon; }

            $arr = array(
                'name'        => $title,
                'description' => $description,
                'parent_id'   => $parent,
                'icon'        => $image,
                'alias'       => $alias,
                'url'         => $url,
                'position'    => $position,
                'target'      => $target,
                'module'      => $module,
                'home'        => $this->input->post('home'),
                'lang'        => $this->language
            );

            if($this->input->post('edit_id')!=0){
                $this->menu_model->Update_where('menu',array('id_menu'=>$id),$arr);
                if ($id) {
                    redirect(base_url('adminvn/menu/menulist'));
                }
            }else{
                $ins = $this->menu_model->Add('menu', $arr);
                if ($ins) {
                    redirect(base_url('adminvn/menu/menulist'));
                }
            }
        }

        if($this->input->get('p')){
            $data['menu'] = $this->menu_model->Get_where('menu',array(
                'position'=>$this->input->get('p'),
                'lang'=>  $this->language
            ));
        }else $data['menu'] = $this->menu_model->Get_where('menu',array('lang'=>1));


        $data['position'] = $this->input->get('p');
        $data['language']    = $this->menu_model->getList('language');
        $data['module_link']    = $this->module_link;
        $data['langguage'] = $this->language;
//        $item = $this->menu_model->getList('menu');
//        $data['item'] = $item;
        $data['headerTitle'] = 'Menu';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/menus/add', $data);
        $this->load->view('admin/footer');
    }

    public function edit($id){
        $this->check_acl();
        $this->add($id);
    }

    //Edit Menu=====================================================================================
    public function editmenu($id){
        $this->check_acl();
        $this->load->helper('model_helper');

        $config['upload_path'] = './upload/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);

        $item1=$this->menu_model->getMenuByID($id);
        if(isset($_POST['editmenu'])){
            $title = $this->input->post('title');
            $parent = $this->input->post('parent');
            $url = $this->input->post('url');
            $position = $this->input->post('position');
            $description = $this->input->post('description');
            $module = $this->input->post('module');
            $alias = make_alias($title);
            $sort = $this->input->post('sort');
            $link=$this->input->post('subcat');

            if($this->input->post('module')){
                if($this->input->post('module')=='news'){
                    $url='tin-tuc/'.$link;
                } else if($this->input->post('module')=='products'){
                    $url ='danh-muc/'.$link;
                } else if($this->input->post('module')=='pages'){
                    $url ='page/'.$link;
                }
            }else{
                $url=$alias;
            }

            if($_FILES['userfile']['name'] != ''){
                if(! $this->upload->do_upload()){
                    $data['error'] = 'Ảnh quá lớn hoặc không đúng định dạng';
                }else{
                    $upload= array('upload_data' => $this->upload->data());
                    $image = 'upload/img/'.$upload['upload_data']['file_name'];

                    $arr = array('name'=>$title,'description'=>$description,'parent_id'=>$parent ,'icon'=>$image,'alias'=>$alias,'position'=>$position, 'url'=>$url,'module'=>$module,'sort'=>$sort);
                    $this->menu_model->UpdateMenu($id,$arr);

                    redirect(base_url('adminvn/menu/menulist'));
                }
            }else{
                $arr = array('name'=>$title,'description'=>$description,'parent_id'=>$parent ,'alias'=>$alias,'url'=>$url,'position'=>$position, 'url'=>$url,'module'=>$module,'sort'=>$sort);

                $this->menu_model->UpdateMenu($id,$arr);

                redirect(base_url('adminvn/menu/menulist'));
            }
        }
        $data['menu_root'] = $this->menu_model->getListRoot();
        $data['menu_chil'] = $this->menu_model->getListChil();
        $data['item1']=$item1;
        $data['headerTitle']='Menu';
        $this->load->view('admin/header',$data);
        $this->load->view('admin/menu_edit',$data);
        $this->load->view('admin/footer');
    }
    //Delete Menu
    public function delete($id){
        $this->menu_model->DeleteMenu($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function active_tab(){
        if($this->input->post('id')){
            $_SESSION['tab_active']=$this->input->post('id');
        }
    }
    //ajax
    public function select_lang($lang_id,$possition)
    {
        $data['menu'] = $this->menu_model->Get_where('menu',array('lang'=>$lang_id,'position'=>$possition));
        $this->load->view('admin/select_parent_menu', $data);
    }

    public function get_iditem(){
        if($this->input->post('module')){
            $module=$this->input->post('module');
            $alias=$this->input->post('alias');
            $data=array();

            if($module=='products'){
                $item=$this->menu_model->get_data('product_category', array('alias' => $alias),array(),true);
                if($item){
                    $data['url'] = $item->alias.'.html';
                    echo json_encode($data);die();
                }
            }
            if($module=='types'){
                $item=$this->menu_model->get_data('product_hangsx', array('alias' => $alias),array(),true);

                if($item){
                    $data['char']='tp';
                    $data['id']=$item->id;
                    echo json_encode($data);die();
                }
            }
            if($module=='media'){

                $item=$this->menu_model->get_data('media_category', array('alias' => $alias),array(),true);

                if($item){
                    $data['url'] = $item->alias.'.html';
                    echo json_encode($data);die();
                }
            }
            if($module=='news'){
                $item=$this->menu_model->get_data('news_category', array('alias' => $alias),array(),true);
                if($item){
                    $data['url'] = $item->alias.'.html';
                    echo json_encode($data);die();
                }
            }
            if($module=='pages'){
                $item=$this->menu_model->get_data('staticpage', array('alias' => $alias),array(),true);
                if($item){
                    $data['url'] = $item->alias.'.html';
                    echo json_encode($data);die();
                }
            }

        }
    }

}