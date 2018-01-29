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
            <i class="fa fa-table"></i>In danh sách đặt phòng
        </li>
    </ol>
</div>
<div class="col-md-12">
<div class="row">
<div class="" >
    <button onclick="CallPrint('printable')"  rel="nofollow" class="btn btn-default">
        <i class="fa fa-print"></i>In bài viết này
    </button>
    <form action="" method="get" class="row">
        <div class="col-sm-2 pull-right text-right">
            <button type="submit" class="btn btn-sm btn-default">
                <i class="fa fa-search"></i>  Tìm kiếm
            </button>
        </div>
        <div class="col-sm-2 pull-right">
            <input name="date_end" type="search" value="<?=date('d-m-Y',$end);?>"
                   placeholder="Đến ngày" id="date_start"
                   class="form-control input-sm">
        </div>
        <div class="col-sm-2 pull-right">
            <input name="date_start" type="search" value="<?=date('d-m-Y',$start);?>"
                   placeholder="Từ ngày" id="date_end"
                   class="form-control input-sm">
        </div>
        <div class="form-group">
            <div class="col-sm-2 pull-right">
                <select name="status" class="form-control input-sm">
                    <option value="">Tất cả</option>
                    <option <?php if($status==1){ echo "selected";}?> value="1">Hoàn thành</option>
                    <option <?php if($status==0){ echo "selected";}?> value="0">Chờ duyệt</option>
                </select>
            </div>

            <div class="clearfix"></div>
        </div>
    </form>
</div>
<style>
    .red{background:  red}
    .blue{background:  #4cae4c}
</style>
    <div id="printable">
            <table class="table  table-hover table-bordered">
                <thead>
                <tr class="active">
                    <th width="3%">STT</th>
                    <th width="7%">Mã ĐH</th>
                    <th>Họ tên khách hàng</th>
                    <th width="10%">Điện thoại</th>
                    <th width="15%">Email</th>
                    <th width="10%">Ngày đặt</th>
                    <th>Thông tin</th>
                    <th width="7%">Trạng thái</th>
                    <th width="10%">Người duyệt</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($lists)) {
                    $stt = 1;
                    foreach ($lists as $v) {
                        $j=$stt++;
                        $id_tr='id_tr'.$j;
                        ?>
                        <tr>
                            <td class="text-center"><?= $j++; ?>
                            </td>

                            <td>
                                <?= @$v->code?>
                            </td>
                            <td><?= $v->fullname; ?>
                            </td>
                            <td><?= @$v->phone ?></td>
                            <td><?= $v->email ?></td>
                            <td><div style="font-size: 11px"><?= date('d-m-Y H:i',@$v->time) ?></div></td>
                            <td>
                                <p><strong>Loại Phòng : <?=@$v->name;?></strong></p>
                                <p><strong>Ngày đến : <?=@$v->date_start;?></strong></p>
                                <p><strong>Ngày đi : <?=@$v->date_end;?></strong></p>
                                <p><strong>Người lớn : <?=@$v->person;?></strong></p>
                                <p><strong>Trẻ em : <?=@$v->child;?></strong></p>
                                <p><strong>
                                        <?php if(!empty($v->price_sale)) : ?>
                                        Giảm giá (Khuyến mại) : <?=@$v->price_sale;?>%
                                        <?php else :?>
                                         Giảm giá :   Không có
                                        <?php endif;?>
                                    </strong></p>
                                <p><strong>Số tiền thanh toán : <?=number_format(@$v->price - ($v->price * ($v->price_sale/100)));?>&nbsp;<?=currentcy($this->language)?></strong></p>
                            </td>
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
                        </tr>
                    <?php
                    }
                } ?>
                </tbody>
            </table>
    </div>
<div data-value=""></div>
<input type="hidden" id="baseurl" value="<?=base_url();?>">
<script>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#date_start" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $( "#date_end" ).datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>
<script type=text/javascript>
    function CallPrint(strid) {
        var prtContent = document.getElementById(strid);
        var WinPrint =
            window.open('', '', 'left=0,top=0,width=1300px,height=800px,toolbar=0,scrollbars=1,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
        // prtContent.innerHTML="test";
    }

</script>