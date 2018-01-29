<section class="content clearfix">
    <div class="container">
        <div class="creatcate clearfix">
            <ul align="right">
                <div clearfix>
                    <li><a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a></li>
                    <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>  <a href="javascript:void(0)" title="Sản phẩm nổi bật">Sản phẩm nổi bật</a></li>
                </div>
            </ul>
        </div>

        <div class="bg_maincontain clearfix" style="background:#fff;margin-bottom:15px;">

            <?=@$sidebar;?>

            <div class="main-content col-md-9 col-sm-12 col-xs-12">
                <div class="tit_home">
                    <h2 class="title-text catetour">
                        <ul>
                            <li><a href="javascript:void(0)" title="Sản phẩm nổi bật">Sản phẩm nổi bật</a></li>
                        </ul>
                    </h2>
                </div>
                <div class="col-md-12 block-content clearfix">
                    <div class="row">
                        <?php if(count($lists)) : ?>
                            <?php foreach($lists as $list) : ?>
                                <div class="col-md-4 col-xs-6 col-sm-6 item">
                                    <div class="item-flow">
                                        <div class="image">
                                            <a href="<?=base_url(@$list->pro_alias.'.html')?>" title="<?=@$list->pro_name?>">
                                                <img src="<?=base_url('upload/img/products/'.$list->pro_dir.'/thumbnail_1_'.@$list->pro_img)?>" alt="<?=@$list->pro_img?>" class="pro-image">
                                            </a>
                                            <span class="tuorhot">Hot</span>
                                            <span class="day"><?=$list->code?> Ngày</span>
                                        </div>
                                        <div class="nametour clearfix">
                                            <h3 class="item-title"><a href="<?=base_url(@$list->pro_alias.'.html')?>" title="<?=@$list->pro_name?>"><?=@$list->pro_name?></a> </h3>
                                            <p></p>
                                            <?php
                                            if ($list->price !=0) {
                                            ?>
                                            <san style="color:#000;font-weight:bold;">Giá: <span class="item-price" style="color:#444;text-decoration: line-through;"><?=number_format($list->price)?> VNĐ</span>
                                                <?php }else{
                                                    echo "";
                                                } ?>
                                                <div class="clearfix"></div>
                                                <san style="color:#000;font-weight:bold;">Giá hiện tại: <span class="item-price" style="color:red;"><?=$list->price_sale!=0?number_format($list->price_sale).'VNĐ':'Liên hệ'?></span>
                                                    <!-- <div class="flow-f text-center">
                                                <a href="<?=base_url('shoppingcart/add_cart?id='.$list->id)?>"><img src="<?=base_url()?>assets/css/img/giohang.png"> </a>
                                                <a href="<?=base_url('shoppingcart/add_cart?id='.$list->id)?>" class="btn btn-default btn-sm btn-mua">Đặt mua</a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    <div class="clearfix text-center">
                        <?php echo $this->pagination->create_links();?>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>

    </div>
</section>








 