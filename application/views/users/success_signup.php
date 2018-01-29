<?php if(count($banners)) : ?>
    <div class="banner">
        <div id="slider2_container"
             style="position: relative; top: 0px; left: 0px; width: 1349px; height: 430px; overflow: hidden;
                                  margin:0 auto; padding:0 auto">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <!--<div style="position: absolute; display: block; background: url(<?=base_url()?>assets/css/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
            </div>-->
            </div>

            <!-- Slides Container -->

            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1349px; height: 430px; overflow: hidden;">
                <?php foreach($banners as $banner) : ?>
                    <div>
                        <img u="image" src="<?=@$banner->link;?>"/>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <!-- Arrow Navigator Skin Begin -->

        <!-- Arrow Left -->
                                <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 163px; left: 0px;">
                                </span>
        <!-- Arrow Right -->
                                <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 163px; right: 0px">
                                </span>
        <!-- Jssor Slider End -->
    </div><!--end-------------------------------banner---->
<?php endif;?>
<section class="content clearfix">
    <div class="container">
        <div class="row">
            <div class="breadcrumb pull-right">
                <ul>
                    <li><a class="breadhome" href="<?=base_url()?>" title="<?=@$this->option->site_name;?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?=lang('home');?></a> </li>
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp;Đăng ký thành công</a> </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="block-content">
                <section class="content_about" >
                    <h3 style="text-shadow:0px 0px 15px #f9ff5f; color:#596067;
                            border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                        Thông tin đăng ký!
                    </h3><br>
                    <?php if(isset($_GET['reset'])){?>
                        <p> Chúng tôi đã gửi email lấy lại mật khẩu vào địa chỉ hòm thư <b><a href=""> <?=@$u2->email;?></a></b>, vui lòng kiểm tra hộp thư đến của quý khách.</p>

                        <p>Quý khách lưu ý kiểm tra hòm thư trong tất cả thư mục (bao gồm Inbox và Bulk mail) để tìm thư đến từ địa chỉ
                            <b><a href=""><?=@$this->option->site_email;?></a></b>. Đôi khi do đường truyền mà email có
                            thể đến
                            chậm
                            5-10 phút.</p>

                        <p>  Quý khách chỉ thực sự hoàn tất thủ tục đăng ký thành viên sau khi đã kích hoạt tài khoản
                            được gửi từ mail kích hoạt  <b><a href=""> <?=@$this->option->site_name;?></a></b>. </p>

                        <p>  Khi cần trợ giúp, vui lòng gọi <b><?=@$this->option->site_email;?></b> (Giờ hành chính: 8h15-18h00)</p>

                        <p> Email hỗ trợ kỹ thuật <?=@$this->option->site_email;?> nếu quý khách không nhận được thông tin kích
                            hoạt tài khoản.</p>

                    <?php  }else{
                        if(isset($u)){?>
                            <div class="confirm" >

                                <p>Cảm ơn quý khách đã đăng ký tài khoản! </p>

                                <p> Chúng tôi đã gửi một email vào địa chỉ hòm thư <b><a href=""> <?=@$u->email;?></a></b>, vui lòng kiểm tra và kích hoạt tài khoản của quý khách.</p>

                                <p>Quý khách lưu ý kiểm tra hòm thư trong tất cả thư mục (bao gồm Inbox và Bulk mail) để tìm thư đến từ địa chỉ
                                    <b><a href=""><?=@$this->option->site_email;?></a></b>. Đôi khi do đường truyền mà email có thể đến chậm 5-10 phút.</p>

                                <p>  Quý khách chỉ thực sự hoàn tất thủ tục đăng ký thành viên sau khi đã kích hoạt tài khoản được gửi từ mail kích hoạt  <b><a href=""><?=@$this->option->site_name;?></a></b>. </p>

                                <p>  Khi cần trợ giúp, vui lòng gọi <b><?=@$this->option->hotline1;?></b> hoặc <b><?=@$this->option->hotline2;?></b> (Giờ hành chính: 8h15-18h00)</p>

                                <p> Email hỗ trợ <?=@$this->option->site_email;?> nếu quý khách không nhận được thông tin kích hoạt tài khoản.</p>

                            </div>
                        <?php }else{?>
                            <div class="confirm" >

                                <p>Đăng ký không thành công, đã có lỗi khi gửi mail đến email bạn đăng ký hoặc email của bạn không tồn tại! </p>

                                <p> Email hỗ trợ kỹ thuật <?=@$this->option->site_email;?> nếu quý khách không nhận được
                                    thông
                                    tin kích hoạt tài khoản.</p>

                            </div>
                        <?php }
                    }?>


                </section>
            </div>
        </div>
    </div>
</section>



