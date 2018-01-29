<?php
/**
 * Created by JetBrains PhpStorm.
 * User: NguyenDai
 * Date: 3/18/16
 * Time: 2:01 PM
 * To change this template use File | Settings | File Templates.
 */
?>
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
                        <a href="<?= base_url('adminvn/pages/pages')?>">Pages</a>
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
                <a href="<?= base_url('adminvn/pages/add')?>" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i> Thêm mới
                </a>
                <a onclick="ActionDelete('formbk')" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Xóa
                </a>
            </div>
            <div class="col-md-12">
                <div class="">
                    <form name="formbk" method="post" action="<?=base_url('adminvn/pages/deletes')?>">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="active">
                                    <th width="3%"><input type="checkbox" name="checkall" id="checkall" value="0" onclick="DoCheck(this.checked,'formbk',0)" /></th>
                                    <th width="3%" class="text-center">STT</th>
                                    <th>Tiêu đề</th>
                                    <th width="10%">Ảnh</th>
                                    <th width="8%">Hiển thị</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($pagelist)){
                                $i=1;
                                foreach($pagelist as $v){?>
                                    <tr>
                                        <td><input type="checkbox" name="checkone[]" id="checkone" value="<?php echo $v->id; ?>" ></td>
                                        <td class="text-center"><?= $i++;?></td>
                                        <td><?= @$v->name?></td>
                                        <td>
                                            <?php if(file_exists($v->icon)){?>
                                                <img src="<?= base_url().@$v->icon?>" style="max-width: 100px; max-height: 80px">
                                            <?php }?>
                                        </td>
                                        <td>
                                            <div data-toggle="tooltip" data-placement="top" title="Trang chủ"
                                                 data-value="<?= $v->id; ?>" data-view="home"
                                                 class='view_color'
                                                 style='border: 1px solid #000088; <?= ($v->home == 1) ? 'background:#000088' : ''; ?>'></div>

                                            <div data-toggle="tooltip" data-placement="top" title="Trang liên hệ"
                                                 data-value="<?= $v->id; ?>" data-view="contact_page"
                                                 class='view_color'
                                                 style='border: 1px solid #008855; <?= ($v->contact_page == 1) ? 'background:#008855' : ''; ?>'>

                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('adminvn/pages/edit/'.$v->id)?>" class="btn btn-xs btn-default">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('adminvn/pages/delete/'.$v->id)?>" class="btn btn-xs btn-danger">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>

                    </table>
                    </form>
            </div>
<div class="pagination">
    <?php
    echo $this->pagination->create_links(); // tạo link phân trang
    ?>
</div>
</div>
</div>

<script>
    $('.view_color').click(function(){
        var color = $( this ).css( "border-color" );
        var background = $( this ).css( "background-color" );

        var baseurl = $("#baseurl").val();
        var form_data = {
            id: $( this ).attr('data-value'),view:$( this ).attr('data-view')
        };
        $.ajax({
            url: baseurl+"admin/pages/update_view",
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function (rs) {

            }
        });
        if(color!=background){
            $( this ).css( "background-color",color ) ;
        }else{
            $( this ).css( "background-color",'#fff' ) ;
        }
    })


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<style>
    .view_color{width: 10px; height: 10px;margin-top: 5px;cursor: pointer; float: left;margin-right: 5px }
</style>
<!-- /.row -->


<!-- /.row -->


<!-- /.row -->


<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>