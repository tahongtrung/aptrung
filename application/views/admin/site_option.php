
<link type="text/css" href="<?= base_url('assets/css/map_css.css') ?>" rel="stylesheet">
<link type="text/css" href="<?= base_url('assets/css/jqueryui.css') ?>" rel="stylesheet">

<script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery-1.11.1.min.js') ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-sm-12">
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
        </li>
        <li class="active">
            <i class="fa fa-table"></i> Siteoption
        </li>
        <li >
            <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
        </li>
    </ol>
</div>
<form class="validate form-horizontal" role="form" id="form1" method="POST" action=""
      enctype="multipart/form-data">
<input type="hidden" name="edit" value="<?= @$row->id; ?>">
<div class="col-md-9" style="font-size: 12px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Thông tin chung</h3>
            <div class="pull-right">
                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                        class="fa fa-check"></i> Cập nhật
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label  class="col-sm-12">Tên đơn vị</label>
                <div class="col-sm-12">
                    <input name="site_name" type="text" class="validate[required] form-control input-sm"
                           value="<?=@$row->site_name;?>" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Địa chỉ top</label>

                <div class="col-sm-12">
                    <input name="slogan" type="text" class="form-control input-sm"
                           value="<?=@$row->slogan;?>" placeholder="">
                </div>
            </div>
            <!-- <div class="form-group">
                <label  class="col-sm-12">Video (Youtube)</label>

                <div class="col-sm-12">
                    <input name="site_video" type="text" class="form-control input-sm"
                           value="<?=$row->site_video==''?'':'https://www.youtube.com/watch?v='.$row->site_video;?>"
                           placeholder="Vd:https://www.youtube.com/watch?v=XXXXXX">
                </div>
            </div> -->
            <div class="form-group">
                <label class="col-sm-12  ">Địa chỉ</label>

                <div class="col-sm-12">
                    <textarea name="address" class="form-control input-sm input-sm" id="ckeditor"><?=@$row->address;?></textarea>
                    <?php echo display_ckeditor($ckeditor); ?>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Slogan:</label>
                <div class="col-sm-12">
                    <textarea name="shipping" class="form-control" placeholder=""
                              id="ckeditor2" rows="8"><?= @$row->shipping ?></textarea>
                    <!-- <?php echo display_ckeditor($ckeditor2); ?> -->
                </div>
            </div>
            <!-- <div class="form-group" style="display: none">
                <label class="col-sm-12  ">Địa chỉ (Tiếng Anh)</label>

                <div class="col-sm-12">
                    <textarea name="address_en" class="form-control input-sm input-sm" id="ckeditor2"><?=@$row->address_en;?></textarea>
                    <?php echo display_ckeditor($ckeditor2); ?>
                </div>
            </div> -->

            <hr>
            <div class="form-group">
                <label  class="col-sm-12">Title Seo</label>

                <div class="col-sm-12">
                    <input name="site_title" type="text" class="form-control input-sm"
                           value="<?=@$row->site_title;?>" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-12">Keyword Seo</label>

                <div class="col-sm-12">
                    <input name="site_keyword" type="text" class="form-control input-sm"
                           value="<?=@$row->site_keyword;?>" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-12">Description Seo</label>

                <div class="col-sm-12">
                    <textarea rows="7" name="site_description" class="form-control input-sm"><?=@$row->site_description;?></textarea>
                </div>
            </div>



            <div class="text-right" style="padding-bottom: 15px">
                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                        class="fa fa-check"></i> Cập nhật
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

            <div class="form-group">
                <label class="col-sm-12 ">Logo</label>

                <div class="col-sm-12">
                    <input type="file" name="userfile" id="input_img" onchange="handleFiles()" />


                    <?php
                    if(file_exists(@$row->site_logo)){
                        echo '<img src="'.base_url($row->site_logo).'" id="image_review">';
                    }else{
                        echo '<img src="" id="image_review">';
                    }
                    ?>


                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-12 ">Favicon</label>

                <div class="col-sm-12">
                    <input type="file" name="user" id="input_img" onchange="handleFiles()" />


                    <?php
                    if(file_exists(@$row->favicon)){
                        echo '<img src="'.base_url($row->favicon).'" id="image_review">';
                    }else{
                        echo '<img src="" id="image_review">';
                    }
                    ?>


                </div>
            </div> -->

            <div class="form-group">
                <label  class="col-sm-12">Email</label>

                <div class="col-sm-12">
                    <input name="site_email" type="text" class="form-control input-sm"
                           value="<?=@$row->site_email;?>" placeholder="">
                </div>
            </div>
            <!-- <div class="form-group">
                <label  class="col-sm-12">Facebook Id +</label>
                <div class="col-sm-12">
                    <input name="face_id" type="text" class="form-control input-sm"
                           value="<?=@$row->face_id;?>" placeholder="">
                </div>
            </div> -->
            <div class="form-group">
                <label  class="col-sm-12">Fanpage Facebook</label>

                <div class="col-sm-12">
                    <input name="site_fanpage" type="text" class="form-control input-sm"
                           value="<?=@$row->site_fanpage;?>" placeholder="Link Facebook">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Link Google +</label>

                <div class="col-sm-12">
                    <input name="link_gg" type="text" class="form-control input-sm"
                           value="<?=@$row->link_gg;?>" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Link rss</label>

                <div class="col-sm-12">
                    <input name="link_youtube" type="text" class="form-control input-sm"
                           value="<?=@$row->link_youtube;?>" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Link Linkin</label>

                <div class="col-sm-12">
                    <input name="link_sky" type="text" class="form-control input-sm"
                           value="<?=@$row->link_sky;?>" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Link Tt +</label>

                <div class="col-sm-12">
                    <input name="link_tt" type="text" class="form-control input-sm"
                           value="<?=@$row->link_tt;?>" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-12">Hotline 1</label>

                <div class="col-sm-12">
                    <input name="hotline1" type="text" class="form-control input-sm"
                           value="<?=@$row->hotline1;?>" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Hotline 2</label>

                <div class="col-sm-12">
                    <input name="hotline2" type="text" class="form-control input-sm"
                           value="<?=@$row->hotline2;?>" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-12">Quảng cáo Facebook, Google +</label>
                <div class="col-sm-12">
                    <textarea rows="10" name="site_promo" class="form-control input-sm"><?=@$row->site_promo;?></textarea>
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

