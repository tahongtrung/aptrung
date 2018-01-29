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
                        <i class="fa fa-table"></i> <?=$btn_name;?> danh mục
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
                    <form class="form-horizontal validate" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data">
            <input type="hidden" name="edit" value="<?=@$edit->id;?>">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên : <span
                                    style="color: red">* </span>:</label>

                            <div class="col-lg-5">
                                <input type="text" class="form-control validate[required]" name="name"
                                       value="<?=@$edit->name;?>" placeholder="Tên"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Hiển thị:</label>

                            <div class="col-lg-5">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="1" name="home"
                                        <?=@$edit->home==1?'checked':'';?>> Trang chủ
                                </label>
                               <!-- &nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="1" name="hot" <?/*=@$edit->hot==1?'checked':'';*/?>> Hot
                                </label>-->
                                &nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="1" name="focus" <?=@$edit->focus==1?'checked':'';?>> Nổi bật
                                </label>
                                <!--&nbsp;&nbsp;&nbsp;
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="1" name="tour"> Tour nước ngoài
                                </label>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 text-right">Alias :</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control input-sm <?php if($this->language == 'ja'){echo "validate[required]";}?>" name="alias"
                                       value="<?=@$edit->alias;?>" placeholder=""/>
                            </div>

                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 text-right">Thông tin khác :</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control input-sm" name="title"
                                       value="<?=@$edit->title;?>" placeholder=""/>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Danh mục cha:</label>

                            <div class="col-lg-5">
                                <select name="parent" class="form-control">
                                    <option value="0">Lựa chọn</option>
                                    <?php view_inuser_cate_select($category,0,'',@$edit->parent_id);?>


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Ảnh:</label>

                            <div class="col-lg-5">
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
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>

                            <div class="col-lg-8">
                                <textarea name="description" id="ckeditor" class="form-control" placeholder="Mô tả" rows="4"><?=@$edit->description;?></textarea>
                                <?=display_ckeditor($ckeditor)?>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="addcate"><i
                                    class="fa fa-check"></i> <?=$btn_name;?>
                            </button>
                        </div>

                    </form>
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
<script>
    $(document).ready(function () {
        $(".validate").validationEngine();
    });
</script>