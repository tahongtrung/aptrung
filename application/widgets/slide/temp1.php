<section id="slider-1" class="clearfix">
    <div class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="<?=base_url()?>upload/img/banner/bn1-01.jpg" alt="">
            </li>
            <li>
                <img src="<?=base_url()?>upload/img/banner/bn4-01.jpg" alt="">
            </li>
        </ul>
    </div>
    <link href="<?=base_url()?>assets/css/front_end/demo.css" rel="stylesheet">
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