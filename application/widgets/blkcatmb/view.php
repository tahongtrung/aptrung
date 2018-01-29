<div class="col-md-3 col-sm-4 visible-xs pdd-13 col-left">
    <div class="left-center">

        <div class="title-left1 dmleft">
            <a href="javascript:void()" title="Danh mục sản phẩm">Danh mục sản phẩm</a>
        </div>
        <ul class="menu-category left_dm">
            <?php
            if (isset($cate_root)) {
                foreach ($cate_root as $keycr => $cs) {
                    ?>
            <li><a href="<?=base_url($cs->alias.'.html')?>" title="<?=$cs->name?>"><img src="<?=base_url()?>img/icon-menu-left.png" alt="<?=$cs->name?>"/><?=$cs->name?></a></li>
        <?php } } ?>
        </ul>
        <div class="clearfix-15"></div>
        <div class="title-left dmleft">
            Sản phẩm nổi bật
        </div>
        <div class="">
            <ul class="partner left_dm">
                <?php
                if (isset($product_focus)) {
                    foreach ($product_focus as $keydt => $dt) {
                        ?>
                        <li>
                            <a href="<?=base_url($dt->alias.'.html')?>" title="<?=$dt->name?>"><img class="img-responsive" src="<?=base_url('upload/img/products/'.$dt->pro_dir.'/thumbnail_1_'.@$dt->image)?>" alt="<?=$dt->name?>"/>
                            </a>
                            <div class="gia_name clearfix">
                                <h3 class="name-prd">
                                    <a href="<?=base_url($dt->alias.'.html')?>" title="<?=$dt->name?>"><?=$dt->name?></a>
                                </h3>
                            </div>
                        </li>
                    <?php } } ?>

            </ul>
        </div>

        <div class="clearfix-15"></div>

        <div class="title-left dmleft hidden-xs">
            Tin tức nổi bật
        </div>
        <div class="hidden-xs">
            <ul class="news_l clearfix left_dm">
                <?php
                if (isset($newfocus)) {
                    foreach ($newfocus as $keydt => $news) {
                        ?>
                        <li>
                        <div class="col-ms-3 col-sm-3 imgleftnewws">
                            <a href="<?=base_url($news->alias.'.html')?>" title="<?=$news->title?>"><img class="img-responsive" src="<?=base_url($news->image)?>" alt="<?=$news->title?>"/></a>
                        </div>
                        <div class="newsleft clearfix col-md-9 col-sm-9">
                            <h3 class="title-prd">
                                <a href="<?=base_url($news->alias.'.html')?>" title="<?=$news->title?>"><?=LimitString($news->title,60,'...')?></a>
                            </h3>
                        </div>
                        <div class="clearfix"></div>
                        </li>
                    <?php } } ?>

            </ul>
        </div>

        <div class="clearfix-15"></div>
        <div class="title-left dmleft">
            hỗ trợ trực tuyến
        </div>
        <div class="box-sp left_dm">
            <div class="number-sp">
                <ul class="suptop">
                    <li>
                        <span><img src="<?=base_url()?>assets/css/img/iconphone.png" alt="iconphone"></span><span style="color: #fe5400;font-weight: bold;font-size: 14px;font-family: 'UTMAvoBold';">Hotline: <?=$this->option->hotline1?></span>
                    </li>
                    <li>
                        <span><img src="<?=base_url()?>assets/css/img/iconmail.png" alt="iconphone"></span><span style="color: #00527b;font-size: 12px;font-family: 'UTMAvo';">Email: <?=$this->option->site_email?></span>
                    </li>
                </ul>
            </div>
            <ul class="list-sp hotro_left hidden">
            <?php
                if (isset($supports)) {
                    foreach ($supports as $keysup => $sup) {
            ?>
                <li>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="name-sp supname">
                                <a class="number-list-sp" href="tel:<?=$sup->phone?>" title="<?=$sup->phone?>">
                                    <span><?=$sup->name?>:</span><span style="color: #f90505;margin-left: 8px;"><?=$sup->phone?></span>
                                </a>
                            </div>
                            

                            <!-- <div class="clearfix"></div>
                            <a href="javascript:void(0)" title="<?=$sup->email?>" class="mail-list-sp"><?=$sup->email?></a> -->
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a href="skype:<?=$sup->skype?>?chat" title="skype"><img class="img-responsive" src="<?=base_url()?>img/skype.png" alt="skype"/></a>

                            <div class="clearfix-10"></div>
                        </div>
                        
                    </div>
                </li>
            <?php } } ?>
            </ul>
        </div>
        <div class="clearfix-15"></div>
       
    </div>
</div>