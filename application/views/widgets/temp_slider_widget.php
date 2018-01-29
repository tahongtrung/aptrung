<section id="slider-1" class="clearfix">
    <div style="min-height: 20px;">
        <!-- ================================================== -->
        <div id="slider2_container" style="display: none; position: relative; margin: 0 auto;
                            top: 0px; left: 0px; width: 1024px !important; height: 300px; overflow: hidden;">
            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1024px!important;
                height:300px;overflow: hidden;">
                <?php if (isset($slide)) {
                    foreach ($slide as $item) {
                        ?>
                        <div>
                            <?php if ($item->url != null) echo "<a href='" . $item->url . "' target='" . $item->target . "'>"; ?>
                            <img u="image" src="<?= base_url($item->link); ?>"/>
                            <?php if ($item->url != null) echo "</a>"; ?>
                        </div>
                    <?php
                    }
                }?>
            </div>


            <!-- Arrow Left -->
                            <span u="arrowleft" class="jssora21l" style="width: 55px; height: 55px; top: 123px; left:
                             28px;">
                                <i class="fa fa-angle-left" style="color:#fff;font-size: 30px"></i>
                            </span>
            <!-- Arrow Right -->
                            <span u="arrowright" class="jssora21r" style="width: 55px; height: 55px; top: 123px; right: 0px">
                                <i class="fa fa-angle-right" style="color:#fff;font-size: 30px"></i>
                            </span>

        </div>

        <!-- Jssor Slider End -->
    </div>

</section>