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
                            <th width="10%">Ảnh</th>
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
                                    <td>
                                        <!--<img src="<?/*=base_url($v->avatar)*/?>" width="50" height="50">-->
                                        <?=check_img2($v->avatar,70,70);?>
                                        <a href="#" class="pull-right" onclick="get_form(<?=@$v->id?>)"
                                           data-item="<?=$v->id;?>"
                                           data-toggle="modal" data-target="#modalAnimated"

                                            ><i class="fa fa-plus"></i></a>
                                    </td>
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
                                    <td width='10%' class="text-center">
                                        <div style="text-align: center; " class="action">
                                            <a href="<?=base_url('adminvn/users/imageUser/'.@$v->id)?>" class="btn
                                            btn-xs
                                            btn-default"
                                               title="Ảnh sản phẩm"><i
                                                    class="fa fa-image"></i></a>
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
            function get_form(id)
            {
                $('#user_img_frm').attr('action','<?=base_url('adminvn/users/imageUser')?>'+'/'+id);
            }
        </script>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<div class="modal fade" data-sound="off" id="modalAnimated" tabindex="-1" role="dialog" aria-labelledby="modalAnimatedLabel" aria-hidden="true">
    <div class="modal-dialog animated bounceIn">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalAnimatedLabel">Cập nhật ảnh</h4>
            </div>
            <div class="modal-body" id="getmodal">
                <form action="" method="post" class="validate"
                      id="user_img_frm"
                      accept-charset="utf-8"
                      enctype="multipart/form-data">
                    <div class="col-md-12">
                        <input name="userfile" id="input_img" type="file"  onchange="handleFiles()" />
                        <div class="user_logo">
                            <img src="" id="image_review">
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-xs" onclick="$('#user_img_frm').submit()">Cập nhật</button>
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Hủy</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<style>
    .user_logo{
        max-width: 100px;
        max-height: 100px;
    }
    .user_logo img{
        width: 100%;
    }
</style>