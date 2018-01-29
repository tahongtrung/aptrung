<div class="col-left col-md-3 hidden-xs hidden-sm">
    <div class="sidebar sort">
        <div class="tit-side">
            <h3>Sort by</h3>
        </div><!--end tit-side-->
        <div class="sort-content">
            <form action="" method="GET">
                <select name="order" class="order">
                    <option data-ordering="int" value="">Price</option>
                    <option data-ordering="int" value="">Duration</option>
                </select>
                <select name="direction" class="order">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                        		<span class="input-group-btn">
                               		<button class="btn btn-4">Sort</button>
                                </span>
            </form>
        </div>
    </div><!--end sidebar-->
    <div class="sidebar search-tours">
        <div class="tit-side">
            <h3>Search Tours</h3>
        </div><!--end tit-side-->
        <div class="box-side">
            <?=@$viewsearch;?>
        </div><!--end box-side-->
    </div><!--end sidebar-->
</div><!--end col-left-->
<div class="main-content col-md-9">
    <div class="box1 col-md-12">
        <h2 class="title-box1">Result Search

    </div><!--end box1-->
    <div class="clearfix"></div>
    <div class="box-tour">
        <?php if(count($lists)) : ?>
            <?php foreach($lists as $list) : ?>
                <div class="item-tour col-md-12">
                    <div class="col-md-3 img-tour">
                        <div class="tourduration"><?=@$list->itinerary?> days </div>
                        <a href="<?= base_url($list->cate_alias.'/'.$list->pro_alias.'-c'.$list->cate_id.'p'.$list->pro_id) ?>" title="<?$list->pro_name;?>" class="link1">
                            <img src="<?=base_url($list->pro_img)?>" alt="">
                        </a>
                    </div><!--end img-->
                    <div class="col-md-6 intro">
                        <div class="text-intro">
                            <h2 class="pos-title">
                                <a href="<?= base_url($list->cate_alias.'/'.$list->pro_alias.'-c'.$list->cate_id.'p'.$list->pro_id) ?>" title="<?$list->pro_name;?>" class="link1">
                                    <?=@$list->pro_name;?>
                                </a>
                            </h2>
                            <div class="clearfix"></div>
                            <span style="font-weight: bold;">Start:</span>
                                <span class="element first last">
                                    <?=@$list->start;?>
                                </span> /
                            <span style="font-weight: bold;">Finish:</span>
                            <span class="element first last"><?=@$list->finish?></span>
                            <div class="pos-description">
                                <div class="element element-textarea first last">
                                    <p>
                                        <strong>
                                                <span style="font-weight: 400;">
                                                    <?=LimitString(@$list->pro_des,'150','...');?>
                                                </span>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <span style="font-weight: bold;">Theme:</span>
                                <span class="element">
                                    <a href="<?=base_url($list->cate_alias.'-pc'.$list->cate_id)?>">
                                        <?=@$list->cate_name?>
                                    </a>
                                </span><br>
                            <span style="font-weight: bold;">Season:</span>
                                <span class="element">
                                    <?=@$list->season;?>
                                    <!--<a href="">Winter</a>, <a href="">Spring</a>-->
                                </span>
                            <div id="travel-style-cont">
                                <span class="style-title">Travel style:</span>
                                    <span class="element">
                                        <a href="<?=base_url(@$list->style_alias.'-ts'.@$list->style_id)?>" title="<?=@$list->style_name;?>">
                                            <?=@$list->style_name;?>
                                        </a>
                                    </span>
                            </div>
                            <div class="pos-destinations">
                                <span style="font-weight: bold;">Destinations:</span>
                                    <span class="element">
                                        <?=@$list->destination;?>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="price-tour col-md-3">
                        <div style="">
                            <div class="pos-baseprice">
                                <span class="pre-label">Starting from</span><br>
                                    <span class="dcconvert" amount=" 131000 " title="">USD&nbsp;
                                        <?=number_format(@$list->price)?>
                                    </span>   <br>
                                <span class="after-label">per person</span><br>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="pos-btn" style="margin-top: 20px;">
                                <a href="<?=base_url('booking/viewbook?id='.$list->pro_id)?>" title="Đặt tour"
                                   class="btn btn-danger btn-block" style="font-size: 130%;  padding:10px;">
                                    BOOK NOW!
                                </a>
                            </div>

                        </div>
                    </div><!--end price-tour-->
                    <div class="clearfix">
                    </div>
                </div><!--end item-tour-->
            <?php endforeach;?>
        <?php endif;?>



</div><!--end item-tour-->
    <div style="text-align: center" class="clearfix"><?=$this->pagination->create_links();?></div>
</div><!--end box-tour-->
</div><!--end main-content-->
<div class="clearfix"></div>