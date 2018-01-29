
<div class="main-content clearfix">
 <div class="dich-vu clearfix">
    <div class="container" style="height: px">
        <div class="row">
            <div class="title-dv">
                <h2> <?=lang('big');?></h2>
            </div>
            <div class="box-item cleafix">
                <ul id="flexiselDemo4" style="height: 200px">
                    <?php if(isset($newshot)){
                        //echo "<pre>"; ; print_r($newshot); die;
                        foreach($newshot as $new){?>
                    <li class="item-1 col-md-3 col-sm-6 col-xs-6">
                        <div class="img-1">
                            <a ><img src="<?=base_url($new->image)?>" class="img-responsive" alt="<?=$new->title?>"></a>
                        </div>
                        <div class="text-1">
                        <h2>
                            <a href="<?=base_url($new->cat_alias.'/'.$new->alias.'-c'.$new->cat_id.'n'.$new->id)?>" alt="<?=$new->title?>" title="<?=$new->title?>">
                                <?=$new->title?>
                            </a>
                        </h2>
                    </div>                                                 
                     </li>   
                    <?php }}?>
                </ul>
                <script type="text/javascript">

        $(window).load(function() {
                                        
            $("#flexiselDemo4").flexisel({
                visibleItems: 4,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                        portrait: {
                changePoint:480,
                visibleItems: 1
                },
                landscape: {
                    changePoint:640,
                    visibleItems: 2
                    },
                tablet: {
                    changePoint:768,
                    visibleItems: 3
                    }
            }
        });
                                        
    });
</script>
                
            </div><!--end box-item-->
        </div><!--end row-->
    </div><!--end container-->
   </div>


<div class="new clearfix">
    <div class="container">
        <div class="row">
            <?php if(isset($newsf)){
                foreach($newsf as $keyn=>$new){?>
                    <div class="box-new col-md-12 col-sm-12">
                    <div class="col-md-4 news-2">
                        <div class="title-new">
                            <h2><a href="<?=base_url($new->alias.'-nc'.$new->id)?>" title="<?=$new->name?>"><?=$new->name?></a></h2>
                        </div><!--end title-->
                        <div class="new-left col-sm-12">
                            <?php if(isset($news_list)){
                                $count=0;
                                foreach($news_list as $keyts=>$list){
                                    if($list->category_id==$new->id){
                                        $count++;?>
                                        <div class="new-1 col-md-12 col-sm-12">
                                            <div class="img-new col-md-5 col-sm-5">
                                                <a href="<?=base_url($list->cat_alias.'/'.$list->alias.'-c'.$list->cat_id.'n'.$list->id)?>" title="<?=$list->title?>">
                                                    <img src="<?=base_url($list->image)?>" alt="">
                                                </a>
                                            </div>
                                            <div class="text-new col-md-7 col-sm-7">
                                                <a href="<?=base_url($list->cat_alias.'/'.$list->alias.'-c'.$list->cat_id.'n'.$list->id)?>" title="<?=$list->title?>">
                                                    <?=$list->title?>
                                                </a>
                                                <p>
                                                    <?=LimitString($list->description, 400, '...')?>
                                                </p>
                                            </div><!--end text-new-->
                                        </div><!--end new-1-->
                                        <?php if($count==1){break;} }}}?>
                            <div class="clearfix"></div>
                            <div class="list-new clearfix">
                                <ul>
                                    <?php if(isset($news_list)){
                                        foreach($news_list as $keyts=>$list){
                                            if($list->category_id==$new->id){?>
                                                <li><a href="<?=base_url($list->cat_alias.'/'.$list->alias.'-c'.$list->cat_id.'n'.$list->id)?>" title="<?=$list->title?>"><?=$list->title?></a></li>
                                            <?php }}}?>

                                </ul>
                            </div><!--end list-new-->
                        </div><!--end new-left-->
                    </div>

                            <!--video-->
                    <div class="col-md-4 news-2">
                        <div class="title-new">
                            <h2><a href="" title="">Video</a></h2>
                        </div><!--end title-->
                        <div class="sidebar video">

                    <div class="video-content">
                        <iframe width="290" height="200" src="https://www.youtube.com/embed/<?=@$this->option->site_video?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    </div><!--end video-->
                        
                            
                    </div>

                    <div class="col-md-4 news-2 new-right1">
                        <div class="new-right hidden-xs hidden-sm">
                            <?php if(isset($news_list)){
                                foreach($news_list as $keyts=>$list){
                                    if($list->category_id==$new->id And $list->focus==1){?>
                                        <div class="right-1 col-md-12">
                                            <div class="img-right col-md-3">
                                                <a href="<?=base_url($list->cat_alias.'/'.$list->alias.'-c'.$list->cat_id.'n'.$list->id)?>" title="<?=base_url($list->image)?>">
                                                    <img src="<?=base_url($list->image)?>" alt="">
                                                </a>
                                            </div><!--end-->
                                            <div class="text-right1 col-md-9">
                                                <a href="<?=base_url($list->cat_alias.'/'.$list->alias.'-c'.$list->cat_id.'n'.$list->id)?>" title=""><?=$list->title?></a>
                                            </div>
                                        </div><!--end right-1-->
                            <?php }}}?>
                        </div><!--new-right-->
                    </div>
                    </div><!--end box-new-->
                <?php }}?>
        </div><!--end row-->
    </div><!--end container-->
</div><!--end new-->
</section><!--end content-->



<footer class="foot clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3 logo_foot">

            </div>
            <div class="col-md-6 add">
                <p>
                    <span style="font-size:14px; font-weight:bold"><?=@$this->option->site_name?></span><br>
                    <?=$this->option->address?>
                </p>
            </div>
            <div class="col-md-3 icon-link hidden-xs hidden-sm">
                <a href="" title=""><img src="<?=base_url()?>img/icon_face.png"></a>
                <a href="" title=""><img src="<?=base_url()?>img/icon_skype.png"></a>
                <a href="" title=""><img src="<?=base_url()?>img/icon_g.png"></a>
                <p>
                    Thiết kế bởi <span><a href="" title="" style="font-weight:bold; color:#000cfa;">QTS</a></span>
                </p>
            </div><!--end-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end foot-->
</body>
</html>
