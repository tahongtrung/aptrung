<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> <?=$btn_name;?> Loại Tour
                    </li>
                    <?php if(isset ($error)){?>
                        <li class="">
                            <span style="color: red"> <?= $error;?></span>
                        </li>
                    <?php }?>
                </ol>
            </div>
            <div class="col-md-12">

                <div class="body collapse in" id="div1">
                    <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >
                        <input type="hidden" name="edit" value="<?=@$edit->id;?>">
                        <div class="col-md-9">
                            <div class="panel-default panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Tổng quan</h3>

                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-success btn-xs" name="addcate"><i
                                                class="fa fa-check"></i> <?=$btn_name;?></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label">Tên danh mục:</label>
                                        <div class="col-lg-5">
                                            <input type="text" class="form-control input-sm " name="name"
                                                   value="<?=@$edit->name;?>" placeholder="Tên danh mục"  />
                                        </div>
                                       <div class="col-lg-5">
                                            <label >
                                                <input type="checkbox" value="1" name="home" <?=@$edit->home==1?'checked':''?>>
                                                <?=_title_product_cate_home?>
                                            </label>
                                           <!--
                                            <label >
                                                <input type="checkbox" value="1" name="hot" <?/*=@$edit->hot==1?'checked':''*/?>>
                                                <?/*=_title_product_cate_hot*/?>
                                            </label>

                                            <label>
                                                <input type="checkbox" value="1" name="focus" <?/*=@$edit->focus==1?'checked':''*/?>>
                                                <?/*=_title_product_cate_focus*/?>
                                            </label>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-2 control-label">Danh mục cha:</label>
                                        <div class="col-lg-5">
                                            <select name="parent" class="form-control input-sm">
                                                <option value="0">Cha</option>
                                                <?php view_product_cate_select($cate,0,'',$edit->parent_id);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-lg-2 control-label">Ảnh:</label>
                                        <div class="col-lg-5">
                                            <input type="file" name="userfile"   />

                                            <?php
                                                if(isset($edit->image)&&file_exists($edit->image)){?>
                                                    <br> <img src="<?=base_url($edit->image)?>" style="width: 100px">
                                                <?php    }
                                            ?>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Thứ tự:</label>
                                    <div class="col-lg-2">
                                        <input type="number" name="sort" class="form-control input-sm" value="<?=$max_sort;?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>
                                    <div class="col-lg-10">
                                        <textarea name="description" id="ckeditor" class="form-control input-sm" placeholder="Mô tả"  >
                                            <?=@$edit->description;?>
                                        </textarea>
                                        <?=display_ckeditor($ckeditor);?>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-sm" name="addcate"><i class="fa fa-check"></i> <?=$btn_name;?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Tùy chọn</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label  class="col-sm-12">SEO title:</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="title_seo" class="input-sm form-control" value="<?=@$edit->title_seo;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">SEO keyword:</label>
                                    <div class="col-sm-12">
                                        <textarea name="keyword" class="form-control input-sm" placeholder=""><?=@$edit->keyword;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-sm-12">SEO description:</label>
                                    <div class="col-sm-12">
                                        <textarea name="description_seo" class="form-control input-sm" placeholder=""
                                                  rows="7"><?=@$edit->description_seo;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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