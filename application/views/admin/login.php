
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>HILAZA  - HỆ THỐNG QUẢN TRỊ WEBSITE</title>
    <!--    <link rel="stylesheet" type="text/css" href="css/admin.css" />-->
    <!--    <link href="../css/style.css" rel="stylesheet">-->

    <!--    <link href="../css/default.css" rel="stylesheet">-->
    <!--    <script type="text/javascript" src="../js/jquery.min.js"></script>-->


    <link type="text/css" href="http://bitconnect.com.vn/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!--    <link type="text/css" href="-->
    <?//= base_url('assets/css/font-awesome.min.css')?><!--" rel="stylesheet"/>-->
    <link type="text/css" href="http://bitconnect.com.vn/assets/css/style_login2.css" rel="stylesheet"/>
    <script type="text/javascript" src="http://bitconnect.com.vn/assets/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://bitconnect.com.vn/assets/js/jssor.core.js"></script>
    <script type="text/javascript" src="http://bitconnect.com.vn/assets/js/jssor.utils.js"></script>
    <script type="text/javascript" src="http://bitconnect.com.vn/assets/js/jssor.slider.js"></script>


</head>

<body>

<div class="wrapper">

    <div class="site_main">

        <div class="container wrapper1 ">
            <header>
                <div class="row banner">
                    <img src="http://www.terravisual.co/wp-content/uploads/2012/06/banner-03.jpg">
                </div>
                <div class="line"></div>
                <div class="menu ">
                    <div class="container">
                        <ul>



                        </ul>
                    </div>
                </div>
            </header>
            <div style="padding: 5px">
                <div class="login_main">
                    <div class="col-xs-12">
                        <div class="row" style="padding: 5px 0px 5px 10px;">
                            <img src="http://bitconnect.com.vn/images/text.png">

                        </div>
                    </div>
                    <div class="col-xs-8 slide">


                        <div class="row">

                            <script>
                                jQuery(document).ready(function ($) {
                                    var _CaptionTransitions = [];
                                    //Left to Right
                                    _CaptionTransitions["L"] = { $Duration: 800, $FlyDirection: 1 };
                                    //Right to Left
                                    _CaptionTransitions["R"] = { $Duration: 800, $FlyDirection: 2 };
                                    //Top to Bottom
                                    _CaptionTransitions["T"] = { $Duration: 800, $FlyDirection: 4 };
                                    //Bottom to Top
                                    _CaptionTransitions["B"] = { $Duration: 800, $FlyDirection: 8 };
                                    //Reference http://www.jssor.com/development/caption-transition-viewer.html

                                    var options = {
                                        $AutoPlay: true,
                                        $PlayOrientation: 1,
                                        $DragOrientation: 3,

                                        $CaptionSliderOptions: {
                                            $Class: $JssorCaptionSlider$,
                                            $CaptionTransitions: _CaptionTransitions,
                                            $PlayInMode: 1,
                                            $PlayOutMode: 3
                                        }
                                    };

                                    var jssor_slider1 = new $JssorSlider$("slider1_container", options);
                                });
                            </script>
                            <div id="slider1_container" style="position: relative; width: 660px; height: 310px;">

                                <!-- Loading Screen -->
                                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                                    <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                                    </div>
                                    <div style="position: absolute; display: block; background: url(images/img/loading.gif) no-repeat center center;
                                        top: 0px; left: 0px;width: 100%;height:100%;">
                                    </div>
                                </div>
                                <!-- Slides Container -->
                                <div u="slides"
                                     style="cursor: move; position: absolute; left: 0px; top: 0px; width:660px; height:310px; overflow: hidden;">
                                    <div><img u="image" src="http://bitconnect.com.vn/images/bn1.jpg" style="height: 310px"/>
                                    </div>
                                    <div><img u="image" src="http://bitconnect.com.vn/images/bn2.jpg" style="height: 310px"/>
                                    </div>
                                    <div><img u="image" src="http://bitconnect.com.vn/images/bn3.jpg" style="height: 310px"/>
                                    </div>
                                </div>
                            </div>
                            <!-- Jssor Slider End -->
                        </div>

                    </div>
                    <div class="col-xs-4 ">
                        <div style="padding-left: 10px" class="row">
                            <div class="login_frm">
                                <div class="title_frm">
                                    <b>THÔNG TIN ĐĂNG NHẬP</b>
                                </div>

                                <form class="form-signin" role="form" method="post" action="">

                                    <div class="form-group form-group">
                                        <label for="exampleInputEmail1">Tên Đăng nhập</label>

                                        <input type="text" name="email" class="form-control" placeholder="Tên Đăng nhập"
                                               required="" autofocus="true">


                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mật Khẩu</label>
                                        <input type="password" name="pass" class="form-control" placeholder="Mật Khẩu" required="">
                                    </div>
                                    <div class="col-xs-12 ">
                                        <div class="row text-ceter">
                                            <button type="submit" class="btn btn-default btn-sm btn-primary"
                                                    style="padding: 5px 25px">Đăng nhập
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="clear"></div>
                                <div style="padding-top: 15px">
                                    <b>Hỗ trơ kỹ thuật</b><br>
                                    Điện thoại: 0967347801<br>
                                    Email: Phamvanhoa1414@outlook.com.vn
                                </div>
                            </div>
                        </div>                    </div>
                    <div class="clear"></div>
                    <div class="hr"></div>

                </div>
            </div>
            <footer>
                <b>CÔNG TY CỔ PHẦN CÔNG NGHỆ HILAZA VIỆT NAM</b><BR>
                Văn Phòng: Số 80 Phố Mễ Trì Hạ, Mễ Trì, Nam Từ Liêm, Hà Nội<br>
                Số điện thoại: 0963.958.699
            </footer>
            <!--<div class="row" style="border-top: ">

            </div>-->
        </div>
    </div>
</div>


</body>


</html>





