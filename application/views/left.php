<section class="khungchinh" style="margin-top: 10px">
    <div class="container">
        <div class="row">
            <div class="col-md-3 left">
                <div class="box-moblie visible-xs">
                    <form><select onchange="if (this.value) window.location.href=this.value">
                            <option value="">Danh mục sản phẩm</option>
                            <option value="">Máy sản xuất cửa nhựa</option>
                            <option value="">Máy sản xuất cửa nhôm</option>
                            <option value="">Linh kiện máy thay thế</option>
                            <option value="">Giàn khoan bắt lỗ chờ</option>
                        </select></form>
                </div>
                <div class="boxx hidden-xs">
                    <div class="top">
                        <h2><i class="icon-star-empty"></i>danh mục sản phẩm 1</h2>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="danhmuc">
                        <?php
                        if (isset($cate_root)) {
                        foreach ($cate_root as $keycr => $cs) {
                        ?>
                        <li class="menu-item"><a href="<?=base_url($cs->alias.'.html')?>" title="<?=$cs->name?>" class="bord"><?=$cs->name?></a> </li>

                        <ul class="menu-child">
                            <?php
                            if (isset($cate_sub1) ) {
                            
                            foreach ($cate_sub1 as $keycr => $cs1) {
                            if($cs1->parent_id == $cs->id){
                            ?>
                                <li>
                                    <a href="<?=base_url($cs1->alias.'.html')?>" title="<?=$cs1->name?>"><i class="icon-double-angle-right"></i><?=$cs1->name?></a>
                                </li>
                            <?php } } } ?>
                        </ul>
                        <?php } } ?>
                    </ul>

                </div>
                <div class="clearfix"></div>
                <div class="boxx video hidden-xs" style="margin-top: 10px">
                    <div class="boder">
                        <h2><i class="icon-star-empty"></i>video</h2>
                    </div>
                    <div class="clearfix"></div>
                    <a><img src="img/video.png"></a>
                </div>
                <div class="clearfix"></div>
                <div class="boxx support hidden-xs" style="margin-top: 10px">
                    <div class="boder">
                        <h2><i class="icon-star-empty"></i>hỗ trợ trực tuyến</h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="info">
                        <label><img src="img/hotline.png" style="padding: 0px 10px 0px 30px"><span><?=($this->option->hotline2)?></span></label>
                        <label style="padding: 0px 18px;"><i class="icon-envelope" style="color: silver"></i>  <?=($this->option->site_email)?></label><br>
                        <ul>
                            <li>
                                <label><i class="icon-double-angle-right"></i></label>        Kinh doanh 1<a href=""><img src="img/zalo.jpg"><span><img src="img/skype.jpg"></span></a>
                                <p><?=($this->option->hotline1)?></p>
                            </li>
                            <li>
                                <label><i class="icon-double-angle-right"></i></label>        Kinh doanh 2<a href=""><img src="img/zalo.jpg"><span><img src="img/skype.jpg"></span></a>
                                <p><?=($this->option->hotline2)?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="boxx sanpham hidden-xs" style="margin-top: 10px">
                    <div class="boder">
                        <h2><i class="icon-star-empty"></i>sản phẩm xem nhiều</h2>
                    </div>
                    <div class="clearfix"></div>
                    <ul>
                        <?php
                        if (isset($product_view)) {
                        foreach ($product_view as $keydt => $dt) {
                        ?>
                        <li>
                            <img src="<?=base_url('upload/img/products/'.$dt->pro_dir.'/thumbnail_1_'.@$dt->image)?>">
                            <label>Mã sản phẩm: <?=$dt->name?></label>
                        </li>
                        <?php } } ?>
                    </ul>
                </div>
            </div>