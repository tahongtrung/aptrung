<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?= base_url('adminvn')?>">Admin</a>
                    </li>
                    <li>
                        <a href="<?= base_url('adminvn/admin/users')?>">Phân quyền</a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="">

                    <form method="post" action="" class="validate form-horizontal " id="form_add" role="form"
                          enctype="multipart/form-data">
                        <input type="hidden" name="edit" value="<?= @$edit->id; ?>">

                        <div id="panel-tablesorter" class="panel panel-default">
                            <div class="panel-heading bg-white">
                               
                                <!-- /panel-actions -->
                                <h3 class="panel-title">Phân quyền</h3>
                            </div>
                            <!-- /panel-heading -->

                            <div class="panel-body">

                                <table class="table table-bordered">
                                    <tr>
                                        <th>User name</th>
                                        <th>Full name</th>
                                        <th>Email</th>
                                    </tr>
                                    <tr>
                                        <td><?= @$user->email; ?></td>
                                        <td><?= @$user->fullname; ?></td>
                                        <td><?= @$user->email; ?></td>
                                    </tr>
                                </table>

                                <?php
                                function check_permission($perm, $access_controller = null, $access_action = null)
                                {
                                    if ($access_action == null) {
                                        foreach ($perm as $k => $v) {
                                            if ($k == $access_controller) {
                                                echo 'checked';
                                            }
                                        }
                                    }
                                    if ($access_action != null) {
                                        foreach ($perm as $k => $v) {
                                            if(!empty($v)){
                                                foreach ($v as $k2 => $v2) {
                                                    if ($k == $access_controller && $v2 == $access_action) {
                                                        echo 'checked';
                                                    }
                                                }
                                            }

                                        }
                                    }

                                }

                                ?>
                                <br>
                                <div class="all_perm btn btn-xs btn-primary" data-value="all_perm">Chọn tất cả
                                    <input type="checkbox" id="all_perm" style="display: none;">
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <div class="row ">

                                    <?php
                                    $i=1;
                                    foreach ($resources as $k => $v) {

                                        if ($v->parent_id == 0) {
                                            $j=$i++;
                                            ?>
                                            <div class="col-md-3 col-sm-4 col-xs-12 resource">
                                                <div style="width: 100%; padding: 2px 10px; background: #ddd">

                                                    <div class="nice-checkbox text-primary">
                                                        <input type="checkbox" name="controller[]"
                                                               class="selecctall" data-items="<?=$v->id;?>"
                                                               value="<?= $v->resource; ?>" id="<?=$v->id;?>"
                                                            <?php check_permission($u_access, $v->resource); ?>>
                                                        <label for="<?=$v->id;?>"><span class="text-inverse"><?= $v->resource_name; ?></span></label>
                                                    </div>

                                                </div>
                                                <div style="border: 1px #ddd solid; padding: 10px;" class="actionbox">

                                                    <?php foreach ($resources as $k2 => $v2) {
                                                        if ($v2->parent_id == $v->id) {
                                                            ?>
                                                            <div style="padding-left: 25px">

                                                                <div class="nice-checkbox text-primary">
                                                                    <input type="checkbox" name="action[]"
                                                                           class="<?=$v->id;?>" id="<?=$v2->id;?>"
                                                                           value="<?= $v->resource . ';' . $v2->resource; ?>"
                                                                        <?php check_permission($u_access, $v->resource, $v2->resource); ?>
                                                                        >
                                                                    <label for="<?=$v2->id;?>"><span class="text-inverse"><?= $v2->resource_name; ?></span></label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            unset($resources[$k2]);
                                                        }
                                                    }?>
                                                </div>
                                            </div>

                                            <?php

                                            unset($resources[$k]);
                                            if($j%4==0&&$j!=12) echo '<div class="clearfix"></div>';
                                        }
                                    }?>
                                </div>
                                <div class="clearfix"></div>

                                <div class="form-group" style="padding-top: 30px">

                                    <div class="col-sm-12 text-center">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                        <button type="reset" class="btn btn-default btn-sm">Hủy</button>
                                    </div>
                                </div>

                            </div>
                            <!--/panel-body-->
                        </div>
                        <!--/panel-tablesorter-->


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



<script src="<?= base_url('assets/plugin/slimscroll/jquery.slimscroll.min.js')?>"></script>
<script>

        $('.actionbox').slimScroll({
            height: 150,
            size: '3px'
        });

    $(document).ready(function() {

        $('.selecctall').click(function(event) {  //on click
            var cl=$(this).attr('data-items');
            if(this.checked) { // check select status

                $('.'+cl).each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
            }else{
                $('.'+cl).each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
            }
        });

        $('.all_perm').click(function(event) {  //on click

            if($(this).hasClass('checked1')){
                $(this).removeClass('checked1');
                $('input[type=checkbox]').each(function() { //loop through each checkbox
                    this.checked = false;  //select all checkboxes with class "checkbox1"
                });
            }else{
                $(this).addClass('checked1');
                $('input[type=checkbox]').each(function() { //loop through each checkbox
                    this.checked = true; //deselect all checkboxes with class "checkbox1"
                });
            }


        });

    });
</script>
<style>

    .resource label{
        cursor: pointer;
    }
    .text-primary{color: #666}
    .resource{margin-bottom: 15px}
    .nice-checkbox>label:before {
        font-size: 14px !important;
    }
    .nice-checkbox {
        padding-top: 0px !important;
        min-height: 10px;
    }
    .nice-checkbox>[type=checkbox]:not(:checked)+label, .nice-checkbox>[type=checkbox]:checked+label {
        font-size: 12px;
    }
</style>