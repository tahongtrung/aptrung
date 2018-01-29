<section class="container" style="margin-top: 20px">
    <div class="row">
        <section class="col-md-3 col-sm-12 col-xs-12">
            <?php foreach($widgets as $widget){
                echo $widget;
            }?>
        </section>
        <!---End .sidebar_box_1--->
        <section class="col-md-9  col-sm-12 col-xs-12" >
            <div class="title-right">
                Đổi mật khẩu
            </div>
            <div class="form-register-aisle">
                <div class="aisle-content">
                    <form action="<?=base_url('users_frontend/change_pass')?>" method="post"   class="validate
                    form-horizontal"
                          role="form">
                        <div class="form-group">
                            <label for="lastname" class="col-md-4 control-label">Mật khẩu cũ</label>
                            <div class="col-md-8">
                                <div id="show_error_pass2"></div>
                                <input type="password" class="validate[required] form-control"
                                       onchange="check_pass($(this).val())"
                                       name="id"  name="old_pass" placeholder="Mật khẩu cũ">
                                <input id="pass_check" name="pass_check" value="1" type="hidden">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class=" col-md-4 control-label">Mật khẩu mới</label>
                            <div class="col-md-8">
                                <input type="password" class=" validate[required,custom[onlyLetterNumber,minSize[6]]] form-control"
                                       id="new_pass" name="new_pass" placeholder="Mật khẩu mới">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Nhập lại mật khẩu mới</label>
                            <div class="col-md-8">
                                <input type="password" class="validate[required,equals[new_pass]] form-control"
                                       name="id" name="re_pass" placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-4">
                                <button name="update_pass" id="btn-changepass" type="submit" class="btn btn-default pull-right">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div><!-- .loginbox-->
</section>
<!---End Left------->
</div><!--end row-->
</section>
<input type="hidden" value="<?=base_url()?>" id="baseurl">
<script src="<?= base_url('assets/js/front_end/users.js')?>"></script>
<script>
    $(document).ready(function(){
        $(".validate").validationEngine();
    });
</script>