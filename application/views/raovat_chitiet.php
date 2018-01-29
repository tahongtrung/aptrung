
<section class="container">
<div class="fix-list"></div>
<div class="menu-detail" >
    <section class="cate-danh-muc">
        <a href="#">
            <p>Rao vặt</p>
        </a>
    </section>
</div><!---menu-detail--->
<div class="clearfix"></div>

<section class="col-xs-12">
<div class="row">
<!---End .sidebar_box_1--->
<section class="col-md-9 col-sm-12 col-xs-12" >
    <div id="loginbox" class="danhsachraovat" style="padding-top: 10px">
         <h2><?=@$item->tieude;?></h2>
        <?php if(isset($item->fullname)){?>
        <p><b>Người đăng: </b><?=@$item->fullname;?></p>
        <?php }
        if(isset($item->name)){
        ?>
        <p><b>Khu vực: </b><?=@$item->name;?></p>
        <?php }
        if(isset($item->gia_m)){
        ?>
        <p><b>Giá: </b><?=number_format(@$item->gia_m);?></p>
        <?php }
        ?>

        <p><?=@$item->noidung;?></p>

    </div><!-- .loginbox-->
</section>
    <section class="col-md-3  col-sm-12 col-xs-12">
        <div class="row">
            <section>
                <iframe style="border: none" width="100%" height="" src="https://www.youtube.com/embed/<?=$this->option->video;?>" frameborder="0" allowfullscreen></iframe>
                <div class="banner_right">
                    <?php if (isset($banner_right)) {
                        foreach ($banner_right as $item) {
                            ?>
                            <?php if ($item->url != null) echo "<a href='" . $item->url . "' target='" . $item->target . "'>"; ?>
                            <img src="<?= base_url($item->link); ?>"/>
                            <?php if ($item->url != null) echo "</a>"; ?>
                        <?php
                        }
                    }?>
                </div>
            </section>
        </div><!--end row-->
    </section>

<!---End Left------->
    <div class="col-md-8">
        <div class="row">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-comments" data-href="<?=current_url()?>" data-width="100%" data-numposts="100" data-colorscheme="light"></div>

        </div>
    </div>
</div><!--end row-->
</section>
</section>


