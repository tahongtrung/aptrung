<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i>Shipping
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
                    <form class="validate form-horizontal" role="form" id="form1" method="POST" action=""
                          enctype="multipart/form-data" >
                        <div class="col-md-6">
                            <input type="hidden" name="edit" value="<?=@$edit->id;?>">
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-3 control-label">Khoảng cách
                                    :</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control input-sm " name="name"
                                           value="<?=@$edit->name;?>" placeholder="Tên vận chuyển"  />
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="inputEmail1" class="col-lg-3 control-label">Giá:</label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" id="price" class="form-control validate[required,
                                    custom[number]]" name="price"
                                           value="<?=@$edit->price;?>" placeholder="Giá vận chuyển"  />
                                </div>

                            </div>
                            <div class="form-group">
                                <label  class="col-lg-3 control-label">Thứ tự:</label>
                                <div class="col-lg-3">
                                    <input type="number" name="sort" class="form-control input-sm" value="<?=$max_sort;?>" />
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="text-center col-md-12">
                            <button type="submit" class="btn btn-success btn-sm" name="addshipping"><i class="fa
                            fa-check"></i> Cập nhật</button>
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

<style>
    li{
        list-style: none;
    }
    .checklist_cate ul{padding: 0px; margin: 0px}
    .checklist_cate label{font-weight: normal}
</style>
<link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css')?>">
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js')?>" charset="utf-8"></script>
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js')?>"></script>
<script>
    $(document).ready( function() {
        $(".validate").validationEngine();
    });
</script>