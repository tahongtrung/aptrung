

<div class="container  p-relative" style="min-height: 450px;">
    <div class="row">

        <?php
        require_once('baokim_constants.php');
        require_once('baokim_payment_pro.php');
        require_once('baokim_payment.php');
        $baokim = new BaoKimPaymentPro();
        $banks = $baokim->get_seller_info();
        ?>
        <link href="<?= base_url('assets/plugin/baokim/css/main.css') ?>" rel="stylesheet" media="all"/>
        <link href="<?= base_url('assets/plugin/baokim/css/bootstrap-responsive.css') ?>" rel="stylesheet" media="all"/>
        <script src="<?= base_url('assets/plugin/baokim/js/jquery-1.9.1.min.js') ?>"  type="text/javascript"></script>
        <script src="<?= base_url('assets/plugin/baokim/js/jquery.number.js') ?>"  type="text/javascript"></script>
        <div id="wrapper">
            <!-- nav -->
            <div class="nav">
                <div class="nav_title">Phương thức thanh toán</div>
            </div>
            <!--/ end nav -->

            <!-- payment -->
            <div class="payment_list">
                <div id="select_payment">
                    <form method="post" action="" id="form-action">
                        <div class="row-fluid customer_info ">
                            <div class="info">
                                <dl class="dl-horizontal">
                                    <?php foreach($list_info_baokim as $info){
                                        if($info[0] == @$madon_hang){ ?>
                                            <dt>Họ tên:</dt>
                                            <dd><input type="text" value="<?= $info[1]?>" name="payer_name"></dd>
                                            <dt>Số điện thoại:</dt>
                                            <dd><input type="text" value="<?= $info[2]?>" name="payer_phone_no"></dd>
                                            <dt>Email:</dt>
                                            <dd><input type="text" value="<?= $info[3]?>" name="payer_email"></dd>
                                            <dt>Địa chỉ:</dt>
                                            <dd><input type="text" value="<?= $info[4]?>" name="address"></dd>
                                            <dt>Số tiền thanh toán:</dt>
                                            <dd style="margin-top: 5px; color:darkred; font-weight: bold">
                                                <?= number_format($info[5]); ?> vnđ
                                            </dd>
                                            <dd><input id="total_amount" value="<?= $info[5]?>" type="hidden" name="total_amount"  readonly="readonly"></dd>
                                            <!--                                <dt>Mã đơn hàng:</dt>-->
                                            <dd><input id="order_code" value="<?= $info[0]?>" type="hidden" name="order_code"  readonly="readonly"></dd>
                                            <?php break; }} ?>
                                </dl>
                            </div>
                        </div>
                        <div class="method row-fluid" id="2">
                            <div class="icon">
                                <img src="<?= base_url('assets/plugin/baokim/images/creditcard.png')?>" border="0"/>
                            </div>
                            <div class="info">
                                <span class="title">Thanh toán trực tuyến bằng thẻ quốc tế <!--<img src="images/safe.png" border="0" style="vertical-align: bottom; margin-left: 5px;" />--></span>

                                <div class="bank_list">
                                    <ul id="b_l">
                                        <?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_CREDIT_CARD); ?>
                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            </div>
                            <div class="check_box"></div>
                        </div>

                        <div class="row-fluid method" id="3">
                            <div class="icon">
                                <img src="<?= base_url('assets/plugin/baokim/images/transfer.png')?>" border="0"/></div>
                            <div class="info">
                                <span class="title">Chuyển khoản InternetBanking</span>
                                <span class="desc">Chọn ngân hàng thanh toán</span>

                                <div class="bank_list">
                                    <ul id="b_l">
                                        <?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_INTERNET_BANKING); ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="check_box"></div>
                        </div>
                        <div class="row-fluid method" id="1">
                            <div class="icon">
                                <img src="<?= base_url('assets/plugin/baokim/images/atm.png')?>" border="0"/></div>
                            <div class="info">
                                <span class="title">Thanh toán trực tuyến bằng thẻ ATM nội địa</span>
                                <span class="desc">Chọn ngân hàng thanh toán</span>

                                <div class="bank_list">
                                    <ul id="b_l">
                                        <?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_LOCAL_CARD); ?>
                                    </ul>
                                    <div class="clr"></div>
                                </div>
                            </div>
                            <div class="check_box"></div>
                        </div>

                        <div class="row-fluid method" id="0">
                            <div class="icon">
                                <img src="<?= base_url('assets/plugin/baokim/images/sercurity.png')?>" border="0"/></div>
                            <div class="info">
                                <div class="bk_logo">
                                    <a href="http://baokim.vn" target="_blank">
                                        <img src="<?= base_url('assets/plugin/baokim/images/bk_logo.png')?>" border="0"/></a></div>
                                <span class="title">Thanh toán Bảo Kim</span>
                                <span class="desc">Thanh toán bằng tài khoản Bảo Kim (Baokim.vn)</span>
                            </div>
                            <div class="check_box" id="check_bk"></div>
                        </div>
                        <input type="hidden" name="active_submit" value="submit"/>
                        <input type="hidden" name="bank_payment_method_id" id="bank_payment_method_id" value=""/>
                        <input type="hidden" name="shipping_address" size="30" value="Hà Nội"/>
                        <input type="hidden" name="payer_message" size="30" value="Ok"/>
                        <input type="hidden" name="extra_fields_value" size="30" value=""/>
                        <input type="hidden" name="extra_payment" id="extra_payment" value=""/>
                        <div class="submit">
                            <input type="submit" class="btn btn-success pm_submit" name="submit" value="Hoàn thành"/>
                        </div>
                    </form>
                </div>

            </div>
            <!--/ end payment -->
        </div>
        <script>
            $("#total_amount").number( true, 0 , ',','.' );
            $(function () {
                $('#check_bk').click(function(){
                    $('#bank_payment_method_id').val(0);
                });

                $('.img-bank').click(function () {
                    $('.method img').removeClass('img-active');
                    $(this).addClass('img-active');
                    var id = $(this).attr('id');
                    $('#bank_payment_method_id').val(id);
                });

                $('.method').click(function () {
                    $(this).siblings().children().find('img').removeClass('img-active');
                    $('.method').removeClass('selected');
                    $('.check_box').removeClass('checked_box');
                    $(this).addClass('selected');
                    $('.selected .check_box').addClass('checked_box');
                    var method = $(this).attr('id');
                    if (method != 0) {
                        //$('.mode').css('display','block');
                        $('.info1').slideDown();
                        $('.selected img').click(function () {
                            $('.method img').removeClass('img-active');
                            $(this).addClass('img-active');
                            var id = $(this).attr('id');
                            $('#bank_payment_method_id').val(id);

                        });
                    }
                    else {
                        //$('.mode').css('display','none');
                        $('.info1').slideUp('slow');
                        $('.method img').removeClass('img-active');
                    }
                    $('#form-action').attr('action', '<?= base_url('baokim_request')?>');
                });

                $('.input-mode').click(function () {
                    var a = $(this).val();
                    if (a == 2) {
                        $('#daykeep').css('display', 'block');
                    }
                    if (a == 1) {
                        $('#daykeep').css('display', 'none');
                    }

                });
            });
        </script>


