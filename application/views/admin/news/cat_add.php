<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thêm danh mục
                    </li>
                    <?php if (isset ($error)) { ?>
                        <li class="">
                            <span style="color: red"> <?= $error; ?></span>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="body collapse in" id="div1">
                    <form class="form-horizontal validate" role="form" id="form-bk" method="POST" action=""
                          enctype="multipart/form-data">
                        <input type="hidden" name="edit" value="<?=@$edit->id;?>">
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Tổng quan</h3>
                                    <div class="pull-right">
                                        <button onclick="createItem()" type="button" class="btn btn-success btn-sm" name="add_cate">
                                            <i class="fa fa-check"></i> Thêm mới
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Tên danh mục: <span
                                                style="color: red">* </span>:</label>

                                        <div class="col-lg-9">
                                            <input type="text" class="form-control validate[required]" name="title" oninput="createAlias(this)"
                                                   value="<?=@$edit->name;?>" placeholder="Tên danh mục"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Alias</label>
                                        <div class="col-lg-9"  id="error-alias">
                                            <input onchange="createAlias(this)" type="text" id="alias" class="form-control input-sm validate[required]" name="alias"
                                                   value="<?= @$edit->alias; ?>" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Hiển thị:</label>

                                        <div class="col-lg-9">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="home"
                                                    <?=@$edit->home==1?'checked':'';?>> Home
                                            </label>
                                             
                                            &nbsp;&nbsp;&nbsp;
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="focus" <?=@$edit->focus==1?'checked':'';?>> Focus
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="hot" <?=@$edit->hot==1?'checked':'';?>> Hot
                                            </label>
                                            <!-- &nbsp;&nbsp;&nbsp;
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="hot" <?=@$edit->hinhanh==1?'checked':'';?>> Hình ảnh
                                            </label>
                                            &nbsp;&nbsp;&nbsp;
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="1" name="hot" <?=@$edit->defaultnews==1?'checked':'';?>> Tin Văn Hóa
                                            </label> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Danh mục cha:</label>

                                        <div class="col-lg-9">
                                            <select name="parent" class="form-control">
                                                <option value="0">Lựa chọn</option>
                                                <?php view_news_cate_select($category,0,'',@$edit->parent_id);?>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Ảnh:</label>

                                        <div class="col-lg-9">
                                            <input type="file" name="userfile"  id="input_img" onchange="handleFiles()" />

                                            <?php
                                            if(file_exists(@$edit->icon)){
                                                echo '<img src="'.base_url($edit->icon).'" id="image_review" >';
                                            }else{
                                                echo '<img src="" id="image_review"  >';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Mô Tả:</label>

                                        <div class="col-lg-9">
                                            <textarea name="description" class="form-control" placeholder="Mô tả" id="ckeditor2"  rows="4"><?=@$edit->description;?></textarea>
                                            <?php echo display_ckeditor($ckeditor2);?>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <input type="hidden" name="addcate" value="1">
                                        <button type="button" onclick="createItem()" class="btn btn-success btn-sm" name="add_cate">
                                            <i class="fa fa-check"></i> Thêm mới
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Thẻ seo</h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-12 ">Title SEO</label>

                                        <div class="col-sm-12">
                                            <input type="text" name="title_seo" placeholder=""
                                                   value="<?= @$edit->title_seo; ?>" class="form-control input-sm"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 ">Key word SEO</label>

                                        <div class="col-sm-12">
                                            <input type="text" name="keyword" placeholder=""
                                                   value="<?= @$edit->keyword; ?>" class="form-control input-sm"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label f class="col-sm-12 ">Description SEO:</label>

                                        <div class="col-sm-12">
                                            <textarea name="description_seo" placeholder="" class="form-control input-sm" rows="5"><?= @$edit->description_seo; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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