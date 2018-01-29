<div class="fix-list"></div>
<article class="container content">
    <section class="col-md-12">
        <div class="row">
            <div class="menu-detail">
                <section class="cate-danh-muc">
                    <a href="#">
                        <h4><i class="fa fa-comments"></i>GÓP Ý CỦA KHÁCH HÀNG</h4>
                    </a>
                </section>
            </div><!---menu-detail--->
        </div><!--row-->
    </section>
    <!--- banner -header --->
    <div class="clearfix"></div>

    <section class="col-md-12">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <section class="col-md-12 col-sm-12 col-xs-12 comment_content">
                        <h1>khách hàng góp ý</h1>
                        Với mục đích nâng cao chất lượng phục vụ ngày càng tốt hơn, Siêu thị <b>Giá Rẻ 24h</b> mong muốn
                        nhận được những ý kiến đóng góp phản ánh của quý khách về chất lượng sản phẩm, dịch vụ khi mua
                        hàng tại <b>Giá Rẻ 24h</b>. Sau khi nhận được ý kiến đóng góp chúng tôi sẽ chuyển thông tin đến các bộ phận
                        có liên quan để giải quyết và trả lời lời Quý khách trong thời gian sớm nhất.</br></br>

                        Trong nội dung phản ảnh xin Quý khách vui lòng để lại thông tin liên hệ (<b>Họ tên, Số điện thoại,
                        email, số chứng từ..</b>) để chúng tôi có thể chuyển đến các bộ phận có liên quan giải quyết cũng
                        như thuận tiện trong việc liên hệ trả lời Quý khách. Nếu quý khách không cung cấp đầy đủ thông
                        tin chúng tôi sẽ không thể chuyển thông tin đến các bộ phận có liên quan để giải quyết cho Quý
                        khách.</br></br>

                        <b>Trân trọng cám ơn !</b></br></br></br>

                        <b><i class="fa fa-comment"></i>Góp ý từ khách hàng</b>
                     </section><!--End noi dung-->
                </div><!-- .row-->
            </div><!--col-md-7-->

            <div class="col-md-5">
                <section class="col-md-12 col-sm-12 col-xs-12" style="border: 1px solid #ccc; margin-left: 15px;">
                    <div class="form-contact" style="padding: 10px;">
                        <form action="" method="post" class="validate form-horizontal" role="form">
                            <div class="alert alert-success alert-dismissible" role="alert"
                                 style="position: fixed; right: 450px;background:none;;font-style:italic;
                                                 top:250px; width: 650px;
                                                 font-size:40px;padding: 2px; margin: auto; line-height: normal;
                                                 color: red; border: none; text-shadow: 0px 0px 5px #ffff00;
                                                 ">
                                <?php if(isset($_SESSION['message'])){
                                    echo $_SESSION['message']; unset($_SESSION['message']);}  ?>
                            </div>
                            <script type="text/javascript">
                                (function () {
                                    setTimeout(showTooltip, 1500)
                                })();

                                function showTooltip() {
                                    $('.alert-success').fadeOut();
                                }
                            </script>
                            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/front_end/validationEngine.jquery.css') ?> "  media="all">
                            <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery.js') ?>" ></script>
                            <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery.validationEngine-en.js') ?>"></script>
                            <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery.validationEngine.js') ?>"></script>
                            <script>
                                $(document).ready(function () {
                                    $(".validate").validationEngine();
                                });
                            </script>
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i  class="fa fa-user"></i></span>
                                        <input type="text" style="z-index: 0;" name="full_name" class="validate[required] form-control placeholder" id="personName"
                                               placeholder="Họ Tên" data-bind="value: name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i  class="fa fa-phone"></i></span>
                                        <input  name="phone" class="validate[required,custom[phone]] form-control placeholder" id="phone"
                                                data-original-title="Your activation email will be sent to this address."
                                                data-bind="value: email, event: { change: checkDuplicateEmail }"
                                                type="text" style="z-index: 0;" class="form-control"  placeholder="Số Điện Thoại">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i  class="fa fa-envelope"></i></span>
                                        <input type="text"  style="z-index: 0;"  placeholder="Email"
                                               name="email" class="validate[required,custom[email]] form-control placeholder" id="personEmail"
                                               data-original-title="Your activation email will be sent to this address."
                                               data-bind="value: email, event: { change: checkDuplicateEmail }">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Địa Chỉ</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text"  style="z-index: 0;" placeholder="Địa Chỉ"
                                               name="address" class="validate[required] form-control placeholder" id="personName"
                                               data-bind="value: name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label">Message</label>
                                <div class="controls">
                                    <div class="input-group" style="z-index: 0;">
                                        <span  class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <textarea  name="comment"   class="form-control placeholder"
                                                   rows="4" cols="78" placeholder="Nội Dung Góp ý"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="controls" style="margin-left: 40%;">
                                <input type="submit" style="background: #5dc300; border: none"  name="sendcontact" id="signupuser"
                                       class="btn btn-primary" value="Gửi Đi" />
                                <input type="reset" style="background: #5dc300; border: none" id="mybtn" class="btn btn-primary" value="Nhập Lại">
                            </div><!--end form-contact-->
                        </form>
                    </div><!----End from contact--->

                </section><!--col-md-8 form contact-->
            </div>
        </div>
    </section><!--content + form-->

    <div class="clearfix"></div>

    <section class="col-md-12">
        <div class="row">
            <div class="banner">
                <?php if (isset($slide_2)) {
                    foreach ($slide_2 as $item) {
                        ?>
                        <?php if ($item->url != null) echo "<a href='" . $item->url . "' target='" . $item->target . "'>"; ?>
                        <img src="<?= base_url($item->link); ?>"/>
                        <?php if ($item->url != null) echo "</a>"; ?>
                    <?php
                    }
                }?>
            </div><!-- .Banner-->
        </div><!--row-->
    </section>
    <!--- banner -header --->
</article>


