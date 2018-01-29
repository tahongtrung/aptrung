$(document).ready(function(){
    $('.on_search').click(function(e) {
        e.preventDefault();
        if ($('#form_search').css('display') == 'none') {
            $('#form_search').show();
        }
        else {
            $('#form_search').hide();
        }
    });
});
$(window).load(function () {
    render_size();
    var url = window.location.href;
    $('.menu-item  a[href="' + url + '"]').parent().addClass('active');
});

$(window).resize(function () {
    render_size();
});


function render_size() {
    var heightitem = $('.prd-item img').width();
    $('.prd-item img').height(0.9 * parseInt(heightitem));

    var height1 = $('.imgnewscate img').width();
    $('.imgnewscate img').height(0.6 * parseInt(height1));

    var slidermain = $('.slider-main img').width();
    $('.slider-main img').height(0.46 * parseInt(slidermain));

}
