<div style="min-height: 50px;" class="hidden-xs clearfix">
    <section id="slider-1" class="clearfix">
        <div class="callbacks_container">
            <ul class="rslides" id="slider4">
                <?php if(isset($slide)) {
                    foreach($slide as $key=>$b){
                        ?>
                        <li>
                            <?= $b->url != null ? '<a href="' . $b->url . '" target="' . $b->target . '" >' : '' ?>
                            <img src="<?=base_url($b->link);?>" alt="">
                            <?= $b->url != null ? '</a>' : '' ?>
                            <?php if($b->title != null){
                                echo '<p class="caption">'.$b->title.'</p>';                        }
                            ?>
                        </li>
                    <?php
                    }
                }?>
            </ul>
        </div>
        <link href="<?= base_url('assets/css/front_end/demo.css');?>" rel="stylesheet">
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 4
                $("#slider4").responsiveSlides({
                    auto: true,
                    pager: false,
                    nav: true,
                    speed: 500,
                    namespace: "callbacks",
                    before: function () {
                        $('.events').append("<li>before event fired.</li>");
                    },
                    after: function () {
                        $('.events').append("<li>after event fired.</li>");
                    }
                });
            });
        </script>
    </section>

</div>