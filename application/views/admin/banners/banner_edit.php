<div id="page-wrapper">
<?php
    $opLoai = array(
        'home' => 'Banner trang chủ',
        'page' => 'Banner Danh mục sản phẩm',
        'slide' => 'Slide',
        'partners'=>'Banner center',
        'ads_left'=>'Banner left',
        'ads_right'=>'Banner right',
    );
//echo "<pre>";print_r($images);?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    Sửa banner
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thêm Banner
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

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Tiêu đề:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tiêu đề..." value="<?= $images->title;?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Loại:</label>
                            <div class="col-lg-5">
                                <select name="type" class="form-control">
                                    <?php foreach($opLoai as $k => $lo) : ?>
                                        <?php if($k == $images->type) :?>
                                        <option value="<?=$k?>" selected="selected"><?=$lo?></option>
                                        <?php else : ?>
                                            <option value="<?=$k?>"><?=$lo?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>

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
                            <label for="inputEmail1" class="col-lg-2 control-label">Url:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="url" placeholder="..."
                                       value="<?=$images->url?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Target:</label>
                            <div class="col-lg-5">
                                <label  class="col-lg-3  ">
                                    <input type="radio"  name="taget" value=""  checked=""/>
                                   Mặc địn</label>

                                <label   class="col-lg-3  ">
                                    <input type="radio"  name="taget" value="_blank"  />
                                    Tab mới
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Ảnh:</label>
                            <div class="col-lg-10">
                                <input type="file" name="userfile"   />

                                <?php if(isset($images->link)&&file_exists($images->link)){?>
                                    <img src="<?= base_url($images->link) ?>" alt="" style="max-height: 100px; max-width: 100%; margin-top: 10px"/>
                                <?php }?>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="upload"><i class="fa fa-check"></i> C?p nh?t</button>
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