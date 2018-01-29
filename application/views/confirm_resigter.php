<section class="container">
    <div class="fix-list"></div>
    <div class="menu-detail" style="margin-top: 50px;">
        <section class="cate-danh-muc">
            <a href="#">
                <p><?= $page->name; ?></p>
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
                <section class="content_about" style="margin-top: -10px;">
                    <h3 style="text-shadow:0px 0px 15px #f9ff5f; color:#596067;
                        border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                        Đăng ký thành công
                    </h3><br>
                    <p class="confirm" >
                        Cảm ơn quý khách đã đăng ký tài khoản!</br>

                        Chúng tôi đã gửi một email vào địa chỉ hòm thư <b><a href=""> tkcamdo1994@gmail.com</a></b>, vui lòng kiểm tra và kích hoạt tài khoản của quý khách.</br>

                        Quý khách lưu ý kiểm tra hòm thư trong tất cả thư mục (bao gồm Inbox và Bulk mail) để tìm thư đến từ địa chỉ <b><a href=""> support@giare24h.com.vn</a></b>. Đôi khi do đường truyền mà email có thể đến chậm 5-10 phút.</br>

                        Quý khách chỉ thực sự hoàn tất thủ tục đăng ký thành viên sau khi đã kích hoạt tài khoản được gửi từ mail kích hoạt  <b><a href=""> Giá Rẻ 24H</a></b>.</br>

                        Khi cần trợ giúp, vui lòng gọi <b>0904.889968</b> hoặc <b>1900.6666</b> (Giờ hành chính: 8h15-18h00)</br>

                        Email hỗ trợ kỹ thuật webmaster@pico.com.vn nếu quý khách không nhận được thông tin kích hoạt tài khoản.</br>

                    </p>
                </section>
            </section>
            <!---End Left------->
        </div><!--end row-->
    </section>
</section>
