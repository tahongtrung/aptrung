
<script type="text/javascript">

</script>
<article>
<?=$sliders?>
<!--end slider mail -->
<div class="container">
    <div class="row">
        <?php
        if (isset($catetour)) {
            $dem9=0;
            foreach ($catetour as $keyctuor => $ctuor) {
                $dem9++;
                ?>
                <div class="travel-home">
                    <h2 class="title-cate-home"><?=$ctuor->name?></h2>
                    <div class="clearfix-30"></div>
                    <ul class="nav nav-tabs tabs-home-1">
                        <li class="active"><a data-toggle="tab" href="#home<?=$dem9;?>">Tất cả</a></li>
                        <li><a href="">Tour bán chạy nhất</a></li>
                        <li><a href="<?=base_url('tour-noi-bat?id='.$ctuor->id)?>">Tour nổi bật</a></li>
                        <li><a href="#">Tour ưa thích</a></li>
                    </ul>
                    <div class="clearfix-20"></div>
                    <div class="tab-content">
                        <div id="home<?=$dem9?>" class="tab-pane fade in active">
                            <section class="slider-tabs col-xs-12">
                                <div id="slider-tabs-item<?=$dem9?>" class="slider-tabs-item">
                                    <?php
                                    if (isset($alltour)) {
                                        $dem=-1;
                                        foreach ($alltour as $keyt => $allt) {
                                            if ($allt->id_category==$ctuor->id) {
                                                $dem++;
                                                if ($dem%2!=0) {

                                                    ?>
                                                    <div class="item">
                                                        <?php
                                                        $dem1=$dem-1;
                                                        $dem2=0;
                                                        if(isset($alltour)){
                                                            foreach ($alltour as $keyt1 => $allt1) {
                                                                if ($allt1->id_category==$ctuor->id) {

                                                                    if ($keyt1==$dem1) {

                                                                        $dem1++;
                                                                        $dem2++;

                                                                        ?>
                                                                        <div class="box-item-prd">
                                                                            <a href="<?=base_url($allt1->pro_alias.'.html')?>" title="<?=$allt1->pro_name?>" class="img-news-1">
                                                                                <img src="<?=base_url('upload/img/products/'.$allt1->pro_dir.'/thumbnail_1_'.@$allt1->pro_img)?>" alt="<?=$allt1->pro_name?>"/>
                                                                            </a>
                                                                            <div class="caption-travel">
                                                                                <div class="row">
                                                                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                                                                        <div class="date-travel">
                                                                                            <?=$allt1->code?><br> ngày
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                                                                        <h3 class="name-travel">
                                                                                            <a href="<?=base_url($allt1->pro_alias.'.html')?>" title="<?=$allt1->pro_name?>"><?=$allt1->pro_name?></a>
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="price">
                                                                                Giá tour: <?=$allt1->price_sale!=0?number_format($allt1->price_sale).'VND':'Liên hệ'?>
                                                                            </div>
                                                                            <div class="dcs-travel">
                                                                                <?=LimitString($allt1->pro_des,200,'...')?>
                                                                            </div>
                                                                        </div>
                                                                        <?php  if($dem2%2==0){break;} } } } } ?>
                                                        <div class="clearfix-10"></div>

                                                    </div>
                                                <?php } } } } ?>
                                </div>
                                <a href="<?=base_url($ctuor->alias.'.html')?>" title="<?=$ctuor->name?>" class="btn more-view pull-right" title="<?=$ctuor->name?>">Xem tất cả</a>
                            </section>
                        </div>

                    </div>
                </div>
                <div class="clearfix-20"></div>



            <?php } } ?>
    </div>
</div>
<!--end slider tabs -->
<div class="clearfix-30"></div>
<section class="favorable hidden-xs">
    <div id="slider-km" class="">
        <?php
        if (isset($bannerbot)) {
            foreach ($bannerbot as $keyban => $ban) {
                ?>
                <div class="item">
                    <a href="javascript:void(0)" title="<?=$ban->name?>" class="img-news-2"><img class="" src="<?=base_url($ban->link)?>" alt="<?=$ban->name?>"/></a>
                </div>
            <?php } } ?>
    </div>
</section>
<div class="clearfix-30"></div>
<?php
if (isset($diemhapdan)) {
    foreach ($diemhapdan as $keyhd => $hd) {
        ?>
        <section class="destination">
            <h2 class="title-cate-home"><?=$hd->name?></h2>
            <h4 class="text-interesting"><?=$hd->description?>  </h4>
            <div class="clearfix-20"></div>
            <div class="destination-content">
                <div class="container">
                    <div class="row">
                        <?php
                        if (isset($news_home)) {
                            foreach ($news_home as $keynh => $nh) {
                                if ($nh->category_id==$hd->id) {
                                    ?>
                                    <div class="col-md-4 col-sm-4 col-xs-6 col-430 pdd-0">
                                        <div class="box-destination">
                                            <a href="<?=base_url($nh->alias.'.html')?>" title="<?=$nh->title?>" class="img-news-3"><img class="w_100" src="<?=base_url($nh->image)?>" alt="<?=$nh->title?>"/></a>
                                            <h3 class="caption-destination">
                                                <a href="<?=base_url($nh->alias.'.html')?>" title="<?=$nh->title?>"><?=$nh->title?></a>
                                            </h3>
                                            <div class="view-destination">
                                                <a href="<?=base_url($nh->alias.'.html')?>" title="<?=$nh->title?>">xem chi tiết</a>
                                            </div>
                                        </div>

                                    </div>
                                <?php } } } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } } ?>
