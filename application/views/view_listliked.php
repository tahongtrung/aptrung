
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
                        <section class="sidebar_title">TRANG CÁ NHÂN</section>
                        <ul style="background: #ffffff">
                            <li>
                                <a href="<?= base_url('san-pham-quan-tam') ?>">
                                    <i class="fa fa-check"></i>
                                    Sản phẩm quan tâm
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('trang-ca-nhan') ?>">
                                    <i class="fa fa-check"></i>
                                    Tin rao vặt đã đăng
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('thong-tin-dat-hang') ?>">
                                    <i class="fa fa-check"></i>
                                    Danh sách đặt hàng
                                </a>
                            </li>
                        </ul>
                    </section>
                </div><!--end row-->
            </section>
            <!---End .sidebar_box_1--->
            <section class="col-md-9 col-sm-12 col-xs-12" >
                <div class="sidebar_title" style="text-align: left !important;margin-top: 10px;">
                    <span style="margin-left: 20px !important;">Sản phẩm quan tâm</span>
                </div>
                <div id="loginbox" style="padding-top: 10px">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th width="15%">Chức năng</th>
                        </tr>
                        <?php if (isset($lists)) {
                            $s=1;
                            foreach (@$lists as $v) {
                                ?>
                                <tr>
                                    <td width="5%"><?=$s++; ?></td>
                                    <td>
                                        <img src="<?=base_url($v->image);?>" width="45" height="45">
                                    </td>
                                    <td >
                                        <a href="<?= base_url('san-pham/'.@$v->alias); ?>">
                                            <?= @$v->name;?> </a></td>
                                    <td width="15%"
                                        style="font-size: 12px">
                                        <?= number_format($v->price) ?>&nbsp; VND
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-xs">
                                            <a href="<?= base_url('users_frontend/un_like/' . @$v->id) ?>" title="Xóa"
                                               class="btn btn-xs btn-danger" style="color: #fff"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <i class="fa fa-times"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        } ?>
                    </table>
                    <div class="pagination">
                        <?php
                        echo $this->pagination->create_links(); // tạo link phân trang
                        ?>
                    </div>

                </div><!-- .loginbox-->
            </section>
            <!---End Left------->
        </div><!--end row-->
    </section>
</section>


