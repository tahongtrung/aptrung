<section class="block-type-title">
    <div class="container">
        <h3>Giỏ hàng</h3>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="block-breacrumb">
            <a href="#">Trang chủ &nbsp<i class="fa fa-angle-right"></i> </a>
            <a href="#">Giỏ hàng</a>
        </div>
        <div class="clearfix">
            <p><b><u>Hướng dẫn:</u></b> Để xóa sản phẩm khỏi giỏ hàng, click <b>Xóa</b> / Để thêm số lượng,
                điền số lượng sản phẩm vào ô rồi click <b>Cập nhật</b></p>
            <table class="orderinfo-table col-md-12 col-sm-12 itemInfo-table table-bordered">
                <tbody>
                <tr  style="padding: 10px 2px;height: 31px; margin-bottom: 10px !important; ">
                    <th class="th-title">Thông tin sản phẩm</th>
                    <th class="th-title">
                        <div class="col-xs-6">
                            <select class="form-control form-address">
                                <option value="">Địa điểm</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            Tên sản phẩm
                        </div>
                    </th>
                    <th class="th-title">Số lượng</th>
                    <th class="th-title">Giá bán</th>
                    <th class="th-title">Giá tốt</th>
                    <th class="th-title">Tổng cộng</th>
                    <th class="th-title"></th>
                </tr>
                <div class="clear-fisrt clearfix"></div>
                <tr style="padding: 10px 2px;height: 31px; margin-bottom: 10px !important; ">
                    <td>
                        <a href="#"  title="LG G3 D855 - 16GB Gold">
                            <img  style="width: 200px; height:150px; margin:10px" src="images/502.jpg" alt="LG G3 D855 - 16GB Gold" />
                        </a>
                    </td>
                    <td><a href="http://pico.vn/24904/dien-thoai-di-dong-lg-optimus-g3-d855--16gb-gold.html"
                           title="LG G3 D855 - 16GB Gold">LG G3 D855 - 16GB Gold</a></td>
                    <td>
                        <div class="numeric-input"><input type="text" value="1" id="item_24904"
                                                          onchange="updateCart(24904,1)"><span
                                class="arrow-up"><i class="icons icon-up-dir"></i></span><span
                                class="arrow-down"><i class="icons icon-down-dir"></i></span></div>
                    </td>
                    <td>8.488.000₫</td>
                    <td>0₫</td>
                    <td>8.488.000₫</td>
                    <td>
                        <p><a href="javascript:deleteFromCart(24904,1)">Xóa</a></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="align-right">Tổng tiền đơn hàng (<i>* Đã bao gồm VAT </i>)</td>
                    <td><strong>8.488.000₫</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" class="align-left"><strong class="red">→ Miễn phí vận chuyển nội thành
                            Hà Nội với đơn hàng trên 200.000 vnđ</strong></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <div style="text-align: right" class="btn-green checkout_btn" data-toggle="modal"
                 data-target=".bs-example-modal-sm_checkout">
                <div class="button-green">
                    <i class="icons icon-basket-2"></i>Thực hiện đặt hàng
                </div>
            </div>
            <div style="text-align: right" class="checkout_btn" onclick="window.history.go(-2);">
                <div class="button-continue">
                    <i class="icons icon-basket-2"></i>Tiếp tục mua hàng
                </div>
            </div>
            <div style="text-align: right" class="checkout_btn">
                <a href="<?= base_url('shoppingcart/destroy_cart') ?>" class="button-destroy"
                   onclick="return confirm('Hủy giỏ hàng sẽ xóa toàn bộ sản phẩm trong giỏ hàng của bạn?')">
                    <i class="icons icon-basket-2"></i>Hủy giỏ hàng
                </a>
            </div>
        </div>
        <div class="block-type-title" style="margin-top: 50px">
            <h2>Thông Tin Đặt Hàng</h2>
        </div>
        <div class="form-register-aisle">
            <div class="aisle-title">Thông tin liên hệ</div>
            <div class="aisle-content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Họ tên:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="fullname" id="fnullname" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Số điện thoại:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Địa chỉ:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address" placeholder="">
                        </div>
                    </div>
                    <div class="aisle-title">Thông tin người nhận thay nếu bạn bận</div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Họ tên:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="fullname" id="fnullname" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Số điện thoại:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Địa chỉ:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Thời gian nhận hàng:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="time" id="time" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email">Ghi chú:</label>
                        <div class="col-sm-9">
                            <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info pull-right">Đặt hàng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>