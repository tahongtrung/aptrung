<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($seo['title']) && $seo['title'] != '' ? $seo['title'] : @$this->option->site_name; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/favicon.png')?>">

    <meta name='description'
          content='<?= isset($seo['description']) ? $seo['description'] : @$this->option->site_description; ?>'/>
    <meta name='keywords'
          content='<?= isset($seo['keyword']) && $seo['keyword'] != '' ? $seo['keyword'] : $this->option->site_keyword; ?>'/>
    <meta name='robots' content='index,follow'/>
    <meta name='revisit-after' content='1 days'/>
    <meta http-equiv='content-language' content='vi'/>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <!--    for facebook-->
    <meta property="og:title"
          content="<?= isset($seo['title']) && $seo['title'] != '' ? $seo['title'] : @$this->option->site_name; ?>"/>
    <meta property="og:site_name" content="<?= @$this->option->site_name; ?>"/>
    <meta property="og:url" content="<?= current_url(); ?>"/>
    <meta property="og:description"
          content="<?= isset($seo['description']) && $seo['description'] != '' ? $seo['description'] : @$this->option->site_description; ?>"/>
    <meta property="og:type" content="<?=@$seo['type'];?> "/>
    <meta property="og:image"
          content="<?= isset($seo['image']) && $seo['image'] != '' ? base_url($seo['image']) : base_url(@$this->option->site_logo); ?>"/>

    <meta property="og:locale" content="vi"/>

    <!-- for Twitter -->
    <meta name="twitter:card"
          content="<?= isset($seo['description']) && $seo['description'] != '' ? $seo['description'] : @$this->option->site_description; ?>"/>
    <meta name="twitter:title"
          content="<?= isset($seo['title']) && $seo['title'] != '' ? $seo['title'] : @$this->option->site_name; ?>"/>
    <meta name="twitter:description"
          content="<?= isset($seo['description']) && $seo['description'] != '' ? $seo['description'] : @$this->option->site_description; ?>"/>
    <meta name="twitter:image"
          content="<?= isset($seo['image']) && $seo['image'] != '' ? base_url($seo['image']) : base_url(@$this->option->site_logo); ?>"/>


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/favicon.png')?>">
    <link href="<?= base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style_meu_filter.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/sb-admin.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=base_url('assets/js/jquery-1.9.1.js')?>"> </script>
    <script src="<?= base_url('assets/js/bootstrap.min.js')?>"></script>

