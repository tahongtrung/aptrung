<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel" >
                <div class="panel-heading">
                    <div class="panel-title"><?=lang('login');?>
                        <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>

                </div>
                <div class="panel-body clearfix">
                    <div style="height: 35px; position: relative">
                        <div style="display:none; padding: 5px 10px;position: absolute" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    </div>
                    <div class="col-md-12">
                        <form id="loginform" class="form-horizontal" role="form">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="login-username" type="text" class="form-control"
                                       name="username" value="" placeholder="Email">
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="login-password" type="password" class="form-control"
                                       name="password" placeholder="<?=lang('pass');?>">
                            </div>
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                <div class="col-sm-offset-3 col-sm-5 controls">
                                    <div onclick="login()" id="btn-login"  class="btn btn-info btn-sm"><?=lang('login');?></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--<div class="col-md-5">
                        <div class="fb-login">
                            <a href="<?/*= $loginUrl */?>" title="login width facebook">
                                <img src="http://www.dosor.com/img/facebook.png" style="width: 100%">
                            </a>
                        </div>
                    </div>-->
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Nếu chưa có tài khoản!
                                <a onclick="registerModal()" data-toggle="modal" data-target=".bs-example-modal-sm2">
                                    Đăngng ký
                                </a>
                                <!--<div style="" >
                                    <a href="#" onclick="$('.fade').fadeOut();" data-toggle="modal" data-target=".forgot_pass">
                                        Quên mật khẩu
                                    </a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
