<div class="clearfix"></div>
<article>
<div class="box_service_home">
    <div class="container">
        <div class="row_pc">
            <div class="txt_sevice new-title">
                <?=@$cate_curent->name;?>
            </div>
            <div class="list_4">
                <div class="tab_hdoder tab-pro">
                </div>
            </div>
            <div class="show_content-pro box-dv">
                <div class="tab-content">
                    <div id="breadcrumb" class="title-pro">
                        <a href="<?=base_url()?>"><?=lang('home');?></a>
                        <?php echo creat_break_crum('news',$cate,$cate_curent->id);?>
                    </div>
                    <div id="dv_room_1" class="tab-pane fade in active">
                        <div class="box_sub_dv1 clearfix">
                            <ul class="owl"><?php /*echo "<pre>";var_dump($news_home);die();*/?>
                                <?php foreach($news_bycate as $new) : ?>
                                    <li class="col-md-3">
                                        <div class="item-inner">
                                            <div class="box_promo">
                                                <a onclick="getValue(<?=@$new->cat_id?>)" href="<?=base_url($new->alias)?>" title="<?=@$new->title;?>">
                                                    <img class="w_100" src="<?=base_url(@$new->image)?>" alt="<?=@$new->title;?>"/>
                                                </a>
                                                <div class="clearfix"></div>
                                                <div class="sub_promo_home">
                                                    <div class="tit_promo_home text-center">
                                                        <a onclick="getValue(<?=@$new->cat_id?>)" href="<?=base_url($new->alias)?>" title="<?=@$new->title;?>">
                                                            <?=@$new->name;?>
                                                        </a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div class="text-center">
                            <?=$this->pagination->create_links();?>
                        </div>
                    </div>
                </div
            </div>
        </div>
    </div>
</div>
</article>