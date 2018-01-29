
                <div class="col-md-9 col-sm-12 col-xs-12" >
                    <section class="content_about" >
                        <h3 style="text-shadow:0px 0px 15px #f9ff5f; color:#596067;
                            border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                            Thông tin đăng ký!
                        </h3><br>
                        <?php if(isset($_GET['reset'])){?>
                                <p> Chúng tôi đã gửi email lấy lại mật khẩu vào địa chỉ hòm thư <b><a href=""> <?=@$u2->email;?></a></b>, vui lòng kiểm tra hộp thư đến của quý khách.</p>

                        <p>Quý khách lưu ý kiểm tra hòm thư trong tất cả thư mục (bao gồm Inbox và Bulk mail) để tìm thư đến từ địa chỉ
                            <b><a href=""> support_douong@gmail.com</a></b>. Đôi khi do đường truyền mà email có
                            thể đến
                            chậm
                            5-10 phút.</p>

                        <p>  Quý khách chỉ thực sự hoàn tất thủ tục đăng ký thành viên sau khi đã kích hoạt tài khoản
                            được gửi từ mail kích hoạt  <b><a href=""> Đồ uống</a></b>. </p>

                        <p>  Khi cần trợ giúp, vui lòng gọi <b>090123456</b> hoặc <b>0912345678</b> (Giờ hành chính: 8h15-18h00)</p>

                        <p> Email hỗ trợ kỹ thuật support_douong@gmail.com nếu quý khách không nhận được thông tin kích
                            hoạt tài khoản.</p>

                        <?php  }else{
                         if(isset($u)){?>
                            <div class="confirm" >

                                <p>Cảm ơn quý khách đã đăng ký tài khoản! </p>

                                <p> Chúng tôi đã gửi một email vào địa chỉ hòm thư <b><a href=""> <?=@$u->email;?></a></b>, vui lòng kiểm tra và kích hoạt tài khoản của quý khách.</p>

                                <p>Quý khách lưu ý kiểm tra hòm thư trong tất cả thư mục (bao gồm Inbox và Bulk mail) để tìm thư đến từ địa chỉ
                                    <b><a href=""><?=@$this->option->site_email;?></a></b>. Đôi khi do đường truyền mà email có thể đến chậm 5-10 phút.</p>

                                <p>  Quý khách chỉ thực sự hoàn tất thủ tục đăng ký thành viên sau khi đã kích hoạt tài khoản được gửi từ mail kích hoạt  <b><a href="">Hoc ky thuat</a></b>. </p>

                                <p>  Khi cần trợ giúp, vui lòng gọi <b><?=@$this->option->hotline1;?></b> hoặc <b><?=@$this->option->hotline2;?></b> (Giờ hành chính: 8h15-18h00)</p>

                                <p> Email hỗ trợ kỹ thuật kythuat@hockythuat.com nếu quý khách không nhận được thông tin kích hoạt tài khoản.</p>

                            </div>
                        <?php }else{?>
                            <div class="confirm" >

                                <p>Đăng ký không thành công, đã có lỗi khi gửi mail đến email bạn đăng ký hoặc email của bạn không tồn tại! </p>



                                <p> Email hỗ trợ kỹ thuật <?=@$this->option->site_email;?> nếu quý khách không nhận được
                                    thông
                                    tin kích hoạt tài khoản.</p>

                            </div>
                        <?php }
                        }?>


                    </section>
                </div>
                </section>


