<div class="sidebar homenews">
    <h3 class="title-sale"><i class="fa fa-folder-open-o"></i>Tin tức</h3>
    <div class="sale-content">
        <ul>
            <?php foreach($homenews as $new) { ?>

                <li class="clearfix">
                    <div class="image">
                        <a href="<?=base_url($new->cat_alias.'/'.$new->alias.'-c'.$new->cat_id.'n'.$new->id)?>" title="<?=$new->title;?>">
                            <img src="<?=base_url($new->image)?>">
                        </a>
                    </div>
                    <h3>
                        <a href="<?=base_url($new->cat_alias.'/'.$new->alias.'-c'.$new->cat_id.'n'.$new->id)?>" title="<?=$new->title;?>">
                            <?=$new->title;?>
                        </a>
                    </h3>

                </li>

            <?php } ?>
        </ul>
    </div>
</div>