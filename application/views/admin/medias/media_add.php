<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-sm-12">
    <ol class="breadcrumb">
        <li>
            <a href="<?= base_url('adminvn') ?>">Admin</a>
        </li>
        <li>
            <a href="<?= base_url('adminvn/product/products') ?>">Media</a>
        </li>
        <li>
            <a href="<?= base_url('adminvn/product/add') ?>"><?= $btn_name; ?></a>
        </li>
        <li >
            <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
        </li>
        <?php if (isset ($error)) { ?>
            <li class="">
                <span style="color: red"> <?= $error; ?></span>
            </li>
        <?php } ?>
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
                <button onclick="createItem()" type="button" class="btn btn-success btn-xs" name="add_news"><i
                        class="fa fa-check"></i> <?= $btn_name; ?>
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">


            <div class="form-group">
                <label class="col-sm-12">Tên</label>

                <div class="col-sm-12">
                    <input type="text" oninput="createAlias(this)" class="validate[required] form-control input-sm " name="name"
                           value="<?= @$edit->name; ?>" placeholder=""/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-12">Alias</label>

                <div class="col-sm-12" id="error-alias">
                    <input type="text" onchange="createAlias(this)" class="validate[required] form-control input-sm " name="alias"
                        id="alias"   value="<?= @$edit->name; ?>" placeholder=""/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label   class="col-sm-12">Vị trí:</label>

                        <div class="col-sm-12">
                            <input type="number" name="order" class="form-control input-sm" min="1"
                                   value="<?= @$max_order; ?>"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-12">Video (Youtube)</label>

                <div class="col-sm-12">
                    <input name="video" type="text" class="form-control input-sm"
                           value=""
                           placeholder="Vd:https://www.youtube.com/watch?v=XXXXXX">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 ">
                    <label for="inputcontent" class=" control-label">Mô tả ngắn:</label>
                    <textarea name="description" class="form-control input-sm" id="ckeditor2"
                              style="height: 200px"><?= @$edit->description; ?></textarea>
                    <?php echo display_ckeditor($ckeditor2); ?>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-12 ">
                    <label  class="  ">Chi tiết</label>
                    <textarea name="detail" class="form-control input-sm" id="ckeditor"
                              style="height: 200px"><?= @$edit->detail; ?></textarea>
                    <?php echo display_ckeditor($ckeditor); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-12 ">Title SEO</label>

                <div class="col-sm-12">
                    <input type="text" name="keyword" placeholder=""
                           value="<?= @$edit->keyword; ?>" class="form-control input-sm"/>
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
                    <textarea name="description_seo" placeholder=""
                              class="form-control input-sm"><?= @$edit->description_seo; ?></textarea>
                </div>
            </div>

            <div class="col-sm-12">

                <div class="text-right" style="padding-bottom: 15px">
                    <input type="hidden" name="addnews" value="1">
                    <button onclick="createItem()" type="button"  class="btn btn-success btn-xs" name="add_news"><i
                            class="fa fa-check"></i> <?= $btn_name; ?>
                    </button>
                </div>


            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="col-md-3" style="font-size: 12px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tùy chọn</h3>
        </div>
        <div class="panel-body">

            <div class="">

                <label class="col-sm-12" style="padding-left: 0px">
                    Danh mục
                </label>

                <div class="col-sm-12  " style="padding: 5px">
                    <select class="form-control input-sm" name="category">
                        <option value="">Lựa chọn</option>
                        <?php view_product_hangsx_select(@$cate, 0, '', @$edit->category_id); ?>
                    </select><!--
                    <div class=" checklist_cate cat_checklist">
                        <?php /*if (isset($cate_selected)) $cate_selected = $cate_selected;
                        else $cate_selected = null;
                        view_product_cate_checklist($cate, 0, '', @$cate_selected)*/?>
                    </div>
-->
                </div>
                <div style="clear: both"></div>
                <br>
                <label class="col-sm-12" style="padding-left: 0px">
                    Hiển thị
                </label>

                <div class="col-sm-12" style="  border: 1px solid #ccc;   padding: 10px 0px">
                    <label class="col-sm-6">
                        <input type="checkbox" value="1" class="checkbox-inline"
                               name="home" <?= @$edit->home == 1 ? 'checked' : '' ?>>
                        Trang chủ
                    </label>

                    <!-- <label class="col-sm-6">
                        <input type="checkbox" value="1"
                               name="focus" <?= @$edit->focus == 1 ? 'checked' : '' ?>>
                        <?= _title_product_focus ?>
                    </label> -->

                    <!--<label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="coupon" <?/*= @$edit->coupon == 1 ? 'checked' : '' */?>>
                                        <?/*= _title_product_coupon */?>
                                    </label>-->
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">

                    <label class="col-sm-12">Ảnh</label>

                    <div class="col-sm-12">
                        <input type="file" name="userfile" class="" id="input_img" onchange="handleFiles()"/>

                        <?php
                        if(file_exists(@$edit->image)){
                            echo '<img src="'.base_url($edit->image).'" id="image_review">';
                        }else{
                            echo '<img src="" id="image_review">';
                        }
                        ?>
                    </div>
                </div>
                <div style="clear: both"></div>

            </div>

        </div>

    </div>
</div>

</form>


<script src="<?=base_url('assets/plugin/slimscroll/jquery.slimscroll.min.js')?>"></script>

<script>
    $('#product_price,#product_price_sale').autoNumeric(0);
    $('.cat_checklist').slimScroll({
        height: '200px',
        alwaysVisible: true,
        railVisible: true
    });

    /*$('.checklist_cate input[type=checkbox]').click(function(){

     $('.checklist_cate input[type=checkbox]').each(function() {
     this.checked = false;
     });

     if(this.checked) {

     this.checked = false;
     }else{
     this.checked =true ;
     }
     });*/
</script>


<!-- /.row -->


<!-- /.row -->


<!-- /.row -->


<!-- /.row -->

</div>
<!-- /.container-fluid -->

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