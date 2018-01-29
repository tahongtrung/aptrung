<link href="<?=base_url()?>assets/css/front_end/profiles.css" rel="stylesheet" type="text/css">
<section class="content clearfix">
    <div class="container">
        <div class="row">
            <div id="pw990">
                <div id="pw300" class="col-md-3 col-sm-12 col-xs 12">
                    <div id="boxprofile"><?/*=var_dump($user_item);die();*/?>
                        <h2 class="profile-title"><strong><?=@$user_item->fullname;?></strong></h2>
                        <div class="inner">
                            <img src="<?=base_url($user_item->logo)?>" alt="<?=@$user_item->fullname;?>" onerror="this.src='<?=base_url()?>upload/img/avatar/logo.png'" width="100%" height="170" class="ava160x170">
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
                <div id="pw678" class="col-md-9 col-sm-12 col-xs 12">
                    <div id="pbox04" class="pbox pmovebox pboder col-sm-12 col-xs 12">
                        <div class="ptt">
                            <div class="docmenu fleft">
                                <ul class="mnu">
                                    <li id="a2Upload_li" name="a2Upload_li" class="active item"><a id="a2Upload" name="a2Upload" href="javascript:void(0);"><span>Quản lý tài liệu</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pcont">
                            <div id="boxdoc01" class="boxcont">
                                <div id="u2Upload" name="u2Upload">
                                    <div class="nullresult" style="overflow:hidden;width:100%;float:left;">
                                        <h4 class="profile-t">Danh sách tài liệu đã tải.</h4>
                                        <p style="margin: 10px 0"><strong>Tổng số tài liệu đã tải về : 1</strong></p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th width="15%">Stt</th>
                                                    <th>Tên tài liệu</th>
                                                    <th>Ngày tải</th>
                                                    <th width="15%">Phí tải</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Toán cao cấp.</td>
                                                    <td><?=date('d-m-Y',time());?></td>
                                                    <td>10.000đ</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="clear"></div>
        </div>
    </div>