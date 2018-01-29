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
<section class="content clearfix">
    <div class="container">
        <div class="row">
            <div class="breadcrumb pull-right">
                <ul>
                    <li><a class="breadhome" href="<?=base_url()?>" title="<?=@$this->option->site_name;?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?=lang('home');?></a> </li>
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp; <?=lang('order');?></a> </li>
                </ul>
            </div>
        </div>
        <div class="row">
        <div class="pro_floo clearfix">
        <div class="col-md-2 col-sm-2"  style="width: 20%">
            <div class="row">
                <div class="acount_nav">
                    <ul>
                        <li>
                            <i class="fa fa-user"></i> &nbsp;
                            <a href="<?= base_url('user-info')?>"><?=lang('user-mana');?></a>
                        </li>
                        <!--<li>
                            <i class="fa fa-heart-o"></i>
                            <a href="<?/*= base_url('acount-like')*/?>">Sản phẩm yêu thích</a>
                        </li>-->
                        <li>
                            <i class="fa fa-file-text-o"></i> &nbsp;
                            <a href="<?= base_url('acount-order')?>"> <?=lang('order');?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-sm-10"  style="width: 80%">
        <div class="acount_tit"><?=lang('order');?></div>
        <div class="clearfix-10"></div>
        <aside class="row_m">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tbody>
                    <thead>
                        <tr class="active">
                            <th width="5%">STT</th>
                            <th class="th-title" width="30%"><?=lang('code');?></th>
                            <th class="th-title" width="15%"><?=lang('date');?></th>
                            <th class="th-title" width="20%"><?=lang('status');?></th>
                            <th class="th-title text-center" width="10%"><?=lang('detail');?></th>
                        </tr>
                    </thead>
                <?php /*echo "<pre>";var_dump($item_list);die();*/?>
                <?php $stt = 1;
                foreach ($item_list as $v) {
                    $j=$stt++;
                    $id_tr='id_tr'.$j;
                        ?>
                        <tr>
                            <th class="th-title" width="5%">
                                <?= $j; ?>
                            </th>
                            <th class="th-title" width="30%">
                                <div data-items="<?=$id_tr;?>"     onclick="show_detail($(this).attr('data-items'),<?=$v->id?>,'<?=$id_tr.'1';?>',<?=$v->show?>)">
                                    <a style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Xem chi tiết">
                                        <i class="fa fa-caret-down" style="font-size: 11px"></i> <?= @$v->code?>
                                    </a>
                                    <div id="<?=$id_tr.'1';?>" style="float: right; border-radius: 50%; width: 8px; height: 8px;margin-top: 6px; cursor: help"
                                         data-toggle="tooltip" data-placement="right" title="<?=$v->show==0?'Chưa xem':'Đã xem'?>"
                                         class="<?=$v->show==0?'red':'blue'?>"></div>
                                </div>
                            </th>
                            <th class="th-title" width="15%"><?= date('d-m-Y H:i',@$v->time) ?></th>
                            <th class="th-title" width="20%">
                                <div class="" id="status_<?= $v->id; ?>">

                                    <?php $status = array(
                                        '1' => array('Hoàn thành', 'success'),
                                        '2' => array('Đã hủy', 'danger'),
                                        '0' => array('Chờ duyệt', 'primary'),
                                    );
                                    if ($v->status == 0) {
                                        foreach ($status as $k => $val) {
                                            if ($v->status == $k) {
                                                ?>
                                                <a class=" dropdown-toggle" data-toggle="dropdown"
                                                    >
                                                            <span class="label label-<?= $val[1]; ?>">
                                                                <?= $val[0]; ?>
                                                            </span>
                                                </a>
                                            <?php
                                            }
                                        }
                                    } else {
                                        ?>

                                        <span class="label label-<?= $status[$v->status][1]; ?>">
                                                                <?= $status[$v->status][0]; ?>
                                                            </span>

                                    <?php
                                    }

                                    ?>

                                    <ul class="dropdown-menu" style="min-width: 50px; padding: 5px 5px">


                                        <li>
                                                        <span  class="label label-success" data-value='1' data-item="<?=$v->id;?>" data-id="status_<?=$v->id;?>"
                                                               onclick="update_order_status($(this))"
                                                            >Hoàn thành</span>
                                        </li>
                                        <li>
                                                        <span  class="label label-danger"    data-value='2' data-item="<?=$v->id;?>" data-id="status_<?=$v->id;?>"
                                                               onclick="update_order_status($(this))"
                                                            >Hủy</span>
                                        </li>
                                    </ul>
                                </div>
                            </th>
                            <th class="th-title text-center" width="10%">
                                <div  class="btn btn-blue btn-sm text-center" >
                                    <div class="button-green" data-items="<?=$id_tr;?>"     onclick="show_detail($(this).attr('data-items'),<?=$v->id?>,'<?=$id_tr.'1';?>',<?=$v->show?>)">
                                        <a style="cursor: pointer; color: #fff" data-toggle="tooltip" data-placement="right" title="Xem chi tiết">
                                            <i class="icons icon-basket-2"></i><?=lang('detail');?>
                                        </a>
                                    </div>
                                </div>
                            </th>
                        </tr>

                        <tr style="display: none" id="<?=$id_tr;?>" data-value="1">
                            <td colspan="10">
                                <div class="col-md-12">
                                    <div style="font-size: 15px">Thông tin chi tiết</div>
                                    <table class="table table-bordered">

                                        <tr>
                                            <th >Ảnh</th>
                                            <th >Tên hàng</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá(đ)</th>
                                            <th colspan="2" >Thành tiền(đ)</th>
                                        </tr>
                                        <?php
                                        $tootle=0;
                                        foreach($detail as $d){
                                            if($d->order_id==$v->id){
                                                $ship=$v->price_ship;
                                                $tootle+=$d->price_sale*$d->count;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <img style="max-width: 100px; height: auto" src="<?= base_url('upload/img/products/'.$d->pro_dir.'/thumbnail_3_'.$d->image);?>" alt=""/>
                                                    </td>
                                                    <td><?=$d->name;?></td>
                                                    <td><?=$d->count;?></td>
                                                    <!--<td>
                                                                <?/*= ($d->color=='0'||$d->color=='')?'':'<div style="padding: 0px 5px ; float: left">Màu:</div> <div style="background:'.$d->color.';width: 20px; height:20px;float:left "></div> ';*/?>
                                                            </td>
                                                            <td>
                                                                <?/*= ($d->size=='0'||$d->size=='')?'':'<div style="padding: 0px 5px ; float: left">Size:</div> <div style="">'.$d->size.'</div> ';*/?>
                                                            </td>-->
                                                    <td><?=number_format($d->price_sale);?></td>
                                                    <td colspan="2"><?=number_format($d->price_sale*$d->count);?></td>
                                                </tr>

                                            <?php }
                                        }

                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-right"  style="color: #000;" >Tổng giá trị đơn hàng:
                                                <b  style="font-weight: bold"><?=number_format($tootle);?>&nbsp;đ</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right" style="color: #000;" >Phí giao hàng:
                                                <b style=" font-weight: bold"><?=number_format($ship);?>&nbsp;đ</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Phải thanh toán:
                                                <b  style="color: red; font-weight: bold"><?=number_format($tootle+$ship);?>&nbsp;đ</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php }?>

                </tbody>
            </table>
            <div class="text-center" style="padding: 0px 15px">
                <?php
                echo $this->pagination->create_links(); // tạo link phân trang
                ?>
            </div>
        </div>

        <div class="clearfix"></div>

        <div data-value=""></div>
        <input type="hidden" id="baseurl" value="<?=base_url();?>">
        <script>
            function show_detail(id_tr,id_order,status,show){
                if($('#'+id_tr).attr('data-value')=='1'){
                    $('#'+id_tr).show();
                    $('#'+id_tr).attr('data-value','2');
                }else{
                    $('#'+id_tr).hide();
                    $('#'+id_tr).attr('data-value','1');
                }
                if(show==0){
                    var baseurl = $('#baseurl').val();
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: baseurl + 'admin/order/update_show',
                        data: {order:id_order},
                        success: function (rs) {
                            $('#'+status).removeClass('red').addClass('blue');
                            count_order();
                        }
                    })
                }
            }
            function mark(id_order, mark, div) {

                var baseurl = $('#baseurl').val();
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: baseurl + 'admin/order/update_show',
                    data: {id_order: id_order},
                    success: function (rs) {
                        if(rs==1){
                            $('#' + div).removeClass('fa-square-o').addClass('fa-check-square-o');
                        }
                        if(rs==0){
                            $('#' + div).removeClass('fa-check-square-o').addClass('fa-square-o');
                        }

                    }
                })
            }


            function add_admin_note(id,note){
                var baseurl = $('#baseurl').val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: baseurl + 'admin/order/update_admin_note',
                    data: {id:id,note:$('#'+note).val()},
                    success: function (result) {

                        if(result.status==true){

                            var t2='<div class=" alert-ml col-xs-12 alert alert-info alert-dismissible" role="alert" style="opacity: 1 !important;  ">\
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                                +result.mess+
                                '</div>';
                            $('#show_mss').html(t2);

                            setTimeout(function(){
                                $('#show_mss').empty();
                            }, 5000)
                        }
                    }
                })
            }

            function messs () {
                setTimeout(show_mss, 2000)
            }

        </script>
        </div>

        </aside>
        </div>
        </div>
    </div>
</section>

