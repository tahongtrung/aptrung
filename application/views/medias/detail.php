<div class="clearfix"></div>
<article>
    <div class="box_service_home">
        <div class="container">
            <div class="row_pc">
                <div class="txt_sevice new-title">
                    <?=@$news->name;?>
                </div>
                <div class="list_4">
                    <div class="tab_hdoder tab-pro">
                    </div>
                </div>
                <div class="show_content-pro box-dv">
                    <div class="tab-content">
                        <div id="breadcrumb" class="title-pro">
                            <a href="<?=base_url()?>"><?=lang('home');?></a>
                            <?php echo creat_break_crum('news',$cate,$cate_current->id);?>
                            <i class="fa fa-angle-double-right"></i>
                            <a href="javascript:void(0)"><?=@$news->name;?></a>
                        </div>
                        <div id="dv_room_1" class="tab-pane fade in active">
                            <div class="box_sub_dv1 clearfix">
                                <ul class="owl"><?php /*echo "<pre>";var_dump($news_home);die();*/?>
                                    <?php foreach($images as $new) : ?>
                                        <li class="col-md-3">
                                            <div class="item-inner">
                                                <div class="box_promo">
                                                    <a class="group3"  href="<?=base_url($new->link)?>" title="<?=@$new->title;?>">
                                                        <img class="w_100" src="<?=base_url(@$new->link)?>" alt="<?=@$new->title;?>"/>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                    <div class="sub_promo_home">
                                                        <div class="tit_promo_home text-center">
                                                            <a class="group3" href="<?=base_url($new->link)?>" title="<?=@$new->title;?>">
                                                                <?=@$new->title;?>
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
<link href="<?=base_url()?>assets/plugin/colorbox/colorbox.css" rel="stylesheet"/>
<script type="text/javascript" src="<?=base_url()?>assets/plugin/colorbox/jquery.colorbox.js"></script>
<script>
    $(document).ready(function(){
        //$(".group2").colorbox({rel:'group2', transition:"fade"});
        $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
        //$(".group4").colorbox({rel:'group4', slideshow:true});
    });
</script>