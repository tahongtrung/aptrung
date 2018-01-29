<div class="clearfix"></div>
<article>
    <?/*=$sliders*/?>
    <div class="clearfix"></div>
    <div class="container">
        <div class="row_pc">
            <div class="clearfix clearfix-20"></div>
              
                <div class="col-lg-800 col-md-9 col-sm-9 col-xs-12 col-page">

                    <div class="">
                            <div class="title-left4">
                                <h2>
                                    <ul>
                                        <li><a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a></li>
                                        <?=creat_break_crum('products',$cate_all,$cate_curent->id);?>
                                    </ul>
                                </h2>
                            </div><!--end title-sidebar-->

                            <div class="clearfix-15"></div>
                    
                            <div class="prd-home">
                                <div class="row row-10">
                                    <?php 
                                    if(count($lists)){
                                        foreach($lists as $product){
                                            ?>
                                    <div class="col-md-3 col-sm-4 col-xs-6 pdd-10">
                                        <div class="box-prd">
                                            <div class="prd-item clearfix">
                                                <a href="<?=base_url($product->pro_alias.'.html')?>" title="<?=$product->pro_name?>"><img class="img-responsive" src="<?=base_url('upload/img/products/'.$product->pro_dir.'/thumbnail_1_'.@$product->pro_image)?>" alt="<?=$product->pro_name?>"/></a>
                                            </div>

                                            <div class="gia_name clearfix">
                                                <h3 class="name-prd">
                                                    <a href="<?=base_url($product->pro_alias.'.html')?>" title="<?=$product->pro_name?>"><?=$product->pro_name?></a>
                                                </h3>
                                                <p><span style="font-weight: bold;font-size: 12px;">Giá: </span> <span style="color:#ff0000;font-size: 12px;"><?=$product->price_sale!=0?number_format($product->price_sale).'VNĐ':'Liên hệ'?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>
                    </div>
                </div>
  <?=$sidebar?>
                <?=$leftmb?>

        </div>
    </div>


</article>