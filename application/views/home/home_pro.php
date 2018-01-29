<div id="<?=@$id;?>" style="display: block;">
    <div class="box_sub_dv">
        <ul class="nav nav-tabs sub_dv">
            <?php if(count($pros)) : ?>
                <?php foreach($pros as $v => $pro) : ?>
                    <li <?php if($v==0){echo 'class="active"';}?>><a data-toggle="tab" href="#dv_room_<?=@$v+1;?>"><?=@$pro->pro_name;?></a></li>
                <?php endforeach;?>
            <?php endif;?>
            <!--<li><a data-toggle="tab" href="#dv_room_2">Premium Deluxe</a></li>
            <li><a data-toggle="tab" href="#dv_room_3">Deluxe</a></li>
            <li><a data-toggle="tab" href="#dv_room_4">Superior</a></li>
            <li><a data-toggle="tab" href="#dv_room_5">Giá Phòng</a></li>-->
        </ul>

        <div class="tab-content">
            <?php if(count($pros)) : ?>
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
            <?php endif;?>
        </div>
    </div>
</div>