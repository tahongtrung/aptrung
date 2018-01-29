<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?= base_url('adminvn')?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách tin tức
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="text-left" style="padding-bottom: 15px">
                    <a href="<?= base_url('adminvn/add-shipping')?>">
                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button></a>
                </div>
                <div class="">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Tên vận chuyển</th>
                            <th>Giá</th>
                            <th width="15%">Action</th>
                        </tr>
                        <?php if(isset($shipping)){
                            foreach($shipping as $v){?>

                                <tr>
                                    <td><?= @$v->id?></td>
                                    <td><?= @$v->name?></td>
                                    <td><?= @$v->price?></td>
                                    <td>
                                        <a href="<?= base_url('admin/product/addShipping/'.$v->id)?>">
                                            <button class="btn btn-xs btn-primary">Sửa</button>
                                        </a>
                                        <a href="<?= base_url('admin/product/deleteShipping/'.$v->id)?>"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa ?')">
                                            <button class="btn btn-xs btn-danger">Xóa</button>
                                        </a>

                                    </td>
                                </tr>
                            <?php }
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