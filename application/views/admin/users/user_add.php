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

                <div class="">

                    <form method="post" action="" class="validate form-horizontal " id="form_add" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="edit" value="<?=@$edit->id;?>">

                        <div id="panel-tablesorter" class="panel panel-default">
                            <div class="panel-heading bg-white">
                                <h3 class="panel-title">Quản trị viên</h3>
                            </div><!-- /panel-heading -->

                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Tên đăng nhập</label>
                                    <div class="col-sm-5">
                                        <input name="email" type="text" class="validate[required] form-control"
                                               value="<?=@$edit->email;?>" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label class="col-sm-3 control-label" >Tên đăng nhập</label>
                                    <div class="col-sm-5">
                                        <input name="username" type="text" class="validate[required] form-control"
                                               value="<?=@$edit->username;?>" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Họ tên</label>
                                    <div class="col-sm-5">
                                        <input name="fullname" type="text" class="validate[required] form-control"
                                               value="<?=@$edit->fullname;?>" placeholder="">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Mật khẩu</label>
                                    <div class="col-sm-5">
                                        <input name="password" type="password" class="<?=isset($edit)?'':'validate[required]';?> form-control"
                                               value="" placeholder="">
                                        <?php if(isset($edit)){?>
                                            <p style="color: #999;font-size: 11px; font-style: italic ">(Chỉ điền khi muốn thay đổi mật khẩu)</p>
                                        <?php }?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" >Hoạt động</label>
                                    <div class="col-sm-5">
                                        <div class="row">
                                        <div class="nice-radio text-primary col-sm-2">
                                            <input type="radio" name="block" id="radio-checked-2" value="0"
                                                <?=(@$edit->block==0||!isset($edit))?'checked':'';?>
                                                >
                                            <label for="radio-checked-2"><span class="text-inverse">Có</span></label>
                                        </div>
                                        <div class="nice-radio text-primary col-sm-5">
                                            <input type="radio" name="block" id="radio-2" value="1"
                                                <?=(@$edit->block==1)?'checked':'';?>
                                                >
                                            <label for="radio-2"><span class="text-inverse">Không</span></label>
                                        </div></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-5">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm"><?=$btn_name;?></button>
                                        <button type="reset"  class="btn btn-default btn-sm">Hủy</button>
                                    </div>
                                </div>


                            </div><!--/panel-body-->
                        </div><!--/panel-tablesorter-->


                    </form>
                </div>

            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>

<link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css') ?>">
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js') ?>"
        charset="utf-8"></script>
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js') ?>"></script>

<script>

    $(document).ready(function () {
        $(".validate").validationEngine();
    });
</script>

