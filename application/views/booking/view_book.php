<article class="block-booking">
    <div class="container">
        <div class="row_pc view-book">
            <div class="txt_sevice" style="color:#fff !important;">
                Booking
            </div>
            <div class="row booking-content">
                <form class="validate" id="form-booking" action="" method="post">
                    <div class="col-md-7 form-booking">
                        <h2><?=lang('yourdetail')?></h2>

                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"><?=lang('name');?></label>
                            <div class="col-xs-9">
                                <input type="text" style="z-index: 0;" name="full_name" class="validate[required] form-x form-control placeholder" id="personName"
                                       placeholder="<?=lang('name');?>" data-bind="value: name">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"><?=lang('phone');?></label>
                            <div class="col-xs-9">
                                <input  name="phone" class="validate[required,custom[phone]] form-x form-control placeholder" id="phone"
                                        type="text" style="z-index: 0;" class="form-control"  placeholder="<?=lang('phone');?>">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"><?=lang('email');?></label>
                            <div class="col-xs-9">
                                <input type="text"  style="z-index: 0;"  placeholder="<?=lang('email');?>"
                                       name="email" class="validate[required,custom[email]] form-x form-control placeholder" id="email"
                                       data-original-title="Your activation email will be sent to this address."
                                       data-bind="value: email, event: { change: checkDuplicateEmail }">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"><?=lang('diachi');?></label>
                            <div class="col-xs-9">
                                <input type="text"  style="z-index: 0;" placeholder="<?=lang('diachi');?>"
                                       name="address" class="validate[required] form-x form-control placeholder" id="address"
                                       data-bind="value: name">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"><?=lang('country');?></label>
                            <div class="col-xs-9">
                                <select class="form-control form-x" id="national">
                                    <?php foreach($nations as $nation) : ?>
                                        <option id="<?=@$nation->id;?>"><?=$nation->name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"><?=lang('city');?></label>
                            <div class="col-xs-9">
                                <input type="text"  style="z-index: 0;" placeholder=""
                                       name="province" class="validate[required] form-x form-control placeholder" id="province"
                                       data-bind="value: name">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3">Yêu cầu khác</label>
                            <div class="col-xs-9">
                                <textarea id="comments" name="comments" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-3"></label>
                            <div class="col-xs-9">
                                <button type="button" onclick="booking()" class="btn btn-sm  btn-code" style="margin-top:15px;margin-bottom: 73px"><?=lang('guidi');?></button>
                                <button type="button" class="btn btn-sm  btn-code" style="margin-top:15px;margin-bottom: 73px"><?=lang('guide');?></button>
                                <!--<button type="button" class="btn btn-xs btn-x">Đặt phòng</button>-->
                            </div>
                        </div>
                    </div>
                <div class="col-md-5 sidebar">

                    <div class="sidebar-content">
                        <div class="book-info">
                            <div class="row">
                                <div class="col-xs-3" style="padding-right:0px"><strong><?=lang('loaiphong');?> :</strong></div>
                                <div class="col-xs-6">
                                    <span>
                                        <select onchange="caculatePrice()" id="loaiphong" class="loaiphong" style="width: 100%">
                                            <?php foreach($cats as $cat) : ?>
                                                <option <?php if($cat_id == $cat->pro_id){echo "selected";} ?> value="<?=@$cat->pro_id?>"><?=@$cat->pro_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </span>
                                </div>
                                <div class="col-xs-3">
                                    <span id="img-item"><img src="<?=base_url($item->image)?>" alt="<?=@$item->name;?>" style="width: 100%"/></span>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <div class="row" style="margin-bottom: 5px">
                                <div class="col-xs-4"><strong><?=lang('date_start');?> : </strong></div>
                                <div class="col-xs-6">
                                    <span id="ngayden">
                                        <input type="text" onchange="caculatePrice()"  name="ngayden" class="validate[required] datepicker form-x" value="<?=@$ngayden;?>" id="datetimepicker8"/>
                                    </span>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 5px">
                                <div class="col-xs-4"><strong><?=lang('date_end');?> : </strong></div>
                                <div class="col-xs-6"><span id="ngaydi">
                                        <input type="text" onchange="caculatePrice()" class="validate[required]  datepicker form-x" name="ngaydi" value="<?=@$ngaydi;?>" id="datetimepicker8_z"/>

                                    </span></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"><strong><?=lang('sophong');?> :</strong></div>
                                <div class="col-xs-6">
                                    <select name="sophong" onchange="caculatePrice()" class="" id="sophong">
                                        <?php for($i = 1;$i<=10;$i++) {
                                            ?>
                                            <option <?php if($i == $sophong){echo "selected";} ?> value="<?=@$i;?>"><?=@$i;?> <?=lang('phong');?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"><strong><?=lang('adult');?> :</strong></div>
                                <div class="col-xs-6">
                                    <select name="person" id="person">
                                            <?php for($i = 1;$i<=10;$i++) {
                                                ?>
                                                <option <?php if($i == $person){echo "selected";} ?> value="<?=@$i;?>"><?=@$i;?> <?=lang('adult')?></option>
                                            <?php
                                            } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"><strong><?=lang('children');?> :</strong></div>
                                <div class="col-xs-6">
                                    <select name="child" id="child">
                                        <?php for($i = 0;$i<=10;$i++) {
                                            ?>
                                            <option <?php if($i == $child){echo "selected";} ?> value="<?=@$i;?>"><?=@$i;?> <?=lang('children');?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <div class="row">
                                <div class="col-xs-7">
                                    <strong><?=lang('roomcost');?> (<span id="night"><?=(strtotime($ngaydi)- strtotime($ngayden))/(60 * 60 * 24);?></span>&nbsp;<?php if($this->language == 'vi'){echo "Đêm";}else{echo "Night";}?>)</strong>
                                </div>
                                <div class="col-xs-5">
                                    <span id="subtotal"><?=number_format($total)?></span>
                                    <span><?php if($this->language=='vi'){echo "vnđ";}else{echo 'usd';}?></span>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <div class="form-group clearfix" id="view-check-code">
                                <div class="col-xs-5" style="padding:0"><h4><?=lang('discount')?> :</h4></div>
                                <div class="col-xs-7"></div>
                                <div class="clearfix"></div>
                                <label class="col-xs-5" style="padding:0"><?=lang('codediscount');?></label>
                                <div class="col-xs-4" id="view-check">
                                    <input  type="text" class="form-control" name="code" id="code-sale">
                                </div>
                                <div class="col-xs-3">
                                    <button onclick="check_code()" class="btn btn-xs btn-code"><?=lang('update');?></button>
                                </div>
                            </div>
                        </div>
                        <div class="book-info">
                            <div class="clearfix" id="view-check-code">
                                <label class="col-xs-4 col-xs-offset-3" style="padding:0"><?=lang('totalcharget');?> :</label>
                                <div class="col-xs-5">
                                    <span id="total"><?=number_format($total)?></span>
                                    <span><?php if($this->language=='vi'){echo "vnđ";}else{echo 'usd';}?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</article>
<link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css') ?>">
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js') ?>"
        charset="utf-8"></script>
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js') ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#datetimepicker8" ).datepicker({
            minDate:+1
        });
        $( "#datetimepicker8_z" ).datepicker({
            minDate:+2
        });
    });
