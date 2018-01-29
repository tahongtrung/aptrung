<div class="container">
    <div class="row_pc">
        <form action="<?=base_url('booking')?>" method="get" class="validate form-horizontal" role="form">
            <div class="content_home clearfix">
                <div class="w_100" style=" top: -45px; position: absolute;">
                    <div class="book_room clearfix">

                        <div class="col-md-1 col-lg-130 col-sm-12 col-xs-6">
                            <div class="row">
                                <div class="text_broom">
                                    <span style="font-size: 13.23px">Book your</span>
                                    <div class="clearfix"></div>
                                    <span style="font-size: 24.57px; font-weight: bold">Rooms</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10 col-lg-760 col-sm-12 hidden-xs">
                            <div class="row">
                                <ul class="lis_bookroom">
                                    <li class="book_w_150">
                                        <div class="w_100">
                                            <div class="pull-left">
                                                <input type="text" name="ngayden" class="set_date validate[required] form-control datepicker" value="" id="datetimepicker8"/>

                                            </div>
                                            <div class="pull-right">
                                                <img style="width: 14px; height: 16px" src="<?=base_url()?>assets/css/img/icon_book.png" alt=""/>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="book_w_150">
                                        <div class="w_100">
                                            <div class="pull-left">
                                                <input type="text" class="set_date validate[required] form-control datepicker" name="ngaydi" value="" id="datetimepicker8_z"/>
                                            </div>
                                            <div class="pull-right">

                                                <img style="width: 14px; height: 16px" src="<?=base_url()?>assets/css/img/icon_book.png" alt=""/>

                                            </div>

                                        </div>
                                    </li>
                                    <li class="book_w_105">
                                        <div class="w_100">
                                            <select name="loaiphong" class="quantity_room validate[required]">
                                                <option value=""><?=lang('loai');?></option>
                                                <?php if(count($cats)) :  ?>
                                                    <?php foreach($cats as $c => $cat) : ?>
                                                        <option <?php if($c==0){echo "selected";}?> value="<?=@$cat->pro_id?>"><?=@$cat->pro_name;?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="book_w_105">
                                        <div class="w_100">
                                            <select name="sophong" class="quantity_room">
                                                <?php for($i = 1;$i<=10;$i++) { ?>
                                                    <option value="<?=@$i;?>"><?=@$i?><?=lang('phong');?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="book_w_105">
                                        <div class="w_100">
                                            <select name="person" class="quantity_adult">
                                                <?php for($j = 1;$j<=10;$j++) { ?>
                                                    <option value="<?=@$j?>"><?=@$j;?> <?=lang('adult')?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="book_w_105">
                                        <div class="w_100">
                                            <select name="child" class="quantity_children">
                                                <?php for($k = 0;$k<=10;$k++) { ?>
                                                    <option value="<?=@$k?>"><?=@$k;?> <?=lang('children');?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-1 col-lg-110 col-sm-12 col-xs-6">
                            <div class="row">
                                <!--<div class="txt_book pull-right">
                                </div>-->
                                <button class="txt_book pull-right" type="submit">
                                    Book
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css') ?>">
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js') ?>"
        charset="utf-8"></script>
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js') ?>"></script>
<script>
    $(document).ready(function () {
        $(".validate").validationEngine();
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#datetimepicker8" ).datepicker({
            minDate:+1
        });
        $( "#datetimepicker8_z" ).datepicker({
            minDate:+2
        });
    });
</script>