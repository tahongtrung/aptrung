<section class="block-type-title">
    <div class="container">
        <h3>Đăng Ký Thành Viên</h3>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="form-register-aisle">
            <div class="aisle-title">Đăng ký / Đăng Nhập</div>
            <div class="aisle-content">
                <form action="" method="post"  id="singup_frm"
                      class="validate form-horizontal" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Họ tên <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" class="validate[required] form-control" name="fullname"
                                   value="<?=@$fullname;?>" placeholder="Họ tên">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Tên đăng nhập <span style="color:red">*</span></label>
                        <div class="col-sm-9">
                            <div id="show_error_user"></div>
                            <input type="text" onblur="check_register_user($(this).val())" class="form-control validate[required]" name="username" id="username"
                                   value="<?=@$username;?>"  placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <div id="show_error"></div>
                            <input type="text" onblur="check_mail($(this).val())"  id="email"
                                   class="validate[required,custom[email]] form-control" name="email"
                                   placeholder="Email" value="<?=@$email;?>">
                            <input type="hidden" name="status_check" id="status_check" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-md-3 control-label">Điện thoại</label>
                        <div class="col-md-9">
                            <input type="text"
                                   class="validate[custom[phone,minSize[10]]] form-control" name="phone"
                                   placeholder="Điện thoại" value="<?=@$phone;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-md-3 control-label">Địa chỉ</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="address"><?=@$address;?></textarea>
                            <!--<input type="text" class="form-control" name="address" placeholder="Địa chỉ">-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-md-3 control-label">Logo</label>
                        <div class="col-sm-9">
                            <input type="file" name="userfile" id="input_img" onchange="handleFiles()" />
                            <div class="user_logo">
                                <img src="" id="image_review">
                            </div>
                        </div>
                    </div>
                    <br/>
                    <hr>
                    <div class="form-group">
                        <label for="password" class=" col-md-3 control-label">Mật khẩu <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="password" class=" validate[required,custom[onlyLetterNumber,minSize[6]]] form-control"
                                   id="password" name="password" placeholder="Mật khẩu" value="<?=@$password;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Nhập lại mật khẩu <span style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="password" class="validate[required,equals[password]] form-control" name="repassword"
                                   value="<?=@$repassword;?>" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <img src="<?php echo base_url().$imageCaptchaPostAds; ?>" width="151" height="30" />

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Nhập mã bảo vệ<span
                                style="color:red">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="captcha_ads" id="captcha_ads" value="" maxlength="10" class="inputcaptcha_form" />
                            <span style="color:red"><?php echo form_error('captcha_ads'); ?><span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="check" class="validate[required]" > Tôi hoàn toàn
                                    đồng ý với qui định mà
                                    Website đã đề
                                    ra</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default pull-right">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".validate").validationEngine();
    });
</script>
<input type="hidden" value="<?=base_url()?>" id="baseurl">
<script src="<?= base_url('assets/js/front_end/users.js')?>"></script>
<script src="<?=base_url('assets/js/admin/main_site.js')?>"></script>
