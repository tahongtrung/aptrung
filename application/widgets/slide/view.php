<section class="slider">
        <div class="slider-main">
            <?php
                if (isset($slides)) {
                    foreach ($slides as $keysl => $sl) {
            ?>
                <div class="item">
                    <a href="javascript:void(0)" title="<?=$sl->name?>"><img class="w_100" src="<?=base_url($sl->link)?>" alt="<?=$sl->name?>" alt="<?=$sl->name?>"/></a>
                </div>
            <?php } } ?>
        </div>
</section>