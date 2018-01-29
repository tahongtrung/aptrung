<link href="<?=base_url()?>assets/css/front_end/profiles.css" rel="stylesheet" type="text/css">
<section class="content clearfix">
    <div class="container">
        <div class="row">
        <div id="pw990">
            <div id="pw300" class="col-md-3 col-sm-12 col-xs 12">
                <div id="boxprofile">
                    <div class="ptt"><strong class="pclink"><?=@$user_item->fullname;?></strong></div>
                    <div class="inner">
                        <img src="<?=base_url($user_item->logo)?>" alt="kingoffwar" onerror="this.src='http://image.tailieu.vn/avatar/member/onerror_200.jpg'" width="100%" height="170" class="ava160x170">
                    </div>
                </div>
                <div id="pbox03" class="pbox pboder hidden-xs hidden-sm">
                    <div class="ptt">
                        <p class="inl"><strong class="pclink">Tổng quan</strong></p>
                    </div>
                    <div class="pcont">
                        <div class="boxcont">
                            <ul class="listinfo">
                                <li><a href="<?=base_url('thong-tin-tai-khoan')?>" title="Thông tin tài cá nhân"><i class="fa fa-user"></i>&nbsp;Thông tin cá nhân</a></li>
                                <li><a href="<?=base_url('quan-ly-tai-chinh')?>" title="Quản lý tài chính"><i class="fa fa-university"></i>&nbsp;Quản lý tài chính</a></li>
                                <li><a href=""><i class="fa fa-university"></i>&nbsp;Quản lý tài liệu</a></li>
                            </ul>
                        </div>
                    </div>
                </div>		      </div>
            <div id="pw678" class="col-md-9 col-sm-12 col-xs 12">
                <div id="pbox04" class="pbox pmovebox pboder col-sm-12 col-xs 12">
                    <div class="ptt">
                        <div class="docmenu fleft">
                            <ul class="mnu">
                                <li id="a2Upload_li" name="a2Upload_li" class="active item"><a id="a2Upload" name="a2Upload" onclick="loadTabBoxSpecial(2,&quot;Upload&quot;);return false;" href="javascript:void(0);"><span>Upload (0)</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pcont">
                        <div id="boxdoc01" class="boxcont">
                            <div id="u2Upload" name="u2Upload">
                                <div class="nullresult" style="overflow:hidden;width:100%;float:left;"><center>chưa có tài liệu nào!</center></div>
                            </div>
                            <div class="page_view" id="p2Upload" name="p2Upload">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pbox04" class="pbox pmovebox pboder col-sm-12 col-xs 12">
                    <div class="ptt">
                        <div class="docmenu fleft">
                            <ul class="mnu">
                                <li id="a2Upload_li" name="a2Upload_li" class="active item"><a id="a2Down" name="a2Down" onclick="loadTabBoxSpecial(2,&quot;Down&quot;);return false;" href="javascript:void(0);"><span>Download (0)</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="pcont">
                        <div id="boxdoc01" class="boxcont">
                            <div id="u2Down" name="u2Down">
                                <div class="nullresult" style="overflow:hidden;width:100%;float:left;"><center>chưa có tài liệu nào!</center></div>
                            </div>
                            <div class="page_view" id="p2Down" name="p2Down">
                            </div>
                            <div class="page_view" id="p2Sugg" name="p2Sugg" style="display:none"></div>
                            <div class="page_view" id="p2Coll" name="p2Coll" style="display:none"></div>
                            <div class="page_view" id="p2CFav" name="p2CFav" style="display:none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="clear"></div>
    </div>
</div>