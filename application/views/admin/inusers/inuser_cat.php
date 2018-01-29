<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?= base_url('adminvn')?>">Admin</a>
                    </li>
                    <li>
                       <a href="<?= base_url('adminvn/inuser/inuserlist')?>">Tin tức</a>
                    </li>
                    <li>
                       <a href="<?= base_url('adminvn/inuser/categories')?>">Danh mục</a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                    <div class="text-left  " style="padding-bottom: 15px">
                        <a href="<?= base_url('adminvn/inuser/cat_add')?>">
                             <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i>  Thêm</button>
                        </a>
                    </div>

                <div class="clearfix"></div>

                <div class="table-striped" >
                    <div class="clear"></div>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="7%">Sắp xếp</th>
                            <th>Tên</th>
                            <th width="30%">Ảnh</th>
                            <th width="10%">Hiển thị</th>
                            <th width="10%" class="text-center" >Action</th>
                        </tr>
                        <?php view_inuser_cate_table($inuser_cate,0);?>

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
            });

            $('.view_color').click(function(){
                var color = $( this ).css( "border-color" );
                var background = $( this ).css( "background-color" );

                var baseurl = $("#baseurl").val();
                var form_data = {
                    id: $( this ).attr('data-value'),view:$( this ).attr('data-view')
                };
                $.ajax({
                    url: baseurl+"admin/inuser/update_cat_view",
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
            })

            function cat_sort(s){
                var baseurl = $("#baseurl").val();
                var form_data = {
                    id: s.attr('data-item'),sort:s.val()
                };
                $.ajax({
                    url: baseurl+"admin/inuser/cat_sort",
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