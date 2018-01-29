
<div class="col-center col-md-9">
    <div class="noi-bat col-md-12 col-sm-12">
        <div class="tit-lich">
            <a href="" title="" class="link1">Trang chủ</a>
            <a href="" title="" class="link2">Search</a>
        </div><!--tit-lich-->
        <div class="lich-content col-md-12 col-sm-12">
            <div class="box-item">
                <?php  if(isset($lists)){
                    foreach($lists as $lis){?>
                        <div class="item col-md-4 col-sm-4">
                            <div class="item-img ">
                                <a href="<?=base_url($lis->cate_alias.'/'.$lis->pro_alias.'-c'.$lis->cate_id.'p'.$lis->pro_id)?>" title="">
                                    <img src="<?=base_url($lis->pro_img)?>" alt="abc">
                                </a>
                            </div>
                            <div class="text-img ">
                                <a href="<?=base_url($lis->cate_alias.'/'.$lis->pro_alias.'-c'.$lis->cate_id.'p'.$lis->pro_id)?>" title=""><?=$lis->pro_name?></a>
                                <p>
                                    Thời gian: <?=$lis->itinerary?> ngày<br>
                                    <!--Ngày khởi hành: Theo từng tour<br>-->
                                    Giá: <span style="color:#e00c0c; font-weight:bold;"><?=number_format($lis->price)?> VND</span><br>


                                </p>
                            </div>
                        </div><!--end item-content-->
                    <?php }}?>
            </div><!--en box-item-->

        </div>
    </div>
</div>