<div class="clearfix"></div>

<article class="content">
    <div class="container">
        <div class="row_pc">
        <?php
            if (isset($cat_home)) {
                foreach ($cat_home as $keych => $ch) {
        ?>
            <div class="block-home">

                <div class="tit_home">
                    <div class="bg_tit_home">
                    </div>
                    <h2 class="title-text">
                        <a href="<?=base_url($ch->alias.'.html')?>" title="<?=$ch->name?>">
                            Sản phẩm <?=$ch->name?> nổi bật
                        </a>
                    </h2>
                </div>
                <div class="clearfix"></div>
                <div class="ma-onsaleproductslider-container<?=$keych?> block-content module-top list_tltk_home">
                    <div class="row_pc">
                        <ul class="owl">
                        <?php
                            if ($pro_focus) {
                                $count  = 0;
                            ?>


                            <?php
                                foreach ($pro_focus as $keypf => $pf) {

                                    if ($pf->category_id==$ch->id) {
                                    $count +=1;
                                ?>
                                <?php if($keypf % 2 == 0) : ?>
                                    </li>
                            <li class='onsaleproductslider-item item'>
                                <?php endif;?>
                                    <div class="item-inner">
                                        <div class="box_tltk_home">
                                            <a class="h_663 img_tltk_home" href="<?=base_url($pf->pro_alias.'.html')?>" title="<?=$pf->pro_name?>">
                                                <img class="w_100" src="<?=base_url('upload/img/products/'.$pf->pro_dir.'/thumbnail_1_'.@$pf->pro_img)?>" alt="<?=$pf->pro_name?>">
                                            </a>
                                            <div class="item-info">
                                                <div class="name_tltk_home">
                                                    <a href="<?=base_url($pf->pro_alias.'.html')?>" title="<?=$pf->pro_name?>"><?=$pf->pro_name?></a>
                                                </div>
                                                <div class="price-info text-center">
                                                    Giá : <span class="price-text"><?=$pf->price?> đ<span>
                                                </span></span></div>
                                                <div class="des_tltk_home text-center">
                                                    <a href="<?=base_url($pf->pro_alias.'.html')?>" title="<?=$pf->pro_name?>" class="btn btn-sm btn-default btn-detail">Chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php } }
                        ?>

                        <?php
                        } ?>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $jq(document).ready(function () {
                            $jq(".ma-onsaleproductslider-container<?=$keych?> .owl").owlCarousel({
                                autoPlay: true,
                                items: 5,
                                loop: true,
                                margin: 20,
                                itemsDesktop: [1199, 4],
                                itemsDesktopSmall: [980, 3],
                                itemsTablet: [768, 2],
                                itemsMobile: [480, 1],
                                slideSpeed: 1000,
                                paginationSpeed: 3000,
                                rewindSpeed: 3000,
                                navigation: true,
                                stopOnHover: true,
                                pagination: false,
                                scrollPerPage: false,

                            });
                        });
                    </script>
                </div>

                <div class="clearfix"></div>
            </div>

        <?php } } ?>


        </div>
    </div>
    <!---Bao gia-->
    <div id="parallax_container" class="adamrob_parallax">
        <h4 class="wow wow-title bounceInLeft">Báo giá</h4>
        <p class="wow wow-text bounceInRight">
            Điền thông tin để nhận báo giá chính xác nhất
        </p>
        <div class="form-1">
            <form method="post" class="validate" name="getmail" id="getmail" action="http://teambuildingmienbac.com/contact/getMail">
                <div class="input-group group" style="position: relative; z-index: 99">
                    <input type="text" class="form-control search" name="email" placeholder="Nhập email của bạn" style="">
                                            <span class="input-group-btn group-btn">
                                                <button class="btn btn1" type="submit">
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;Đăng ký
                                                </button>
                                            </span>
                </div>
            </form>
        </div>
    </div>
</article>







<div class="clearfix"></div>

