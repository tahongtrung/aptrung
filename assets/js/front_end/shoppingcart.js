
function add_cart1(id,op){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url() + 'shoppingcart/add_cart',
        data: {id:id,color:op.attr('data-color'),size:op.attr('data-size')},
        success: function (result) {

            if(result.status==true){

                location.href=base_url()+'gio-hang';


                var t2='<div class=" alert-ml col-xs-12 alert alert-info alert-dismissible" role="alert">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    +result.mess+
                    '<br>'+'Giỏ hàng: '+result.count+' sản phẩm&nbsp;&nbsp;&nbsp;<a style="float: right" href="'+base_url()+'gio-hang'+'">Xem giỏ hàng <i class="fa fa-angle-double-right"></i></a>' +
                    '</div>';
                $('#show_added').html(t2);


                $('#count_cart').html(result.count);

                setTimeout(function(){
                    $('#show_added').empty();
                }, 5000);
            }
        }
    })
}
function add_cart(id){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url() + 'shoppingcart/add_cart',
        data: {id:id},
        success: function (result) {
            if(result.status==true){
                var t='<div class="alert alert-success alert-dismissible alert-ml" role="alert"\
                    style="position: absolute;right: 40px;top:250px;padding: 5px;  ">\
                        Sản phẩm bạn chọn đã thêm vào giỏ hàng!\
                    </div>';
                var t2='<div class=" alert-ml col-xs-12 alert alert-info alert-dismissible" role="alert">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    +result.mess+
                    '<br>'+'Giỏ hàng: '+result.count+' sản phẩm&nbsp;&nbsp;&nbsp;<a style="float: right" href="'+base_url()+'gio-hang'+'">Xem giỏ hàng <i class="fa fa-angle-double-right"></i></a>' +
                    '</div>';
                $('#show_added').html(t2);
                $('.number_item').html('('+result.count+')');
                $('.total_price').html(formatNumber(result.totalPrice));
                setTimeout(function(){
                    $('#show_added').empty();
                }, 5000)
            }
        }
    })
    /*cart();*/
}
function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

function update_cart(id,qty,address){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url() + 'shoppingcart/update_cart',
        data: {id:id,qty:qty,address:address},
        success: function (ketqua) {
            $('#count_cart').html(ketqua.count);
            $('#total_cart').html(formatNumber(ketqua.total));
            $('#item_total'+id).html(formatNumber(ketqua.item_total));
        }
    })
}
function add_color(sender){
    $('#color_size_val').attr('data-color',sender.attr('data-color'));
    $('.color').css('border','1px #ddd solid');
    sender.css('border',' 2px #20e330 solid');
}
function add_size(sender){
    $('#color_size_val').attr('data-size',sender.attr('data-size'));
    $('.size').css('border','1px #aaa solid');
    sender.css('border',' 2px #20e330 solid');
}
function changeaddress(sender){
    $('#'+sender.data('item')).html(sender.val());
}


function messs () {
    setTimeout(show_mss, 2000)
}
function show_mss() {

}