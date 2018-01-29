<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-sm-12">
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
        </li>
        <li>
            <a href="<?= base_url('adminvn/news') ?>">Tin tức</a>
        </li>
        <li >
            <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
        </li>
    </ol>
</div>
<?php
function view_news_cat_checklist($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $item=array('id_category'=> $v->id);
            if($edit!=null){
                in_array($item,$edit)?$selected='checked':$selected='no';
            }

            echo "<li><ul>";

            echo '<div class="checkbox">
                        <label>
                          '.$text.'<input type="checkbox" name ="category[]" value="'.$v->id.'"'.@$selected.' class="chk" id="'.$v->id.'">
                          '.$v->name.'
                                </label>
                      </div> ';
            /*echo $text.'<input type="checkbox" name ="category[]" value="'.$v->id.'"'.@$selected.' class="chk" id="'.$v->id.'"/>
                            <label class=" " for="'.$v->id.'"> '.$v->name.'</label>';*/
            view_news_cat_checklist($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$edit);
            echo "</ul><li>";

        }
    }
}
?>


<form class="validate form-horizontal" role="form" id="form-bk" method="POST" action=""
      enctype="multipart/form-data">

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
                        <input type="text" class="form-control input-sm validate[required]" name="title"
                               oninput="createAlias(this)" value="<?=@$edit->title;?>" placeholder=""/>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-12">Alias</label>
                    <div class="col-sm-12" id="error-alias">
                        <input onchange="createAlias(this)" type="text" id="alias" class="form-control input-sm validate[required]" name="alias"
                               value="<?= @$edit->alias; ?>" placeholder=""/>
                    </div>
                </div>


                <div class="form-group">
                    <label  class="col-sm-12">Mô tả</label>

                    <div class="col-sm-12">
                        <textarea name="description" class="form-control input-sm" placeholder=""
                                  rows="4"><?=@$edit->description;?></textarea>
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
                    <label for="keyword" class="col-sm-12">Video</label>

                    <div class="col-sm-12">
                        <input type="text" placeholder="Link video youtube" name="video" class="form-control input-sm" value="">
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
                    <input type="hidden" value="1" name="addnews">
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

                <div class="col-sm-12" style="  border: 1px solid #ccc; padding-left: 0px;padding: 10px 0px">
                    <label class="col-sm-6">
                        <input type="checkbox" value="1" class="checkbox-inline"
                               name="home" <?= @$edit->home == 1 ? 'checked' : '' ?>>
                        Trang chủ
                    </label>

                   <!--  <label class="col-sm-6">
                        <input type="checkbox" value="1" class="checkbox-inline"
                               name="hot" <?= @$edit->hot == 1 ? 'checked' : '' ?>>
                        Hot
                    </label> -->

                    <label class="col-sm-6">
                        <input type="checkbox" value="1"
                               name="focus" <?= @$edit->focus == 1 ? 'checked' : '' ?>>
                        Tin nổi bật
                    </label>

                   <!-- <label class="col-sm-6">
                                        <input type="checkbox" value="1"
                                               name="coupon" <?/*= @$edit->coupon == 1 ? 'checked' : '' */?>>

                                    </label>-->
                </div>
                <div class="clearfix"></div>

                <br>
                <div class="form-group">
                    <label  class="col-sm-12 ">Danh mục</label>

                    <!--<div class="col-sm-12">
                                    <select name="category_id" class="form-control input-sm">
                                        <option value="">Lựa chọn</option>
                                        <?php /*view_news_cate_select(@$news_cate,0,'',@$edit->category_id);*/?>

                                    </select>
                                </div>-->

                    <div class="col-sm-12  " >

                        <div class=" checklist_cate cat_checklist" style="border: 1px solid #ccc; padding: 5px" >
                            <?php if (isset($cate_selected)) $cate_selected = $cate_selected;
                            else $cate_selected = null;
                            view_product_cate_checklist($cate, 0, '', @$cate_selected)?>
                        </div>

                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-12 ">File tài liệu</label>

                    <div class="col-sm-12">
                        <input type="file" name="userfile1" id="input_img"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-12 ">Hình ảnh</label>

                    <div class="col-sm-12">
                        <input type="file" name="userfile" id="input_img" onchange="handleFiles()"/>

                        <?php
                        if(file_exists(@$edit->image)){
                            echo '<img src="'.base_url($edit->image).'" id="image_review">';
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