<div class="clearfix-30"></div>
<?php
if (isset($ttdl)) {
    foreach ($ttdl as $keytt => $catett) {
        ?>
        <section class="news-travel">
            <h2 class="title-cate-home"><?=$catett->name?></h2>
            <h4 class="text-interesting"><?=$catett->description?></h4>
            <div class="clearfix-20"></div>
            <div class="container">
                <div class="row-15 row">
                    <?php
                    if (isset($news_home)) {
                        foreach ($news_home as $keynh => $nh) {
                            if ($nh->category_id==$catett->id) {
                                ?>
                                <div class="col-md-4 col-sm-4 col-xs-6 col-430 pdd-15">
                                    <div class="item-news-travel">
                                        <a href="<?=base_url($nh->alias.'.html')?>" title="<?=$nh->title?>"><img class="w_100" src="<?=base_url($nh->image)?>" alt="<?=$nh->title?>"/></a>
                                        <h3 class="name-news-travel">
                                            <a href="<?=base_url($nh->alias.'.html')?>" title="<?=$nh->title?>"><?=$nh->title?></a>

                                        </h3>
                                        <ul class="date-news-travel">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i><?=date('d/m/Y',$nh->time)?> </li>
                                            <li><i class="fa fa-eye" aria-hidden="true"></i>2350 </li>
                                            <!-- <li><i class="fa fa-comments-o" aria-hidden="true"></i> 150</li> -->
                                        </ul>
                                        <div class="clearfix"></div>
                                        <div class="dcs-news-travel">
                                            <?=LimitString($nh->description,200,'[...]')?>
                                        </div>
                                        <div class="clearfix-15"></div>
                                        <a href="<?=base_url($nh->alias.'.html')?>" title="<?=$nh->title?>" class="pull-left view-news-travel"><i>Xem chi tiết <i class="fa fa-angle-double-right" aria-hidden="true"></i></i></a>
                                    </div>

                                </div>
                            <?php } } } ?>
                </div>
            </div>
        </section>
    <?php } } ?>
<div class="clearfix-30"></div>
<section class="support-online">
    <h2 class="title-cate-home">TƯ VẤN VIÊN HỖ TRỢ</h2>
    <h4 class="text-interesting">Luôn giúp bạn giải đáp những thắc mắc một cách chính xác</h4>
    <div class="clearfix-20"></div>
    <div class="container">
        <div class="row">
            <?php
            if (isset($support)) {
                foreach ($support as $keysup => $sup) {
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-6 col-430">
                        <div class="box-sp">
                            <div class="box-img-sp">
                                <a href="javascript:void(0)" title="<?=$sup->name?>" class="img-news-4"><img src="<?=base_url($sup->image)?>" alt="<?=$sup->name?>"/></a>
                            </div>
                            <div class="name-sp">
                                <?=$sup->name?>
                            </div>
                            <div class="phone-sp">
                                <i class="fa fa-mobile" aria-hidden="true"></i><a class="" href="tel:<?=$sup->phone?>" title="<?=$sup->name?>"> Tel: <?=$sup->phone?></a>
                            </div>
                            <div class="text-center">
                                <a href="skype:<?=$sup->skype?>?chat" title="<?=$sup->name?>" class="btn btn-skype"><i class="fa fa-skype" aria-hidden="true"></i> connect on skype</a>
                            </div>
                        </div>
                    </div>
                <?php } } ?>
        </div>
    </div>
</section>
<div class="clearfix-40"></div>
<section class="partner">
    <div class="container container-header">
        <div class="row row-20">
            <div class="col-md-6 col-sm-12 col-xs-12 pdd-20">
                <div class="box-partner">
                    <h3 class="item-partner">
                        <a href="" title="">Đối tác chiến lược</a>
                    </h3>
                    <div class="clearfix"></div>
                    <div class="box-item-partner clearfix">
                        <?php
                        if (isset($doitac)) {
                            foreach ($doitac as $keydt => $dt) {
                                ?>
                                <div class="col-md-4 col-sm-4 col-xs-6 pdd-0">
                                    <div class="img-partner clearfix">
                                        <a href="<?=$dt->url?>" title="<?=$dt->name?>"><img class="w_100" src="<?=$dt->link?>" alt="<?=$dt->name?>"/></a>
                                    </div>
                                </div>
                            <?php } } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 pdd-20">
                <h3 class="item-partner">
                    <a href="" title="">Cảm nhận khách hàng</a>
                </h3>
                <div class="slider-feedback">
                    <div id="feedback">
                        <?php
                        if (isset($comment)) {
                            foreach ($comment as $keycom => $com) {
                                ?>
                                <div class="item">
                                    <div class="box-feedback">
                                        <i><?=$com->description?>
                                        </i>
                                    </div>
                                    <div class="name-custom clearfix">
                                        <div class="col-md-3 col-sm-3 col-xs-4">
                                            <a href="javascript:void(0)" title="<?=$com->name?>"><img class="" src="<?=base_url($com->icon)?>" alt="<?=$com->name?>"/></a>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-8">
                                            <div class="custom-item">
                                                <strong><?=$com->name?></strong><br>
                                                <?=$com->title?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</article>
<!-- End Main -->