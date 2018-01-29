
<!---endlist.thuong-hieu--->
<section class="block-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3  ">
                <?php foreach($widgets as $widget){
                    echo $widget;
                }?>
            </div>

            <div class="col-md-9  ">
            <?php
            function users_cate_checklist($data,$parent=0,$text='',$edit=null){

                foreach ($data as $k=>$v) {
                    if ($v->parent_id == $parent) {
                        unset($data[$k]);
                        $id = $v->id;
                        $item=array('id_category'=> $v->id);
                        if($edit!=null){
                            in_array($item,$edit)?$selected='checked':$selected='';
                        }else{
                            $v->id==1?$selected='checked':$selected='';
                        }

                        echo "<li><ul>";

                        echo '<div class="checkbox">
                        <label>
                          '.$text.'<input type="checkbox" name ="category[]" value="'.$v->id.'"'.@$selected.' class="chk" id="'.$v->id.'">
                          '.$v->name.'
                                </label>
                      </div> ';

                        users_cate_checklist($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$edit);
                        echo "</ul><li>";

                    }
                }
            }
            ?>

                <link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css') ?>">
                <script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js') ?>"
                        charset="utf-8"></script>
                <script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js') ?>"></script>

                <script src="<?= base_url('assets/plugin/autonumber/autoNumeric.js') ?>"></script>
                <script src="<?= base_url('assets/plugin/autonumber/jquery.number.js') ?>"></script>
                <div class="row">
                <form class="validate form-horizontal" role="form" id="form1" method="POST" action=""
                      enctype="multipart/form-data">

                <input type="hidden" name="edit" value="<?= @$edit->id; ?>">

                <div class="col-md-9" style="font-size: 12px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Tổng quan</h3>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                        class="fa fa-check"></i> <?= $btn_name; ?>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">


                            <div class="form-group">
                                <label class="col-sm-12">Tên sản phẩm</label>

                                <div class="col-sm-12">
                                    <input type="text" class="validate[required] form-control input-sm " name="name"
                                           value="<?= @$edit->name; ?>" placeholder=""/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12">Mã sản phẩm</label>

                                        <div class="col-sm-12">
                                            <input type="text" class="form-control input-sm " name="code"
                                                   value="<?= @$edit->code; ?>" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12  ">Giá gốc</label>

                                        <div class="col-sm-12">
                                            <input type="text" name="price" id="product_price"
                                                   data-v-max="9999999999999" data-v-min="0"
                                                   class="auto form-control input-sm"
                                                   value="<?= @$edit->price; ?>" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-12">Giá bán:</label>

                                        <div class="col-sm-12">
                                            <input type="text" name="price_sale" id="product_price_sale"
                                                   data-v-max="9999999999999" data-v-min="0"
                                                   class=" auto form-control input-sm"
                                                   value="<?= @$edit->price_sale; ?>" placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label   class="col-sm-12">Số lượng:</label>

                                        <div class="col-sm-12">
                                            <input type="number" name="counter" class="form-control input-sm" min="1"
                                                   value="<?= @$edit->counter; ?>"/>
                                        </div>
                                    </div>
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
                                <label class="col-sm-12 ">Thông tin khác</label>

                                <div class="col-sm-12">
                                    <textarea name="caption_1" class="form-control input-sm"
                                        ><?= @$edit->caption_1; ?></textarea>
                                </div>
                            </div>
                            <hr>

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
                                    <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
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
                        <div class="panel-body" style="padding: 3px">

                            <div class="">

                                <label class="col-sm-12" style="padding-left: 0px">
                                    Danh mục
                                </label>

                                <div class="col-sm-12  " style="border: 1px solid #ccc;padding: 5px">

                                    <div class=" checklist_cate cat_checklist">
                                        <?php if (isset($cate_selected)) $cate_selected = $cate_selected;
                                        else $cate_selected = null;
                                        users_cate_checklist($cate, 0, '', @$cate_selected)?>
                                    </div>

                                </div>
                                <div style="clear: both"></div>
                                <br>

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
                </div>

                <script src="<?=base_url('assets/js/front_end/users.js')?>"></script>
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

                <script>
                    $(".validate").validationEngine();
                </script>

            </div>
        <style>
            #image_review{max-width: 100%}
            .cat_checklist li{
                list-style: none;
            }
            .cat_checklist{
                font-size: 11px;
            }
            .cat_checklist input{
                width: 11px;
                margin-top: 0px;
            }
        </style>

        </div>
    <!--end share face-->
    </div><!---endlist-item--->
</section>

