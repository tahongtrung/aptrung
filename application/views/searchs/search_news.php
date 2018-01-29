
<div class="clearfix"></div>

<article class="npc">
    <section class="ss_home2">
        <div class="container">
            <div class="row_pc">
                <div class="col-center col-md-9">
                
                    <div class="cate1">
                        
                        <h2 class="title-text1">
                           <ul>
                               <li><a href="javascript:void(0)" title="Kết quả tìm kiếm">Kết quả tìm kiếm</a></li>
                            </ul>
                        </h2>
                    
                        <div class="itemhome clearfix">
                            <ul class="clearfix boxdv">
                            <?php if (isset($lists)) {
                                foreach ($lists as $nf) {
                            ?>
                                <li class="col-md-6 col-sm-6 col-xs-12 itemdv">
                                    <div class="clearfix itemdvin">
                                        <h3>
                                            <a href="<?=base_url($nf->pro_alias.'.html')?>" title="<?=$nf->title?>"><?=$nf->title?></a>
                                        </h3>
                                        <div class="imgnewscate col-md-4 col-sm-4 col-xs-4">
                                            <a href="<?=base_url($nf->pro_alias.'.html')?>" title="<?=$nf->title?>"><img src="<?=base_url($nf->image)?>" alt="<?=$nf->title?>"></a>
                                        </div>
                                        <div class="text_news col-md-8 col-sm-8 col-xs-8">
                                            
                                            <p style="color:#444444;font-size:12px;font-family:arial;"><?=LimitString($nf->description,100,'...')?></p>
                                            <div class="clearfix" style="font-size: 12px;font-family: arial;;font-style: italic;">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;<?=date('d/m/Y',$nf->time)?>
                                            </div>
                                            <div class="xemchitiet" align="right"><a href="<?=base_url($nf->pro_alias.'.html')?>" title="<?=$nf->title?>" style="font-style:italic;">Xem thêm >></a></div>
                                        </div>
                                    </div>
                                </li>
                            <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                
                </div>
                <?=$right?>
            </div>
        </div>
    </section>
</article>
<div class="clearfix"></div>

