<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i>
                        <a href="<?=base_url('admin/report/bestsellers')?>">
                            Hàng bán chạy
                        </a>
                    </li>
                </ol>
            </div>


            <!--<object type="application/x-shockwave-flash" data="http://dj.very.vn/flvplayer.swf" allowfullscreen="true"
                    allowscriptaccess="always"
                    flashvars="&file=http://dj.very.vn/list/79.xml&displayheight=35&backcolor=0xFFFFFF&frontcolor=0x293725&lightcolor=0x293725&showdigits=true&showeq=true&showfsbutton=true&autostart=false&shuffle=false&repeat=true;volume=100;width=432&amp;height=300"
                    width="432" height="300">
                <param name="movie" value="http://dj.very.vn/flvplayer.swf" allowfullscreen="true"
                       allowscriptaccess="always"
                       flashvars="&file=http://dj.very.vn/list/79.xml&displayheight=35&backcolor=0xFFFFFF&frontcolor=0x293725&lightcolor=0x293725&showdigits=true&showeq=true&showfsbutton=true&autostart=false&shuffle=false&repeat=true;volume=100;width=432&amp;height=300"
                       width="auto" height="auto"/>
                <param name="allowfullscreen" value="true"/>
                <param name="allowscriptaccess" value="always"/>
                <param name="wmode" value="transparent"/>
            </object>-->






            <div class="col-md-12">
                <div class="row" style="padding-bottom: 15px">

                    <div class="col-md-3" style="padding-bottom: 10px">

                        <a href="<?= base_url('admin/product/product_saler') ?>" class="btn btn-success btn-sm">
                             <i class="fa fa-plus"></i> Bán hàng
                        </a>
                    </div>

                    <div class="col-md-9" >

                    </div>


                    <div class="col-md-6 text-right">

                        <script>
                            $(function () {
                                $('[data-toggle="tooltip"]').tooltip()
                            })
                        </script>
                        <style>
                            .view_color{width: 10px; height: 10px;float: left;margin-top: 5px;cursor: pointer}
                        </style>

                    </div>
                </div>
                <div class="">
                    <div class="clear"></div>

                    <div class="row">
                        <div class="col-sm-4">
                            <h3 style="margin: 0">Hàng bán chạy</h3>
                        </div>
                        <div class="col-sm-8">
                            <form action="" method="get">
                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <div class="row"> Từ ngày</div>
                                    </div>
                                    <div class="col-sm-2">

                                        <input name="from" type="text" id="from" class="form-control input-sm"
                                               value="<?=@$date_from;?>">
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="row"> đến ngày</div>
                                    </div>
                                    <div class="col-sm-2">

                                        <input name="to" type="text" id="to" class="form-control input-sm"
                                               value="<?=@$date_to;?>">
                                    </div>


                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-sm btn-default">
                                            <i class="fa fa-search"></i>  Tìm kiếm
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table  table-hover table-bordered">
                        <tr>
                            <th width="2%">#</th>
                            <th >Tên sản phẩm</th>
                            <th width="18%">Danh mục</th>
                            <th width="12%">Số lượng nhập</th>
                            <th width="12%">Số lượng bán</th>
                            <th width="12%">Số lượng tồn</th>
                        </tr>
                        <?php if (isset($prolist)) {
                            $s=1;
                            foreach ($prolist as $v) {
                                ?>
                                <tr>
                                    <td><?= $s++; ?></td>
                                    <td><?= @$v->name ?></td>
                                    <td><?= @$v->cat_name ?></td>
                                    <td>
                                        <?= $v->first_quantity ?>
                                    </td>
                                    <td>
                                        <?= $v->soluongban ?>
                                    </td>
                                    <td>
                                        <?= $v->counter ?>
                                    </td>


                                </tr>
                            <?php
                            }
                        } ?>
                    </table>
                </div>
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
                </div>
            </div>
        </div>


        <!-- modalAnimated -->
        <div class="modal fade" data-sound="off" id="modalAnimated" tabindex="-1" role="dialog" aria-labelledby="modalAnimatedLabel" aria-hidden="true">
            <div class="modal-dialog animated bounceIn">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modalAnimatedLabel">Cập nhật số lượng</h4>
                    </div>
                    <div class="modal-body" id="getmodal">


                        <div class="clearfix"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-xs" onclick="$('#pro_img_frm').submit()">Cập nhật</button>
                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Hủy</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <script src="<?=base_url('assets/js/admin/product.js')?>"></script>
        <script src="<?=base_url('assets/plugin/datetimepicker/jquery.datetimepicker.js')?>"></script>
        <link href="<?=base_url('assets/plugin/datetimepicker/jquery.datetimepicker.css')?>" rel="stylesheet" media="all"/>

        <script>
            $('#from,#to').datetimepicker({
                lang:'vi',
                timepicker:false,
                format:'d-m-Y',
                formatDate:'Y-m-d',
            });
        </script>

        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>