</script>

<script>
    $('html, body').animate({
        scrollTop: $('.view-book').offset().top
    }, 'slow');
</script>
<script>
    function booking(){
        if($('#form-booking').validationEngine('validate')){
            $.ajax({
                url: base_url() + 'booking/addBooking',
                dataType: "json",
                type:"POST",
                data:{comment:$('#comments').val(),name:$('#personName').val(),phone:$('#phone').val(),email:$('#email').val(),
                    national:$('#national').val(),city:$('province').val(),
                    address:$('#address').val(),code:$('#code-sale').val(),note:$('#book-note').val(),ngaydi:$('#datetimepicker8_z').val(),
                    ngayden:$('#datetimepicker8').val(),loaiphong:$('#loaiphong').val(),sophong:$('#sophong').val(),
                    person:$('#person').val(),child:$('#child').val(),total:$('#total').text()},
                beforeSend:function(){
                    $('.checkbox').append('<span class="ajax-load-qa"></span>&nbsp; Đặt phòng');
                },
                success:function(res){
                    if(res.check == true){
                        window.location = base_url() + 'thanhtoan';
                    }else{
                        alert('Lỗi gửi dữ liệu');
                    }
                },
                complete:function(){
                    $('.ajax-load-qa').remove();
                }
            });
        }
    }
    function check_code(){
        var $cs = $('#code-sale').val();
        $('.code-error').remove();
        $('.alert-success').empty();
        $.ajax({
            dataType:"json",
            type: "POST",
            url:base_url() + 'booking/checkCode',
            data:{cs:$cs,price:$('#subtotal').text()},
            success:function(res){
                if(res.check == false)
                {
                    var $text = '<div class="code-error"><i class="fa fa-exclamation-triangle" style="color:red"></i>Mã không chính xác ! Vui lòng nhập lại</div>';
                    $($text).insertAfter('#view-check-code');
                    $('#view-check').html('<input  type="text" class="form-control" name="code" id="code-sale">');

                }else{
                    var $mess = '<div class="alert-success"> <i class="fa fa-check" style="color:blue"></i>&nbsp;Mã giảm giá đã được xác nhận</div>';
                    $($mess).insertAfter('#view-check-code');
                    $('#total').text(res.total);
                }
            }
        });
    }
    function getModal(){
        //alert('dslgjlsd');
        $.ajax({
            dataType:"html",
            type: "POST",
            url:base_url() + 'booking/getModal',
            data:{cs:1},
            success:function(res){
               $('.view-book').append(res);
               $("#myModal").modal();
            }
        });
        //$("#myModal").modal();
    }
</script>


