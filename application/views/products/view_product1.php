<div class="container content-detail">
    <div class="row">
        <section class="col-md-8 col-xs-12 detail-left">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?=base_url()?>" title="Trang chủ">Trang chủ</a></li>
                    <li><a href="javascript:void(0)">  <?=@$pro_first->name;?> </a></li>        </ol>
            </div>
            <!----thumbimage------------>
            <div class="row">
                <h1 class="detail-title"><?=@$pro_first->name;?></h1>
                <div style="display: block" class="block-view-pro">
                    <div id="slider1_container" style="position: relative; width: 500px;
                                        height: 350px; overflow: hidden">
                        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:
                                    500px; height: 350px;
                                            overflow: hidden;">
                            <div>
                                <img u="image" src="<?=@$pro_first->image;?>" style="width: 100%;height: auto"/>
                                <?php if(count($product_img)) : ?>
                                    <?php foreach($product_img as $img) : ?>
                                        <img u="thumb" src="<?=base_url($img->link)?>" alt="<?=@$img->title;?>" style="width: 100%;height: auto"/>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                        </div>

                        <!-- Thumbnail Navigator Skin Begin -->
                        <div u="thumbnavigator" class="jssort07" style="position: absolute; width: 500px;
                                    height: 70px; left: 0px; bottom: 0px; overflow: hidden; ">
                            <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>
                            <!-- Thumbnail Item Skin Begin -->

                            <div u="slides" style="cursor: move;">
                                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 99px; HEIGHT: 66px; TOP: 0; LEFT: 0;">
                                    <thumbnailtemplate class="i" style="position:absolute;"></thumbnailtemplate>
                                    <div class="o">
                                    </div>
                                </div>
                            </div>
                            <!-- Thumbnail Item Skin End -->
                            <!-- Arrow Navigator Skin Begin -->

                            <!-- Arrow Left -->
                                            <span u="arrowleft" class="jssora11l" style="width: 37px; height: 37px; top: 123px; left: 8px;">
                                            </span>
                            <!-- Arrow Right -->
                                            <span u="arrowright" class="jssora11r" style="width: 37px; height: 37px; top: 123px; right: 8px">
                                            </span>
                            <!-- Arrow Navigator Skin End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cf">
                <div class="col-md-4 cfl">
                    <!--<div class="detail-giamoi">
                <span><?/*=number_format($pro_first->price_sale)*/?>đ</span>
            </div>
            <div class="detail-giacu">
                <?/*=number_format($pro_first->price)*/?>đ
            </div>-->
                </div>
                <div class="col-md-4 cfc">
                    <div class="detail-mua">
                        <a href="<?=base_url('shoppingcart/add_cart?id='.$pro_first->id)?>"  class="add-to-cart">
                            Mua ngay
                        </a>
                    </div>
                </div>
                <div class="md-4 cfr">
                    <div class="bold">
                                    <span>
                                        <?=@$pro_first->bought;?>
                                        &nbsp;Lượt mua</span>&nbsp;/&nbsp;<span><?=@$pro_first->view;?>  &nbsp;Lượt xem</span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="block-detail1">
                    <h3>Chi tiết</h3>
                    <div>
                        <?=@$pro_first->detail;?>
                    </div>

                </div>
            </div>

        </section>
        <section class="col-md-4 col-sm-12 col-xs-12 detail_ls">
            <div class="block-left">
                <div class="sale-title clearfix">
                    <h2>Sản phẩm bán chạy</h2>
                </div>
                <div class="block-left-content clearfix">
                    <ul>
                        <?php if(count($pro_sale)) : ?>
                            <?php foreach($pro_sale as $sale) : ?>
                                <li class="col-xs-12">
                                    <!--<h3>
                            <a href="<?/*= base_url($sale->pro_alias.'.html') */?>" title="<?/*$sale->pro_name;*/?>">
                                <?/*=@$sale->pro_name;*/?>
                                <?php /*if($sale->price > 0 && $sale->price_sale > 0) :*/?>
                                    &nbsp;-&nbsp;
                                    Giảm
                                    <span style="color: red">
                                                    <?/*=floor(100-($sale->price_sale/$sale->price)*100)*/?>%
                                                </span>
                                <?php /*endif;*/?>
                            </a>
                        </h3>-->
                                    <div class="sale-content">
                                        <a href="<?= base_url($sale->pro_alias.'.html')?>" title="<?$sale->pro_name;?>">
                                            <img src="<?=base_url($sale->pro_img)?>" alt="<?=@$sale->name;?>">
                                        </a>
                                        <p class="sale-text">
                                            <!--Chỉ <span style="color:red"><?/*=number_format($sale->price_sale)*/?>đ</span>
                                được <?/*=@$sale->pro_name*/?> trị giá <?/*=@$sale->price;*/?>đ.
                                Tiết kiệm <span style="color:#00f "><?/*=number_format($sale->price-$sale->price_sale)
                                    */?>đ<span>-->
                                            <a href="<?= base_url($sale->pro_alias.'.html') ?>" title="<?$sale->pro_name;?>">
                                                <?=@$sale->pro_name;?>
                                            </a>
                                            <?php if($sale->price == 0 || $sale->price =='') : ?>
                                        <div class="price">
                                            Giá : Liên hệ
                                        </div>
                                        <?php else : ?>
                                            <div class="price">
                                                Giá :<span><?=number_format(@$sale->price);?></span>&nbsp;đ
                                            </div>
                                        <?php endif;?>
                                        </p>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
            </div>

            <div class="clearfix"></div>
        </section><!---End sản pham ban chay--->
    </div>
</div>