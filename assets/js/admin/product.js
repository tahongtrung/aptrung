function get_product_data(sender){

    var baseurl=$('#baseurl').val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseurl + 'admin/product/get_product_data',
        data: {id:sender.attr('data-item')},
        success: function (rs) {
            var str='';
            str+='<form id="pro_img_frm" action="'+baseurl+'admin/product/update_counter" method="post"\
                        accept-charset="utf-8" enctype="multipart/form-data">\
                        <input name="id"  type="hidden" value="'+rs.id+'"/>\
                        <div class="col-xs-12" style="margin-bottom: 10px">\
                        <div>'+rs.name+'</div>\
                        </div>\
                        <div class="col-md-6">\
                        <input name="counter"  id="userfile" type="number" min="1" class="form-control input-sm"/>\
                        </div>\
                        </form>\
                        <div class="clearfix"></div> \
                        ';
            $("#getmodal").empty();
            $("#getmodal").html(str);

        }
    })
}

function update_order_status(sender){
    var baseurl=$('#baseurl').val();
    if(sender.attr('data-value')==1){
        var action='Xác nhận hoàn thành đơn hàng?';
    }
    if(sender.attr('data-value')==2){
        var action='Bạn có chắc chắn muốn hủy đơn hàng?';
    }


    var check=confirm(action);

    if(check==true){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: baseurl + 'admin/order/update_order_status',
            data: {item:sender.attr('data-item'),value:sender.attr('data-value'),user_name:$('#user_login').text()},
            success: function (rs) {
                if(rs.check==true){
                    var str=' <span class="label label-'+rs.color+'">'+rs.status+'\
                </span>';
                    $("#"+sender.attr('data-id')).html(str);
                    $('#user_'+sender.attr('data-item')).html(rs.user);
                }

            }
        })
    }

}