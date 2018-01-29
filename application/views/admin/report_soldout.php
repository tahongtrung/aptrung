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
                        <a href="<?=base_url('admin/report/soldout')?>">
                        Sản phẩm hết hàng
                        </a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="row" style="padding-bottom: 15px">

                    <div class="col-md-3" style="padding-bottom: 10px">

                        <a href="<?= base_url('admin/product/product_saler') ?>" class="btn btn-success btn-sm">
                             <i class="fa fa-plus"></i> Bán hàng
                        </a>
                    </div>

                    <div class="col-md-9" >
                        <form action="" method="get">
                            <div class="form-group row">
                                <div class="col-sm-2">

                                    <?php $num=array(10,20,30,40,50,60);
                                         $num_curr=$this->uri->segment(4);
                                    ?>
                                    <select class="form-control input-sm" id="num" onchange="changenum($(this))">

                                        <?php foreach($num as $v){
                                            $num_curr== $v?$sl='selected':$sl='';
                                            echo ' <option value="'.$v.'" '.$sl.'>Nhỏ hơn '.$v.'</option>';
                                        }?>

                                    </select>
                                </div>
                                <script>
                                    function changenum(sender){
                                        var num=sender.val();
                                        location.href='<?=base_url("admin/report/soldout")?>/'+num;
                                    }
                                </script>
                                <div class="col-sm-2">
                                    <input name="code" type="search" value="<?=$this->input->get('code');?>"
                                           placeholder="Mã sản phẩm..."
                                           class="form-control input-sm">
                                </div>
                                <div class="col-sm-3">
                                    <input name="name" type="search" value="<?=$this->input->get('name');?>"
                                           placeholder="Tìm tên sản phẩm..."
                                           class="form-control input-sm">
                                </div>
                                <div class="col-sm-3">
                                    <select name="cate" class="input-sm form-control">
                                        <option value="">Danh mục</option>
                                        <?php view_product_cate_select2($cate,0,'',@$this->input->get('cate'));?>
                                    </select>
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
                    <table class="table  table-hover table-bordered">
                        <tr>
                            <th width="2%">#</th>
                            <th width="8%">Ảnh</th>
                            <th >Tên sản phẩm</th>
                            <th width="18%">Danh mục</th>
                            <th width="8%">Số lượng</th>
                            <th width="8%">Action</th>
                        </tr>
                        <?php if (isset($prolist)) {
                            $s=1;
                            foreach ($prolist as $v) {
                                ?>
                                <tr>
                                    <td><?= $s++; ?></td>
                                    <td>
                                        <?php if (file_exists($v->image)) { ?>
                                            <img src="<?= base_url(@$v->image) ?>" style="width: 65px; height: 30px">
                                        <?php } else echo 'No image'; ?>
                                    </td>
                                    <td><?= @$v->name ?></td>
                                    <td><?= @$v->cat_name ?></td>
                                    <td>
                                        <?= @$v->counter ?>
                                        <a href="#" class="pull-right" onclick="get_product_data($(this))"
                                              data-item="<?=$v->id;?>"
                                           data-toggle="modal" data-target="#modalAnimated"

                                            ><i class="fa fa-plus"></i></a>
                                    </td>


                                    <td>
                                        <div style="text-align: right; " class="action">
                                            <div class="btn-group btn-group-xs">




                                                    <a href="<?= base_url('adminvn/product/Edit/' . $v->id) ?>"
                                                       class="btn btn-xs btn-default" title="Sửa"><i class="fa fa-pencil"></i></a>


                                                    <!--<a href="<?/*= base_url('adminvn/product_images/' . $v->id) */?>"
                                                       class="btn btn-xs btn-default" title="Ảnh sản phẩm"  ><i class="fa fa-image"></i></a>-->

                                                    <a href="<?= base_url('adminvn/product/Delete/' . $v->id) ?>"
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                       class="btn btn-xs btn-danger"title="Xóa" style="color: #fff"><i class="fa fa-times"></i> </a>



                                            </div>
                                        </div>
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

        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>