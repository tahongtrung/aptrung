
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
                <a href="<?= base_url('them-san-pham')?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
                <div class="clearfix"></div>
                <br>
                <div class=" " >
                    <form action="" method="get">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input name="code" type="search" value="<?=$this->input->get('code');?>"
                                       placeholder="Mã sản phẩm..."
                                       class="form-control input-sm">
                            </div>
                            <div class="col-sm-4">
                                <input name="name" type="search" value="<?=$this->input->get('name');?>"
                                       placeholder="Tìm tên sản phẩm..."
                                       class="form-control input-sm">
                            </div>
                            <div class="col-sm-2">
                                <select name="cate" class="input-sm form-control">
                                    <option value="">Danh mục</option>
                                    <?php view_product_cate_select2($cate,0,'',@$this->input->get('cate'));?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-default">
                                    <i class="fa fa-search"></i>  Tìm kiếm
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <table class="table  table-hover table-bordered">
                    <tr>
                        <th width="2%">#</th>
                        <th width="8%">Ảnh</th>
                        <th >Tên sản phẩm</th>
                        <th width="18%">Danh mục</th>
<!--                        <th width="8%">Số lượng</th>-->
                        <th width="15%">Action</th>
                    </tr>
                    <?php if (isset($prolist)) {
                        $s=1;
                        foreach ($prolist as $v) {
                            ?>
                            <tr>
                                <td><?= $s++; ?></td>
                                <td>
                                    <?php if (file_exists($v->image)) { ?>
                                        <img src="<?= base_url(@$v->image) ?>" style="width: 65px; height: 30px">
                                    <?php } else echo 'No image'; ?>
                                </td>
                                <td>
                                    <?= @$v->name ?>

                                </td>
                                <td><?= @$v->cat_name ?></td>
                                <!--<td>
                                    <?/*= @$v->counter */?>
                                    <a href="#" class="pull-right" onclick="get_product_data($(this))"
                                       data-item="<?/*=$v->id;*/?>"
                                       data-toggle="modal" data-target="#modalAnimated"

                                        ><i class="fa fa-plus"></i></a>
                                </td>-->


                                <td>
                                    <div style="text-align: center; " class="action">

                                        <a href="<?= base_url('sua-san-pham/' . $v->id) ?>"
                                           class="btn btn-xs btn-default" title="Sửa"><i class="fa fa-pencil"></i></a>

                                        <a href="<?= base_url('hinh-anh/' . $v->id) ?>"
                                           class="btn btn-xs btn-default" title="Ảnh sản phẩm"  ><i class="fa fa-image"></i></a>

                                        <a href="<?= base_url('xoa-san-pham/' . $v->id) ?>"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                           class="btn btn-xs btn-danger"title="Xóa" style="color: #fff"><i class="fa fa-times"></i> </a>

                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } ?>
                </table>
            </div>

        </div>
    <!--end share face-->
    </div><!---endlist-item--->
</section>

