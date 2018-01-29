<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="<?= base_url('adminvn/imageupload/banners') ?>">Banner</a>
                    </li>

                </ol>
            </div>
            <div class="col-md-12">
                <div class="clearfix col-sm-12">
                    <a href="<?= base_url('adminvn/imageupload/banner_add') ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                    <a onclick="ActionDelete('formbk')" class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i> Xóa
                    </a>
                    <div class="pull-right">
                        <form action="" method="get" class="row">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input name="title" type="search" value="<?= $this->input->get('title'); ?>"
                                           placeholder="Tiêu đều"
                                           class="form-control input-sm">
                                </div>
                                <div class="col-sm-3">
                                    <select name="p" class="input-sm form-control">
                                        <option value="">Vị trí</option>
                                        <?php
                                        foreach ($type as $k => $t) {
                                            ?>
                                            <option
                                                value="<?= $k; ?>" <?= $this->input->get('p') == $k ? 'selected' : '';; ?>><?= $t; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--<div class="col-sm-2  ">
                                <select name="lang" class="input-sm form-control">

                                    <option value="">Ngôn ngữ</option>
                                    <?php /*foreach ($datalang as $val) {
                                        $select = '';
                                        if ($val->id == $this->input->get('lang')) {
                                            $select = 'selected';
                                        }

                                        echo '<option value="' . $val->id . '" ' . $select . '>' . $val->name . '</option>';
                                    }*/?>

                                </select>
                            </div>-->

                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fa fa-search"></i> Tìm kiếm
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="table-striped" style="overflow-x: auto">
                    <div class="clearfix"></div>
                    <form name="formbk" method="post" action="<?=base_url('adminvn/imageupload/deletes')?>">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="active">
                                <th width="3%"><input type="checkbox" name="checkall" id="checkall" value="0" onclick="DoCheck(this.checked,'formbk',0)" /></th>
                                <th width="3%">STT</th>
                                <th width="8%">Ảnh</th>
                                <th width="20%">Tiêu đề</th>
                                <th width="20%">Danh mục</th>
                                <th width="20%">Vị trí</th>
                                <th width="10%">Sắp xếp</th>
                                <th width="5%">Target</th>
                                <th width="8%" class="text-center">#</th>
                            </tr>
                            </thead>

                            <?php if (isset($list)) {
                                $stt = 1;
                                foreach ($list as $v) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkone[]" id="checkone" value="<?php echo $v->id; ?>" ></td>
                                        <td><?= $stt++; ?></td>
                                        <td>
                                            <img style="max-width: 100%; max-height: 100px; min-width: 50px"
                                                 src="<?= base_url(@$v->link); ?>" alt=""/>
                                        </td>
                                        <td><?= @$v->title ?></td>
                                        <td><?=@$v->cat_name;?></td>
                                        <td><?= @$type[@$v->type]; ?></td>
                                        <td>
                                            <input type="number" onchange="banner_sort($(this))" value="<?= @$v->sort ?>"
                                                   data-item='<?= @$v->id; ?>' style="width: 55px">
                                        </td>
                                        <td><?= @$v->target ?></td>

                                        <td class="text-center">

                                            <a class="btn btn-xs btn-default"
                                               href="<?= base_url('adminvn/imageupload/banner_edit/' . $v->id) ?>"><i
                                                    class="fa fa-pencil"></i> </a>

                                            <a class="btn btn-xs btn-danger"
                                               href="<?= base_url('adminvn/imageupload/delete_banner/' . $v->id) ?>" title="Xóa"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                    class="fa fa-times"></i> </a>

                                        </td>
                                    </tr>
                                <?php
                                }
                            } ?>
                        </table>
                    </form>
                </div>
                <div class="pagination  ">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
                </div>
            </div>
        </div>

        <script>
            function banner_sort(s) {
                var baseurl = $("#baseurl").val();
                var form_data = {
                    id: s.attr('data-item'), sort: s.val()
                };
                $.ajax({
                    url: baseurl + "admin/imageupload/banner_sort",
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (rs) {

                    }
                });
            }
        </script>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>