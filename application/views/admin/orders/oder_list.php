<div id="show_mss" style="position: fixed; top: 100px; right: 20px;  z-index: 9999999"></div>
<div id="page-wrapper">
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12"> 
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách đặt hàng
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
            <!--<div class="row">
                <i class="fa fa-print" aria-hidden="true"></i>
                <a href="<?/*=base_url()*/?>" target="_blank">In danh sách</a>
            </div>-->
                <div class="row">
                <div class="" >
                    <form action="" method="get" class="row">
                        <div class="col-sm-2 pull-right text-right">
                            <button type="submit" class="btn btn-sm btn-default">
                                <i class="fa fa-search"></i>  Tìm kiếm
                            </button>
                        </div>
                        <div class="col-sm-2 pull-right">
                            <input name="phone" type="search" value="<?=$this->input->get('phone');?>"
                                   placeholder="Điện thoại"
                                   class="form-control input-sm">
                        </div>
                        <div class="col-sm-2 pull-right">
                            <input name="email" type="search" value="<?=$this->input->get('email');?>"
                                   placeholder="Email"
                                   class="form-control input-sm">
                        </div>
                        <div class="col-sm-3 pull-right">
                            <input name="cutommer" type="search" value="<?=$this->input->get('cutommer');?>"
                                   placeholder="Tên khách hàng"
                                   class="form-control input-sm">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2 pull-right">
                                <input name="code" type="search" value="<?=$this->input->get('code');?>"
                                       placeholder="Mã đơn hàng"
                                       class="form-control input-sm">
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                    <style>
                        .red{background:  red}
                        .blue{background:  #4cae4c}
                    </style>
                    <table class="table  table-hover table-bordered">
                        <thead>
                            <tr class="active">
                                <th width="3%"></th>
                                <th width="3%">STT</th>
                                <th width="15%">Mã ĐH</th>
                                <th>Họ tên khách hàng</th>
                                <th width="10%">Điện thoại</th>
                                <th width="15%">Email</th>
                                <th width="10%">Ngày đặt</th>
                                <th width="7%">Trạng thái</th>
                                <th width="10%">Người duyệt</th>
                                <th width="7%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($item_list)) {
                                $stt = 1;
                                foreach ($item_list as $v) {
                                    $j=$stt++;
                                    $id_tr='id_tr'.$j;
                                    ?>
                                    <tr <?php if(($stt - 1) % 2 == 0) :?>class="active"<?php endif;?>>

                                        <td class="text-center">
                                            <i style="cursor: pointer" id="<?=$id_tr.'2';?>"
                                               data-toggle="tooltip" data-placement="right" title="Quan trọng"
                                               class="fa <?=$v->mark==0?'fa-square-o':'fa-check-square-o'?>"
                                               onclick="mark(<?=$v->id?>,<?=$v->mark?>,$(this).attr('id'))"></i>
                                        </td>

                                        <td class="text-center"><?= $j++; ?>
                                        </td>

                                        <td>
                                            <div data-items="<?=$id_tr;?>"     onclick="show_detail($(this).attr('data-items'),<?=$v->id?>,'<?=$id_tr.'1';?>',<?=$v->show?>)">
                                                 <a style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Xem chi tiết">
                                                     <i class="fa fa-caret-down" style="font-size: 11px"></i> <?= @$v->code?>
                                                 </a>
                                                <div id="<?=$id_tr.'1';?>" style="float: right; border-radius: 50%; width: 8px; height: 8px;margin-top: 6px; cursor: help"
                                                     data-toggle="tooltip" data-placement="right" title="<?=$v->show==0?'Chưa xem':'Đã xem'?>"
                                                     class="<?=$v->show==0?'red':'blue'?>"></div>
                                            </div>
                                        </td>
                                        <td><?= $v->fullname; ?>
                                        </td>
                                        <td><?= @$v->phone ?></td>
                                        <td><?= $v->email ?></td>
                                        <td><div style="font-size: 11px"><?= date('d-m-Y H:i',@$v->time) ?></div></td>
                                        <td>
                                            <div class="dropdown" id="status_<?= $v->id; ?>">

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
                                                                <span class="fa fa-caret-down"></span>
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

                                        </td>
                                        <td>
                                            <span id="user_<?=$v->id;?>">
                                                <?php if($v->approved !=''){
                                                    echo $v->approved;
                                                }else{
                                                    echo "Chưa có ai";
                                                }?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <!---Xoa--->
                                            <a href="<?= base_url('adminvn/order/Deleteorder/' . $v->id) ?>"
                                               class="btn btn-xs btn-danger" title="Xóa"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')" >
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr style="display: none" id="<?=$id_tr;?>" data-value="1">
                                        <td colspan="10">
                                            <div class="col-md-12">
                                                <h3>Thông tin chi tiết</h3>
                                                <table class="table table-bordered">

                                                    <tr>
                                                        <td colspan="4">
                                                            <p><b>Địa chỉ khách hàng:</b></p>
                                                            <p>
                                                                <?= @$v->address ?>
                                                            </p>

                                                            <p><b>Nội dung:</b></p>
                                                            <?=  @$v->note; ?>
                                                        </td>
                                                        <td   colspan="2">
                                                            <p><b>Admin ghi chú:</b></p>
                                                            <textarea id="<?='ad_note'.$v->id;?>" class="form-control"><?=@$v->admin_note;?></textarea>
                                                            <input type="button" value="Lưu" data-items="<?='ad_note'.$v->id;?>"
                                                                   onclick="add_admin_note(<?=$v->id?>,'<?='ad_note'.$v->id;?>')"
                                                                   class="btn btn-xs btn-default pull-right" style="margin-top: 5px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tên hàng</th>
                                                        <th>Số lượng</th>
                                                        <!--<th>Màu</th>
                                                        <th>Size</th>-->
                                                        <th>Đơn giá(đ)</th>
                                                        <th>Thành tiền(đ)</th>
                                                    </tr>
                                                    <?php
                                                    $tootle=0;
                                                    foreach($detail as $d){
                                                        if($d->order_id==$v->id){
                                                            $ship=$v->price_ship;
                                                            $code_sale=$v->code_sale;
                                                            print_r($code_sale);
                                                            $tootle+=$d->price_sale*$d->count;
                                                            $saleall=$tootle*$code_sale/100;
                                                            $total_sale=$tootle-$saleall+$ship;
                                                            $tootle+=$d->price*$d->count;
                                                            ?>
                                                            <tr>
                                                                <td><?=$d->name;?></td>
                                                                <td><?=$d->count;?></td>
                                                                <!--<td>
                                                                <?/*= ($d->color=='0'||$d->color=='')?'':'<div style="padding: 0px 5px ; float: left">Màu:</div> <div style="background:'.$d->color.';width: 20px; height:20px;float:left "></div> ';*/?>
                                                            </td>
                                                            <td>
                                                                <?/*= ($d->size=='0'||$d->size=='')?'':'<div style="padding: 0px 5px ; float: left">Size:</div> <div style="">'.$d->size.'</div> ';*/?>
                                                            </td>-->
                                                                <td><?=number_format($d->price_sale);?></td>
                                                                <td><?=number_format($d->price_sale*$d->count);?></td>
                                                            </tr>

                                                        <?php }
                                                    }

                                                    ?>
                                                    <tr>
                                                        <td colspan="6" class="text-right">Phí giao hàng:
                                                            <b><?=number_format($ship);?>&nbsp;đ</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-right">Mã giảm giá:
                                                            <b> - <?=($code_sale);?>&nbsp;%</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-right">Tổng giá trị đơn hàng:
                                                            <?=number_format($total_sale);?>&nbsp;đ</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } ?>
                        </tbody>
                    </table>
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
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
                </div>
            </div>
        </div>
        <script src="<?=base_url('assets/js/admin/product.js')?>"></script>
    </div>
    <!-- /.container-fluid -->
    <style>
        .label{cursor: pointer  }
    </style>
</div>