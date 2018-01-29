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
                        <i class="fa fa-table"></i> <?=$btn_name;?> mục rao vặt
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

                                <label >
                                    <input type="checkbox" value="1" name="hot" <?=@$edit->hot==1?'checked':''?>>
                                    <?=_title_product_cate_hot?>
                                </label>

                                <label>
                                    <input type="checkbox" value="1" name="focus" <?=@$edit->focus==1?'checked':''?>>
                                    <?=_title_product_cate_focus?>
                                </label>
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
                            <div class="col-lg-5">
                                <textarea name="description" class="form-control input-sm" placeholder="Mô tả"  >
                                    <?=@$edit->description;?>
                                </textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="addcate"><i class="fa fa-check"></i> <?=$btn_name;?></button>
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