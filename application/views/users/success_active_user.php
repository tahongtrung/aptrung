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
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp;Kích hoạt tài khoản</a> </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="block-content">
                <section class="content_about" style="margin-top: 0px;">
                    <h3 style="padding-bottom: 10px;">
                        Kích hoạt tài khoản thành công!
                    </h3><br>

                    <div class="confirm" >


                        <p>Tài khoản đã được kích hoạt thành công!</p>

                        <p> Tài khoản đăng ký của quý khách đã được kích hoạt thành công. Quý khách có thể
                            <a href="" style="color: red" data-toggle="modal" data-target=".bs-example-modal-sm">Đăng nhập</a> vào
                            tài khoản hoặc vào Trang chủ <b><?=@$this->option->site_name;?></b> để bắt đầu giao dịch mua hàng.</p>
                    </div>


                </section>
             </div>
        </div>
    </div>
</section>