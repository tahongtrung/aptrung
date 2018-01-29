<div class="col-right col-md-3 hidden-sm hidden-xs">
    <div class="col-right1 clearfix">
        <div class="cate">
            <h2><a href="javascript:void(0)" title="Quảng cáo">Quảng cáo</a></h2>
            <ul class="quangcao">
            <?php
                if (isset($quangcao)) {
                    foreach ($quangcao as $keyqc => $qc) {
            ?>
                <li><a target="_blank" href="<?=$qc->url?>"><img src="<?=base_url($qc->link)?>" alt="<?=$qc->name?>"></a></li>
            <?php } } ?>
            </ul>
        </div>
        <div class="cate">
            <h2><a href="javascript:void(0)" title="Hỗ trợ trực tuyến">Hỗ trợ trực tuyến</a></h2>
            <div class="hotro">
                <p class="imghotro"><img src="<?=base_url()?>assets/css/img/hotro.png" alt="img hỗ trợ"></p>
                <ul class="clearfix">
                <?php
                    if (isset($supports)) {
                        foreach ($supports as $keysup => $sup) {
                ?>
                    <li class="htro clearfix">
                        
                        <div class="itemhotro">
                            <div class="col-md-9 col-sm-9 col-xs-9 row">
                                <p><span><?=$sup->name?>:</span> <?=$sup->phone?></p>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <a href="skype:call?<?=$sup->skype?>" title="skype"><img src="<?=base_url()?>assets/css/img/icon_skype.png" alt="skype"></a>
                            </div>
                        </div>
                    </li>
                <?php } } ?>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="cate">
            <h2><a href="javascript:void(0)" title="Video Clip">Video Clip</a></h2>
            <div class="videor">
                <iframe width="100%" height="200" src="https://www.youtube.com/embed/<?=$this->option->site_video?>" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="cate">
            <h2><a href="javascript:void(0)" title="tin nổi bật">Tin Nổi Bật</a></h2>
            <div class="tinnoibatl clearfix">
                <ul>
                    <?php
                        if (isset($news_home)) {
                            foreach ($news_home as $keynh => $nh) {
                    ?>
                        <li class="itemr clearfix">
                            <div class="col-md-4 col-sm-4 col-xs-4 newr">
                                <div class="row">
                                    <a href="" title="<?=$nh->title?>"><img src="<?=base_url($nh->image)?>" alt="<?=$nh->title?>"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-8 newr"><a href="" title="<?=$nh->title?>"><?=$nh->title?></a></div>
                        </li>
                        <div class="clearfix"></div>
                    <?php } } ?>
                </ul>
            </div>
        </div>
        <!-- <div class="clearfix"></div>
        <div class="cate">
            <h2><a href="" title="">Liên kết mạng xã hội</a></h2>
            <ul class="lienket col-md-12" align="center">
                <li style="border:none;"><a target="_blank" href="<?=$this->option->site_fanpage?>"><img src="<?=base_url()?>assets/css/img/iconf.png" alt=""></a></li>
                <li style="border:none;"><a target="_blank" href="<?=$this->option->link_gg?>"><img src="<?=base_url()?>assets/css/img/icong.png" alt=""></a></li>
                <li style="border:none;"><a target="_blank" href="<?=$this->option->face_id?>"><img src="<?=base_url()?>assets/css/img/iconkb.png" alt=""></a></li>
                <li style="border:none;"><a target="_blank" href="<?=$this->option->link_sky?>"><img src="<?=base_url()?>assets/css/img/iconlk.png" alt=""></a></li>
                <li style="border:none;"><a target="_blank" href="<?=$this->option->link_tt?>"><img src="<?=base_url()?>assets/css/img/iconw.png" alt=""></a></li>
            </ul>
        </div> -->
    </div>
</div>