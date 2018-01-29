<?php if(count($banners)) : ?>
    <div class="banner" xmlns="http://www.w3.org/1999/html">
        <div id="slider2_container"
             style="position: relative; top: 0px; left: 0px; width: 1349px; height: 430px; overflow: hidden;
                                  margin:0 auto; padding:0 auto">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <!--<div style="position: absolute; display: block; background: url(<?=base_url()?>assets/css/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
            </div>-->
            </div>

            <!-- Slides Container -->

            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1349px; height: 430px; overflow: hidden;">
                <?php foreach($banners as $banner) : ?>
                    <div>
                        <img u="image" src="<?=@$banner->link;?>"/>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <!-- Arrow Navigator Skin Begin -->

        <!-- Arrow Left -->
                                <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 163px; left: 0px;">
                                </span>
        <!-- Arrow Right -->
                                <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 163px; right: 0px">
                                </span>
        <!-- Jssor Slider End -->
    </div><!--end-------------------------------banner---->
<?php endif;?>
<section class="content clearfix">
<div class="container  p-relative" style="min-height: 450px;">
    <div class="row">
        <div class="row">
            <div class="breadcrumb pull-right">
                <ul>
                    <li><a class="breadhome" href="<?=base_url()?>" title="<?=@$this->option->site_name;?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?=lang('home');?></a> </li>
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp;Thanh toán đặt hàng</a> </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="block-head clearfix">
        <h2 class="title-block">Thanh toán đặt hàng</h2>
    </div>
    <div class="block-content clearfix">
        <form id="checkoutform" action="<?= base_url('dat-hang')?>" class="validate form-horizontal" method="post" role="form">
            <div class="col-md-7 col-sm-7">
                <div class="row">
                    <div class="box_infoCart" style="margin-top: 0">
                        <div class="infor_contact_cart ">
                            <strong>Thông tin người nhận hàng</strong>
                        </div>
                        <div class="clearfix-10"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Họ tên</label>
                            <div class="col-sm-7">
                                <input type="text" class="validate[required] form-control input-sm " id="fullname" name="fullname"
                                       value="<?=@$user_item->fullname;?>" placeholder="" onkeyup="change_name()"/>
                                <input type="hidden" class=" form-control input-sm " name="user_id"
                                       value="<?=@$user_item->id;?>" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2  control-label">Email</label>
                            <div class="col-sm-7">
                                <input type="text" class="validate[required] form-control input-sm " id="email" name="email"
                                       value="<?= @$user_item->email; ?>" placeholder="" onkeyup="change_name()"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2  control-label">Điện thoaị</label>
                            <div class="col-sm-7">
                                <input type="text" class="validate[required] form-control input-sm " id="phone" name="phone"
                                       value="<?= @$user_item->phone; ?>" placeholder="Điện thoại..." onkeyup="change_name()"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2  control-label">Địa chỉ</label>
                            <div class="col-sm-7">
                                <input type="text" class="validate[required] form-control input-sm " id="address" name="address"
                                       value="<?= @$user_item->address; ?>" placeholder="Số, Nhà, Thôn, Xóm.." onkeyup="change_name()"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2  control-label">Tình thành</label>
                            <div class="col-sm-7">
                                <select name="province" class=" validate[required] required form-control input-sm" >
                                    <option class=" validate[required]" value="">--Chọn tỉnh thành-- </option>
                                    <?php foreach($province as $v){?>
                                        <option value="<?= $v->provinceid; ?>"  <?= $v->provinceid==@$user_item->province?'selected':''?>>
                                            <?= $v->name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2  control-label">Ghi chú</label>
                            <div class="col-sm-7">
                                <textarea type="text" class=" form-control input-sm " name="note" id="note" value="" placeholder="Hình ảnh, màu sắc sản phẩm.." onkeyup="change_name()"/></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="display: none !important;">
                            <div class="col-md-12" >
                                <div style="background: #edf0f0; color: #454444; margin: 0px 10px; padding: 10px; display: none">
                                    Thời gian giao hàng từ 1-2 ngày đối với Hà Nội, 2-3 ngày đối với Tp HCM, 4-7 ngày đối với các tỉnh thành khác.
                                    Phí giao hàng quy định như sau: Nội thành Hà Nội: 10.000đ, Nội thành Tp. HCM: 20.000đ, Tỉnh thành khác: 30.000đ
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5" style="border-left: 1px #ddd solid">
                <aside>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="box_infoCart" style="margin-top: 0">
                                <div class="infor_contact_cart clearfix">
                                    <b>Thông tin đơn hàng</b>
                                </div>
                                <?php if (!empty($cart)) {
                                    $stt=1;
                                    foreach ($cart as $key => $v) {
                                        ?>
                                        <div class="clearfix" style="padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px">
                                            <aside class="col-md-3 col-sm-3 col-xs-3">
                                                <a href="#"  title="">
                                                    <?= isset($v['image'])?'<img  class="img_mx100"
                                                                      src="'.base_url('upload/img/products/'.$v['pro_dir'].'/'.$v['image']).'" alt="'.$v['name'].'" class="cart-d-img" />':'';?>

                                                </a>
                                                <input type="hidden" value="<?=$v['rowid'];?>" id="rowid" name="rowid"/>
                                            </aside>
                                            <aside class="col-md-9 col-ms-9 col-xs-9">
                                                <div class="row">
                                                    <div class="infor_name">

                                                        <a href="<?=@$v['url'];?>" title="<?=$v['name'];?>"><strong><?=$v['name'];?></strong></a>

                                                    </div>
                                                    <section class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                            <span class="gray text-center font_size_10">Giá tiền</span></br>
                                                            <?=number_format($v['price_sale']);?>₫

                                                        </div>
                                                        <div class="col-md-4  col-sm-4 col-xs-4" >
                                                            <div class="numeric-input">
                                                                <div class="col-md-12">
                                                                    <span class="gray text-center font_size_10">Số lượng:</span></br>
                                                                    <input class="" style="max-width:60px " onchange="update_cart('<?=$key?>',$(this).val())"
                                                                           min="1" max="20" type="number" value="<?=$v['qty'];?>" id="qty" name="count[]">

                                                                    <input type="hidden" name="item_id[]" value="<?=$v['rowid'];?>">

                                                                    <input type="hidden" name="price_sale[]"  value="<?=$v['price_sale'];?>">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="row">
                                                                <span class="gray text-center font_size_10">Thành tiền</span><br>
                                                                <span id="item_total<?=$key;?>"><?=number_format($v['qty']*$v['price_sale']);?></span>₫


                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </aside>

                                            <div class="clearfix-10"></div>
                                        </div>
                                    <?php } ?>
                                    <div class="clearfix-10"></div>
                                    <!--<div class="payment">
                                        <a>Thanh toán: </a>
                                    </div>-->
                                    <div class="clearfix-5"></div>
                                    <div class="total ">
                                        <div class="clearfix">
                                            <label class="col-md-4 text-left">
                                                Tổng tiền :
                                            </label>
                                            <div class="col-md-8 text-right">
                                                <span><?=number_format($total)?></span><sup>đ</sup>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="clearfix s-row">
                                            <label class="col-md-4 col-sm-4 col-xs-4 text-left">
                                                Phí vận chuyển
                                            </label>
                                            <div class="col-sm-5 col-sm-5 col-xs-5 ">
                                                <select name="shipping" class=" required form-control input-sm" id="shipping" onchange="update_shipping($(this).val())">
                                                    <option class="validate[required]" value="">--Chọn khu vực-- </option>
                                                    <?php foreach($shipping as $ship){?>
                                                        <option value="<?= $ship->price; ?>"><?= $ship->name; ?>  </option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3 control-label">
                                                <strong class="shipprice">
                                                    0đ
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <label class="col-sm-4 col-sm-4 col-xs-4 ">Mã giảm giá</label>
                                            <label class="col-sm-5 col-sm-5 col-xs-5 ">
                                                <div style="position: relative; width: 100%">
                                                    <input  class="form-control" type="text" id='sale_code' name="sale_code"  placeholder="Mã giảm giá">
                                                    <div id="isset_code" style="position: absolute; right: 5px; margin-top: -20px;display: none " class="text-success">
                                                    </div>
                                                </div>
                                            </label>
                                            <div class="col-sm-4 col-sm-4 col-xs-4 control-label" style="font-weight: bold">
                                                <span id="price_sale"></span>
                                                <span id="price_sale_code"></span>
                                            </div>
                                        </div>
                                        <div class="clearfix-10"></div>
                                        <div style=" border-top: 1px solid #ddd; padding-top: 10px ">
                                            <label class="col-md-8 col-sm-8 col-xs-8 text-left red" style="font-size: 12px; padding-bottom: 10px">
                                                Tổng tiền phải thanh toán<i>(* Đã gồm VAT) </i>
                                            </label>
                                            <div class="col-md-4 col-sm-4 col-xs-4 text-right red">
                                                <div id="new_total">
                                                    <b><?=number_format(@$total);?><sup>đ</sup></b>
                                                </div>
                                                <input type="hidden" id="total_price_add" value="<?=(@$total);?>" name="total_price_add" placeholder="Số tiền phải thanh toán">
                                                <input type="hidden" name="shipping" value="0" id="value_ship">
                                                <input type="hidden" value="0" id="value_code">
                                                <input type="hidden"  value="<?=@$total.'đ'?>" id="_total">
                                                <input name="total_all" type="hidden" value="<?=@$total.'đ'?>" id="_total_input">
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{?>
                                    <tr>
                                        <td colspan="6" class="align-left"><strong class="red">→
                                                Giỏ hàng của bạn hiện không có sản phẩm nào!</strong></td>
                                    </tr>
                                <?php  }?>

                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        <div class="clearfix-10"></div>
        <!-- Button -->
        <div class="col-sm-7 controls text-right" style="padding: 10px 0"  >
            <div class="row" style="margin-bottom: 10px;">
                <button  name="sendcart"  id="btn-login"  class="btn btn-blue">Gửi đơn hàng</button>
            </div>
        </div>

        </form>

    <div class="pull-left" style="padding:10px 0">
        <form action="<?= base_url('checkout-baokim'); ?>" class="validate form-horizontal" method="post" role="form">
            <?php if (!empty($cart)) {   $stt=1; foreach ($cart as $key => $v) {  ?>
                <input type="hidden" value="<?=$v['rowid'];?>" id="rowid" name="rowid"/>
                <input class="" style="max-width:60px " onchange="update_cart('<?=$key?>',$(this).val())"
                       min="1" max="20" type="hidden" value="<?=$v['qty'];?>" id="qty" name="count[]">
                <input type="hidden" name="item_id[]" value="<?=$v['rowid'];?>">
                <input type="hidden" name="price_sale[]"  value="<?=$v['price_sale'];?>">
            <?php   }} ?>
            <div class="clearfix"></div>
            <input type="hidden" name="user_id" value="<?=@$user_item->id;?>" placeholder=""/>
            <input type="hidden"  name="province" value="<?=@$user_item->province;?>" placeholder=""/>
            <input type="hidden" id="payer_name" name="payer_name"  value="<?=@$user_item->fullname;?>" placeholder="họ tên">
            <input type="hidden" id="payer_phone_no" name="payer_phone_no" value="<?=@$user_item->phone;?>" placeholder="Số điện thoại">
            <input type="hidden" id="payer_email" name="payer_email" value="<?=@$user_item->email;?>" placeholder="Email">
            <input type="hidden" id="address_hidden" name="address_hidden" value="<?=@$user_item->adress;?>" placeholder="Địa chỉ">
            <input type="hidden" id="note_hidden" name="note_hidden"  placeholder="Ghi chú">
            <input  type="hidden" id="code_sale_all_hidden" value="" name="code_sale_all_hidden" placeholder="% Khuyến mại">
            <input  type="hidden" id="price_ship_hidden" value="" name="price_ship_hidden" placeholder="Phí vận chuyển">
            <input  type="hidden" id="total_amount" value="<?=(@$total);?>" name="total_amount" placeholder="Số tiền phải thanh toán">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <?php
            if($this->session->userdata('userid')){
                echo '<button  name="sendcart_bk"  id="btn-login"  class="btn btn-blue">Thanh Toán Trực Tuyến</button> ';
            }else{
                echo '<a href="javascript:return 0" onclick="getModalLogin()">
                             <button  id="btn-login"  class="btn btn-blue" type="button"  >Thanh Toán Trực Tuyến</button>
                            </a>';
            }
            ?>
        </form>
    </div>
    </div>
</div>
</div>
</div>

</section>
<script>

    function change_name(){
        var fullname = $("#fullname").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var note = $("#note").val();
        document.getElementById('payer_name').value = fullname;
        document.getElementById('payer_phone_no').value = phone;
        document.getElementById('payer_email').value = email;
        document.getElementById('address_hidden').value = address;
        document.getElementById('note_hidden').value = note;

    }
    $('#sale_code').keyup(function(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo base_url()?>' + 'shoppingcart/check_sale',
            data: {code:$(this).val()},
            success: function (rs) {
                if(rs.check==true){
                    /*alert($('#_total').val());*/
                    var _total= parseInt($('#_total').val())*parseInt(rs.item.price)/100;
                    $('#value_code').val(_total);
                    $('#price_sale').html(rs.item.price + '%');
                    $('#price_sale_code').html('<input type="hidden" name="code_sale_all" class="input_fomart" style="padding-left: 40px !important;" value="'
                        + rs.item.price  + '">');
                    $('#new_total').html('<b class="red" >'+formatNumber((parseInt($('#_total').val())-parseInt(_total)) + parseInt($('#value_ship').val())) +'đ</b>');
                    $('#_total_input').val(parseInt($('#_total').val())-_total) ;
                    $('#isset_code').html('<i class="fa fa-check"></i>').fadeIn('show').css('color','#569b4a');
                    /* total bao kim */
                    $("#total_amount").val(((parseInt($('#_total').val())-parseInt(_total)) + parseInt($('#value_ship').val())));
                    $("#total_price_add").val(((parseInt($('#_total').val())-parseInt(_total)) + parseInt($('#value_ship').val())));
                    $("#code_sale_all_hidden").val( rs.item.price );
                }
            }
        })
    })
        .change(function(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '<?php echo base_url()?>' + 'shoppingcart/check_sale',
                data: {code:$(this).val()},
                success: function (rs) {
                    if(rs.check==false){
                        var _total= parseInt($('#_total').val())*parseInt(rs.item.price_sale)/100;
                        $('#new_total').html(formatNumber(parseInt($('#_total').val()-parseInt(_total)) + parseInt($('#value_ship').val())) + 'đ');
                        $('#isset_code').html('<i class="fa fa-times"></i>').fadeIn('show').css('color','red');
                        $('#price_sale').html(rs.item.price_sale);
                    }
                }
            })
        });
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    function update_shipping(price_sale){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo base_url()?>' + 'shoppingcart/update_shipping',
            data: {price_sale:price_sale},
            success: function (ketqua) {
                $('#new_total').html('<b class="red" >' + formatNumber(parseInt($('#_total').val()) +(-parseInt($('#value_code').val()) +
                    parseInt(ketqua.shipp))) + 'đ</b>') ;
                $('#value_ship').val(ketqua.shipp);
                $('.shipprice').html('<input type="text" style="float: left; padding-left: 32px !important;" name="price_ship"  class="input_fomart" value="' + (ketqua.shipp)  + '">' + '<b style="float: left;color: red;">đ</b>'  );
                $('.total_price').html(formatNumber(ketqua.total));
                /* total bao kim*/
                $("#total_amount").val((parseInt($('#_total').val()) +(-parseInt($('#value_code').val()) + parseInt(ketqua.shipp))));
                $("#total_price_add").val((parseInt($('#_total').val()) +(-parseInt($('#value_code').val()) + parseInt(ketqua.shipp))));
                $("#price_ship_hidden").val(ketqua.shipp);
            }
        })
    }
    function update_cart(id,qty){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo base_url()?>' + 'shoppingcart/update_cart',
            data: {id:id,qty:qty},
            success: function (ketqua) {
                $('#count_cart').html(ketqua.count);
                $('#new_total').html('<input type="text" class="input_fomart" style="padding-left: 40px !important;"  name="total_price" value="' + formatNumber(ketqua.total) + 'đ' + '">' );
//                        $('#total_cart').html(formatNumber(ketqua.total));
                $('#item_total'+id).html(formatNumber(ketqua.item_total));
                $('.number_item').html(ketqua.count);
                $('.total_price').html(formatNumber(ketqua.total));
            }
        })
    }




</script>
<script>
    function payment_note1(temp_value)
    {
        $('.payment-note').hide();
        $('#payment-note'+temp_value).show();
    }
    $(document).ready(function(){
        $('.validate').validationEngine();
    });
</script>
