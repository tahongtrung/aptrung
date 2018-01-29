<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?=base_url('adminvn')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i>
                        <a href="<?=base_url('adminvn/news/newslist')?>">
                            Tin tức
                            </a>
                    </li>
                    <li>
                        <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="clear"></div>
                <div class="row" style="padding-bottom: 15px">
                    <div class="col-md-3" style="padding-bottom: 10px">
                        <a href="<?= base_url('adminvn/news/add') ?>">
                            <div class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm</div>
                        </a>
                    </div>
                    <div class="col-md-9" >
                        <form action="" method="get" class="row">

                            <div class="col-sm-2 pull-right text-right">
                                <button type="submit" class="btn btn-sm btn-default">
                                    <i class="fa fa-search"></i>  Tìm kiếm
                                </button>
                            </div>
                            <div class="col-sm-2 pull-right">
                                <select name="lang" class="input-sm form-control" >

                                    <option value="">Ngôn ngữ</option>
                                    <?php foreach($datalang as $val){
                                        $select='';
                                        if($val->id==$this->input->get('lang')){
                                            $select='selected';
                                        }

                                        echo '<option value="'.$val->id.'" '.$select.'>'.$val->name.'</option>';
                                    }?>



                                </select>
                            </div>
                            <div class="col-sm-2 pull-right">
                                <select name="view" class="input-sm form-control" >
                                    <option value="">Hiển thị</option>
                                    <option value="home" <?=$this->input->get('view')=='home'?'selected':'';?> >Trang chủ</option>
                                    <option value="hot" <?=$this->input->get('view')=='hot'?'selected':'';?>>Hot</option>
                                    <option value="focus" <?=$this->input->get('view')=='focus'?'selected':'';?>>Nổi bật</option>

                                </select>
                            </div>
                            <div class="col-sm-3 pull-right">
                                <select name="cate" class="input-sm form-control">
                                    <option value="">Danh mục</option>
                                    <?php view_news_cate_select2($cate,0,'',@$this->input->get('cate'));?>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-3 pull-right">
                                    <input name="name" type="search" value="<?=$this->input->get('name');?>"
                                           placeholder="Tiêu đề..."
                                           class="form-control input-sm">
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="">
                    <div class="clear"></div>
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th class="text-center">STT</th>
                            <th>Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Hiển thị</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if (isset($newslist)) {
                            $stt=1;
                            foreach ($newslist as $v) {
                                ?>

                                <tr>
                                    <td width="4%" class="text-center"><?= $stt++; ?></td>
                                    <td width="10%"><?php if (file_exists(@$v->image)) { ?>
                                            <img src="<?= base_url(@$v->image) ?>" style="height: 35px">
                                        <?php } else echo "No image" ?>
                                    </td>
                                    <td>

                                        <?= @$v->title ?>

                                    </td>
                                    <td width="20%"><?= $v->cat_name ?></td>

                                    <td width="8%">

                                        <div data-toggle="tooltip" data-placement="top" title="Trang chủ"
                                             data-value="<?=$v->id;?>" data-view="home"
                                             class='view_color' style='border: 1px solid #000088;margin-right: 10px;<?=($v->home == 1)?'background:#000088':'';?>'></div>

                                        <div data-toggle="tooltip" data-placement="top" title="Tin hot"
                                             data-value="<?=$v->id;?>" data-view="hot"
                                             class='view_color' style='border: 1px solid #ff0000;margin-right: 10px;<?=($v->hot == 1)?'background:#ff0000':'';?>'></div>

                                        <div data-toggle="tooltip" data-placement="top" title="Nổi bật"
                                             data-value="<?=$v->id;?>" data-view="focus"
                                             class='view_color' style='border: 1px solid #008855;margin-right: 10px;<?=($v->focus == 1)?'background:#008855':'';?>'></div>


                                    </td>

                                    <td width='8%' class="text-center">

                                                <a href="<?= base_url('adminvn/news/edit/' . $v->id) ?>" class="btn btn-xs btn-default" title="Sửa"><i class="fa fa-pencil"></i></a>

                                                <a href="<?= base_url('adminvn/news/delete/' . $v->id) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-xs btn-danger" title="Xóa" style="color: #fff"><i class="fa fa-times"></i> </a>

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
                    url: baseurl+"admin/news/update_view",
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
        </script>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </div>
    <!-- /.container-fluid -->

</div>