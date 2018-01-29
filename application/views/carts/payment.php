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
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp;Thông báo đặt hàng</a> </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <section class="product col-md-9">
                <div class="block-head clearfix">
                    <h2 class="title-block">Đặt hàng thành công !</h2>
                </div>
                <div class="block-new list-new">
                    <div class="m-detail">
                        <ul>
                            <li>
                                Cảm ơn bạn đã đặt hàng tại <?=@$this->option->site_name;?>
                            </li>
                            <li>
                                Chúng tôi sẽ liên lạc và giao hàng cho bạn trong vòng 24 đến 72 giờ
                            </li>
                            <!--<li>
                                Chúng tôi đã gửi thông tin đơn hàng vào email của bạn
                            </li>-->
                            <li>
                                Kính chúc bạn thật nhiều sức khỏe và thành công !
                            </li>
                        </ul>
                    </div>
                </div>
                <!--menu-detail-->

            </section>
            <?=@$sidebar;?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>