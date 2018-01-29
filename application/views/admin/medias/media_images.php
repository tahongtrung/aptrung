<link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css')?>">
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js')?>" charset="utf-8"></script>
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js')?>"></script>
<script>
    $(document).ready(function(){
        $(".validate").validationEngine();
    });
</script>
<div id="page-wrapper">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?=base_url('adminvn')?>">Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('adminvn/media/listAll') ?>">Danh mục tài liệu</a>
                    </li>
                    <li>
                        <a href="<?= base_url('adminvn/media/images') ?>">Tài liệu</a>
                    </li>
                </ol>
            </div>
            <div class="clear"></div>
            <!--<div class="col-md-12">
                <?php /*echo form_open_multipart(base_url('adminvn/product_images/' . $id)); */?>
                <div class="col-md-3">
                    <input name="userfile[]" id="userfile" type="file" multiple="" class="form-control"/>
                </div>
                <div class="col-md-1">
                    <input type="submit" value="upload" class="btn btn-success"/>
                </div>
                <div style="padding-top: 5px;   font-style: italic;">
                    (Note: Bạn có thể chọn nhiều ảnh Upload cùng 1 lúc.)
                </div>
                <?php /*echo form_close() */?>
            </div>-->

            <button   class="btn btn-success btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm-up">
                <i class="fa fa-plus"></i> Thêm hình ảnh
            </button>

            <!-- UPLOAD Small modal -->
            <div class="modal fade bs-example-modal-sm-up"   tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-md">


                    <div class="modal-content">
                        <div class="panel panel-success" >
                            <div class="panel-heading">
                                <div class="panel-title"  >Thêm Media</div>

                            </div>
                            <div style="padding-top:30px" class="panel-body" id="getmodal">
                                <div class="row">


                                    <form action="<?= base_url('adminvn/media/images/' . $id) ?>" method="post"
                                          class="validate"
                                          accept-charset="utf-8" enctype="multipart/form-data">

                                        <div class="col-xs-12" style="margin-bottom: 10px">
                                            <input name="title" id="userfile" type="text" placeholder="Tiêu đề"
                                                   class="  form-control input-sm"/>
                                        </div>

                                        <div class="col-md-12" style="margin-bottom: 10px">
                                            <input name="userfile[]" id="userfile" type="file" class="validate[required]  "/>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 10px">
                                            <!--<textarea id="ckeditor2" name="content"></textarea>
                                            --><?php /*echo display_ckeditor($ckeditor2); */?>
                                            <!--<input name="content" id="content" type="text"
                                                   placeholder="Link Vide Youtube"
                                                   class="  form-control input-sm"/>-->
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 10px">
                                            <!--<input name="name" id="userfile" type="text" placeholder="Thông tin khác"
                                                   class="  form-control input-sm"/>-->
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Vị trí :</label>
                                            <div class="col-md-12" style="margin-bottom: 10px">
                                                <input name="sort" id="sort" type="text" value="<?=@$max_sort;?>"
                                                       class="form-control input-sm" placeholder="Vị trí"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <input name ="Upload"  type="submit" value="Upload" class="btn btn-success btn-xs"/>
                                        </div>

                                    </form>

                                    <!---->

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- Page Heading -->



            <br>
            <br>

            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr class="active">
                        <th width='5%'>STT</th>
                        <th width="15%">Hình ảnh</th>
                        <th >Tiêu đề</th>
                        <th width="10%">Vị trí</th>
                        <th width='10%'>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($pro_image)&& !empty($pro_image)) {
                        $s=1;
                        foreach ($pro_image as $v1) {
                            ?>
                            <tr>
                                <td><?= $s++; ?></td>
                                <td><img src="<?=base_url($v1->link)?>" style="width: 100%"> </td>
                                <td><?= @$v1->title; ?></td>
                                <td><?=@$v1->sort;?></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a onclick="getModal(<?=$v1->img_id;?>)"
                                           data-toggle="modal" data-target=".bs-example-modal-sm-up"
                                           class="btn btn-xs btn-default" title="Sửa"><i class="fa fa-pencil"></i></a>

                                        <a href="<?= base_url('adminvn/media/delete/' . $v1->img_id) ?>"
                                           class="btn btn-xs btn-danger" title="Xóa" style="color: #fff">
                                            <i class="fa fa-times"></i> </a>

                                    </div>

                                </td>
                            </tr>
                        <?php
                        }
                    }?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php
                echo $this->pagination->create_links(); // tạo link phân trang
                ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <input type="hidden" id="baseurl" value="<?=base_url();?>">
    <input type="hidden" id="id_product" value="<?=$id;?>">
    <script type="text/javascript">
        function getModal(id) {
            var baseurl = $('#baseurl').val();
            var id_product = $('#id_product').val();
            $.ajax({
                type: "post",
                dataType: 'html',
                url: baseurl + 'admin/media/getImagePopup',
                data: {id:id},
                success: function (rs) {
                    $("#getmodal").empty();
                    $("#getmodal").html(rs);
//                    remove_val();
                }
            })
        }
        function remove_val(){
            if($('.form-control').val()=='undefined'){
                $('.form-control').attr('value','');
            }
        }
    </script>

</div>