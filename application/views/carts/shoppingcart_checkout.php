<?php if(count($banners)) : ?>
    <div class="banner">
        <div id="slider2_container"
             style="position: relative; top: 0px; left: 0px; width: 1349px; height: 430px; overflow: hidden;
                                  margin:0 auto; padding:0 auto">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <!--<div style="position: absolute; display: block; background: url(<?=base_url()?>assets/css/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
            </div>-->
            </div>

            <!-- Slides Container -->

            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1349px; height: 430px; overflow: hidden;">
                <?php foreach($banners as $banner) : ?>
                    <div>
                        <img u="image" src="<?=@$banner->link;?>"/>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <!-- Arrow Navigator Skin Begin -->

        <!-- Arrow Left -->
                                <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 163px; left: 0px;">
                                </span>
        <!-- Arrow Right -->
                                <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 163px; right: 0px">
                                </span>
        <!-- Jssor Slider End -->
    </div><!--end-------------------------------banner---->
<?php endif;?>
<section id="content" class="content clearfix">
    <div class="container top" role="main">
        <div class="content_top">
            <div class="breadcrumb pull-right">
                <ul>
                    <li><a class="breadhome" href="<?=base_url()?>" title="<?=@$this->option->site_name;?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?=lang('home');?></a> </li>
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp;Giỏ hàng</a> </li>
                </ul>
            </div>
        </div>
        <div class="col-md-12">
            <div class="block-head clearfix">
                <h2 class="title-block">Giỏ hàng</h2>
            </div>
            <div class="block-content clearfix">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover orderinfo-table  itemInfo-table">
                        <thead>
                        <tr class="active">
                            <th class="th-title hidden-xs" width='20%'>Hình ảnh</th>
                            <th class="th-title" >Tên sản phẩm</th>
                            <th class="th-title" width='10%'>Số lượng</th>
                            <th class="th-title" width='10%'>Giá bán</th>
                            <th class="th-title" width='10%'>Tổng cộng</th>
                            <th class="th-title" width='5%'></th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php if (!empty($cart)) {
                            //                                    print_r($cart);
                            $stt=1;
                            foreach ($cart as $key => $v) {
                                ?>
                                <tr style="padding: 10px 2px;height: 31px; margin-bottom: 10px !important; ">
                                    <td class="hidden-xs">
                                        <a href="#"  title="">
                                            <?= isset($v['image'])?'<img  style="width: 100%;"
                                                                  src="'.base_url('upload/img/products/'.$v['pro_dir'].'/thumbnail_2_'.$v['image']).'" alt="'.$v['name'].'" />':'';?>

                                        </a>
                                        <input type="hidden" value="<?=$v['rowid'];?>" id="rowid" name="rowid"/>
                                    </td>
                                    <td>
                                        <a href="#"
                                           title="<?=$v['name'];?>"><?=$v['name'];?></a><br>



                                    </td>

                                    <td>
                                        <div class="numeric-input">
                                            <input onchange="update_cart('<?=$key?>',$(this).val(),$('#address').val())"
                                                   min="1" max="99"
                                                   type="number" value="<?=$v['qty'];?>" id="qty<?=$v['rowid'];?>" name="count[]">
                                            <input type="hidden" name="item_id[]" value="<?=$v['rowid'];?>">
                                            <input type="hidden" name="price[]"  value="<?=$v['price_sale'];?>">


                                        </div>
                                    </td>
                                    <td><?=number_format($v['price_sale']);?>₫</td>
                                    <td><span id="item_total<?=$key;?>"><?=number_format($v['qty']*$v['price_sale']);?></span>₫</td>
                                    <td class="text-center" style="text-align: center">
                                        <a title="xóa sản phẩm khỏi giỏ hàng" href="<?= base_url('xoa-gio-hang/' . $key) ?>" class="btn btn-danger btn-xs">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="7" class="align-right">
                                    Tổng tiền đơn hàng (<i>* Đã bao gồm VAT </i>)
                                    <strong><span id="total_cart">  <?=number_format(@$total);?></span>₫</strong>
                                </td>
                            </tr>
                        <?php }else{?>
                            <tr>
                                <td colspan="6" class="align-left"><strong class="red">→
                                        Giỏ hàng của bạn hiện không có sản phẩm nào!</strong></td>
                            </tr>
                        <?php  }?>

                        </tbody>
                    </table>
                </div>
                <?php if (!empty($cart)) { ?>
                    <div style="text-align: right" class="btn btn-success checkout_btn" data-toggle="modal"
                         data-target=".bs-example-modal-sm_checkout">
                        <div class="button-green">
                            <a style="color: #fff" href="<?= base_url('dat-hang')?>"><i class="icons icon-basket-2"></i>Thực hiện đặt hàng</a>
                        </div>
                    </div>
                    <div style="text-align: right" class="btn btn-success checkout_btn" onclick="window.history.go(-2);">
                        <div class="button-green">
                            <i class="icons icon-basket-2"></i>Tiếp tục mua hàng
                        </div>
                    </div>
                    <div style="text-align: right" class="btn btn-success checkout_btn">
                        <a style="color:#fff" href="<?= base_url('shoppingcart/destroy_cart') ?>" class="button-green"
                           onclick="return confirm('Hủy giỏ hàng sẽ xóa toàn bộ sản phẩm trong giỏ hàng của bạn?')">
                            <i class="icons icon-basket-2"></i>Hủy giỏ hàng
                        </a>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</section>

<script>
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    /*function abc()
    {
        alert('gjdslajgljs');
    }*/
    function update_cart(id,qty){
        jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo base_url()?>' + 'shoppingcart/update_cart',
            data: {id:id,qty:qty},
            success: function (ketqua) {
                jQuery('.badge-inverse').html(ketqua.count);
                jQuery('.total-sub').html(formatNumber(ketqua.total) + '₫');
                jQuery('#item_total'+id).html(formatNumber(ketqua.item_total));
            }
        })
    }

</script>
