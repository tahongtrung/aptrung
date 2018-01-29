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
                        <i class="fa fa-table"></i> Quản trị viên
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>
                <a href="<?= base_url('adminvn/admin/user_add') ?>" class="btn btn-xs btn-success"> <i class="fa fa-plus"></i> Thêm mới</a>
                <div class="">

                   <br>
                    <div class="clearfix"></div>
                    <div class="table-responsive table-responsive-datatables">
                        <table class=" table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width='5%'>#</th>
                                <th>Username</th>
                                <th width='30%'>Fullname</th>
<!--                                <th width='30%'>Email</th>-->
                                <th width='5%'>Active</th>
                                <th width='10%' class="text-right">Action</th>
                            </tr>
                            </thead>
                            <!--/thead-->

                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($users as $k => $user) {
                                ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $user->email; ?></td>
                                    <td><?= $user->fullname; ?></td>

                                    <td>
                                        <label class="checkbox-inline active_u" data-items="<?= $user->id; ?>">
                                            <input type="checkbox" <?= $user->block == 0 ? 'checked' : '' ?>
                                                   data-on="Yes" data-off="No"
                                                   data-onstyle="primary" data-offstyle="warning"
                                                   data-toggle="toggle" id="toggle" data-size="mini">
                                        </label>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?= base_url('admin/admin/permission/' . $user->id); ?>"
                                           class="btn btn-xs btn-primary"><i class="fa fa-cogs"></i></a>
                                        <a href="<?= base_url('admin/admin/user_edit/' . $user->id); ?>"
                                           class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= base_url('admin/admin/user_delete/' . $user->id); ?>"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản?')"
                                           class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>


                            </tbody>
                            <!--/tbody-->


                            <tfoot>


                            </tfoot>
                            <!--/tfoot-->
                        </table>
                        <!--/table tools-->
                    </div>



                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>





<link href="<?= base_url('assets/plugin/boostrap/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('assets/plugin/boostrap/bootstrap-toggle.min.js') ?>"></script>
<script type="text/javascript">

    $('.active_u').on('click', function () {
        var baseurl = $('#baseurl').val();
        var check = $(this).find('input').is(":checked");
        if (check == true) {
            var conf = confirm('Khóa tài khoản?');
        }
        if (check == false) {
            var conf = confirm('Mở khóa tài khoản?');
        }

        if (conf == true) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: base_url() + 'admin/admin/useractive',
                data: {id: $(this).attr('data-items')},
                success: function (ketqua) {

                }
            })
        }
        else return false;

    });

</script>