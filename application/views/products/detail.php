
<article><!--
--><?/*=$sliders;*/?>
<div class="clearfix-25"></div>
<section class="home-center">
<div class="container">
<div class="row row-13">

<div class="col-md-9 col-sm-8 col-xs-12 pdd-13">
<div class="center-home">
<div class="back-link">
    <div class="title-left4">
        <h2>
            <ul class="breadcrumb1">
                <li><a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a></li>
                <?=creat_break_crum('products',$cate_all,$cate_current->id);?>
            </ul>
        </h2>
    </div>
</div>
<div class="prd-detail">
    <div class="row">
        <div class="col-md-5">
            <div class="img-detail">
                <img class="img-responsive" src="<?=base_url('upload/img/products/'.$pro_first->pro_dir.'/thumbnail_1_'.@$pro_first->image)?>" alt="image"/>
            </div>
        </div>
        <div class="col-md-7">
            <div class="text-detail">
                <h1 class="name-detail">
                    <?=$pro_first->name?>
                </h1>

                <p><span style="font-weight: bold;font-size: 12px;">Giá: </span> <span style="color:#ff0000;font-size: 12px;"><?=$pro_first->price_sale!=0?number_format($pro_first->price_sale).'VNĐ':'Liên hệ'?></span></p>
                <div class="row">
                    <?=$pro_first->description?>
                    <div class="col-md-12">
                        <a href="">
                            <div class="btn btn-style">
                                <a href="<?=base_url('shoppingcart/add_cart?id='.$pro_first->id)?>" title="" style="color: #fff;"><img src="img/cart-detail.png" alt=""/>
                                Mua hàng nhanh</a>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix-20"></div>
        <div class="col-md-12">
            <ul class="nav nav-tabs detail-content">
                <li class="active"><a data-toggle="tab" href="#home">Chi tiết</a></li>
                <li><a data-toggle="tab" href="#menu1">Hướng dẫn sử dụng</a></li>
            </ul>
            <div class="tab-content detail-tabs-content">
                <div id="home" class="tab-pane fade in active">
                    <?=$pro_first->detail?>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <?=$pro_first->pricing?>
                </div>
            </div>
            <div class="clearfix-20"></div>
            <div class="comment-fb">
                <div class="fb-comments" data-href="<?=base_url('products/detail?id='.$pro_first->id)?>" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix-15"></div>
<div class="category-home">
    <div class="title-left">
        sản phẩm liên quan
    </div>
    <div class="prd-home">
        <div class="row row-10">
        <?php if(count($pros)) { ?>
            <?php foreach($pros as $product) { ?>
            <div class="col-md-3 col-sm-4 col-xs-6 pdd-10">
                <div class="box-prd">
                    <div class="prd-item clearfix">
                        <a href="<?=base_url($product->pro_alias.'.html')?>" title="<?=$product->product_name?>">
                            <img class="img-responsive" src="<?=base_url('upload/img/products/'.$product->pro_dir.'/thumbnail_1_'.@$product->pro_image)?>" alt="<?=$product->product_name?>"/>
                        </a>
                    </div>

                    <div class="gia_name clearfix">
                        <h3 class="name-prd">
                            <a href="<?=base_url($product->pro_alias.'.html')?>" title="<?=$product->product_name?>"><?=$product->product_name?></a>
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
</div>
<?=$sidebar?>
<div class="clearfix-35"></div>
    <?=$leftmb?>
</div>
</div>
</section>
</article>
<!-- End Main -->









 