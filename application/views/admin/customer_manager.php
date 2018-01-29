<div id="page-wrapper">
    <div class="container-fluid">
    <input type="hidden" value="<?= base_url()?>" id="hddurl">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    Liên hệ
                </h3>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Danh sách khách hàng
                    </li>
                </ol>
            </div>
            <div class="col-md-12">
            
                <div class="">
                    <div class="clear"></div>
                    <table class="table  table-hover table-bordered">
                        <tr>
                            <th>STT</th>
                            <th>IP khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Ngày</th>
                            <th class="text-center">Action</th>
                        </tr>
                        <?php if (isset($customer)) {
                            $s=1;
                            foreach ($customer as $v) {
                                ?>
                                <tr>
                                    <td><?= $s++; ?></td>
                                    <td><?= substr(str_replace("khach","",@$v->userID),0,-3)  ?></td>
                                    <td><?= @$v->location ?></td>
                                    <td class="td-status" onclick="change_status(this)" data-status="<?= @$v->status?>" data-id="<?=@$v->id?>"><?php if(@$v->status=="open"){
                                        echo "<i class='fa fa-2x fa-toggle-on'></i>";
                                    } else{
                                        echo "<i class='fa fa-2x fa-toggle-off'></i>";
                                    }

                                    ?></td>
                                    <td><?= date_fomat_by_string(@$v->loginTime,"H:i:s d/m/Y"); ?></td>
                                    <td>
                                        <div style="text-align: center; " class="action">
                                        
                                        <a href="<?= base_url('adminvn/chat/del-transcript/' . $v->id).'/chat_sessions' ?>"
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
                <div class="pagination">
                    <?php
                    echo $this->pagination->create_links(); // tạo link phân trang
                    ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        function change_status(obj){
            var baseurl = $("#hddurl").val();
            var status =  $(obj).attr("data-status");
            var idcustomer =  $(obj).attr("data-id");

             $.ajax({
             type: "POST",
             url: baseurl + 'admin/chat/change_status_customer',
             data: {status: status,idcustomer:idcustomer},
                success: function(rs) {
                    if(rs="success"){
                        if ($(obj).find("i.fa").hasClass("fa-toggle-on")) {
                            $(obj).find("i.fa").removeClass("fa-toggle-on").addClass("fa-toggle-off");
                        }
                        else{
                            $(obj).find("i.fa").removeClass("fa-toggle-off").addClass("fa-toggle-on");
                        }
                        
                    }
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