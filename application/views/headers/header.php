<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://fontawesome.io/3.2.1/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/layer/layers.css">
    <link rel="stylesheet" href="css/layer/navigation.css">
    <link rel="stylesheet" href="css/layer/settings.css">
    <link rel="stylesheet" href="css/slider/owl.carousel.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/flexnav.css">
</head>
<body>
<header>
    <section class="top1">
        <div class="container">
            <div class="row">
                <div class="col-md-3 logo">
                    <img src="<?=base_url($this->option->site_logo)?>">
                </div>
                <div class="col-md-9 text">
                    <h1><?=($this->option->site_name)?></h1>
                    <p>Hotline:  <?=($this->option->hotline1)?> - <?=($this->option->hotline2)?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="top2">
        <div class="container">
            <div class="row">
                <div class="pull-left menu" id="my-menu">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <div class="MenuMobile">
                            <div class="container">
                                <div class="menu-button">
                                    <img src="http://senvoifrap.com/content/Responsive/images/m2.png"><span class="touch-button"><i class="navicon">▼</i></span>
                                </div>
                                <nav>
                                    <ul data-breakpoint="1025" class="flexnav with-js opacity lg-screen">
                                        <ul id="menu_mid">
                                            <li>
                                                <div class="line"></div>
                                                <div class="div_left"></div>
                                                <a href="" target="_self">Trang chủ</a>
                                                <div class="div_right"></div>
                                            </li>
                                            <li>
                                                <div class="line"></div>
                                                <div class="div_left"></div>
                                                <a href="" target="_self">giới thiệu</a>
                                                <div class="div_right"></div>

                                            <li class="itop item-with-ul">
                                                <div class="line"></div>
                                                <div class="div_left"></div>
                                                <a href="" target="_self">Sản phẩm</a>
                                                <div class="div_right"></div>
                                                <ul style="display: none;">

                                                    <li>
                                                        <div class="line"></div>
                                                        <div class="div_left"></div>
                                                        <a href="" target="_self">Máy sản xuất cửa nhựa</a>
                                                        <div class="div_right"></div>
                                                    </li>

                                                    <li>
                                                        <div class="line"></div>
                                                        <div class="div_left"></div>
                                                        <a href="" target="_self">Máy sản xuất cửa nhôm</a>
                                                        <div class="div_right"></div>
                                                    </li>

                                                </ul>
                                                <span class="touch-button"><i class="navicon">▼</i></span></li>
                                            <li>
                                                <div class="line"></div>
                                                <div class="div_left"></div>
                                                <a href="" target="_self">Bảo hành & hỗ trợ kĩ thuật</a>
                                                <div class="div_right"></div>
                                            </li>
                                            <li>
                                                <div class="line"></div>
                                                <div class="div_left"></div>
                                                <a href="" target="_self">Quy trình máy sản xuất cửa</a>
                                                <div class="div_right"></div>
                                            </li>

                                            <li>
                                                <div class="line"></div>
                                                <div class="div_left"></div>
                                                <a href="" target="_self">Liên hệ</a>
                                                <div class="div_right"></div>
                                            </li>
                                        </ul>
                                    </ul>
                                </nav>
                                <div class="pull-right search visible-xs">
                                    <input placeholder="Tìm kiếm...">
                                    <button><i class="icon-search" style="color: #0e5da9"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                        <?=$menu_top?>
                    </div>
                </div>
                <div class="pull-right search hidden-xs">
                    <input placeholder="Tìm kiếm...">
                    <button><i class="icon-search" style="color: #0e5da9"></i></button>
                </div>
            </div>
        </div>
    </section>
</header>
<article>
    <div class="clearfix"></div>
    <section class="slider slider-university" style="margin-top: 2px">
        <div class="container">
            <div class="row">
                <div class="rev_slider_wrapper">
                    <div id="rev_slider_1" class="rev_slider" style="display:none">
                        <!-- BEGIN SLIDES LIST -->
                        <ul>
                            <li data-transition="slideleft" data-title="Slide Title" data-param1="Additional Text"
                                data-thumb="http://themes.webspixel.com/chongchay/upload/img/banner/thép1.jpg">
                                <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                                <img src="http://themes.webspixel.com/chongchay/upload/img/banner/thép1.jpg" alt="Sky" class="rev-slidebg">
                                <!-- BEGIN BASIC TEXT LAYER -->
                                <!-- LAYER NR. 2 -->

                            </li>
                            <li data-transition="slideleft" data-title="Slide Title" data-param1="Additional Text"
                                data-thumb="http://themes.webspixel.com/nafaco/upload/img/banner/1349x430_Nafaco.jpg">
                                <!-- SLIDE'S MAIN BACKGROUND IMAGE -->
                                <img src="http://themes.webspixel.com/nafaco/upload/img/banner/1349x430_Nafaco.jpg" alt="Sky" class="rev-slidebg">
                                <!-- BEGIN BASIC TEXT LAYER -->
                                <!-- LAYER NR. 2 -->

                            </li>
                        </ul>
                    </div>
                    <!-- END SLIDER CONTAINER -->
                </div>
                <!-- END SLIDER CONTAINER WRAPPER -->
            </div>
        </div>
    </section>
    <div class="clearfix"></div>