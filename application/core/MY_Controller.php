<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class MY_Controller extends CI_Controller
    {
        protected $options = '';
        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->helper('model_helper');
            $this->load->model('f_homemodel');
            $this->load->library('pagination');
            if(!isset($_SESSION))
            {
                session_start();
            }

            //language
            $this->load->helper('language');
            $weblang=array('vi'=>'vietnamese','en'=>'english','ja' => 'japanese');

            if(isset($this->session->userdata['lang'])&&$this->session->userdata['lang']!=null){
                $this->lang->load($this->session->userdata['lang'], $weblang[$this->session->userdata['lang']]);
            }else{
                $this->session->userdata['lang']='vi';
                $this->lang->load($this->session->userdata['lang'], $weblang[$this->session->userdata['lang']]);
            }
            $this->language = $this->session->userdata['lang'];
            //$this->language = 'vi';

            $this->option = $this->f_homemodel->getFirstRowWhere('site_option',array(
                'lang' => $this->language
            ));

            $this->site_name        = @$this->option->site_name;
            $this->site_logo        = @$this->option->site_logo;
            $this->site_keyword     = @$this->option->site_keyword;
            $this->site_description = @$this->option->site_description;
            $this->hotline1         = @$this->option->hotline1;
            $this->hotline2         = @$this->option->hotline2;
            $this->hotline3         = @$this->option->hotline3;
            $this->favicon          = @$this->option->favicon;
            $this->address          = @$this->option->address;
            $this->fanpage          = @$this->option->site_fanpage;
        }
        public function Check_module($module_name)
        {
            if($this->session->userdata['adminid']=='af53b1505489'){
                return true;
            }

            $user_id = $this->session->userdata('adminid');

            if (isset($module_name) && isset($user_id)) {

                $user = $this->f_homemodel->getAdminAcc($user_id);

                if($user->level ==0){

                    $module = $this->f_homemodel->getUserModules($user_id);

                    $arr_module = explode(';', $module->module_name);

                    if(in_array('Full', $arr_module)){
                        return true;
                    } elseif (in_array($module_name, $arr_module)) {
                        return true;
                    } else {

                        die('Tai khoan cua ban khong duoc cap quyen truy cap chuc nang nay!');
//                redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            } else return false;
        }
        public function LoadHeader($view,$seo=array(),$show_slider=false)
        {
            $data             = array();
            $count = 0;
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=array();
            }else{

                foreach ($_SESSION['cart'] as $v) {
                    $count += $v['qty'];
                }
            }
            $data['count']= $count;
            $data['catxs'] = $this->f_homemodel->getCateRoot(array(
                'lang' => $this->language,
                'parent_id' => 0
            ));
            $data['cate_root'] = $this->f_homemodel->getCateRoot(array(
                'lang' => $this->language,
                'parent_id' => 0
            ));

            $data['cate_subs'] = $this->f_homemodel->getCateChild(array(
                'lang' => $this->language,
                'parent_id !=' => 0
            ));

            $data['cat_dichvu'] = $this->f_homemodel->GetData('news_category',array('parent_id'=>0,'home'=>1,'lang'=>$this->language));
            $data['news_home'] = $this->f_homemodel->get_news(array('news.home'=>1,'news.lang'=>$this->language),100,0);
            $data['slides'] = $this->f_homemodel->get_data('images',array('type'=>'slide'));
            
            $data['current_search'] = $this->input->get('cat');
            //echo "<pre>";var_dump($count);die();
            $where = array(
                'position' => 'top',
                'lang' => $this->language
            );
            $data['menu_root'] = $this->f_homemodel->getMenuTopRoot($where);
            $data['menu_sub'] = $this->f_homemodel->getMenu_chil($where);
            $data['menu_sub1'] = $this->f_homemodel->getMenu_chil($where);
            $data['banner_top'] = $this->f_homemodel->GetData('images',array('type'=>'banner'));
            $this->load->library('remenu');
            $menus = $this->f_homemodel->listAllMenu('menu');
            $data['menu'] = $this->remenu->createMenu($menus,0);
            $data['menu_top'] = $this->load->widget('blkmenu');

            if($show_slider==true){
                $data['slider_widget'] = $this->load->widget('slide');
                $data['view_book'] = $this->load->widget('blkbook');
            }else{
                $data['slider_widget']='';
            }
            $data['seo']=$seo;
            if($view == null)
            {
                $this->load->view('headers/header', $data);
            }
            else{
                $this->load->view($view,$data);
            }

        }

        public function LoadRight()
        {
            /*$data = array();
            $data['menus'] = $this->f_homemodel->GetData('menu',array(
                'position' => 'left',
                'lang' => $this->language,
                'parent_id' => 0
            ),array('sort','asc'),null);
            $this->load->view('right', $data);*/
        }

        public function LoadLeft($var = null,$view = null)
        {
            $data = array();
            $data['menus'] = $this->f_homemodel->GetData2('menu',array(
                'position' => 'left',
                'lang' => $this->language,
                'parent_id' => 0
            ),array('sort','asc'),null);
            $this->load->view('left', $data);
        }

        public function LoadFooter($view = null)
        {
            $data = array();
            $data['menu_right'] = $this->f_homemodel->getMenu(array('position'=>'right','lang'=>$this->language));
            $data['menu_rightc'] = $this->f_homemodel->getMenuchild(array('position'=>'right','lang'=>$this->language));
            $data['menu_bot'] = $this->f_homemodel->getMenu(array('position'=>'bottom','lang'=>$this->language));
            $data['menu_botc'] = $this->f_homemodel->getMenuchild(array('position'=>'bottom','lang'=>$this->language));
            $data['partners'] = $this->f_homemodel->get_data('images',array(
                'type' => 'partners'
            ),array('id' => 'asc'));
            $data['doitac'] = $this->f_homemodel->get_data('images',array('type'=>'partners','lang'=>$this->language));
            $this->load->view('footer', $data);
        }
        public function check_acl()
        {

            $this->zend->load('Zend_Acl');

            $module = $this->router->fetch_module();

            $controller = $this->router->fetch_class();

            $action = $this->router->fetch_method();
            $level = $this->session->userdata('level');
            $user_id = $this->session->userdata('adminid');
            //echo "<pre>";var_dump($level);die();
            $this->setRoles();
            $this->setResources();
            $role  = 'guest';
            //        $access=array('products'=>array('index', 'add','edit','list'),'news'=>array('index','add','edit','list'));
            $access_us=$this->f_homemodel->get_data('access',array('user_id'=>$user_id),array(),true);

            @$access=json_decode(@$access_us->access);
            @$access=(array)$access;

            //level=1: admin; level=2: mod
            switch ($level) {
                case '1':
                    $role = 'admin';
                    break;
                case '2':
                    $role = 'mod';
                    break;
            }
            $this->setAccess($role,$access);

            if (!$this->Zend_Acl->isAllowed($role,':' . $controller, $action)) {
                $this->creat_mess('danger','Tài khoản của bạn chưa được cấp quyền sử dụng chức năng này!');
                redirect(base_url('adminvn'));
                die();
            }
        }

        public function setRoles()
        {
            $this->Zend_Acl->addRole(new Zend_Acl_Role('guest'))
                ->addRole(new Zend_Acl_Role('mod'))
                ->addRole(new Zend_Acl_Role('admin'));
        }

        public function setResources()
        {
            $this->Zend_Acl->add(new Zend_Acl_Resource(':admin'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':news'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':product'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':share'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':pages'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':menu'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':quotation'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':raovat'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':users'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':order'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':imageupload'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':contact'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':comment'));
            $this->Zend_Acl->add(new Zend_Acl_Resource(':trademark'));
        }

        public function setAccess($role=null,$access=null){
            if($role!=null&&is_array($access)&&!empty($access)){
                foreach($access as $k=>$v){
                    $this->Zend_Acl->allow($role, ':'.$k,$v);
                }
            }
            $this->Zend_Acl->allow('admin', null);
        }
        public function creat_mess($type='default',$mess=''){
            $this->ci =& get_instance();
            $this->ci->session->set_userdata('alert',array('type'=>$type,'mess'=>'<i class="fa fa-exclamation-circle"></i>  '.$mess));
        }
    }