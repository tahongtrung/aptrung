<div class="container content">
    <div class="row">
        <?=@$sidebar;?>
        <div class="main-content col-md-9 col-sm-12 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12 title_all  title_all_mobi">
                <div class="pull-left list-tit">
                    <ul>
                        <li class="active"><a href="<?=base_url()?>" title="<?=@$this->option->site_name;?>">Trang chủ</a></li>
                        <li>
                            <a href="<?=base_url($cate_current->alias.'.html');?>" title="<?=$cate_current->name;?>">
                                <?=@$cate_current->name;?>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url($news->alias.'.html');?>" title="<?=$news->title;?>">
                                <?=@$news->title;?>
                            </a>
                        </li>

                    </ul>
                </div><!--end p-left-->
            </div><!--end tit-all-->
            <div class="main-video clearfix">
                <h1 class="tit-video text-center clearfix">
                    <?=@$news->title;?>
                </h1>
                <div class="m-video text-center clearfix">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?=@$news->video;?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="icon col-sm-12 col-md-12">
                    <!--<div class="pull-left down">
                        <a href="" title=""><img src="<?/*=base_url()*/?>assets/css/img/sp/download.jpg" alt=""></a>
                    </div>-->
                    <div class="pull-right social hidden-xs">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_native_toolbox"></div>

                    </div>
                </div><!--end iocn-->
            </div><!--end main-video-->
            <div class="box-video row">
                <?php if(count($new_same)) : ?>
                    <?php foreach($new_same as $ns) : ?>
                        <div class="col-sm-4 col-md-4 col-xs-6 video1">
                            <div class="img-1">
                                <a href="<?=@$ns->alias.'.html'?>" title="<?=@$ns->title?>">
                                    <?php if($ns->image !='') : ?>
                                        <img src="<?=base_url(@$ns->image)?>" alt="<?=@$ns->title?>">
                                    <?php else :?>
                                        <img src="<?=base_url('upload/img/avatar/no_image.jpg');?>" width="100%"/>
                                    <?php endif;?>
                                </a>
                            </div>
                            <div class="text-1">
                                <a href="<?=@$ns->alias.'.html'?>" title="<?=@$ns->title?>"><?=@$ns->title?></a>
                            </div>
                        </div><!--end video1-->
                    <?php endforeach;?>
                <?php endif;?>
            </div><!--end box-v-->
        </div><!--end maincontent-->
    </div>
</div>