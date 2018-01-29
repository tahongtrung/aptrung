<?php foreach($lists as $kv => $list) : ?>
    <div class="span3 product carousel_item post-<?=@$kv;?> type-product status-publish has-post-thumbnail brand-remax product_cat-cap-sac product_tag-oto product_tag-remax sale shipping-taxable purchasable product-type-simple product-cat-cap-sac product-tag-oto product-tag-remax instock isotope-item">
        <div class="product-image-wrapper onhover animate scale animated">
            <?php if($list->price > 0 && $list->price_sale >0) :?>
                <div class="sale_discount img-rounded">

                    -<?=$list->price==0?0:floor(100-($list->price_sale/$list->price)*100)?>%

                </div>
            <?php endif;?>
            <div class="label_sale_top_right">Sale!</div>
            <a href="<?=base_url(@$list->pro_alias.'.html')?>" title="<?=@$list->pro_name?>">
                <!--<img width="600" height="486" src="<?/*=base_url(@$list->pro_image)*/?>" class="attachment-shop_single wp-post-image" alt="<?/*=@$list->pro_name*/?>">-->
                <img width="600" height="600" src="<?=base_url('upload/img/products/'.$list->pro_dir.'/thumbnail_1_'.@$list->pro_image)?>" class="attachment-shop_single wp-post-image" alt="<?=@$list->pro_name;?>" />
            </a>
        </div>

        <div class="wrapper-hover">

            <div class="product-name">
                <a href="<?=base_url(@$list->pro_alias)?>" title="<?=@$list->pro_name?>">
                    <?=@$list->pro_name?>
                </a>
            </div>
            <a class="quickview img-circle hidden-phone hidden-small-desktop hidden-tablet" data-product-id="1731">Quick View</a>
            <div class="wrapper">
                <div class="product-price">
                    <del><span class="amount"><?=number_format(@$list->price)?>&nbsp;₫</span></del>
                    <ins><span class="amount"><?=number_format(@$list->price_sale)?>&nbsp;₫</span></ins>
                </div>
                <!--<div class="product-tocart">
                            <a href="<?/*=base_url('shoppingcart/add_cart?id='.$list->id)*/?>" rel="nofollow" data-product_id="1731" data-product_sku="Car Holder" data-wooclass="add_to_cart_button button product_type_simple" class="wft_add_to_cart_button product_type_simple">
                                <i class="icon-basket"></i></a>
                        </div>-->
                <div class="clearfix"></div>
            </div>

        </div>


        <span class="sort-date hidden">1449066430</span>
        <span class="sort-price hidden">299000</span>
        <span class="sort-product_name hidden">Bộ giá đỡ điện thoại trên oto Remax Car Holder</span>
        <span class="sort-rating hidden">0</span>

    </div>

    <?php if($list->multi_image !='') : ?>
        <?php $images = explode(',',$list->multi_image); ?>
        <div class="preview hidden-tablet hidden-phone " style="top: 10px; left: -45px; display: none;">
            <div class="wrapper">

                <div class="col-1">
                    <?php foreach($images as $image) : ?>
                        <a class="image" data-rel="<?=base_url('upload/img/products/'.$list->img_dir.'/thumbnail_1_'.$image)?>" href="#">
                            <img class="thumb" alt="" src="<?=base_url('upload/img/products/'.$list->img_dir.'/thumbnail_2_'.$image)?>" />
                        </a>
                    <?php endforeach;?>
                </div>
                <div class="col-2 with_media">
                    <div class="big_image">
                        <?php if($list->price > 0 && $list->price_sale >0) :?>
                            <div class="sale_discount img-rounded">

                                -<?=$list->price==0?0:floor(100-($list->price_sale/$list->price)*100)?>%

                            </div>
                        <?php endif;?>
                        <div class="label_sale_top_right">Sale!</div>
                        <a href="<?=base_url(@$list->pro_alias.'.html')?>" title="<?=@$list->pro_name?>">
                            <!--<img width="600" height="486" src="<?/*=base_url(@$list->pro_image)*/?>" class="attachment-shop_single wp-post-image" alt="<?/*=@$list->pro_name*/?>">-->
                            <img width="600" height="600" src="<?=base_url('upload/img/products/'.$list->pro_dir.'/thumbnail_1_'.@$list->pro_image)?>" class="attachment-shop_single wp-post-image" alt="<?=@$list->pro_name;?>" />
                        </a>
                    </div>

                    <div class="wrapper-hover">

                        <div class="product-name">
                            <a href="<?=base_url(@$list->pro_alias)?>" title="<?=@$list->pro_name?>">
                                <?=@$list->pro_name?>
                            </a>
                        </div>
                        <a onclick="getModalProduct(<?=$list->pro_id?>)" class="quickview img-circle hidden-phone hidden-small-desktop hidden-tablet" data-product-id="1731">Quick View</a>
                        <div class="wrapper">


                            <div class="product-price">
                                <del><span class="amount"><?=number_format(@$list->price)?>&nbsp;₫</span></del>
                                <ins><span class="amount"><?=number_format(@$list->price_sale)?>&nbsp;₫</span></ins>
                            </div>


                            <!--<div class="product-tocart">
                                <a href="/danh-muc/cap-sac/?add-to-cart=1731" rel="nofollow" data-product_id="1731" data-product_sku="Car Holder" data-wooclass="add_to_cart_button button product_type_simple" class="wft_add_to_cart_button product_type_simple">
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
<script type='text/javascript' src='<?=base_url()?>assets/plugin/themes/buyshop/js/custom3e13.js'></script>
<script>
    resize();
</script>