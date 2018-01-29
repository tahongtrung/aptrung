<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($seo['title']) && $seo['title'] != '' ? $seo['title'] : @$this->option->site_name; ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/favicon.png') ?>"/>

    <link href="<?=base_url()?>assets/css/front_end/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/front_end/font-awesome.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/front_end/setmedia.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/front_end/nav-menu3.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/front_end/style00.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/front_end/slider-full.css" rel="stylesheet"/>
    <link href="<?=base_url()?>assets/css/front_end/jquery.datetimepicker.css" rel="stylesheet"/>


    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/style-img.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/nav-menu3.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/common.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/slider-full.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/date-functions.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/front_end/jquery.datetimepicker.js"></script>
    <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<header>
    <div class="top-head">
    <div class="container">
        <div class="row_pc">

            <div class="visible-xs menu_mb">
                <button class="nav-toggle">
                    <div class="icon-menu">
                        <span class="line line-1"></span>
                        <span class="line line-2"></span>
                        <span class="line line-3"></span>
                    </div>
                </button>
            </div><!-- /menu_mb -->
            <div class="box_header clearfix">
                <div class="row">
                    <div class="logo_pc">
                        <a href="">
                            <img class="w_100" src="<?=base_url(@$this->option->site_logo)?>" alt="<?=@$this->option->site_name;?>"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="top">
                            <div class="pull-left">
                                <!--<ul class="form-login">
                                    <?php
/*                                    if($this->session->userdata('userid')){
                                        echo '<li >
                                                    <div class="dropdown ">
                                                      <a  id="dLabel"  style=" cursor: pointer; font-size:14px;"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        '.$this->session->userdata('fullname').'
                                                        <span class="caret"></span>
                                                      </a>
                                                      <ul class="dropdown-menu user_dropdown" role="menu" aria-labelledby="dLabel" >
                                                        <li role="presentation"><a onclick="changePassModal()" id="change-pass" role="menuitem" tabindex="-1" href="#"
                                                        data-toggle="modal" data-target=".bs-example-modal-sm3"><i class="fa fa-key"></i>&nbsp;Đổi mật khẩu</a>
                                                        </li>
                                                        <li role="presentation">
                                                        <a onclick="userInfoModal()" href="#" id="user-info"><i class="fa fa-user"></i>&nbsp;Thông tin cá nhân</a>
                                                        </li>
                                                        <li role="presentation">
                                                        <a role="menuitem" tabindex="-1" href="'.base_url('dang-xuat').'"><i class="fa fa-times"></i>&nbsp;Thoát</a>
                                                        </li>
                                                      </ul>
                                                    </div>
                                                        </li>';
                                    }else{
                                        echo '<li>
                                                            <a onclick="getModalLogin()"  style=" padding-top: 3px" href="javascript:return 0" id="login"
                                                             data-toggle="modal" data-target=".bs-example-modal-sm" class="login">
                                                            '.lang('login').'</a>
                                                        </li>

                                                        <li>
                                                            <a onclick="registerModal()" id="register" style=" padding-top: 3px"  href="javascript:return 0"
                                                            data-toggle="modal" data-target=".bs-example-modal-sm2" class="login" >
                                                            '.lang('register').'</a>
                                                        </li>';
                                    }
                                    */?>
                                </ul>-->
                            </div>
                            <div class="pull-right slide-top" style="margin-top: 2px">
                                <div class="search_box">
                                    <form action="<?=base_url('search')?>" class="search-form" id="form-search">
                                        <div class="form-group has-feedback" style="margin-bottom: 5px">
                                            <label for="search" class="sr-only">Search</label>
                                            <input type="text" class="form-control" style="height: 30px" name="key" id="search" placeholder="search">
                                            <span onclick="search()" id="btn_search"  class="glyphicon glyphicon-search form-control-feedback"></span>
                                        </div>
                                    </form>
                                </div>
                                <div class="hotline_header">
                                    <span style="color: #ff0000;font-size: 14px">Hotline: </span>
                                    <span style="color: #333333"><?=@$this->option->hotline1;?></span>
                                </div>
                                <div class="language">
                                    <a href="<?= base_url('home/lang/en') ?>" title="" class="icon">
                                        <img src="<?=base_url();?>assets/css/img/anh-co2.png" alt=""></a>
                                    <a href="<?= base_url('home/lang/vi') ?>" title="" class="icon">
                                        <img src="<?=base_url();?>assets/css/img/anh-co1.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="qts_menu">
                            <nav class="nav is-fixed" role="navigation" style="position: relative;z-index: 100;">

                                <div class="wrapper wrapper-flush">
                                    <div class="nav-container container">
                                        <ul class="nav-menu menu">
                                            <li class="menu-item"><a href="<?=base_url()?>" title="<?=@$this->option->site_name;?>" class="menu-link"><?=lang('home');?></a> </li>
                                            <?php if(isset($menu_root)){
                                                if($this->language == 'vi'){$mitem = 'item';}else{$mitem='eitem';}
                                                foreach($menu_root as $key=>$root){?>
                                                    <li class="menu-item <?=$mitem.$key;?> <?php if(check_hassub($root->id_menu,$menu_sub) == true){echo 'has-dropdown';} ;?>">
                                                        <a href="<?= base_url($root->url); ?>" title="<?=$root->name;?>" class="menu-link">
                                                            <?=$root->name;?></a>
                                                        <?php
                                                        if (isset($menu_sub)) {
                                                            ?>
                                                            <ul class="nav-dropdown" style="text-align: left">
                                                                <?php
                                                                foreach ($menu_sub as $key_sub=> $mn_sub) {
                                                                    if($mn_sub->parent_id==$root->id_menu){
                                                                        ?>
                                                                        <li class="menu-item">
                                                                            <a href="<?= base_url($mn_sub->url);?>"
                                                                               title="<?=$mn_sub->name;?>" class="menu-link">
                                                                                <i class="<?=@$mn_sub->icon?>"></i><?=$mn_sub->name;?>
                                                                            </a>
                                                                        </li>
                                                                        <?php
                                                                        //unset($menu_sub[$key_sub]);
                                                                    } }?>
                                                            </ul>
                                                        <?php
                                                        }?>
                                                    </li>

                                                <?php   }
                                            }?>

                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="row">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
    <?=@$slider_widget;?>
</header>
