<div class="modal fade bs-example-modal-sm_checkout font-si"   tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="panel panel-success" >
                <div class="panel-heading">
                    <div class="panel-title" style="text-align: center">Thông tin
                        ng??i nh?n hàng
                        <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>

                </div>
                <div style="padding-top:5px" class="panel-body" >
                    <form name="dathangngay" id="dathangngays" method="post" action="http://lalaxinh.com/dat-hang-ngay">
                        <div class="form-group clearfix">
                            <label class="col-md-3">S? l??ng :</label>
                            <div class="col-md-3">
                                <input type="number" id="qual" name="quantity" onchange="test1($(this))" value="1"
                                       min='1'
                                       class="form-control">
                                <input type="hidden" name="pro_id" id="pro_id" value="" />
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#dathangngays").validationEngine();
                            });
                            function formatNumber (num) {
                                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                            }
                            function test1(sender){
                                var num=parseInt(sender.val());
                                var price=parseInt($('#prices').val());
                                $('#pricetotals').html(formatNumber(num*price) +'?');
                            }
                        </script>
                        <div class="form-group clearfix">
                            <label class="col-md-3 col-xs-5">Thành ti?n :</label>
                            <input type="hidden"id="prices" name="price" value="">
                            <div class="col-md-9 col-xs-7">
                                                <span id="pricetotals">

                                                </span>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-3">H? và tên :</label>
                            <div class="col-md-9">
                                <input type="text" name="hoten" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-3">?i?n tho?i :</label>
                            <div class="col-md-9">
                                <input type="text" name="phone" class="form-control validate[required,custom[phone]]" />
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-3">??a ch? :</label>
                            <div class="col-md-9">
                                <textarea placeholder="" name="address" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-3">Ghi chú :</label>
                            <div class="col-md-9">
                                <textarea placeholder="Ví d? : L?i nh?n, th?i gian giao hàng" name="note"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix" style="text-align: center">
                            <input type="submit" class="btn btn-success" name="sendProfiler" value="G?i ??n hàng">
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>