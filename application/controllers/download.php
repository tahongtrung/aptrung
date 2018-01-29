<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Download extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        //$this->load->helper(array('form', 'url'));
        $this->load->model('m_download');
    }
    //index, just load the main page
    public function index() {
        //load the view/download.php
        $this->load->view('download');

    }
    function downloadPdf()
    {
        header('Content-Type: text/html; charset=utf-8');
        //echo $file;
        //$file_name ='./upload/file/Mobile-web-app-with-ZF.pdf';
        if($this->session->userdata('userid'))
        {
            $userItem = $this->m_download->getFirstRowWhere('users',array(
                'id' => $this->session->userdata('userid')
            ));
            $priceNow = $userItem->price;
            $xu = base64_decode($this->input->get('xu'));
            $xu = (int)$xu;
            $timeNow = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            if(($priceNow < $xu) || ($userItem->enddate < $timeNow))
            {
                $_SESSION['mss_success'] = "Tài khoản của bạn đã hết hoặc đã quá hạn để thực hiện chức năng download";
                redirect(base_url('quan-ly-tai-chinh'));
            }else{
                //echo "<pre>";var_dump($userItem);die();
                $file = $this->input->get('file');
                $file_name = base64_decode($file);
                //echo $file_name;
                $id = $this->input->get('id');
                $mime = 'application/force-download';
                header('Pragma: public');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Cache-Control: private',false);
                header('Content-Type: '.$mime);
                header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
                header('Content-Transfer-Encoding: binary');
                header('Connection: close');
                readfile($file_name);
                $priceUpdate = (int)$priceNow - $xu;
                // $priceUpdate = $priceNow;
                $this->m_download->Update('users',$this->session->userdata('userid'),array(
                    'price' => $priceUpdate
                ));
                $fileOld = $this->m_download->getFirstRowWhere('product',array(
                    'id' => $id
                ));
                $downloadNew = $fileOld->downloaded + 1;
                $this->m_download->Update('product',$id,array(
                    'downloaded' => $downloadNew
                ));
                exit();
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function quickDownload()
    {
        $file = $this->input->get('file');
        $id = $this->input->get('id');

        $fileOld = $this->m_download->getFirstRowWhere('product',array(
            'id' => $id
        ));
        $file_name = base64_decode($file);

        $downloadNew = $fileOld->downloaded + 1;
        //echo "<pre>";var_dump($downloadNew);die();
        $this->m_download->Update('product',$id,array(
            'downloaded' => $downloadNew
        ));
        //echo $file_name;
        $mime = 'application/force-download';
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private',false);
        header('Content-Type: '.$mime);
        header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: close');
        readfile($file_name);
        exit();
    }
}
