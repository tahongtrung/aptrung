


<div class="clearfix"></div>
<article>
    <?=$sliders?>
    <div class="clearfix"></div>
    <div class="container">
        <div class="row_pc">

            <div class="clearfix clearfix-20"></div>

            <div class="row_8">
                <?=$sidebar?>
                <div class="col-lg-800 col-md-9 col-sm-9 col-xs-12 col-page">
                    <div class="">
                        <div class="title-sidebar tit_left col-md-12">
                            <h2>
                                <ul>
                                    <li><a href="javascript:void(0)" title="<?=@$this->option->site_name?>">TAGS</a></li>

                                </ul>
                            </h2>
                        </div><!--end title-sidebar-->
                        <div class="clearfix"></div>
                        <div class="content_right mg_minus_8 clearfix">
                            <div class="box-dv clearfix"  style="margin-top: 10px">
                                <?php if(count($lists)) : ?>
                                    <?php foreach($lists as $product) : ?>
                                        <div class="item-dv col-md-3 col-sm-4 col-xs-12">
                                            <div class="item-flow">
                                                <div class="img-item">
                                                    <a href="<?=base_url($product->pro_alias.'.html')?>" title="<?=$product->pro_name?>">
                                                        <img src="<?=base_url('upload/img/products/'.$product->pro_dir.'/thumbnail_1_'.@$product->pro_img)?>">
                                                    </a>
                                                </div><!--end img-item-->
                                                <div class="item-text">
                                                    <div class="clearfix name_item">
                                                        <a href="<?=base_url($product->pro_alias.'.html')?>" title="<?=$product->pro_name?>">
                                                            <?=$product->pro_name?>
                                                        </a>
                                                    </div>
                                                    <div class="price_prod_home">Giá:
                                                        <span class="color_ff0000">
                                                            <?=$product->price_sale!=0?number_format($product->price_sale).'VNĐ':'Liên hệ'?>
                                                        </span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <a href="<?=base_url($product->pro_alias.'.html')?>" class="view_prod_detail" title="<?=$product->pro_name?>">Chi tiết</a>
                                                </div>
                                            </div><!--end item-flow-->
                                        </div><!--end item-dv-->
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div><!--end box-sp-->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</article>