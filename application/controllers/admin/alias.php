<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alias extends MY_Controller
{
    protected $module_name="Menu";
    function __construct()
    {
        parent::__construct();
        $this->load->model('productmodel');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }
    public function checkAdd()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias
        ));
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'item_id !=' => $id
        ));
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkNewEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'new !=' => $id
        ));
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkCatNewEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'new_cat !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkProEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'pro !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkCateProEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'pro_cat !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkPageEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'page !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkCatMediaEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'm_cat !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkMediaEdit()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'media !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
    public function checkHangsx()
    {
        $data = array();
        $check = false;
        $alias = $_POST['alias'];
        $id = $_POST['id'];
        $item = $this->productmodel->getFirstRowWhere('alias',array(
            'alias' => $alias,
            'hangsx !=' => $id
        ));
        //var_dump($item);die();
        if(empty($item)){
            $check = true;
        }
        $data['check'] = $check;
        echo json_encode($data);
    }
}
