
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
                <form class="form-horizontal" role="form" id="form1" method="POST" action="" enctype="multipart/form-data" >
                    <input type="hidden" name="edit" value="<?=@$edit->id;?>">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-sm-2 control-label">Tên danh mục:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control input-sm " name="name"
                                   value="<?=@$edit->name;?>" placeholder="Tên danh mục"  />
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-sm-2 control-label">Danh mục cha:</label>
                        <div class="col-sm-5">
                            <select name="parent" class="form-control input-sm">
                                <option value="0">Lựa chọn</option>
                                <?php view_product_cate_select($cate,0,'',$edit->parent_id);?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Ảnh:</label>
                        <div class="col-sm-5">
                            <input type="file" name="userfile"  id="input_img" onchange="handleFiles()" />

                            <div style="width: 30%">
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
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Thứ tự:</label>
                        <div class="col-sm-2">
                            <input type="number" name="sort" class="form-control input-sm" value="<?=@$max_sort;?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-sm-2 control-label">Mô Tả:</label>
                        <div class="col-sm-5">
                            <textarea name="description" class="form-control input-sm" placeholder="Mô tả"
                                      rows="5"><?=@$edit->description;?></textarea>
                        </div>
                    </div>


                    <div class="col-sm-7 text-right">
                        <button type="submit" class="btn btn-success btn-sm" name="addcate"><i class="fa fa-check"></i> <?=$btn_name;?></button>
                    </div>

                </form>
            </div>

        </div>
    <!--end share face-->
    </div><!---endlist-item--->
</section>

