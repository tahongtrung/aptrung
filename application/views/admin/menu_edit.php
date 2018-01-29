<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Tables
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Thêm danh menu
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
                            <label for="inputEmail1" class="col-lg-2 control-label">Tên menu <span style="color: red">* </span>:</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control " name="title" placeholder="Tên menu" value="<?= $item1->name;?>"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Menu cha:</label>
                            <div class="col-lg-5">
                                <select name="parent" class="form-control">
                                    <option value="0">Root</option>

                                    <?php foreach (@$menu_root as $v) {
                                        if ($v->position == 'top') {
                                            ?>

                                            <option value="<?= $v->id_menu; ?>" <?php if($v->id_menu==$item1->parent_id){echo "selected";}?>
                                                    style="background: #dff0d8"><?php echo 'Top_ ' . $v->name; ?></option>
                                            <?php
                                            foreach (@$menu_chil as $v2) {
                                                if ($v2->parent_id == $v->id_menu) {
                                                    ?>
                                                    <option value="<?= $v2->id_menu; ?>" <?php if($v2->id_menu==$item1->parent_id){echo "selected";}?>
                                                            style="background: #dff0d8" >
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v2->name; ?></option>
                                                    <?php
                                                    foreach (@$menu_chil as $v3) {
                                                        if ($v3->parent_id == $v2->id_menu) {
                                                            ?>
                                                            <option value="<?= $v3->id_menu; ?>" <?php if($v3->id_menu==$item1->parent_id){echo "selected";}?>style="background: #dff0d8">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v3->name; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }?>
                                    <?php foreach (@$menu_root as $v) {
                                        if ($v->position == 'left') {
                                            ?>

                                            <option value="<?= $v->id_menu; ?>" <?php if($v->id_menu==$item1->parent_id){echo "selected";}?>
                                                    style="background: #eee"><?php echo "Left_ " . $v->name; ?></option>
                                            <?php
                                            foreach (@$menu_chil as $v2) {
                                                if ($v2->parent_id == $v->id_menu) {
                                                    ?>
                                                    <option value="<?= $v2->id_menu; ?>" <?php if($v2->id_menu==$item1->parent_id){echo "selected";}?>style="background: #eee">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v2->name; ?></option>
                                                    <?php
                                                    foreach (@$menu_chil as $v3) {
                                                        if ($v3->parent_id == $v2->id_menu) {
                                                            ?>
                                                            <option value="<?= $v3->id_menu; ?>" <?php if($v3->id_menu==$item1->parent_id){echo "selected";}?> style="background: #eee">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v3->name; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }?>
                                    <?php foreach (@$menu_root as $v) {
                                        if ($v->position == 'right') {
                                            ?>

                                            <option value="<?= $v->id_menu; ?>" <?php if($v->id_menu==$item1->parent_id){echo "selected";}?>><?php echo 'Right_ ' . $v->name; ?></option>
                                            <?php
                                            foreach (@$menu_chil as $v2) {
                                                if ($v2->parent_id == $v->id_menu) {
                                                    ?>
                                                    <option value="<?= $v2->id_menu; ?>" <?php if($v2->id_menu==$item1->parent_id){echo "selected";}?>>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v2->name; ?></option>
                                                    <?php
                                                    foreach (@$menu_chil as $v3) {
                                                        if ($v3->parent_id == $v2->id_menu) {
                                                            ?>
                                                            <option value="<?= $v3->id_menu; ?>" <?php if($v3->id_menu==$item1->parent_id){echo "selected";}?>>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v3->name; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }?>
                                    <?php foreach (@$menu_root as $v) {
                                        if ($v->position == 'bottom') {
                                            ?>

                                            <option value="<?= $v->id_menu; ?>" <?php if($v->id_menu==$item1->parent_id){echo "selected";}?>
                                                    style="background: #d9edf7"><?php echo 'Bottom_ ' . $v->name; ?></option>
                                            <?php
                                            foreach (@$menu_chil as $v2) {
                                                if ($v2->parent_id == $v->id_menu) {
                                                    ?>
                                                    <option value="<?= $v2->id_menu; ?>" <?php if($v2->id_menu==$item1->parent_id){echo "selected";}?> style="background: #d9edf7">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v2->name; ?></option>
                                                    <?php
                                                    foreach (@$menu_chil as $v3) {
                                                        if ($v3->parent_id == $v2->id_menu) {
                                                            ?>
                                                            <option value="<?= $v3->id_menu; ?>" <?php if($v3->id_menu==$item1->parent_id){echo "selected";}?> style="background: #d9edf7">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- <?= $v3->name; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }?>


                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Vị trí:</label>
                            <div class="col-lg-5">
                                <select name="position" class="form-control" >
                                    <option value="top" <?php if($item1->position=='top'){echo "selected";}?>>Top (Trên)</option>
                                    <option value="left"<?php if($item1->position=='left'){echo "selected";}?>>Left (Trái)</option>
                                    <option value="right"<?php if($item1->position=='right'){echo "selected";}?>>Right (Phải) </option>
                                    <option value="bottom"<?php if($item1->position=='bottom'){echo "selected";}?>>Bottom (Dưới)</option>
                                </select>
                            </div>
                        </div>

                        <!--                        -->

                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Module:</label>
                            <div class="col-lg-3">
                                <select name="module" id="sc_get" class="form-control">
                                    <option value="0">Chọn module</option>
                                    <option value="news" <?php if($item1->module=='news'){echo "selected";}?>>Tin tức</option>
                                    <option value="products" <?php if($item1->module=='products'){echo "selected";}?>>Sản phẩm</option>
                                    <option value="pages" <?php if($item1->module=='pages'){echo "selected";}?>>Trang tĩnh</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-lg-2 control-label">Module:</label>
                            <div class="col-lg-3">
                                <select name="subcat" id="sc_show"  class="form-control">
                                </select>
                            </div>
                        </div>



                        <script>
                            //Script for getting the dynamic values from database using jQuery and AJAX
                            $(document).ready(function() {
                                $('#sc_get').change(function() {

                                    var form_data = {
                                        name: $('#sc_get').val()
                                    };

                                    $.ajax({
                                        url: "<?php echo site_url('admin/menu/get_subcat'); ?>",
                                        type: 'POST',
                                        dataType: 'json',
                                        data: form_data,
                                        success: function(msg) {
                                            // alert(msg);
                                            var sc='';
                                            $.each(msg, function(key, val) {

                                                sc+='<option value="'+val.alias+'">'+val.name+'</option>';
                                            });
                                            $("#sc_show option").remove();
                                            $("#sc_show").append(sc);
                                        }
                                    });
                                });
                            });
                        </script>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Thứ tự:</label>

                            <div class="col-lg-3">
                                <select name="sort"   class="form-control">
                                    <?php for($i=1; $i<=12;$i++){?>
                                        <option value="<?= $i?>" <?php if($item1->sort==$i)echo 'selected' ?>><?= $i?></option>
                                    <?php   }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <div class="form-group">
                                <?php if ($item1->icon != null) { ?>
                                    <div class="col-md-3 text-right">
                                        <label class="control-label">Ảnh:</label>
                                        <img src="<?= base_url($item1->icon) ?>"
                                             style="width: 100px; max-height: 100px"/>
                                    </div>
                                <?php } ?>
                                <label class="col-lg-2 control-label">Thay đổi ảnh:</label>

                                <div class="col-lg-3">
                                    <input type="file" name="userfile" class="form-control" style="font-size: 12px"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Mô Tả:</label>
                            <div class="col-lg-5">
                                <textarea name="description" class="form-control" placeholder="Mô tả" rows="4" ><?= @$item1->description?></textarea>
                                <?php echo display_ckeditor($ckeditor); ?>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm" name="editmenu"><i class="fa fa-check"></i> Lưu</button>
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