<article class="content">
    <div class="container">
        <div class="row_pc">

            <?php
            if (isset($cat_home)) {
                foreach ($cat_home as $keych => $ch) {
                    ?>

                    <div class="block-home">

                        <div class="tit_home">
                            <div class="bg_tit_home">
                            </div>
                            <h2 class="title-text">
                                <a href="">
                                    <?=$ch->name?>
                                </a>
                            </h2>
                        </div>
                        <div class="clearfix"></div>
                        <div class="ma-onsaleproductslider-container<?=$keych?> block-content module-top list_tltk_home">
                            <div class="row_pc">
                                <ul class="owl">
                                    <?php
                                    if (isset($pro_focus)) {
                                        $dem=-1;
                                        foreach ($pro_focus as $keypf => $pf) {
                                            $dem++;
                                            if ($pf->category_id==$ch->id && $keypf%2==0) {

                                                ?>
                                                <li class='onsaleproductslider-item item'>
                                                    <?php
                                                    $dem1=$dem;
                                                    foreach ($pro_focus as $keypf1 => $pf1) {
                                                        if ($pf1->category_id==$ch->id && $keypf1==$dem1) {
                                                            ?>
                                                            <div class="item-inner">
                                                                <div class="box_tltk_home">
                                                                    <a class="h_663 img_tltk_home" href="<?=base_url($pf1->pro_alias.'.html')?>" title="<?=$pf1->pro_name?>">
                                                                        <img class="w_100" src="<?=base_url('upload/img/products/'.$pf1->pro_dir.'/thumbnail_1_'.@$pf1->pro_img)?>" alt="<?=$pf1->pro_name?>">
                                                                    </a>
                                                                    <div class="item-info">
                                                                        <div class="name_tltk_home">
                                                                            <a href="<?=base_url($pf1->pro_alias.'.html')?>" title="<?=$pf1->pro_name?>"><?=$pf1->pro_name?></a>
                                                                        </div>
                                                                        <div class="price-info text-center">
                                                                            Giá : <span class="price-text">Liên hệ<span>
                                                </span></span></div>
                                                                        <div class="des_tltk_home text-center">
                                                                            <a href="<?=base_url($pf1->pro_alias.'.html')?>" title="<?=$pf1->pro_name?>" class="btn btn-sm btn-default btn-detail">Chi tiết</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if($dem1%2!=0){break;} $dem1++; } } ?>


                                                </li>
                                            <?php } } } ?>

                                </ul>
                            </div>
                            <script type="text/javascript">
                                $jq(document).ready(function () {
                                    $jq(".ma-onsaleproductslider-container<?=$keych?> .owl").owlCarousel({
                                        autoPlay: true,
                                        items: 5,
                                        loop: true,
                                        margin: 20,
                                        itemsDesktop: [1199, 4],
                                        itemsDesktopSmall: [980, 3],
                                        itemsTablet: [768, 2],
                                        itemsMobile: [480, 1],
                                        slideSpeed: 1000,
                                        paginationSpeed: 3000,
                                        rewindSpeed: 3000,
                                        navigation: true,
                                        stopOnHover: true,
                                        pagination: false,
                                        scrollPerPage: false,

                                    });
                                });
                            </script>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                <?php } } ?>



        </div>
    </div>
    <!---Bao gia-->
    <div id="parallax_container" class="adamrob_parallax">
        <h4 class="wow wow-title bounceInLeft">Báo giá</h4>
        <p class="wow wow-text bounceInRight">
            Điền thông tin để nhận báo giá chính xác nhất
        </p>
        <div class="form-1">
            <form method="post" class="validate" name="getmail" id="getmail" action="<?=base_url('lien-he')?>">
                <div class="input-group group" style="position: relative; z-index: 99">
                    <input type="text"  style="z-index: 0;"  placeholder="Nhập email của bạn"
                           name="email" class="validate[required,custom[email]] form-control placeholder" id="email"
                           data-original-title="Your activation email will be sent to this address."
                           data-bind="value: email, event: { change: checkDuplicateEmail }">
                                            <span class="input-group-btn group-btn">
                                                <button class="btn btn1" type="submit" name="sendcontact" id="signupuser">
                                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;Đăng ký
                                                </button>
                                            </span>
                </div>
            </form>
        </div>
    </div>
</article>