</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url('adminvn')?>"><i class="fa fa-user"></i> Admin-CP</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <!--<li>
                <span class="label">Language :</span>
                <select class="multi-language" id="dynamic_select">
                    <option value="<?/*= base_url('admin/admin/lang/vi') */?>" <?php /*if($this->language == 'vi'){echo "selected";} */?>>
                        Vietnamese
                    </option>
                    <option value="<?/*= base_url('admin/admin/lang/en')*/?>" <?php /*if($this->language == 'en'){echo "selected";} */?>>
                        Englisth
                    </option>
                    <option value="<?/*= base_url('admin/admin/lang/ja')*/?>" <?php /*if($this->language == 'ja'){echo "selected";} */?>>
                        Tiếng Nhật
                    </option>
                </select>
            </li>-->
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    Language<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?/*= base_url('admin/admin/lang/vi') */?>" class="active-lang">
                            Vietnamese
                        </a>
                    </li>
                    <li>
                        <a href="<?/*= base_url('admin/admin/lang/en') */?>">
                            English
                        </a>
                    </li>
                </ul>
            </li>-->
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-navicon"></i> Module khác <b class="caret"></b>

                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="<?/*= base_url('adminvn/emails')*/?>"> Qu?n lý email</a>
                    </li>
                    <li>
                        <a href="<?/*= base_url('adminvn/contact/list')*/?>"> Qu?n lý liên h?</a>
                    </li>
                    <li>
                        <a href="<?/*= base_url('adminvn/imageupload/banner')*/?>">Qu?n lý banner</a>
                    </li>

                    <li>
                        <a href="<?/*= base_url('adminvn/imageupload')*/?>"> Qu?n lý ?nh</a>
                    </li>
                    <li>
                        <a href="<?/*= base_url('adminvn/site_option')*/?>">C?u hình h? th?ng</a>
                    </li>
                     <li>
                            <a href="<?/*= base_url('adminvn/quan-ly-modules')*/?>">Qu?n lý modules</a>
                        </li>

                </ul>
            </li>-->

            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    <span id="user_login"><?= $this->session->userdata('adminname')?><span></span> <b class="caret"></b></a>
                <ul class="dropdown-menu">

                    <li>
                        <a href="<?= base_url('admin/admin/users')?>"><i class="fa fa-fw fa-users"></i> Phân quyền </a>
                    </li>

                    <li>
                        <a href="<?= base_url('adminvn/doi-mat-khau')?>"><i class="fa fa-fw fa-refresh"></i> Đổi mật khẩu</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= base_url('adminvn/logout')?>"><i class="fa fa-fw fa-power-off" style="color: red"></i> Đăng xuất</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav menu_admin">
                <li class="">
                    <a href="<?= base_url('adminvn')?>"><i class="fa fa-fw fa-dashboard"></i>
                        <?/*=lang('home');*/?>Trang chủ
                    </a>
                </li>
                <!-- <li>
                    <a href="<?= base_url('adminvn/inuser/categories')?>"><i class="fa fa-navicon"></i>

                        Ý kiến khách hàng<i class="fa fa-fw fa-caret-down"></i></a>

                </li> -->
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-navicon"></i>
                        <?/*=lang('admin-title-new');*/?>Quản lý tin tức & dịch vụ <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="<?= base_url('adminvn/news/add')?>">
                                <?/*=lang('admin-add-new');*/?>Thêm tin tức
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/news/newslist')?>">
                                <?/*=lang('list-new');*/?>Danh sách tin
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/news/categories')?>">
                                <?/*=lang('cat-new');*/?>Danh mục tin
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#product"><i class="fa
                    fa-navicon"></i>
                        Quản lý Sản phẩm <i class="fa fa-fw fa-caret-down"></i>
                        <span id="count_order" style="    color: #fff;
                                                            font-size: 10px !important;
                                                            border-radius: 50%;
                                                            position: absolute;
                                                            margin: -9px 0px 0px -18px;"></span>
                    </a>
                    <ul id="product" class="collapse">
                        <li>
                            <a href="<?= base_url('adminvn/product/add')?>">
                                Thêm sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/product/products')?>">
                                Danh sách sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/product/categories')?>">
                                Danh mục sản phẩm
                            </a>
                        </li>

                        <!-- <li>
                            <a href="<?= base_url('adminvn/product/hangsxList')?>">Loại sản phẩm</a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/list-shipping')?>">
                                <i class="fa fa-angle-double-right"></i>
                                Phí vận chuyển
                            </a>
                        </li>
                        <li >
                            <a href="<?= base_url('adminvn/list-code-sale')?>">
                                <i class="fa fa-angle-double-right"></i>
                                Quản lý mã giảm giá
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/order/orders')?>">
                                Danh sách đặt hàng
                                <span id="count_order2" style="    color: #fff;
                                                            font-size: 10px !important;
                                                            border-radius: 50%;
                                                            position: absolute;
                                                            margin: -3px 0px 0px 0px;"></span>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url('adminvn/menu/menulist')?>"><i class="fa fa-navicon"> </i>
                        <?/*=lang('m_menu');*/?>Quản lý menu
                    </a>
                </li>

                <!-- <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#media"><i class="fa fa-navicon"></i>
                        Quản Lý Media <i class="fa fa-fw fa-caret-down"></i>
                        <span id="count_order" style="    color: #fff;
                                                            font-size: 10px !important;
                                                            border-radius: 50%;
                                                            position: absolute;
                                                            margin: -9px 0px 0px -18px;"></span>
                    </a>
                    <ul id="media" class="collapse">
                        <li>
                            <a href="<?= base_url('adminvn/media/add')?>">
                                Thêm mới
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/media/listAll')?>">
                                Danh sách
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/media/categories')?>">
                                Danh mục
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!--<li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#raovat">
                        <i class="fa fa-navicon"></i> Quản lý rao vặt
                        <span id="count_post" style="color: #fff; font-size: 10px !important;border-radius: 50%;"></span>
                        <i class="fa fa-fw fa-caret-down"></i>

                    </a>
                    <ul id="raovat" class="collapse">
                        <li>
                            <a href="<?/*= base_url('adminvn/raovat/raovat_list')*/?>">Danh sách tin rao vặt</a>
                        </li>
                        <li>
                            <a href="<?/*= base_url('adminvn/raovat/cat_raovat')*/?>">Danh mục rao vặt</a>
                        </li>
                    </ul>
                </li>-->


                <li>
                    <a href="<?= base_url('adminvn/pages/pagelist')?>"><i class="fa fa-navicon"></i>
                        <?/*=lang('m_content');*/?>Quản lý nội dung
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('adminvn/imageupload/banners')?>"><i class="fa fa-navicon"></i>
                        <?/*=lang('m_banner');*/?>Quản lý banner
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('adminvn/contact/contacts')?>"><i class="fa fa-navicon"></i>
                        <?/*=lang('m_contact');*/?>Quản lý liên hệ
                    </a>
                </li>

                <!--<li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#report"><i class="fa fa-navicon"></i> Báo cáo-Thống kê <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="report" class="collapse">
                        <li>
                            <a href="<?/*= base_url('admin/report/soldout')*/?>"> Hết hàng</a>
                        </li>
                        <li>
                            <a href="<?/*= base_url('admin/report/bestsellers')*/?>"> Hàng bán chạy</a>
                        </li>
                    </ul>
                </li>-->
                <!--<li>
                    <a href="<?/*= base_url('adminvn/users/userslist')*/?>"> <i class="fa fa-navicon"></i>
                        Quản lý thành viên
                    </a>
                </li>-->
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#banner"><i class="fa fa-navicon"></i>
                        <?=lang('m_module');?>
                        <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="banner" class="collapse">
                        <!--<li>
                            <a href="<?/*= base_url('adminvn/users/emails')*/?>">
                                <?/*=lang('m_email');*/?>Quản lý email
                            </a>
                        </li>-->

                        <li>
                            <a href="<?= base_url('adminvn/site_option')?>">
                                <?/*=lang('m_sys');*/?>Cấu hình hệ thống
                            </a>
                        </li>
                       <li>
                            <a href="<?= base_url('adminvn/support_online/listSuport')?>"><?=lang('support');?>Hỗ trợ trực tuyến
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('adminvn/admin/bando_map')?>">Cấu hình bản đồ map</a>
                        </li>
                    </ul>
                </li>
                <!--<li>
                    <a href="<?/*= base_url('adminvn/comment/comments')*/?>">
                         Quản lý bình luận
                        <span id="count_cmt"
                              style="color: #fff; font-size: 10px !important;border-radius: 50%;"></span>
                    </a>
                </li>-->




                    <!--<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#menu"><i class="fa fa-navicon"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="menu" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>-->


            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <script>
        jQuery(document).ready(function ($) {
            // Get current url
            // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
            var url = window.location.href;
            $('.menu_admin  a[href="' + url + '"]').parent().addClass('active');

            $('.menu_admin  a[href="' + url + '"]').parent().parent().parent('li').addClass('active').find('.collapse').addClass('in');

        });

        function count_comments(){

            var baseurl='<?php echo base_url();?>';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: baseurl + 'admin/admin/count_comments',
                success: function (result) {
                    if(parseInt(result)>0){
                        $('#count_cmt').empty();
                        $('#count_cmt').html('('+result+')');
                    }//
                }
            })
        }

        function count_post(){

            var baseurl='<?php echo base_url();?>';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: baseurl + 'admin/admin/count_post',
                success: function (result) {
                    if(parseInt(result)>0){
                        $('#count_post').empty();
                        $('#count_post').html('('+result+')');
                    }//
                }
            })
        }

        function count_order(){

            var baseurl='<?php echo base_url();?>';
            $.ajax({
                type: "POST",
                dataType: "json",
                url: baseurl + 'admin/admin/count_order',
                success: function (result) {
                    if(parseInt(result)>0){
                        $('#count_order').empty();
                        $('#count_order').html('('+result+')');
                        $('#count_order2').html('('+result+')');
                    }//
                }
            })
        }
        count_comments();
        count_post();
        count_order();
        $(document).ready(
            function() {
                setInterval(function() {
                    count_comments();
                    count_post();
                    count_order();
                }, 60000);
            });
    </script>
    <script>
        $(function(){
            // bind change event to select
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });
    </script>
    <input type="hidden" id="baseurl" value="<?=base_url();?>"/>
