<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel" >
                <div class="panel-heading">
                    <div class="panel-title">Đổi mật khẩu
                        <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>

                </div>

                <div class="panel-body user-register" >
                    <div style="height: 35px; position: relative">
                        <div style="display:none; padding: 5px 10px;position: absolute" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    </div>
                    <form action="<?=base_url()?>users_frontend/change_pass" method="post"   class="validate form-horizontal"
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
                            <label for="password" class="col-md-4 control-label"> </label>
                            <!--<div class="col-md-8">
                                (<a href="#" class="link-forget-pass">Quên mật khẩu</a>)
                            </div>-->
                        </div>

                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-4 col-md-8">
                                <button name="update_pass" id="btn-changepass" type="submit" class="btn btn-info">
                                    <i class="icon-hand-right"></i> &nbsp Hoàn thành</button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
</div>