<div id="<?=@$id;?>" style="display: block;">
    <div class="box_sub_dv  <?php if(count($pros)&&$pros[0]->hot !=1){echo "box_sub1";} ?>">
        <?php if(count($pros)&&$pros[0]->hot !=1) : ?>
            <ul class="nav nav-tabs sub_dv">

                    <?php foreach($pros as $v => $pro) : ?>
                        <li <?php if($v==0){echo 'class="active"';}?>><a data-toggle="tab" href="#dv_room_<?=@$v+1;?>"><?=@$pro->pro_name;?></a></li>
                    <?php endforeach;?>

            </ul>
        <?php endif;?>
        <div class="tab-content">
            <?php if(count($pros)) : ?>
                <?php if($pros[0]->hot !=1) : ?>
                    <?php foreach($pros as $k => $pro1) : ?>
                        <div id="dv_room_<?=$k+1;?>" class="tab-pane fade in <?php if($k==0){echo "active";}?>">
                            <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <img class="w_100" src="<?=base_url($pro1->pro_img)?>" alt="<?=$pro1->pro_name;?>"/>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <div class="txt_cten_dv">
                                            <div class="name_room"><?=$pro1->pro_name;?></div>
                                            <div class="room-detail">
                                                <?=@$pro1->detail;?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else :?>
                        <div id="dv_room_1" class="tab-pane fade in active">
                            <div class="clearfix">
                                <?php foreach($pros as $k => $pro1) : ?>
                                    <div class="col-xs-2 col-sm-3 home-r home-r<?=@$k;?>">
                                        <div class="room-img">
                                            <img src="<?=base_url(@$pro1->pro_img);?>" alt="<?=$pro1->pro_name;?>">
                                        </div>
                                        <h3><a href="<?=@$pro1->pro_alias.'.html'?>" title="<?=$pro1->pro_name;?>"><?=$pro1->pro_name;?></a> </h3>
                                        <div class="room-des">
                                            <?=@$pro1->pro_des;?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                <?php endif; ?>
            <?php endif;?>
        </div>
    </div>
</div>