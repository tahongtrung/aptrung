











<script type="text/javascript" src="<?= base_url('assets/plugin/autonumber/autoNumeric.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/plugin/autonumber/jquery.number.js') ?>"></script>

<section class="container">
<div class="fix-list"></div>
<div class="menu-detail" style="margin-top: 50px;">
    <section class="cate-danh-muc">
        <a href="#">
            <p>Đăng tin</p>
        </a>
    </section>
</div><!---menu-detail--->
<div class="clearfix"></div>

<section class="col-xs-12">
<div class="row">
<section class="col-md-3  col-sm-12 col-xs-12">
    <div class="row">
        <section class="sidebar">
            <section class="sidebar_title">CÓ THỂ BẠN QUAN TÂM</section>
            <ul style="background: #ffffff">
                <li>
                    <a href="<?= base_url() ?>">
                        <i class="fa fa-home"></i>
                        Trang chủ
                    </a>
                </li>
                <?php if (isset($menu_right)) {
                    foreach ($menu_right as $n) {
                        ?>
                        <li>
                            <a href="<?= base_url(@$n->url); ?>">
                                <i class="sidebar_icon ">
                                    <img src=" <?= base_url( @$n->icon) ; ?>" />
                                </i>
                                <?= $n->name; ?>
                            </a>
                        </li>
                    <?php
                    }
                } ?>
            </ul>
        </section>
    </div><!--end row-->
