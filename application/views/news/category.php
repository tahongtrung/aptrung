<div class="clearfix"></div>
<article>
    <?/*=$sliders*/?>
    <div class="clearfix"></div>
    <div class="container">
        <div class="row_pc">

            <div class="clearfix clearfix-20"></div>

            <div class="row_8">

                <div class="col-lg-800 col-md-9 col-sm-9 col-xs-12 col-page">
                <div class="row">
                    
                </div>
                    <div class="">
                    <div class="title-left4">
                        <h2>
                            <ul>
                                <li><a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a></li>
                                <?=creat_break_crum('products',$cate,$cate_curent->id);?>
                                
                            </ul>
                        </h2>
                    </div><!--end title-sidebar-->

                    <div class="clearfix-15"></div>
                    
                    <div class="prd-home">
                        <div class="row row-10">
                            <ul class="clearfix boxdv">
                            <?php if (isset($news_bycate)) {
                                foreach ($news_bycate as $nf) {
                            ?>
                                <li class="col-md-19 col-sm-12 col-xs-12 itemdv">
                                    <div class="clearfix itemdvin">
                                        
                                        <div class="imgnewscate col-md-4 col-sm-4 col-xs-4">
                                            <a href="<?=base_url($nf->alias.'.html')?>" title="<?=$nf->title?>"><img src="<?=base_url($nf->image)?>" alt="<?=$nf->title?>"></a>
                                        </div>
                                        <div class="text_news col-md-8 col-sm-8 col-xs-8">
                                            <h3>
                                                <a href="<?=base_url($nf->alias.'.html')?>" title="<?=$nf->title?>"><?=$nf->title?></a>
                                            </h3>
                                            <p style="color:#444444;font-size:12px;font-family:arial;"><?=LimitString($nf->description,400,'...')?></p>
                                            <div class="clearfix" style="font-size: 12px;font-family: arial;;font-style: italic;">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;<?=date('d/m/Y',$nf->time)?>
                                            </div>
                                            <div class="xemchitiet" align="right"><a href="<?=base_url($nf->alias.'.html')?>" title="<?=$nf->title?>" style="font-style:italic;">Xem thêm >></a></div>
                                        </div>
                                    </div>
                                </li>
                            <?php } } ?>
                            </ul>

                            <div class="clearfix"></div>
                            <div class="clearfix text-center">
                                <?php echo $this->pagination->create_links();?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                <?=$sidebar?>
        </div>
    </div>


</article>