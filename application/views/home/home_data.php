<?php if(count($lists)) : ?>
    <?php foreach($lists as $pro) : ?>
        <div class="span3 product carousel_item post-1890 type-product status-publish has-post-thumbnail brand-rock product_cat-phu-kien-khac sale shipping-taxable purchasable product-type-simple product-cat-phu-kien-khac instock">
            <div class="product-image-wrapper onhover animate scale">
                <?php if($pro->price > 0 && $pro->price_sale >0) :?>
                    <div class="sale_discount img-rounded">

                        -<?=$pro->price==0?0:floor(100-($pro->price_sale/$pro->price)*100)?>%

                    </div>
                <?php endif;?>
                <div class="label_sale_top_right">Sale!</div>
                <a href="<?=base_url(@$pro->pro_alias.'.html')?>" title="<?=@$pro->pro_name;?>">
                    <img width="600" height="600" src="<?=base_url('upload/img/products/'.$pro->pro_dir.'/thumbnail_1_'.@$pro->pro_img)?>" class="attachment-shop_single wp-post-image" alt="<?=@$pro->pro_name;?>" />
                </a>
            </div>

            <div class="wrapper-hover">

                <div class="product-name">
                    <a href="<?=base_url(@$pro->pro_alias.'.html')?>" title="<?=@$pro->pro_name;?>">
                        <?=@$pro->pro_name;?>
                    </a>
                </div><a class="quickview img-circle hidden-phone hidden-small-desktop hidden-tablet" data-product-id="1890">Quick View</a>
                <div class="wrapper">


                    <div class="product-price">
                        <del><span class="amount"><?=number_format(@$pro->price)?>&nbsp;&#8363;</span></del>
                        <ins><span class="amount"><?=number_format(@$pro->price_sale)?>&nbsp;&#8363;</span></ins>
                    </div>


                    <!--<div class="product-tocart">
                        <a href="index8c69.html?add-to-cart=1890" rel="nofollow" data-product_id="1890" data-product_sku="IR 2" data-wooclass="add_to_cart_button button product_type_simple" class="wft_add_to_cart_button product_type_simple"><i class="icon-basket"></i></a>
                    </div>-->
                    <div class="clearfix"></div>
                </div><!--end wrapper-->

            </div><!--end wrappet-hover-->


            <span class="sort-date hidden">1461706696</span>
            <span class="sort-price hidden">199000</span>
            <span class="sort-product_name hidden"><?=@$pro->pro_name;?></span>
            <span class="sort-rating hidden">0</span>

        </div>
        <?php if($pro->multi_image !='') : ?>
            <?php $images = explode(',',$pro->multi_image); ?>
            <div class="preview hidden-tablet hidden-phone " style="display: none;">
                <div class="wrapper">
                    <div class="col-1">
                        <?php foreach($images as $image) : ?>
                            <a class="image" data-rel="<?=base_url('upload/img/products/'.$pro->img_dir.'/thumbnail_1_'.$image)?>" href="#">
                                <img class="thumb" alt="" src="<?=base_url('upload/img/products/'.$pro->img_dir.'/thumbnail_3_'.$image)?>" />
                            </a>
                        <?php endforeach;?>
                    </div>
                    <div class="col-2 with_media">
                        <div class="big_image">
                            <?php if($pro->price > 0 && $pro->price_sale >0) :?>
                                <div class="sale_discount img-rounded">

                                    -<?=$pro->price==0?0:floor(100-($pro->price_sale/$pro->price)*100)?>%

                                </div>
                            <?php endif;?>
                            <div class="label_sale_top_right">Sale!</div>

                            <a href="<?=base_url(@$pro->pro_alias.'.html')?>" title="<?=@$pro->pro_name;?>">
                                <img width="600" height="600" src="<?=base_url('upload/img/products/'.$pro->pro_dir.'/thumbnail_1_'.@$pro->pro_img)?>" class="attachment-shop_single wp-post-image" alt="<?=@$pro->pro_name;?>" />
                            </a>
                        </div>

                        <div class="wrapper-hover">

                            <div class="product-name">
                                <a href="<?=base_url(@$pro->pro_alias.'.html')?>" title="<?=@$pro->pro_name;?>">
                                    <?=@$pro->pro_name;?>
                                </a>
                            </div>
                            <a onclick="getModalProduct(<?=$pro->pro_id?>)"  class="quickview img-circle hidden-phone hidden-small-desktop hidden-tablet" data-product-id="1890">Quick View</a>
                            <div class="wrapper">


                                <div class="product-price">
                                    <del><span class="amount"><?=number_format(@$pro->price)?>&nbsp;&#8363;</span></del>
                                    <ins><span class="amount"><?=number_format(@$pro->price_sale)?>&nbsp;&#8363;</span></ins></div>


                                <!--<div class="product-tocart">
                                    <a href="index8c69.html?add-to-cart=1890" rel="nofollow" data-product_id="1890" data-product_sku="IR 2" data-wooclass="add_to_cart_button button product_type_simple" class="wft_add_to_cart_button product_type_simple">
                                        <i class="icon-basket"></i>
                                    </a>
                                </div>-->

                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>
    <?php endforeach;?>
<?php endif;?>
<script type='text/javascript' src='<?=base_url()?>assets/plugin/themes/buyshop/js/custom3e13.js'></script>
<script>
    resize();
</script>