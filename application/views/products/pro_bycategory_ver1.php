<div class="product col-md-9">
    <div class="title title-sp">
        <a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a>
        <?php echo creat_break_crum('products',$cate,@$cate_curent->id);?>
        <!--<a href="<?/*=base_url($cate_curent->alias.'.html');*/?>" title="<?/*=$cate_curent->name;*/?>">
                <?/*=@$cate_curent->name;*/?>
            </a>--><i class="fa fa-angle-down"></i>
    </div><!--end title-->
    <div class="block-item">
        <?php if(count($lists)) : ?>
            <?php foreach($lists as $list) : ?>
                <div class="item-sp col-md-4 col-sm-6 col-xs-6">
                    <div class="item-flow clearfix">
                        <div class="item">
                            <a href="<?= base_url($list->pro_alias.'.html'); ?>" title="<?=@$list->pro_name;?>">
                                <img src="<?= base_url($list->pro_image); ?>" alt="<?=@$list->pro_name;?>">
                            </a>
                        </div>
                        <div class="item-info">
                            <h3>
                                <a href="<?= base_url($list->pro_alias.'.html'); ?>" class="link1" title="<?=@$list->pro_name;?>">
                                    <?=@$list->pro_name;?>
                                </a>
                            </h3>
                            <!--<span class="price"><?/*=number_format($list->price)*/?><sup>đ</sup><br>
                                        <del><?/*=number_format($list->price)*/?><sup>đ</sup></del>
                                    </span>-->
                            <?php if($list->price == 0 || $list->price =='') : ?>
                                <div class="price text-center">
                                    Giá : Liên hệ
                                </div>
                            <?php else : ?>
                                <div class="price text-center">
                                    Giá :<span><?=number_format(@$list->price);?></span>&nbsp;đ
                                </div>
                            <?php endif;?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="btn-muangay">
                            <button <?=base_url('shoppingcart/add_cart?id='.$list->id)?>
                                class="btn btn-primary btn-buy btn-xs pull-left">
                                <i class="fa fa-shopping-cart"></i>&nbsp;Mua Ngay
                            </button>
                            <a href="<?= base_url($list->pro_alias.'.html'); ?>"
                               title="<?=@$list->pro_name;?>" class="pull-right">
                                Chi tiết&nbsp;<i class="fa fa-angle-double-right"></i>
                            </a>
                        </div>
                        <!--<span class="percent">
                                                                        -%
                                                                </span>-->
                    </div>
                </div><!--end item-->
            <?php endforeach;?>
        <?php endif;?>
    </div>
    <div class="clearfix"></div>
    <div class="text-center">
        <?php
        echo $this->pagination->create_links(); // tạo link phân trang
        ?>
    </div>
</div>