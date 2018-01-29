    <section class="sc_partner_home">
        <div class="container">
            <div class="row_pc">

                <div class="owl-carousel slider_partner_home">
                <?php
                    if (isset($partners)) {
                        foreach ($partners as $keydt => $dt) {
                ?>
                    <div class="item">
                        <a href="<?=$dt->url?>" title="<?=$dt->name?>"><img class="w_100" src="<?=base_url($dt->link)?>" alt="<?=$dt->name?>"/></a>
                    </div>
                <?php } } ?>
                </div>

            </div>
        </div>
    </section>