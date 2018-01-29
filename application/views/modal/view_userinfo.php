<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel" >
                <div class="panel-heading">
                    <div class="modal-header" style="padding: 0;border-bottom:none !important;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Thông tin cá nhân</h4>
                    </div>
                </div>

                <div class="panel-body form-dh" >
                    <div style="position: relative">
                        <div style="display:none; padding: 5px 10px;position: absolute" id="login-alerts"
                             class="alert alert-danger col-sm-12"></div>
                    </div>
                    <form action="<?=base_url()?>users_frontend/updateProfile" method="post"   class="validate form-horizontal"
                          enctype="multipart/form-data" role="form">

                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Họ tên :</label>
                            <div class="col-md-9">
                                <div id="show_error_pass"></div>
                                <input type="text" value="<?=@$user_item->fullname;?>" class="validate[required]
                                form-control form-input"
                                       name="fullname" placeholder="Họ và tên">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class=" col-md-3 control-label">Số điện thoại :</label>
                            <div class="col-md-9">
                                <input type="text"  value="<?=@$user_item->phone?>" class="validate[required]
                                form-control form-input"
                                       id="phone" name="phone" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class=" col-md-3 control-label">Email :</label>
                            <div class="col-md-9">
                                <input type="text"  value="<?=@$user_item->email?>" class="validate[required]
                                form-control form-input" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-3 control-label">Địa chỉ :</label>
                            <div class="col-md-9">
                                <textarea name="address" id="address" rows="3"
                                          class="form-control"><?=@$user_item->address;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-3">
                                <button name="update_profiler" id="btn-changepass" type="submit" class="btn btn-info btn-sm">
                                    <i class="icon-hand-right"></i> &nbsp Cập nhật</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>