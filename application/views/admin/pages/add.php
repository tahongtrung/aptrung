<?php
/**
 * Created by JetBrains PhpStorm.
 * User: NguyenDai
 * Date: 3/18/16
 * Time: 2:01 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="page-wrapper">
    <style>.view_checkbox input[type=checkbox]{margin-top:2px }</style>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li>
                        <a href="<?= base_url('adminvn/pages/pages')?>">Pages</a>
                    </li>
                    <li >
                        <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
                    </li>
                </ol>
            </div>
            <form class="validate form-horizontal" role="form" id="form-bk" method="POST" action=""
                  enctype="multipart/form-data">
                <input type="hidden" name="edit" value="<?= @$edit->id; ?>">
                <div class="col-md-9" style="font-size: 12px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Tổng quan</h3>
                            <div class="pull-right">
                                <button type="button" onclick="createItem()" class="btn btn-success btn-xs" name="add_news"><i
                                        class="fa fa-check"></i> <?= @$btn_name; ?>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label  class="col-sm-12">Tiêu Đề</label>
                                <div class="col-sm-12">
                                    <input type="text" oninput="createAlias(this)" class="form-control input-sm validate[required]" name="name"
                                           value="<?=@$edit->name;?>" placeholder=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 ">Alias :</label>
                                <div class="col-sm-12" id="error-alias">
                                    <input type="text" onchange="createAlias(this)" id="alias" class="form-control input-sm validate[required]" name="alias"
                                           value="<?= @$edit->alias; ?>" placeholder=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-12">Mô tả</label>
                                <div class="col-sm-12">
                                    <textarea name="description" class="form-control input-sm" placeholder=""
                                              id="description"   rows="4"><?=@$edit->description;?></textarea>
                                    <?=display_ckeditor($description)?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12  ">Nội dung:</label>

                                <div class="col-sm-12">
                                    <textarea name="content" class="form-control input-sm" id="ckeditor"><?=@$edit->content;?></textarea>
                                    <?php echo display_ckeditor($ckeditor); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keyword" class="col-sm-12">Title SEO</label>

                                <div class="col-sm-12">
                                    <input type="text" name="title_seo" class="form-control input-sm" value="<?=@$edit->title_seo;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label   class="col-sm-12" value="<?=@$edit->keyword_seo;?>">Từ khóa SEO</label>

                                <div class="col-sm-12">
                                    <input type="text" name="keyword_seo" class="form-control input-sm" value="<?=@$edit->keyword_seo?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12">Description SEO</label>

                                <div class="col-sm-12">
                                    <textarea name="description_seo" class="form-control input-sm" placeholder=""
                                              rows="4"><?=@$edit->description_seo?></textarea>
                                </div>
                            </div>

                            <div class="text-right" style="padding-bottom: 15px">
                                <input type="hidden" name="addnews" value="1">
                                <button type="button" onclick="createItem()" class="btn btn-success btn-xs" name="add_news"><i
                                        class="fa fa-check"></i> <?= @$btn_name; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3" style="font-size: 12px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Tùy chọn</h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">


                            <label class="col-sm-12" style="padding-left: 0px">
                                Hiển thị
                            </label>

                            <div class="col-sm-12 view_checkbox" style="  border: 1px solid #ccc; padding-left: 0px; padding: 10px">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="1"
                                           name="home" <?= @$edit->home == 1 ? 'checked' : '' ?>>
                                    Trang chủ
                                </label>

                                <label class="checkbox-inline" >
                                    <input type="checkbox" value="1"
                                           name="hot" <?= @$edit->contact_page == 1 ? 'checked' : '' ?>>
                                    Trang liên hệ
                                </label>

                                <!--<label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="focus" <?/*= @$edit->focus == 1 ? 'checked' : '' */?>>
                                        <?/*= _title_product_focus */?>
                                    </label>-->

                                <!--<label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="coupon" <?/*= @$edit->coupon == 1 ? 'checked' : '' */?>>
                                        <?/*= _title_product_coupon */?>
                                    </label>-->
                            </div>
                            <div class="clearfix"></div>

                            <br>



                            <div class="form-group">
                                <label class="col-sm-12 ">Hình ảnh</label>

                                <div class="col-sm-12">
                                    <input type="file" name="userfile" id="input_img" onchange="handleFiles()" />

                                    <?php
                                    if(file_exists(@$edit->icon)){
                                        echo '<img src="'.base_url($edit->icon).'" id="image_review">';
                                    }else{
                                        echo '<img src="" id="image_review">';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>




        </div>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<script type="text/javascript">
    function createItem()
    {
        $('#error-alias .alert-danger').remove();
        if($('#form-bk').validationEngine('validate')){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url() + 'adminvn/alias/checkAdd',
                data: {alias:$('#alias').val()},
                success:function(result){
                    if(result.check == true){
                        $('#form-bk').submit();
                    }else{
                        $('#error-alias').append('<div class="alert-danger">Alias này đã tồn tại ! Vui lòng nhập alias khác</div>');
                    }
                }
            });
        }
    }
</script>
