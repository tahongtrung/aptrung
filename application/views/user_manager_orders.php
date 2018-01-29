
<!---endlist.thuong-hieu--->
<section class="block-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3  ">
                <?php foreach($widgets as $widget){
                    echo $widget;
                }?>
            </div>

            <div class="col-md-9  ">
                <table class="table  table-hover table-bordered">
                    <thead>
                    <tr class="success">
                        <th width="3%">STT</th>
                        <th width="15%">Mã ĐH</th>
                        <th>Họ tên khách hàng</th>
                        <th width="10%">Điện thoại</th>
                        <th width="15%">Email</th>
                        <th width="10%">Ngày đặt</th>
<!--                        <th width=10%>Trạng thái</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($orders)) {
                        $stt = 1;
                        foreach ($orders as $v) {
                            $j=$stt++;
                            $id_tr='id_tr'.$j;
                            ?>
                            <tr <?php if(($stt - 1) % 2 == 0) :?>class="active"<?php endif;?>>


                                <td class="text-center"><?= $j++; ?>
                                </td>

                                <td>
                                    <div data-items="<?=$id_tr;?>"     onclick="show_detail($(this).attr('data-items'))">
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
                                <!--<td>
                                    <div class="dropdown" id="status_<?/*= $v->id; */?>">

                                        <?php /*$status = array(
                                            '1' => array('Hoàn thành', 'success'),
                                            '2' => array('Đã hủy', 'danger'),
                                            '0' => array('Chờ duyệt', 'primary'),
                                        );
                                        if ($v->status == 0) {
                                            foreach ($status as $k => $val) {
                                                if ($v->status == $k) {
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
                                            <span class="label label-<?/*= $status[$v->status][1]; */?>">
                                                                <?/*= $status[$v->status][0]; */?>
                                                            </span>
                                        <?php
/*                                        }
                                        */?>

                                        <ul class="dropdown-menu" style="min-width: 50px; padding: 5px 5px">

                                            <li>
                                                        <span  class="label label-success" data-value='1' data-item="<?/*=$v->id;*/?>" data-id="status_<?/*=$v->id;*/?>"
                                                               onclick="update_order_status($(this))"
                                                            >Hoàn thành</span>
                                            </li>
                                            <li>
                                                        <span  class="label label-danger"    data-value='2' data-item="<?/*=$v->id;*/?>" data-id="status_<?/*=$v->id;*/?>"
                                                               onclick="update_order_status($(this))"
                                                            >Hủy</span>
                                            </li>
                                        </ul>
                                    </div>

                                </td>-->
                            </tr>
                            <tr style="display: none" id="<?=$id_tr;?>" data-value="1">
                                <td colspan="10">
                                    <div class="col-md-12">

                                        <table class="table table-bordered">

                                            <tr>
                                                <td colspan="5">
                                                    <p><b>Địa chỉ khách hàng:</b></p>
                                                    <p>
                                                        <?= @$v->address ?>
                                                    </p>


                                                    <p><b>Nội dung:</b></p>
                                                    <?=  @$v->note; ?>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th >Tên hàng</th>
                                                <th >Cơ sở</th>
                                                <th>Số lượng</th>
                                                <!--<th>Màu</th>
                                                <th>Size</th>-->
                                                <th>Đơn giá(đ)</th>
                                                <th colspan="2" >Thành tiền(đ)</th>
                                            </tr>
                                            <?php
                                            $tootle=0;
                                            foreach($items as $d){
                                                if($d->order_id==$v->id){
                                                    $tootle+=$d->price*$d->count;
                                                    ?>
                                                    <tr>
                                                        <td><?=$d->name;?></td>
                                                        <td><?=$d->address;?></td>
                                                        <td><?=$d->count;?></td>
                                                        <!--<td>
                                                                <?/*= ($d->color=='0'||$d->color=='')?'':'<div style="padding: 0px 5px ; float: left">Màu:</div> <div style="background:'.$d->color.';width: 20px; height:20px;float:left "></div> ';*/?>
                                                            </td>
                                                            <td>
                                                                <?/*= ($d->size=='0'||$d->size=='')?'':'<div style="padding: 0px 5px ; float: left">Size:</div> <div style="">'.$d->size.'</div> ';*/?>
                                                            </td>-->
                                                        <td><?=number_format($d->price);?></td>
                                                        <td colspan="2"><?=number_format($d->price*$d->count);?></td>
                                                    </tr>

                                                <?php }
                                            }

                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-right">Tổng giá trị đơn hàng:
                                                    <?=number_format($tootle);?>&nbsp;đ</td>
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
                <?php
                echo $this->pagination->create_links(); // tạo link phân trang
                ?>
            </div>
            <script>
                function show_detail(id_tr){
                    if($('#'+id_tr).attr('data-value')=='1'){
                        $('#'+id_tr).show();
                        $('#'+id_tr).attr('data-value','2');
                    }else{
                        $('#'+id_tr).hide();
                        $('#'+id_tr).attr('data-value','1');
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
        </div>
    <!--end share face-->
    </div><!---endlist-item--->
</section>

