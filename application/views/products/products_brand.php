<section class="block-type-title">
    <div class="container">
        <h3><?=@$brand->fullname;?></h3>
    </div>
</section>
<div class="container">
    <div class="row">
    <div class="col-main-left col-md-9">
        <div class="row detail-type">
            <div class="col-md-4">
                <div class="image">
                    <img src="<?=base_url(@$brand->logo)?>" style="width: 100%;border: 1px #666 solid;margin-top: 0px" alt="<?=@$brand->fullname;?>">
                </div>
            </div>
            <div class="col-md-8">
                <div class="text">
                        <?=@$brand->description;?>
                </div>
            </div>
        </div><!---end-detail-type--->
        <div class="clearfix">
                <?php
                $stt=array('1','2','3','4');
                $i=1;
                foreach($brand_cat as $k=>$cat){
                    if($cat->parent_id==0){
                        $j=$i++;
                    ?>
                    <div class="col-md-4 detail-list-type">
                        <h3 class="tab-tile<?=$j;?>"><?=$cat->name;?></h3>
                        <ul>
                            <?php
                            $i2=1;
                            foreach($brand_cat as $k2=>$cat2){
                            if($cat->id==$cat2->parent_id){
                                $j2=$i2++;
                            ?>
                            <li><a href="<?=base_url($cat2->alias.'-pc'.$cat2->id)?>" title="<?=$cat2->name;?>" class="link<?=$j2;?>"><?=$cat2->name;?></a> </li>
                                <?php unset($brand_cat[$k2]);
                            }
                            }?>
                        </ul>
                    </div>
                <?php unset($brand_cat[$k]);
                    }
                }?>


            <!--<div class="col-md-4 detail-list-type">
                <h3 class="tab-tile2">Cafe</h3>
            </div>
            <div class="col-md-4 detail-list-type">
                <h3 class="tab-tile3">Đồ uống khác</h3>
            </div>-->
        </div>
        <div class="block-nav">
            <ol class="breadcrumb">
                <li><a href="<?=base_url()?>">Trang chủ</a></li>
                <li><a href="<?=base_url(@$brand->alias.'-b'.@$brand->id)?>"><?=@$brand->fullname;?></a></li>
            </ol>
        </div>
        <div class="block-pro row product_brand">
            <?php
            foreach($list as $product){?>
                <div class="item item-col col-md-3 col-sm-3">
                    <div class="item-flow">
                        <div class="image">
                            <a href="<?= base_url($product->cate_alias.'/'.$product->pro_alias.'-c'.$product->cate_id.'p'.$product->pro_id) ?>" title="<?$product->pro_name;?>">
                            <img src="<?=base_url($product->pro_img)?>" alt="<?=$product->pro_name;?>">
                                </a>
                        </div>
                        <div class="item-info">
                            <div class="item-name">
                                <a href="<?= base_url($product->cate_alias.'/'.$product->pro_alias.'-c'.$product->cate_id.'p'.$product->pro_id) ?>" title="<?$product->pro_name;?>">
                                <?=$product->pro_name;?>
                                </a>
                            </div>
                            <div class="item-brand">Thương hiệu : <?=$product->fullname;?></div>
                            <div class="item-quantity">Số lượng : 10</div>
                        </div>
                    </div>
                    <div class="add-cart">
                        <a href="javascript:void(0)"onclick="add_cart(<?=$product->pro_id;?>)" title="Đặt hàng"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Đặt hàng</a>
                    </div>
                </div>
            <?php  }
            ?>



        </div>
    </div>
    <div class="col-right col-md-3">
        <div class="promotion">
            <ul>
                <li><a href="#"><img src="<?=base_url('assets/css/img/qc09.jpg')?>"></a> </li>
                <li><a href="#"><img src="<?=base_url('assets/css/img/sp1.png')?>"></a> </li>
                <li><a href="#"><img src="<?=base_url('assets/css/img/qc1.jpg')?>"></a> </li>
                <li><a href="#"><img src="<?=base_url('assets/css/img/qc09.jpg')?>"></a> </li>
                <li><a href="#"><img src="<?=base_url('assets/css/img/qccf.jpg')?>"></a> </li>
            </ul>
        </div>
    </div>
</div>
</div>
