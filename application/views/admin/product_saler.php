<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i> <?= @$btn_name; ?> mục sản phẩm
                </li>
                <?php if (isset ($error)) { ?>
                    <li class="">
                        <span style="color: red"> <?= @$error; ?></span>
                    </li>
                <?php } ?>
            </ol>
        </div>
        <div class="col-md-12">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="body collapse in" id="div1">


                    <link rel="stylesheet" href="<?= base_url('assets/plugin/jquery-ui/jquery-ui.css') ?>"
                          type="text/css" media="all"/>
                    <link rel="stylesheet" href="<?= base_url('assets/plugin/jquery-ui/ui.theme.css') ?>"
                          type="text/   css" media="all"/>
                    <link rel="stylesheet" href="<?= base_url('assets/plugin/jquery-ui/autocomplete.css') ?>"
                          type="text/   css" media="all"/>
                    <script src="<?= base_url('assets/plugin/jquery-ui/jquery-ui.min.js') ?>"
                            type="text/javascript"></script>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-12 ">Khách hàng</label>

                                <div class="col-sm-12">
                                    <input type="text" name="fullname" placeholder=""
                                           value="" class="form-control input-sm"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-12 ">Điện thoại</label>

                                <div class="col-sm-12">
                                    <input type="text" name="phone" placeholder=""
                                           value="" class="form-control input-sm"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="col-sm-12 ">Email</label>

                                <div class="col-sm-12">
                                    <input type="text" name="email" placeholder=""
                                           value="" class="form-control input-sm"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label class="col-sm-12 ">Địa chỉ</label>

                                <div class="col-sm-12">
                                    <input type="text" name="address" placeholder=""
                                           value="" class="form-control input-sm"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="col-sm-4">
                        <div class="row">


                            <!--                            <div class="btn btn-default" onclick="add_row()">ok</div>-->

                            <div class="input-group">
                                <input type="text" id="product_name" class="form-control"
                                       onkeypress="handle(event,$(this))"
                                       autofocus="true" aria-describedby="basic-addon2"
                                       data-toggle="tooltip" title="Tìm theo tên sản phẩm" data-placement="top"
                                       style="position: relative">

                                <span class="input-group-addon" id="basic-addon2" style="cursor: pointer; "
                                      onclick="handle2($('#product_name'))"><i class="fa fa-plus"></i></span>
                            </div>
                            <div class="clearfix"></div>
                            <div style="position: relative;">
                                <div id="result_complete"
                                     style="position: absolute; background: #eee"></div>
                            </div>

                            <!--<input type="text" id="product_name" class="form-control" onkeypress="handle(event,$(this))"
                                   autofocus="true"
                                   data-toggle="tooltip" title="Tìm theo tên sản phẩm" data-placement="top"
                                   style="position: relative">-->


                        </div>
                        <br>
                    </div>


                    <br>
                    <table class="table table-bordered" id="table_slecected">
                        <tr>
                            <td>Tên sản phẩm</td>
                            <td width='15%'>Giá</td>
                            <td width='10%'>Số lượng</td>
                            <td width='10%'>Thành tiền</td>
                            <td width='5%'>#</td>
                        </tr>


                    </table>
                    <div id="total"></div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-xs" name="submit">Hoàn thành</button>
                    </div>

                    <script>

                        var baseurl = $("#baseurl").val();

                        function add_row(productname) {

                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: baseurl + 'admin/product/add_row',
                                data: {productname: productname},
                                success: function (kq) {

                                    var str = '<tr>' +
                                        '<td>' + kq.item.name +
                                        '<input type="hidden" name="id[]" value="' + kq.item.id + '">' +
                                        '<input type="hidden" name="price[]" class="price" value="' + kq.item.price_sale + '">' +
                                        '</td>' +
                                        '<td>' + formatNumber(kq.item.price_sale) +
                                        '</td>' +
                                        '<td>' +
                                        '<input name="counter[]" type="number" value="1" class="form-control input-sm" ' +
                                        'onchange="update_row($(this))" data-value="price_' + kq.item.id + '"' +
                                        'data-price="' + kq.item.price_sale + '" min="1">' +
                                        '</td>' +
                                        '<td><div id="price_' + kq.item.id + '">' + formatNumber(kq.item.price_sale) + '</div>' +
                                        '</td>' +
                                        '<td> <div class="btn btn-xs btn-danger" onclick="remove_row($(this))"><i class="fa fa-times"></i></div>' +
                                        '</td>' +
                                        '</tr>';

                                    $(str).appendTo('#table_slecected');
                                    $('#product_name').val('').focus();

                                }
                            })
                        }

                        function formatNumber(num) {
                            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                        }

                        function update_row(sender) {
//                            alert(sender.attr('data-price'));
                            var new_price = parseInt(sender.val()) * parseInt(sender.attr('data-price'));

                            $('#' + sender.attr('data-value')).html(formatNumber(new_price));
                        }
                        $('input').keypress(function(even){
                            if(even.keyCode == 13){
                                even.preventDefault();
                            }

                        });

                        function remove_row(sender) {
                            sender.parent().parent().remove();
                        }

                        function handle(e, sender) {
                            if (e.keyCode == 13) { //alert(sender.val());
                                e.preventDefault();
                                add_row(sender.val());
                                $('.ui-autocomplete-loading').css('background', '#fff');
                            } else {
                                $('.ui-autocomplete-loading').css('background', 'white url(\'' + baseurl + 'assets/plugin/jquery-ui/ui-anim_basic_16x16.gif\') right center no-repeat');
                            }
                            return false;
                        }

                        function handle2(sender) {
                            add_row(sender.val());
                            $('.ui-autocomplete-loading').css('background', '#fff');
//                            return false;
                        }


                        $("#product_name").autocomplete({
                            minLength: 3,
                            appendTo: "#result_complete",
                            source: function (req, add) {
                                $.ajax({
                                    url: baseurl + "admin/product/lookup",
                                    dataType: 'json',
                                    type: 'POST',
                                    data: req,
                                    success: function (data) {
                                        if (data.response == "true") {
                                            add(data.message);
                                            $('#product_name').attr('value', '')
                                        }
                                    }
                                });
                            },
                            select: function (event, ui) {
                                $("#result").append(
                                    "<li>" + ui.item.value + "</li>"
                                );
                            }
                        });

                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip();
                        });
                    </script>


                </div>
            </form>
        </div>
    </div>
    <!-- /.row -->


    <!-- /.row -->


    <!-- /.row -->


    <!-- /.row -->

</div>
<!-- /.container-fluid -->
<style>
    .ui-autocomplete {
        min-width: 250px !important;
    }
</style>
</div>