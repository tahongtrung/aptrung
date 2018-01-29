<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Support online
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?= $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>

            <div class="col-lg-12">
                <div class="clear"></div>
                <div class="">
                    <a href="<?= base_url('adminvn/support_online/index')?>" class="btn btn-success btn-xs"
                       style="margin-bottom: 5px">
                        <i class="fa fa-plus"></i> Thêm</a>

                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="active">
                            <th width='3%'>STT</th>
                            <!--<th width="5%">Avatar</th>-->
                            <th width='20%'>Họ tên</th>
                            <th width="15%">Phone</th>
                            <th width='15%'>Email</th>
                            <th width='15%'>Skype</th>
                            <th width='15%'>Yahoo</th>
                            <th width='10%'>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($list)){
                            $stt=1;
                            foreach($list as $v){?>

                                <tr>
                                    <td><?= $stt++;?></td>
                                    <!--<td><img src="<?/*=base_url($v->image)*/?>" width="50" height="50"></td>-->
                                    <td><?= $v->name;?></td>
                                    <td><?=@$v->phone;?></td>
                                    <td><?= $v->email;?></td>
                                    <td><?= $v->skype;?></td>
                                    <td><?= $v->yahoo;?></td>
                                    <td>
                                        <div style="text-align: center; " class="action">
                                            <a href="<?= base_url('adminvn/support_online/index/'.$v->id);?>" class="btn
                                            btn-default btn-xs" title="Sửa"><i class="fa fa-pencil"></i></a>
                                            <a href="<?= base_url('adminvn/support_online/Delete/'.$v->id);?>" class="btn
                                            btn-danger btn-xs" title="Xóa"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                </tr>


                            <?php   }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>

