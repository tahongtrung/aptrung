<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?=base_url('adminvn')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thành viên
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>

                <div class="">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Họ và tên</th>
                            <th>Điện thoại</th>
                            <th>Tỉnh/Thành</th>
                            <th>Hoạt động</th>
                            <th>Đăng ký</th>
                            <th>Đăng nhập</th>
                            <th></th>
                        </tr>
                        <?php if (isset($userslist)) {
                            $s=1;
                            foreach ($userslist as $v) {
                                ?>
                                <tr>
                                    <td width="5%"><?=$s++; ?></td>
                                    <td width="20%"><?= @$v->email ?></td>
                                    <td ><?= @$v->fullname ?></td>
                                    <td ><?= @$v->phone ?></td>
                                    <td ><?= @$v->provin_name ?></td>

                                    <td width="10%" class="text-center">
                                        <label class="checkbox-inline" onclick="active_user(<?=$v->id;?>)">
                                            <input type="checkbox" <?=$v->active==1?'checked':''?>  data-toggle="toggle"  id="toggle" data-size="mini"
                                                   data-on="Yes" data-off="No">
                                        </label>
                                    </td>
                                    <td width="10%"
                                        style="font-size: 12px"><?= $v->signup_date;?> </td>
                                    <td width="15%"
                                        style="font-size: 12px"><?= date('Y-m-d H:i',$v->last_login);?> </td>
                                    <td width='5%' class="text-center">

                                            <div class="btn-group btn-group-xs">
                                                    <a href="<?= base_url('adminvn/users/delete/' . $v->id) ?>" title="Xóa"
                                                       class="btn btn-xs btn-danger" style="color: #fff"
                                                       onclick="return confirm('Xóa thành viên?')">
                                                        <i class="fa fa-times"></i> </a>
                                            </div>


                                    </td>
                                </tr>

                            <?php
                            }
                        } ?>
                    </table>

                </div>
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
                </div>
            </div>
        </div>

        <link href="<?=base_url('assets/css/bootstrap-toggle.min.css')?>" rel="stylesheet">
        <script src="<?=base_url('assets/js/bootstrap-toggle.min.js')?>"></script>

        <script type="text/javascript">

            function active_user(user){
                var baseurl = '<?php echo base_url();?>';

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: baseurl + 'admin/users/active_user',
                    data: {id:user},
                    success: function (ketqua) {

                    }
                })
            }
            function changeStatus(id) {
                var data = {id: id};
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "<?=  base_url('adminvn/users/changeStatusUser')?>",
                    cache: false,
                    dataType: 'json',
                    success: function (e) {
                        if (e) {
                            $("#" + id).html(e);
                        }
                    }
                });
            }
        </script>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>