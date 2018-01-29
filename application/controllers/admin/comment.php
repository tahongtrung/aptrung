<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_comment');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
    }

    public function comments()
    {
        $this->check_acl();
        $config['base_url']    = base_url('adminvn/comment/comments');
        $config['total_rows']  = $this->m_comment->countComment(); // xác định tổng số record
        //echo"<pre>";var_dump($config['total_rows']);die();
        $config['per_page']    = 15; // xác định số record ở mỗi trang
        $config['uri_segment'] = 4; // xác định segment chứa page number
        $this->pagination->initialize($config);
        $data              = array();
        $data['list']  = $this->m_comment->listAllComment($config['per_page'],$this->uri->segment(4));

        $this->m_comment->Update_where('comments_binhluan',array('flg'=>0),array('flg'=>1));
        //echo"<pre>";var_dump($data['list']);die();
        $data['cate']=$this->m_comment->GetData('product_category');

        $data['headerTitle'] = 'Bình luận';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/comments/comment_list', $data);
        $this->load->view('admin/footer');
    }
    public function deletes()
    {
        $this->check_acl();
        $ids = $this->input->post('checkone');
        foreach($ids as $id)
        {
            $this->delete_once($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete_once($id)
    {
        $this->m_comment->Delete('comments_binhluan',$id);
    }
    public function delete($id){
        $this->check_acl();
        $this->m_comment->Delete('comments_binhluan',$id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function popupdata()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $id   = $_GET['id'];
            $item = $this->m_comment->getFirstRowWhere('comments_binhluan', array('id' => $id));
            echo '
                        <div class="col-xs-12">
                            <p> '.@$item->comment.'</p>
                        </div>
                ';
        }
    }
    public function active_comment(){
        //$this->auth->check();
        $u=$this->m_comment->getFirstRowWhere('comments_binhluan',array('id'=>$_POST['id']));

        if($u->review==1){
            $this->m_comment->Update_where('comments_binhluan', array('id' => $_POST['id']), array('review'=>0));

        }else if($u->review==0){
            $this->m_comment->Update_where('comments_binhluan', array('id' => $_POST['id']), array('review'=>1));
        }

        echo 1;
    }
}