<link href="<?=base_url()?>assets/css/front_end/profiles.css" rel="stylesheet" type="text/css">
<section class="content clearfix">
    <div class="container">
        <div class="row">
            <div id="pw990">
                <div id="pw300" class="col-md-3 col-sm-12 col-xs 12">
                    <div id="boxprofile">
                        <h2 class="profile-title"><strong><?=@$user_item->fullname;?></strong></h2>
                        <div class="inner">
                            <img src="<?=base_url($user_item->logo)?>" alt="kingoffwar" onerror="this.src='<?=base_url()?>upload/img/avatar/logo.png'" width="100%" height="170" class="ava160x170">
                        </div>
                    </div>
                    <div id="pbox03" class="pbox pboder hidden-xs hidden-sm">
                        <h2 class="profile-title">
                            <strong>Tổng quan</strong>
                        </h2>
                        <div class="pcont">
                            <div class="boxcont">
                                <ul class="listinfo">
                                    <li><a href="<?=base_url('thong-tin-tai-khoan')?>" title="Thông tin tài cá nhân">Thông tin cá nhân</a></li>
                                    <li><a href="<?=base_url('quan-ly-tai-chinh')?>">Quản lý tài chính</a></li>
                                    <li><a href="<?=base_url('tai-lieu-download')?>">Quản lý tài liệu</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>

                <div class="form-register-aisle col-md-9" style="margin-top: 0px;padding: 0px">
                    <div id="pbox04" class="pbox pmovebox pboder col-sm-12 col-xs 12">
                        <div class="ptt">
                            <div class="docmenu fleft">
                                <ul class="mnu">
                                    <li id="a2Upload_li" name="a2Upload_li" class="active item"><a id="a2Upload" name="a2Upload" href="javascript:void(0);"><span>Thông tin cá nhân</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pcont">
                            <div id="boxdoc01" class="boxcont">
                                <div id="u2Upload" name="u2Upload">
                                    <div class="nullresult" style="overflow:hidden;width:100%;float:left;">

                                            <form action="<?= base_url('users_frontend/updateProfile') ?>" method="post" class="validate
                    form-horizontal" enctype="multipart/form-data" name="changprofile" role="form">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Tên:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?=@$user_item->fullname;?>" class="validate[required] form-control"
                                                               name="fullname" id="fnullname" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Giới tính</label>
                                                    <div class="col-sm-10" style="padding-top: 5px">
                                                        <label >
                                                            <input type="checkbox" value="1" name="nam" <?=@$user_item->nam==1?'checked':''?>>
                                                            Nam
                                                        </label>

                                                        <label>
                                                            <input type="checkbox" value="1" name="nu" <?=@$user_item->nu==1?'checked':''?>>
                                                            Nữ
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="email" name="email" placeholder=""
                                                               value="<?=@$user_item->email;?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Số điện thoại:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="phone" id="phone" placeholder=""
                                                               value="<?=@$user_item->phone;?>" >
                                                    </div>
                                                </div>
                                                <br>
                                                <hr>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Địa chỉ</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" name="address"><?=@$user_item->address;?></textarea>
                                                        <!--<input type="text" class="form-control" name="address" placeholder="Địa chỉ">-->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for="email">Ảnh đại diện:</label>
                                                    <div class="col-sm-10">
                                                        <div class="user_logo">
                                                            <input type="file" name="userfile" id="input_img" onchange="handleFiles()" />
                                                            <!--<img src="<?/*=base_url(@$user_item->logo);*/?>" id="image_review">-->
                                                            <?=check_img2(@$user_item->logo,65,65);?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Giới thiệu </label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="description" id="ckeditor"><?=@$user_item->description?></textarea>
                                                        <?php echo display_ckeditor($ckeditor); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button name="update_profiler" id="btn-changepass" type="submit" class="btn btn-info pull-right">Cập nhật</button>
                                                    </div>
                                                </div>
                                            </form>
                                   </div>
                                </div>
                                <div class="page_view" id="p2Upload" name="p2Upload">
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div><!-- .loginbox-->
            <!---End Left------->
            </div>
            <div id="clear"></div>
        </div>
    </section>
<script>
    $(document).ready(function(){
        $(".validate").validationEngine();
    });
</script>
<script src="<?=base_url('assets/js/admin/main_site.js')?>"></script>
