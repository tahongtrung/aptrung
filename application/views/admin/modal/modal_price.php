<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel" >
                <div class="panel-heading">
                    <div class="panel-title">Bảng giá <?=@$thus;?>
                        <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>

                </div>
                <div class="panel-body clearfix">
                    <div class="col-md-12">
                        <?php /*echo "<pre>";var_dump($item);die();*/?>
                        <form id="priceform" class="form-horizontal validate" role="form">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="active">
                                    <th>Ngày</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($item)) : ?>
                                    <?php foreach($item as $it) : ?>
                                    <tr>
                                        <td>
                                            <?php echo gettimeDay(@$it->day);?>
                                            <?php /*echo $it->day;*/?>
                                        </td>
                                        <td>
                                            <input type="hidden" id="day<?=@$it->day?>" value="<?=@$it->day;?>">
                                            <input value="<?=@$it->price;?>" id="price<?=@$it->day?>"  class="input-sm" type="text" name="price<?=@$it->day;?>"></td>
                                    </tr>
                                    <?php endforeach;?>
                                <?php else : ?>
                                    <tr>
                                        <td>Thứ 2</td>
                                        <td>
                                            <input type="hidden" id="day1" value="1">
                                            <input value="<?=@$item->day1?>" id="price1"  class="input-sm" type="text" name="price1"></td>
                                    </tr>
                                    <tr>
                                        <td>Thứ 3</td>
                                        <td>
                                            <input type="hidden" id="day2" value="2">
                                            <input value="<?=@$item->day2?>" id="price2" class="input-sm" type="text" name="price2">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Thứ 4</td>
                                        <td>
                                            <input type="hidden" id="day3" value="3">
                                            <input value="<?=@$item->day3?>" id="price3" class="input-sm" type="text" name="price3">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Thứ 5</td>
                                        <td>
                                            <input type="hidden" id="day4" value="4">
                                            <input value="<?=@$item->day4?>" id="price4"  class="input-sm" type="text" name="price4"></td>
                                    </tr>
                                    <tr>
                                        <td>Thứ 6</td>
                                        <td>
                                            <input type="hidden" id="day5" value="5">
                                            <input value="<?=@$item->day5?>" id="price5" class="input-sm" type="text" name="price5"></td>
                                    </tr>
                                    <tr>
                                        <td>Thứ 7 </td>
                                        <td>
                                            <input type="hidden" id="day6" value="6">
                                            <input value="<?=@$item->day6?>" id="price6"  class="input-sm" type="text" name="price6"></td>
                                    </tr>
                                    <tr>
                                        <td>Chủ nhật</td>
                                        <td>
                                            <input type="hidden" id="day0" value="0">
                                            <input value="<?=@$item->day7?>" class="input-sm" type="text" id="price0" name="price0">

                                        </td>
                                    </tr>
                            <?php endif;?>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <input type="hidden" name="item" id="id_item" value="<?=@$id;?>">
                                        <button onclick="updatePrice()" type="button" class="btn btn-xs btn-success">Cập nhật</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    /*$('#price1').autoNumeric(0);*/
</script>