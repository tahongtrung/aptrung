<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller
{
    protected $module_name = "Report";

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('reportmodel');
        $this->load->library('pagination');
        $this->auth = new Auth();
        $this->auth->check();
        $this->Check_module($this->module_name);
    }

    protected $pagination_config = array(
        'full_tag_open'    => "<ul class='pagination'>",
        'full_tag_close'   => "</ul>",
        'num_tag_open'     => '<li>',
        'num_tag_close'    => '</li>',
        'cur_tag_open'     => "<li class='disabled'><li class='active'><a href='#'>",
        'cur_tag_close'    => "<span class='sr-only'></span></a></li>",
        'next_tag_open'    => "<li>",
        'next_tagl_close'  => "</li>",
        'prev_tag_open'    => "<li>",
        'prev_tagl_close'  => "</li>",
        'first_tag_open'   => "<li>",
        'first_tagl_close' => "</li>",
        'last_tag_open'    => "<li>",
        'last_tagl_close'  => "</li>",
    );


    public function soldout($num = 10)
    {

        if ($this->input->get()) {


            $where = array(
                'code' => $this->input->get('code'),
                'name' => $this->input->get('name'),
                'cate' => $this->input->get('cate'),
            );

            //var_dump($where);die();
            $config['page_query_string']    = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['base_url']             = base_url('admin/report/soldout/' . $num . '?code=' . $this->input->get('code') . '&name=' . $this->input->get('name') . '&cate=' . $this->input->get('cate'));
            $config['total_rows']           = $this->reportmodel->countsearch_soldout($num, $where);
            $config['per_page']             = 20;
            $config['uri_segment']          = 5;

            $config = array_merge($config, $this->pagination_config);

            $this->pagination->initialize($config);
            $data['prolist'] = $this->reportmodel->getsearch_soldout($num, $where, $config['per_page'], $this->input->get('per_page'));

            $data['total_rows'] = $config['total_rows'];
            $data['cate']       = $this->reportmodel->get_data('product_category');


        } else {

            $config['base_url']    = base_url('admin/report/soldout/' . $num);
            $config['total_rows']  = $this->reportmodel->count_All('product'); // xác định tổng số record
            $config['per_page']    = 20; // xác định số record ở mỗi trang
            $config['uri_segment'] = 5; // xác định segment chứa page number
            $config                = array_merge($config, $this->pagination_config);
            $this->pagination->initialize($config);
            $data['prolist'] = $this->reportmodel->get_soldout($num, $config['per_page'], $this->uri->segment(5));
        }


//        $data['prolist'] = $this->reportmodel->get_soldout($num, $config['per_page'], $this->uri->segment(5));
        $data['cate']        = $this->reportmodel->getList('product_category');
        $data['headerTitle'] = "Hết hàng";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/report_soldout', $data);
        $this->load->view('admin/footer');
    }

    public function bestsellers()
    {
//        $this->load->helper('webcounter_helper');

        if($this->input->get('from')){
            $from = date_fomat_en($this->input->get('from'));
        }else{
            $from=null;
        }
        if($this->input->get('to')){
            $to   = date_fomat_en($this->input->get('to'));
        }else{
            $to=null;
        }

        $data['date_from'] = date_fomat_en($from);
        $data['date_to']   = date_fomat_en($to);
        $data['prolist']   = $this->reportmodel->get_bestsellers(strtotime($from), strtotime($to));

        $data['headerTitle'] = "Bán chạy";
        $this->load->view('admin/header', $data);
        $this->load->view('admin/report_bestsellers', $data);
        $this->load->view('admin/footer');
    }
}