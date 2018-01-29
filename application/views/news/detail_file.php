
<section class="content clearfix">
    <div class="container">
        <div class="bg_maincontain clearfix" style="background:#fff;margin-bottom:15px;border-bottom:1px solid #ccc;">
            <div class="row">
                <div class="main-content col-md-9 col-sm-12 col-xs-12">
                    <!-- <div class="block-head clearfix">
                        <h2 class="title-block"><?=@$news->title;?></h2>
                    </div> -->
                    <div class="tit_home">
                        <div class="bg_tit_home">
                        </div>
                        <h2 class="title-text">
                            <ul>
                                <li><a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a></li>
                                    <?=creat_break_crum('products',$cate,$cate_current->id);?>
                                <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>  <a href="<?=@$news->alias.'.html'?>" title="<?=@$news->title;?>"><?=@$news->title;?></a></li>
                            </ul>
                        </h2>
                    </div>
                    <div class="col-md-12 block-content clearfix">
                        <div class="linkdow" align="right">
                            <a href="<?=base_url($news->link_file)?>" download title="dowload">Link tải file <i class="fa fa-download" aria-hidden="true" style="color:blue;"></i></a>
                        </div>

                        <div class="doc-preview">
                            <iframe src="http://docs.google.com/gview?url=<?=base_url(@$news->link_file)?>&embedded=true#sthash.VGmBPBzy.dpuf" style="width: 100%; border: 1px solid #ccc;height:1000px;" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <?=@$sidebar;?>
                <div class="clearfix"></div>

            </div>
        </div>
        
    </div>
</section>
