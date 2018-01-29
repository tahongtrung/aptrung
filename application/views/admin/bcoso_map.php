
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
                        <i class="fa fa-table"></i> Cấu hình bản đồ map
                    </li>
                    <li >
                        <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
                    </li>
                </ol>
            </div>
            <form class="validate form-horizontal" role="form" id="form1" method="POST" action=""
                  enctype="multipart/form-data">
                <input type="hidden" name="edit" value="<?= @$edit->id; ?>">
                <div class="col-md-9" style="font-size: 12px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Cấu hình bản đồ map</h3>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                        class="fa fa-check"></i> <?= @$btn_name; ?>
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">


                            <div class="form-group">
                                <label  class="col-sm-4">Map title</label>
                                <div class="col-sm-8">
                                    <input name="map_title" type="text" class="form-control input-sm"
                                           value="<?=@$edit->map_title;?>" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4">Map địa chỉ</label>
                                <div class="col-sm-8">
                                    <input name="map_adrdress" type="text" class="form-control input-sm"
                                           value="<?=@$edit->map_adrdress;?>" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4">Map điện thoại</label>
                                <div class="col-sm-8">
                                    <input name="map_phone" type="text" class="form-control input-sm"
                                           value="<?=@$edit->map_phone;?>" placeholder="">
                                </div>



                                <div class="text-right" style="padding-bottom: 15px">
                                    <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                            class="fa fa-check"></i> <?= @$btn_name; ?>
                                    </button>
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
