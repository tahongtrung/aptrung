<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách loại tour
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="text-right" style="padding-bottom: 15px">
                    <a href="<?= base_url('adminvn/product/addprohangsx') ?>">
                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</button>
                    </a>
                </div>

                <div class="table-striped">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr class="success">
                                <th>STT</th>
                                <th width="60%">Tên</th>
                                <th width="20%">Ảnh</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                             view_product_hangsx_table($cate,0,'');
                        ?>
                    </table>
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