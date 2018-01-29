<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">  
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Báo giá
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="" style="padding-bottom: 15px">

                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?= base_url('adminvn/bao-gia/add') ?>">
                            <div class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</div>
                        </a>
                    </div> 

                </div>
                <div class="">
                    <div class="clear"></div>
                    <table class="table  table-hover">
                        <tr>
                            <th width="5%">#</th>
                            <th width="40%">Tên</th>
                            <th width="10%">Ảnh</th>
                            <th width="5%">Hiển thị</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php if (isset($list)) {
                            $s=1;
                            foreach ($list as $v) {
                                ?>
                                <tr>
                                    <td><?= $s++; ?></td>
                                    <td><?= $v->name ?></td>
                                    <td>
                                        <?php if (@$v->image != null) { ?>
                                            <img src="<?= base_url(@$v->image) ?>" style="width: 65px; height: 30px">
                                        <?php } else echo 'No image'; ?>
                                    </td>
                                    <td>
                                        <?php if ($v->home == 1) echo "<div style='width: 10px; height: 10px; background: #000088; float: left; margin-right: 10px '></div>" ?>
                                        <?php if ($v->hot == 1) echo "<div style='width: 10px; height: 10px; background: red; float: left;margin-right: 10px '></div>" ?>

                                    </td>
                                    <td>
                                        <div style="text-align: left; " class="action">
                                            <div class="btn-group btn-group-xs">

                                                    <a href="<?= base_url('adminvn/bao-gia/edit/' . $v->id) ?>"
                                                       class="btn btn-xs btn-default" title="Sửa"><i class="fa fa-pencil"></i></a>


                                                    <a href="<?= base_url('adminvn/bao-gia/delete/' . $v->id) ?>"
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
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>