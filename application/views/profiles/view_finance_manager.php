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
                                    <li id="a2Upload_li" name="a2Upload_li" class="active item"><a id="a2Upload" name="a2Upload" href="javascript:void(0);"><span>Quản lý tài chính</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="pcont">
                            <div id="boxdoc01" class="boxcont">
                                <div id="u2Upload" name="u2Upload">
                                    <div class="nullresult" style="overflow:hidden;width:100%;float:left;">
                                        <div style="margin: 15px 0">
                                            <span class="sodu-hientai"><strong>Số dư tài khoản hiển tại :</strong></span>
                                            <span style="color:red;font-weight: bold;margin-right: 30px" id="sodu">&nbsp;<?=number_format(@$user_item->price);?>&nbsp;đ</span>
                                        </div>
                                        <?php if($user_item->enddate < $timeNow) : ?>
                                            <div style="margin: 15px 0">
                                                <span class="time-download">
                                                    <strong>Thời gian dowload của bạn đã hết !.Bạn vui lòng nạp thẻ cào để thêm thời gian download.</strong>
                                                </span>
                                            </div>
                                        <?php else : ?>
                                            <div style="margin: 15px 0">
                                                <span class="time-download">
                                                    <strong>Thời gian dowload đến hết ngày:</strong>
                                                    <b style="color: red"><?=date('d-m-Y',$user_item->enddate);?></b>
                                                </span>
                                            </div>
                                        <?php endif;?>
                                        <div style="line-height: 2">
                                            <strong>Chú ý</strong>:<br>
                                            <?=@$card->content;?>
                                        </div>
                                        <div style="margin: 15px 0">
                                            <a class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target=".bs-example-modal-sm-charge-s">Nạp tiền</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <h4>Lịch sử nạp thẻ</h4>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th width="15%">Stt</th>
                                                    <th w>Ngày nạp thẻ</th>
                                                    <th>Loại thẻ</th>
                                                    <th width="15%">Mã thẻ</th>
                                                    <th>Mã Seri</th>
                                                    <th width="15%">Mệnh giá</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(count($cards)) :  ?>
                                                    <?php foreach($cards as $k => $card) : ?>
                                                    <tr>
                                                        <td><?=@$k +1;?></td>
                                                        <td><?=date('d-m-Y',$card->day_create);?></td>
                                                        <td><?=$card->card_type?></td>
                                                        <td><?=@$card->card_code?></td>
                                                        <td><?=@$card->card_seri?></td>
                                                        <td><?=number_format($card->price)?>đ</td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                <?php endif;?>
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

<!---popup--->
    <div class="modal fade bs-example-modal-sm-charge-s" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="panel" >
                    <div class="panel-heading">
                        <div class="panel-title">Nạp tiền vào tài khoản
                            <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                    <div class="panel-body user-register">
                        <div id="ajax_loader" class="ajax-load-qa"> </div>
                        <div class="col-md-6">
                            <form class="form-horizontal form-bk validate" id="form-bk" role="form" method="post" action="<?=base_url('profile/transaction')?>">
                                <h5 class="title-tn1">Sử dụng thẻ cào viễn thông</h5>
                                <h6 class="tn-mgtt">Mệnh giá tối thiểu : <?=number_format(20000)?>đ</h6>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <select class="form-control validate[required]" name="chonmang" id="chonmang">
                                            <option value="">---Chọn loại thẻ---</option>
                                            <option value="VIETEL">Viettel</option>
                                            <option value="MOBI">Mobifone</option>
                                            <option value="VINA">Vinaphone</option>
                                            <option value="GATE">Gate</option>
                                            <option value="VNM">Vietnamobile</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control validate[required,custom[integer],min[10]]" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control validate[required,custom[integer],min[10]]" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control validate[required]" id="txt_captcha" name="txt_captcha" placeholder="Mã bảo vệ">
                                    </div>
                                    <div class="col-lg-5">
                                        <span id="captcha_value"></span>
                                    </div>
                                    <div class="col-lg-2 btn-refresh">
                                        <i class="fa fa-refresh" onclick="getCaptcha()"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <input type="hidden" class="form-control" id="txtuser" name="txtuser" value="<?=@$user_item->email;?>">
                                        <button type="button" onclick="sendCard()" class="btn btn-info" id="btn_sendcart" name="napthe">Nạp thẻ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <img src="<?=base_url('assets/css/img/hd_mobile.png')?>" alt="Hướng dẫn nạp thẻ">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-footer">
                        <!--<strong>Lưu ý :</strong>
                        <ul>
                            <li>
                                Sau khi tải xong sẽ không còn số dư, do bạn chọn phương thức tải không đăng nhập, bạn nên đăng nhập để tải về.
                            </li>
                            <li>
                                Mọi thắc mắc vui lòng chat trực tiếp với qts@gmail.com.
                            </li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
    </div>