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
                        <a href="<?= base_url('adminvn/media/listAll') ?>">Media</a>
                    </li>
                    <li class="active">
                        <a href="<?= base_url('adminvn/product/categories') ?>">Danh mục</a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="" style="padding-bottom: 15px">
                    <a href="<?= base_url('adminvn/media/cat_add')?>" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Thêm
                    </a>
                </div>

                <div class=" ">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="7%">Sắp xếp</th>
                            <th width="20%">Ảnh</th>
                            <th  >Tên</th>
                            <th width="8%">Hiển thị</th>
                            <th width="8%" class="text-center">Action</th>
                        </tr>
                        <?php
                            view_media_cate_table($cate,0,'');
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <style>
            .view_color{width: 10px; height: 10px;float: left;margin-top: 5px;cursor: pointer}
        </style>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })


            $('.view_color').click(function(){
                var color = $( this ).css( "border-color" );
                var background = $( this ).css( "background-color" );

                var baseurl = $("#baseurl").val();
                var form_data = {
                    id: $( this ).attr('data-value'),view:$( this ).attr('data-view')
                };
                $.ajax({
                    url: baseurl+"admin/media/update_cat_view",
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (rs) {

                    }
                });
                if(color!=background){
                    $( this ).css( "background-color",color ) ;
                }else{
                    $( this ).css( "background-color",'#fff' ) ;
                }
            });

            function cat_sort(s){
                var baseurl = $("#baseurl").val();
                var form_data = {
                    id: s.attr('data-item'),sort:s.val()
                };
                $.ajax({
                    url: baseurl+"admin/media/cat_sort",
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (rs) {

                    }
                });
            }
        </script>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>