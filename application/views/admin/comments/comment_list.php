<div id="page-wrapper">
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?= base_url('adminvn')?>">Admin</a>
                    </li>
                    <li class="active">
                        <a href="<?= base_url('adminvn/comment/comments')?>">Bình luận</a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="">
                    <input id="baseurl" type="hidden" value="<?= base_url();?>">
                    <div class="modal fade bs-example-modal-lg popup1" id="popup1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel">Nội dung bình luận</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="getmodal" style="min-height: 300px">



                                        <div class="clear" style="clear: both; "></div>
                                    </div>
                                    <div class="clear" style="clear: both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .red{background:  red}
                        .blue{background:  #4cae4c}
                    </style>
                    <div class="col-md-12" style="padding-bottom: 10px">
                        <a onclick="ActionDelete('formbk')" class="btn btn-danger btn-sm">
                            <i class="fa fa-times"></i> Xóa
                        </a
                    </div>
                    <form name="formbk" method="post" action="<?=base_url('adminvn/comment/deletes')?>">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr class="active">
                                <th width="3%"><input type="checkbox" name="checkall" id="checkall" value="0" onclick="DoCheck(this.checked,'formbk',0)" /></th>
                                <th width="3%" class="text-center">STT</th>
                                <th>Người gửi</th>
                                <th width="40%">Sản phẩm</th>
                                <th width="10%">Hiển thị</th>
                                <th width="15%">Thời gian gửi</th>
                                <th width="10%" class="text-center">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)){
                                $stt=0;
                                foreach($list as $v){
                                    $j=$stt++;
                                    $id_tr='id_tr'.$j;
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkone[]" id="checkone" value="<?php echo $v->id; ?>" ></td>
                                        <td><?=$stt;?></td>
                                        <td><?=$v->user_name;?></td>
                                        <td>
                                            <?php foreach($cate as $cat){
                                                if($cat->id == $v->cate_id){?>
                                                    <a target="_blank" href="<?= site_url($cat->alias.'/'.$v->pro_alias.'-c'.$v->cate_id.'p'.$v->pro_id);?>">
                                                        <?=$v->pro_name;?>
                                                    </a>
                                                <?php }}?>
                                        </td>
                                        <td  class="text-center">
                                            <label class="checkbox-inline" onclick="active_comment(<?=$v->id_comment;?>)">
                                                <input type="checkbox" <?=$v->review==1?'checked':''?>  data-toggle="toggle"  id="toggle" data-size="mini"
                                                       data-on="Yes" data-off="No">
                                            </label>
                                        </td>
                                        <td><?=date('d-m-Y',$v->time)?></td>
                                        <td class="text-center">
                                            <div onclick="getModal(<?=$v->id;?>,'<?=$id_tr.'1';?>')"

                                                 class="btn btn-xs btn-default" data-toggle="modal" data-target=".popup1" title="Xem nội dung bình luận">
                                                <i class="fa fa-eye" style=""></i></div>

                                            <a href="<?= base_url('adminvn/comment/delete/'.$v->id)?>"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <div class="btn btn-xs btn-danger"><i class="fa fa-times-circle" style=""></i></div>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </form>
                    <script>
                        function mark(id_contact, mark, div) {

                            var baseurl = $('#baseurl').val();
                            $.ajax({
                                type: "POST",
                                dataType: 'json',
                                url: baseurl + 'admin/contact/update_show',
                                data: {id_contact: id_contact},
                                success: function (rs) {
                                    if(rs==1){
                                        $('#' + div).removeClass('fa-square-o').addClass('fa-check-square-o');
                                    }
                                    if(rs==0){
                                        $('#' + div).removeClass('fa-check-square-o').addClass('fa-square-o');
                                    }

                                }
                            })
                        }

                        function getModal(id,div) {
                            var baseurl = $('#baseurl').val();

                            $.ajax({
                                type: "GET",
                                url: baseurl + 'admin/comment/popupdata',
                                data: "id=" + id,
                                success: function (ketqua) {
                                    $('#'+div).removeClass('red').addClass('blue');
                                    $("#getmodal").html(ketqua);

                                }
                            })
                            $("#num").select();
                        }
                    </script>
                </div>
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
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
<script type="text/javascript">

    function active_comment(id){
        var baseurl = '<?php echo base_url();?>';
//        alert(id);
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: baseurl + 'admin/comment/active_comment',
            data: {id:id},
            success: function (ketqua) {

            }
        })
    }
    function changeStatus(id) {
        var data = {id: id};
        $.ajax({
            type: "POST",
            data: data,
            url: "<?=  base_url('adminvn/comment/changeStatusUser')?>",
            cache: false,
            dataType: 'json',
            success: function (e) {
                if (e) {
                    $("#" + id).html(e);
                }
            }
        });
    }
</script>
<link href="<?=base_url('assets/css/bootstrap-toggle.min.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/bootstrap-toggle.min.js')?>"></script>