<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel" >
                <div class="panel-heading">
                    <div class="panel-title"><?=lang('register');?>
                        <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                </div>

                <div class="panel-body user-register">
                    <div>
                        <div style="display:none; padding: 5px 10px;position: absolute" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    </div>
                    <form action="<?=base_url('dang-ky')?>" method="post"
                          name="form_u_register"
                          id="register_user_frm" class="validate form-horizontal"
                          role="form">

                        <div class="form-group">
                            <label for="firstname" class="col-md-3 control-label">
                                <?=lang('name');?> (*)
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="validate[required] form-control" name="fullname"
                                       placeholder="<?=lang('name');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">
                                <?=lang('email');?> (*)
                            </label>
                            <div class="col-md-9">
                                <div id="show_error"></div>
                                <input type="text" onBlur="check_mail($(this).val())"  id="email"
                                       class="validate[required,custom[email]] form-control" name="email"
                                       placeholder="Email">
                                <input type="hidden" name="status_check" id="status_check" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-3 control-label"><?=lang('phone');?></label>
                            <div class="col-md-9">
                                <input type="text"
                                       class="validate[custom[phone,minSize[10]]] form-control" name="phone"
                                       placeholder="<?=lang('phone');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class=" col-md-3 control-label">
                                <?=lang('pass')?> (*)
                            </label>
                            <div class="col-md-9">
                                <input type="password" class="validate[required,custom[onlyLetterNumber,minSize[6]]] form-control"
                                       id="password" name="password" placeholder="<?=lang('pass')?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">
                                <?=lang('re-pass');?> (*)
                            </label>
                            <div class="col-md-9">
                                <input type="password" class="validate[required,equals[password]] form-control" name="repassword" placeholder="<?=lang('re-pass');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-3 col-sm-3 control-label"><?=lang('code_catpcha');?></label>
                            <div class="col-md-5 col-sm-5">
                                <div style="position: relative">
                                    <div id="error_captcha"></div>
                                </div>
                                <input type="text" placeholder="..." class="form-control" name="captcha_user" id="captcha_user">

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <img src="<?php echo base_url().$imageCaptchaPostAds; ?>" width="151" height="30" />
                                <input type="hidden" id="captcha_check" value="<?=@$captcha_check;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-9">
                                <div name="signups" onClick="check_captcha_user()"
                                     id="btn-signups"  class="btn btn-info">
                                    <i class="icon-hand-right"></i> &nbsp <?=lang('register');?></div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    <?=lang('have_account');?> !
                                    <a onclick="getModalLogin()" data-dismiss="modal"  data-toggle="modal" data-target=".bs-example-modal-sm">
                                        <?=lang('login');?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
</div>