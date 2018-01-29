<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('f_profiler');
    }
    public function index()
    {
        echo "Ok";
    }
    public function changProfiler()
    {
        $data = array();
        if($this->session->userdata('userid')){
            @$u=$this->f_homemodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['user_item'] = $u;
        }
        //echo "<pre>";var_dump($data['user_item']);die();

        $title=@$data['pro_first']->name;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader(null,$title,$keyword,$description,true);
        $this->LoadLeft();
        $this->load->view('change_profiler',$data);
        $this->LoadFooter();
    }
    public function profileone(){
        $data=array();
        if($this->session->userdata('userid')){
            @$u=$this->f_profiler->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['user_item'] = $u;
        }
        $title=@$data['pro_first']->name;
        $keyword=@$data['pro_first']->keyword;
        $description=@$data['pro_first']->description_seo;
        $this->LoadHeader($title,$keyword,$description);
        $this->load->view('profiles/profile',$data);
        $this->LoadFooter();
    }
    public function financeManager()
    {
        $data = array();
        if($this->session->userdata('userid')){
            @$u=$this->f_profiler->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['cards'] = $this->f_profiler->get_data('cardrecharge',array(
                'user_id' => $this->session->userdata('userid')
            ),array('id' => 'desc'));
            $data['timeNow'] = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $data['card'] = $this->f_profiler->getFirstRow('card');
            $data['user_item'] = $u;
            $seo = array();
            $this->LoadHeader($seo);
            $this->load->view('profiles/view_finance_manager',$data);
            $this->LoadFooter();
        }
        else{

            redirect(base_url());
        }
    }
    public function getFiledownloaded()
    {
        $data = array();
        if($this->session->userdata('userid')){
            @$u=$this->f_homemodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['user_item'] = $u;
            $seo = array();
            $this->LoadHeader($seo);
            $this->load->view('profiles/view_downloaded',$data);
            $this->LoadFooter();
        }
        else{

            redirect(base_url());
        }
    }
    public function getViewRecharge()
    {
       $this->load->view('view_recharge');
    }
    public function recharge()
    {
        //var_dump(FCPATH);die();
        $data = array();
        if($this->session->userdata('userid')){
            @$u=$this->f_homemodel->getFirstRowWhere('users',array('id'=>$this->session->userdata('userid')));
            $data['user_item'] = $u;
        }
        $seo = array();
        $this->LoadHeader($seo);
        $this->load->view('profiles/rechage',$data);
        $this->LoadFooter();
    }
}