<link href="<?=base_url()?>assets/css/front_end/profiles.css" rel="stylesheet" type="text/css">
<section class="content clearfix">
    <div class="container">
        <div class="row">
            <div id="pw990">
                <div id="pw300" class="col-md-3 col-sm-12 col-xs 12">
                    <div id="boxprofile">
                        <div class="ptt"><strong class="pclink"><?=@$user_item->name;?></strong></div>
                        <div class="inner">
                            <img src="<?=base_url($user_item->logo)?>" alt="kingoffwar" onerror="this.src='http://image.tailieu.vn/avatar/member/onerror_200.jpg'" width="100%" height="170" class="ava160x170">
                        </div>
                    </div>
                    <div id="pbox03" class="pbox pboder hidden-xs hidden-sm">
                        <div class="ptt">
                            <p class="inl"><strong class="pclink">Tổng quan</strong></p>
                            <div class="inr">
                                <p class="pcontgo">
                                    <img src="images/graphics/blank.gif" width="9" height="5" class="go1">
                                    <img src="images/graphics/blank.gif" width="9" height="5" class="go2">
                                </p>
                            </div>
                        </div>
                        <div class="pcont">
                            <div class="boxcont">
                                <ul class="listinfo">
                                    <li><a href="<?=base_url('thong-tin-tai-khoan')?>" title="Thông tin tài cá nhân">Thông tin cá nhân</a></li>
                                    <li><a href="">Quản lý tài chính</a></li>
                                    <li><a href="">Quản lý tài liệu</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pw678" class="col-md-9 col-sm-12 col-xs 12">
                    <div class="col-md-7">
                        <form class="form-horizontal form-bk" role="form" method="post" action="<?=base_url('profile/transaction')?>">
                            <h2 class="form-control-heading">NẠP THẺ CÀO</h2>
                            <div class="form-group">
                                <label for="txtpin" class="col-lg-3 control-label">Loại thẻ</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="chonmang">
                                        <option value="VIETEL">Viettel</option>
                                        <option value="MOBI">Mobifone</option>
                                        <option value="VINA">Vinaphone</option>
                                        <option value="GATE">Gate</option>
                                        <option value="VTC">VTC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtpin" class="col-lg-3 control-label">Tài khoản</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txtuser" name="txtuser" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtpin" class="col-lg-3 control-label">Mã thẻ</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtseri" class="col-lg-3 control-label">Số seri</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <button type="submit" class="btn btn-primary" name="napthe">Nạp thẻ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <img src="<?=base_url('assets/css/img/hd_mobile.png')?>" title="hướng dẫn nạp thẻ">
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div id="clear"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".form-control").tooltip({ placement: 'right'});
        });
    </script>