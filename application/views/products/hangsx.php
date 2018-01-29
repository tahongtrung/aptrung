<?php if(count($banners)) : ?>
    <div class="banner">
        <div id="slider2_container"
             style="position: relative; top: 0px; left: 0px; width: 1349px; height: 430px; overflow: hidden;
                                  margin:0 auto; padding:0 auto">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <!--<div style="position: absolute; display: block; background: url(<?=base_url()?>assets/css/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
            </div>-->
            </div>

            <!-- Slides Container -->

            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1349px; height: 430px; overflow: hidden;">
                <?php foreach($banners as $banner) : ?>
                    <div>
                        <img u="image" src="<?=@$banner->link;?>"/>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <!-- Arrow Navigator Skin Begin -->

        <!-- Arrow Left -->
                                <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 163px; left: 0px;">
                                </span>
        <!-- Arrow Right -->
                                <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 163px; right: 0px">
                                </span>
        <!-- Jssor Slider End -->
    </div><!--end-------------------------------banner---->
<?php endif;?>
<div class="content">
    <div class="container">
        <div class="row bread-head">
            <h2 class="title-block"><?=@$cate_curent->name;?></h2>
            <div class="breadcrumb pull-right">
                <ul>
                    <li><a class="breadhome" href="<?=base_url()?>" title="<?=@$this->option->site_name;?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?=lang('home');?></a> </li>
                    <?=creat_break_crum('products',$types,$cate_curent->id)?>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="bread-content clearfix">
            <div class="col-sm-12">
                <ul>
                    <?php foreach($cate_all as $cat) : ?>
                        <li>
                            <a href="<?=base_url($cat->alias.'.html')?>">
                                <img src="<?=base_url($cat->image)?>" alt="<?=@$cat->name;?>" class="cat-img">
                                <h3><?=@$cat->name;?></h3>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="block-head clearfix">
                <div class="list-sub pull-left">
                    <ul>
                        <?php if(count($types)) : ?>
                            <?php foreach($types as $type) : ?>
                                <li><a href="<?=@$type->alias.'.html'?>"><?=@$type->name;?></a></li>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <div class="block-content clearfix">
                <?php if(count($lists)) : ?>
                    <?php foreach($lists as $list) : ?>
                        <div class="col-md-3 item">
                            <div class="item-flow">
                                <div class="image">
                                    <a href="<?=base_url(@$list->pro_alias.'.html')?>" title="<?=@$list->pro_name?>">
                                        <img src="<?=base_url('upload/img/products/'.$list->pro_dir.'/thumbnail_1_'.@$list->pro_image)?>" alt="<?=@$list->pro_name?>" class="pro-image">
                                    </a>
                                </div>
                                <h3 class="item-title"><a href="<?=base_url(@$list->pro_alias.'.html')?>" title="<?=@$list->pro_name?>"><?=@$list->pro_name?></a> </h3>
                                <span class="item-price"><?=number_format($list->price_sale)?> VNĐ</span>
                                <div class="flow-f text-center">
                                    <a href=""><img src="<?=base_url()?>assets/css/img/giohang.png"> </a>
                                    <a href="" class="btn btn-default btn-sm btn-mua">Đặt mua</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="clearfix"></div>
            <div class="text-center">
                <!---Phantrang--->
                <?php echo $this->pagination->create_links();?>
            </div>
        </div>
    </div>
</div>