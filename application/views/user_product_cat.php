
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
                <?php
                function view_product_cate_table_user($data,$parent=0,$text='',$edit=null){

                    foreach ($data as $k=>$v) {
                        if ($v->parent_id == $parent) {
                            unset($data[$k]);
                            $id = $v->id;
                            if(isset($v->image)&&file_exists($v->image)){
                                $img="<img src='".base_url($v->image)."' style='height:40px; max-width:100px'/>";
                            }else $img='';

                            ($v->home == 1)?$home='background:#000088':$home='';
                            ($v->focus == 1)?$focus='background:#008855':$focus='';


                            echo "<tr>
                    <td>
                        <input type='number' value='".@$v->sort."' data-item='".$v->id."' onchange='cat_sort($(this))' style='width: 45px; padding: 2px;border:1px solid #ddd'/>
                    </td>
                    <td>".$text.$v->name."</td>
                    <td>$img</td>



                <td class='text-center'>
                <a href='".base_url('sua-danh-muc/' . $v->id)."'
                        class=\"btn btn-xs btn-default\" title=\"Sửa\"><i class=\"fa fa-pencil\"></i></a>
                <a href='".base_url('xoa-danh-muc/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

                            view_product_cate_table_user($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
                        }
                    }
                }
                ?>

                <a href="<?= base_url('them-danh-muc')?>" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Thêm mới</a>
                <div class="clearfix"></div>
                <br>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th width="7%">Sắp xếp</th>
                        <th  >Tên</th>
                        <th width="20%">Ảnh</th>
                        <th width="8%" class="text-center">Action</th>
                    </tr>
                    <?php
                    view_product_cate_table_user($cate,0,'');

                    ?>
                </table>
            </div>

        </div>
    <!--end share face-->
    </div><!---endlist-item--->
</section>