</section>
<!---End .sidebar_box_1--->
<section class="col-md-9 col-sm-12 col-xs-12" >
    <div id="loginbox" style="padding-top: 10px">

    <form  class="validate form-horizontal"   method="post" action="" role="form" enctype="multipart/form-data" >
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Thông tin bài đăng</div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

            <div class="form-group">
                <label for="tieude"  style="text-align:left !important; "
                       class="col-md-3 control-label">Tiêu đề</label>
                <div class="col-md-9">
                    <input type="text" class="validate[required]   form-control input-sm "
                           name="tieude" placeholder="Tiêu đề" value="<?= @$raovat->tieude; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="password" style="text-align:left !important; "
                       class="col-md-3 control-label ">Loại</label>
                <div class="col-md-9">
                    <select   class="form-control input-sm   validate[required]" name="loai_giaodich">
                        <option value="1"<?= @$raovat->loai_giaodich==0?'selected':''; ?>>--Chọn loại--</option>
                        <option value="1"<?= @$raovat->loai_giaodich==1?'selected':''; ?>>Bán</option>
                        <option value="2" <?= @$raovat->loai_giaodich==2?'selected':''; ?>>Cho thuê</option>
                        <option value="3" <?= @$raovat->loai_giaodich==3?'selected':''; ?>>Cần bán</option>
                        <option value="4" <?= @$raovat->loai_giaodich==4?'selected':''; ?>>Cần thuê</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="password" style="text-align:left !important; "
                       class="col-md-3  control-label">Ngày bắt đầu</label>
                <div class="col-md-9">
                    <input type="text" class="validate[required]   form-control input-sm "
                           id="datetimepicker" name="ngay_batdau"
                           placeholder="Ngày bắt đầu"
                           value="<?= date('d-m-Y',$raovat->ngay_batdau); ?>">
                </div>
            </div>
            <div class="form-group">
                <label  style="text-align:left !important; "
                        class=" col-md-3 control-label">Ngày kết thúc </label>
                <div class="col-md-9">
                    <input type="text" class="validate[required]  form-control input-sm "
                           id="datetimepicker1" name="ngay_ketthuc" placeholder="Ngày kết thúc"
                           value="<?= date('d-m-Y',$raovat->ngay_ketthuc); ?>">
                </div>
            </div>



        </div>
    </div><!-- .panel panel-info-->
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Thông tin cơ bản</div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <div class="form-group">
                <label for="tinhthanh" style="text-align:left !important; "
                       class="col-md-3 control-label ">Tỉnh/Thành</label>
                <div class="col-md-9">
                    <select id="location99"  class="form-control input-sm  " name="tinh_thanh">
                        <option value="0">--Chọn Tỉnh/Thành--</option>
                        <?php
                        foreach(@$province as $t){?>
                            <option value="<?=$t->provinceid;?>"
                                <?=@$raovat->tinh_thanh==$t->provinceid?'selected':''?>>
                                <?=$t->name;?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="district" style="text-align:left !important; "
                       class="col-md-3 control-label ">Khu Vực</label>
                <div class="col-md-9">
                    <select id="distric99"  class="form-control input-sm  " name="quan_huyen">

                        <?php
                        foreach(@$district as $t){?>
                            <option value="<?=$t->districtid;?>"
                                <?=(string)$raovat->quan_huyen==(string)$t->districtid?'selected':'';?>>
                                <?=$t->name;?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <?php if ($raovat->anh != null) { ?>
                    <label class=" col-md-3 control-label"  style="text-align:left !important;" >Ảnh đại diện</label>
                    <div class="col-md-2">
                        <input type="file"  value="<?= @$raovat->anh; ?>"  name="userfile"  >
                    </div>
                    <div class="col-md-3 text-right">
                        <label class="control-label">Ảnh:</label>
                        <img src="<?= base_url($raovat->anh) ?>"
                             style="width: 100px; max-height: 100px"/>
                    </div>
                <?php } ?>
            </div>


            <div class="form-group">
                <div>
                    <label   style="text-align:left !important; "
                             class=" col-md-3 control-label">Tải thêm ảnh</label>
                    <div class="col-md-3">
                        <input type="file"  multiple=""
                               id="file_more" name="file_more[]"  >
                    </div>
                </div>

                <div class="col-md-12">
                    <figure class="list-img">
                        <?php if (isset($pro_image)) {
                            $s=1;
                            foreach ($pro_image as $v1) {
                                ?>
                                <?php if ($v1->link != null) { ?>
                                    <img style="height: 100px; width: 100px; " src="<?= base_url($v1->link) ?>" style="width: 80px">
                                <?php } else {
                                    echo '';
                                } ?>
                            <?php
                            }
                        }?>
                    </figure>
                </div>


            </div>
        </div>
    </div><!-- .panel panel-info-->
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Nội dung</div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <div class="form-group">
                <div class="col-md-12">
                    <textarea name="noidung" class=" form-control input-sm  " id="ckeditor"
                              style="height: 200px"><?= @$raovat->noidung; ?></textarea>
                    <?php echo display_ckeditor($ckeditor); ?>
                </div>
            </div>
        </div>
    </div><!-- .panel panel-info-->
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Thông tin liên hệ</div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <div class="form-group">
                <label for="ten_lienhe" style="text-align:left !important; "
                       class="col-md-3  control-label">Tên liên hệ</label>
                <div class="col-md-9">
                    <input type="text"
                           class=" validate[required] form-control input-sm " name="ten_lienhe"
                           placeholder="Tên liên hệ" value="<?= @$raovat->ten_lienhe; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="diachi_lienhe" style="text-align:left !important; "
                       class=" col-md-3 control-label">Địa chỉ</label>
                <div class="col-md-9">
                    <input type="text" class="form-control input-sm " id="diachi_lienhe"
                           value="<?= @$raovat->diachi_lienhe; ?>" name="diachi_lienhe" placeholder="Địa chỉ">
                </div>
            </div>
            <div class="form-group">
                <label for="dienthoai_lienhe" style="text-align:left !important; "
                       class=" col-md-3 control-label">Điện thoại</label>
                <div class="col-md-9">
                    <input type="text" class="validate[required,custom[phone,minSize[10]]  form-control input-sm "
                           id="dienthoai_lienhe" value="<?= @$raovat->dienthoai_lienhe; ?>" name="dienthoai_lienhe" placeholder="Điện thoại">
                </div>
            </div>
            <div class="form-group">
                <label   style="text-align:left !important; "
                         class=" col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="text" class="form-control input-sm "
                           id="email_lienhe" value="<?= @$raovat->email_lienhe; ?>" name="email_lienhe" placeholder="Email">
                </div>
            </div>




        </div>

    </div><!-- .panel panel-info-->

    <div class="form-group">
        <!-- Button -->
        <div class="col-md-offset-3 col-md-9 controls">
            <button id="btn-login" type="submit" name="editraovat"  class="btn btn-success">Lưu </button>
        </div>
    </div>


    </form>

    </div><!-- .loginbox-->
</section>
<!---End Left------->
</div><!--end row-->
</section>
</section>


<link href="<?= base_url('assets/plugin/datetimepicker/jquery.datetimepicker.css') ?>"  rel="stylesheet" media="all"/>
<script>
    $('#price,#dientich').autoNumeric();
</script>

<script type="text/javascript" src="<?= base_url('assets/plugin/datetimepicker/jquery.datetimepicker.js') ?>"></script>
<input type="hidden" value="<?=base_url();?>" id="baseurl">
<script type="text/javascript">
    $('#datetimepicker,#datetimepicker1').datetimepicker({

        onGenerate:function( ct ){
            $(this).find('.xdsoft_date')
                .toggleClass('xdsoft_disabled');
        },
        timepicker:false,
        format:'d-m-Y'

    });

    $(document).ready(function(){
        $("#location9").change(function(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: $('#baseurl').val() + 'user_post/getdistric',
                data: {id:this.value},
                success: function (result) {
                    var sc='';
                    $.each(result, function (key, val) {
                        sc += '<option value="' + val.districtid + '">' + val.name + '</option>';
                    });
                    $('#distric9').html(sc);
                }
            })
        });
    });
    //ajax

</script><!--ajax from contrycite-->