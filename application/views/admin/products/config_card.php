
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
            <h3 class="panel-title pull-left">Cấu hình thời hạn thẻ cào</h3>
            <div class="pull-right">
                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                        class="fa fa-check"></i> Cập nhật
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th width="5%">stt</th>
                        <th>Mệnh giá thẻ</th>
                        <th>Hạn sử dụng (Tính = ngày)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dưới 50.000đ</td>
                        <td>
                            <input name="card20" type="text" class="validate[required] form-control input-sm"
                                   value="<?=@$row->card20;?>" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>50.000đ</td>
                        <td>
                            <input name="card50" type="text" class="validate[required] form-control input-sm"
                                   value="<?=@$row->card50;?>" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>100.000đ</td>
                        <td>
                            <input name="card100" type="text" class="validate[required] form-control input-sm"
                                   value="<?=@$row->card100;?>" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Trên 100.000đ</td>
                        <td>
                            <input name="card200" type="text" class="validate[required] form-control input-sm"
                                   value="<?=@$row->card200;?>" placeholder="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <label>Chú ý :</label>
            <textarea name="content" id="ckeditor"><?=@$row->content;?></textarea>
            <?php echo display_ckeditor($ckeditor); ?>
            <div class="text-right" style="padding-bottom: 15px">
                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                        class="fa fa-check"></i> Cập nhật
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

