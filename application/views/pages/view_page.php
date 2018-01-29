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
                                <li> <i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="javascript:void(0)" title="<?=@$page->name;?>"> <?=@$page->name;?></a></li>
                                
                            </ul>
                        </h2>
                    </div><!--end title-sidebar-->

                    <div class="clearfix-15"></div>
                    
                    <div class="prd-home">
                        <div class="">
                            <div class="page-detail">
                                <?=@$page->content;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?=$sidebar?>
        </div>
    </div>


</article>



