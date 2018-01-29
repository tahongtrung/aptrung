<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?=base_url('adminvn')?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Cập nhật banner
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
                        <input type="hidden" name="edit_id" value="<?=@$edit->id;?>">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-sm-2 control-label">Tiêu đề:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control input-sm" value="<?=@$edit->title;?>"
                                       name="title"
                                       placeholder="Tiêu đề..
                                ."  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-sm-2 control-label">Vị trí:</label>
                            <div class="col-sm-5">
                                <select name="type" class="form-control input-sm">
                                    <?php
                                    foreach($type as $k=>$v){?>
                                        <option value="<?=$k;?>" <?php if($k == @$edit->type){echo "selected";}?>>
                                            <?=$v;?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Danh mục SP:</label>
                            <div class="col-sm-5">
                                <select name="cate" class="form-control input-sm">
                                    <option value="0">Lựa chọn</option>
                                    <?php view_product_cate_select($procate,0,'',@$edit->cate);?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-sm-2 control-label">Url:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control input-sm" value="<?=@$edit->url;?>" name="url"
                                       placeholder="..."  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-sm-2 control-label">Target:</label>
                            <div class="col-sm-5">
                            <div class="row">
                            <label  class="col-sm-3  ">
                                <input type="radio"  name="target" value="_self"
                                    <?php if(@$edit->target=='_self'||@$edit->target==0||!isset($edit))echo 'checked=""'; else echo '';?>/>
                                Mặc địn</label>

                            <label   class="col-sm-3  ">
                                <input type="radio"  name="target" value="_blank"
                                    <?=@$edit->target=='_blank'?'checked':'';?>/>
                                Tab mới
                            </label>

                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Ảnh:</label>
                            <div class="col-sm-2">
                                <input type="file" name="userfile"  id="input_img" onchange="handleFiles()" />

                                <?php
                                if(file_exists(@$edit->link)){
                                    echo '<img src="'.base_url($edit->link).'" id="image_review" >';
                                }else{
                                    echo '<img src="" id="image_review"  >';
                                }
                                ?>

                            </div>
                        </div>

                        <div class="form-group">
                        <div class="text-right col-sm-7">
                            <button type="submit" class="btn btn-success btn-xs" name="upload"><i class="fa fa-check"></i> <?=$btn_name;?></button>
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