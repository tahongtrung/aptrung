<section class="content clearfix">
	<div class="container wrapper-main">
		<div class="row">
        	<div class="dead col-md-12 col-sm-12" style="padding:0px;">
            	<div class="col-md-9 banner col-sm-12">
                	<div id="slider2_container"
                                 style="position: relative; top: 0px; left: 0px; width: 778px; height: 268px; overflow: hidden;
                                  margin:0 auto; padding:0 auto">
            
                                <!-- Loading Screen -->
                                <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                                    <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                                    </div>
                                    <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
                                    </div>
                                </div>
            
                                <!-- Slides Container -->
                               
                                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 778px; height: 268px; overflow: hidden;">
                                    <?php if(isset($slide)){
                                    foreach($slide as $sli){?>
                                        <div>

                                        
                                            <img u="image" src="<?=base_url($sli->link)?>"/>

                                        </div>
                                    <?php }}?>
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
                    
            
                                <!-- Arrow Navigator Skin End -->
                                <a style="display: none" href="http://www.jssor.com">javascript</a>
                           
                            <!-- Jssor Slider End -->
   				 </div><!--end-------------------------------banner---->
                <div class="col-md-3 tim-kiem hidden-xs hidden-sm">
                    <div class="tit">
                        <a href="" title=""><?=lang('search')?></a>
                        <form class="" action="<?=base_url('advanced-search')?>" method="get">
                            <div class="input-group group">
                                <input type="text" class="form-control inp" placeholder="" style="height:26px;">

                            </div><!-- /input-group -->
                            <select name="category" class="form-control input-sm">
                                <option value="" style="text-align:center;"><?=lang('choo')?></option>
                                <?php foreach($themes as $theme) : ?>
                                <option value="<?=@$theme->cate_id?>" <?php if($theme->cate_id == @$var_search['theme']){echo "selected";} ?>>
                                    <?=@$theme->cate_name?> (<?=@$theme->total;?>)</option>
                                <?php endforeach;?>
                            </select>
                            <select name="places" class="form-control input-sm">
                                <option value="" style="text-align:center;"><?=lang('sele')?></option>
                                <?php foreach($places as $place) :?>
                                <option value="<?=@$place->id?>" <?php if($place->id == @$var_search['place']){echo "selected";} ?>>
                                    <?=@$place->name;?></option>
                                <?php endforeach;?>
                            </select>
                            <select name="finish" class="form-control input-sm">
                                <option value="" style="text-align:center;"><?=lang('selec')?></option>
                                <option value="140">Chọn điểm đến</option>
                                <?php foreach($places as $place) :?>
                                    <option value="<?=@$place->id?>" <?php if($place->id == @$var_search['finish']){echo "selected";} ?>>
                                        <?=@$place->name;?></option>
                                <?php endforeach;?>
                            </select>
                            <select name="duration" class="form-control input-sm">
                                <option value="" style="text-align:center;"><?=lang('setim')?></option>
                                <?php foreach($durations as $duration) : ?>
                                    <?php if($duration->name >=3) : ?>
                                <option value="<?=@$duration->name?>" <?php if($duration->name == @$var_search['duration']){echo "selected";} ?>>
                                    <?=@$duration->name;?> days</option>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </select>
                            <!--<input type="submit"  value="Tìm Kiếm" id="Button1" class="btn-1" >-->
                            <button type="submit" id="Button1" class="btn btn-default btn-3 btn-sm"><?=lang('sear')?></button>
                            <a href="<?=base_url('dat-ve-may-bay')?>" id="Button1" class="btn-3 btn btn-default btn-sm pull-right" ><?=lang('stic')?></a>
                        </form>
                    </div><!--end tit-->
                </div><!--end tim-kiem-->
            </div><!--end dead-->
