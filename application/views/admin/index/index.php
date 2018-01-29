

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->


<!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php if($news == null || $news==0) echo 0; else echo $news;?></div>
                        <div>Tin tức</div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('adminvn/danh-sach-tin-tuc')?>">
                <div class="panel-footer">
                    <span class="pull-left">Xem thêm</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php if($products == null || $products==0) echo 0; else echo $products;?></div>
                        <div>Sản phẩm</div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('adminvn/danh-sach-san-pham')?>">
                <div class="panel-footer">
                    <span class="pull-left">Xem thêm</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$count_order;?></div>
                        <div>Đơn hàng mới!</div>
                    </div>
                </div>
            </div>
            <a href="<?=base_url('adminvn/danh-sach-dat-hang')?>">
                <div class="panel-footer">
                    <span class="pull-left">Xem thêm</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Xem thêm</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                ??n hàng c?n x? lý
            </div>
            <div class="panel-body">
                <?php if(!empty($orders)){?>

                    <table class="table table-bordered">
                        <tr>
                            <th width='5%' class="text-center">STT</th>
                            <th width='20%'>Mã</th>
                            <th>Khách hàng</th>
                            <th width='15%'>Tr?ng thái</th>
                        </tr>
                        <?php
/*                        $i = 1;
                        foreach ($orders as $order) {
                            $j = $i++;$id_tr='id_tr'.$j;
                            */?>
                            <tr>
                                <td class="text-center"><?/*= $j; */?></td>
                                <td>
                                    <div data-items="<?/*=$id_tr;*/?>"     onclick="show_detail($(this).attr('data-items'),<?/*=$order->id*/?>,'<?/*=$id_tr.'1';*/?>',<?/*=$order->show*/?>)">
                                        <a style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Xem chi ti?t">
                                            <i class="fa fa-caret-down" style="font-size: 11px"></i> <?/*= @$order->code*/?>
                                        </a>
                                    </div> </td>
                                <td><?/*= $order->fullname; */?></td>
                                <td>
                                    <div class="dropdown" id="status_<?/*= $order->id; */?>">

                                        <?php /*$status = array(
                                            '1' => array('Hoàn thành', 'success'),
                                            '2' => array('?ã h?y', 'danger'),
                                            '0' => array('Ch? duy?t', 'primary'),
                                        );
                                        if ($order->status == 0) {
                                            foreach ($status as $k => $val) {
                                                if ($order->status == $k) {
                                                    */?>
                                                    <a class=" dropdown-toggle" data-toggle="dropdown"
                                                        >
                                                            <span class="label label-<?/*= $val[1]; */?>">
                                                                <?/*= $val[0]; */?>
                                                                <span class="fa fa-caret-down"></span>
                                                            </span>
                                                    </a>
                                                <?php
/*                                                }
                                            }
                                        } else {
                                            */?>
                                            <span class="label label-<?/*= $status[$order->status][1]; */?>">
                                                                <?/*= $status[$order->status][0]; */?>
                                                            </span>
                                        <?php
/*                                        }

                                        */?>

                                        <ul class="dropdown-menu" style="min-width: 50px; padding: 5px 5px">


                                            <li>
                                                <span class="label label-success" data-value='1'
                                                      data-item="<?/*= $order->id; */?>"
                                                      data-id="status_<?/*= $order->id; */?>"
                                                      onclick="update_order_status($(this))"
                                                    >Hoàn thành</span>
                                            </li>
                                            <li>
                                                <span class="label label-danger" data-value='2'
                                                      data-item="<?/*= $order->id; */?>"
                                                      data-id="status_<?/*= $order->id; */?>"
                                                      onclick="update_order_status($(this))"
                                                    >H?y</span>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr style="display: none" id="<?/*=$id_tr;*/?>" data-value="1">
                                <td colspan="10">
                                    <div class="col-md-12" style="padding: 5px">
                                        <b>??a ch?: </b><?/*=$order->address;*/?><br>
                                        <b>?i?n tho?i: </b><?/*=$order->phone;*/?><br>
                                        <b>Email: </b><?/*=$order->email;*/?><br>
                                        <b>Ghi chú: </b><?/*=$order->note;*/?><br>
                                        <table class="table table-bordered">

                                            <tr>
                                                <th >Tên hàng</th>
                                                <th>S? l??ng</th>
                                                <th>??n giá(?)</th>
                                            </tr>
                                            <?php
/*                                            $tootle=0;
                                            foreach($detail_order as $d){
                                                if($d->order_id==$v->id){
                                                    $tootle+=$d->price*$d->count;
                                                    */?>
                                                    <tr>
                                                        <td><?/*=$d->name;*/?></td>
                                                        <td><?/*=$d->count;*/?></td>

                                                        <td><?/*=number_format($d->price);*/?></td>
                                                    </tr>

                                                <?php /*}
                                            }

                                            */?>
                                            <tr>
                                                <td colspan="6" class="text-right">T?ng giá tr? ??n hàng:
                                                    <?/*=number_format($tootle);*/?>&nbsp;?</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                        <?php /*} */?>
                    </table>
                <?php  }else{ echo 'Không có ??n hàng nào!';}?>

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liên hệ
            </div>
            <div class="panel-body">
                <?php if(!empty($contacts)){?>

                    <table class="table table-bordered">
                        <tr>
                            <th width='5%' class="text-center">STT</th>

                            <th>Khách hàng</th>
                            <th width='20%'>Ngày gửi</th>
                            <th width='15%'>Trạng thái</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($contacts as $contact) {
                            $j = $i++;$id_tr='id_tr2'.$j;
                            ?>
                            <tr>
                                <td class="text-center"><?= $j; ?></td>
                                <td>
                                    <div data-items="<?=$id_tr;?>"     onclick="show_detail_contact($(this).attr('data-items'),<?=$contact->id?>,'<?=$id_tr.'1';?>',<?=$contact->show?>)">
                                        <a style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Xem chi tiết">
                                            <i class="fa fa-caret-down" style="font-size: 11px"></i> <?= @$contact->full_name?>
                                        </a>
                                    </div>
                                </td>
                                <td><?= date('d-m-Y',$contact->time); ?></td>
                                <td>

                                </td>
                            </tr>
                            <tr style="display: none" id="<?=$id_tr;?>" data-value="1">
                                <td colspan="10">
                                    <div class="col-md-12" style="padding: 5px">
                                        <b>Địa chỉ: </b><?=$contact->address;?><br>
                                        <b>Điện thoại: </b><?=$contact->phone;?><br>
                                        <b>Email: </b><?=$contact->email;?><br>
                                        <b>Ghi chú: </b><?=$contact->comment;?><br>

                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                    </table>
                <?php  }else{ echo 'Không có dữ liệu!';}?>

            </div>
        </div>
    </div>

</div>
<!--
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
    </div>
</div>-->


</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<style>
    .label{cursor: pointer  }
</style>
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
        function show_detail_contact(id_tr,id_order,status,show){
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
                    type: "GET",
                    url: baseurl + 'admin/contact/popupdata',
                    data: "id=" + id_order,
                    success: function (ketqua) {
                        $('#'+div).removeClass('red').addClass('blue');
                        $("#getmodal").html(ketqua);

                    }
                })
            }
        }


        function update_order_status(sender){
            var baseurl=$('#baseurl').val();
            if(sender.attr('data-value')==1){
                var action='Xác nhận hoàn thành đơn hàng?';
            }
            if(sender.attr('data-value')==2){
                var action='Bạn có chắc chắn muốn hủy đơn hàng?';
            }


            var check=confirm(action);

            if(check==true){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: baseurl + 'admin/order/update_order_status',
                    data: {item:sender.attr('data-item'),value:sender.attr('data-value')},
                    success: function (rs) {

                        if(rs.check==true){
                            var str=' <span class="label label-'+rs.color+'">'+rs.status+'\
                </span>';
                            $("#"+sender.attr('data-id')).html(str);
                        }

                    }
                })
            }

        }
    </script>
