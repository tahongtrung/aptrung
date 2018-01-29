<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <button style="color: red;opacity: 0.9" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"></button>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="span3">
                <div class="product-img-box">
                    <!--<img alt="1444960354276-P-3264755" src="<?/*=@$item->image;*/?>" class="thumbnail" style="width: 100% !important;">-->
                    <img width="600" height="600" src="<?=base_url('upload/img/products/'.$item->pro_dir.'/thumbnail_1_'.@$item->image)?>" class="attachment-shop_single wp-post-image" alt="<?=@$item->name;?>" />
                </div>
            </div>
            <div class="span7" style="width: 510px">
                <div class="product-shop">
                    <div class="product_info_left">
                        <div class="product-name"><h1><?=@$item->name;?></h1></div>

                        <div class="short-description">
                            <?=@$item->detail;?>
                        </div>

                        <div class="price-box" itemprop="offers" itemscope="">
                            Giá :
                            <del><span class="amount"><?=number_format($item->price)?>&nbsp;₫</span></del>
                            <ins><span class="amount"><?=number_format($item->price_sale)?>&nbsp;₫</span></ins>
                        </div>




                        <!--<div class="add-to-cart">
                            <form class="cart" id="form-add_to_cart" method="post" enctype="multipart/form-data">



                                <div class="qty">
                                    <label for="qty">SL:</label>
                                    <input type="number" name="quantity" maxlength="12" value="1" class="input-text qty" id="qty" min="1" title="SL">
                                </div>			<button type="submit" class="button btn-cart"><i class="icon-basket"></i>Thêm vào giỏ</button>

                                <input type="hidden" name="add-to-cart" value="1827">


                            </form>

                        </div>-->

                        <!--<div class="socialsplugins_wrapper">
                            <div class="facebook_button">
                                <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fcapsac.vn%2Fshop%2Fo-cam-thong-minh%2Fo-cam-thong-minh-wifi-broadlink-sp-mini%2F&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21&amp;appId=609838709082531" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowtransparency="true"></iframe>
                            </div>
                            <div class="twitter_button">
                                <iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/tweet_button.1379634856.html#_=1379949792265&amp;count=horizontal&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fcapsac.vn%2Fshop%2Fo-cam-thong-minh%2Fo-cam-thong-minh-wifi-broadlink-sp-mini%2F&amp;text=%E1%BB%94%20c%E1%BA%AFm%20th%C3%B4ng%20minh%20wifi%20Broadlink%20SP-Mini&amp;url=http%3A%2F%2Fcapsac.vn%2Fshop%2Fo-cam-thong-minh%2Fo-cam-thong-minh-wifi-broadlink-sp-mini%2F&amp;via=http://capsac.vn" class="twitter-share-button twitter-count-horizontal" style="width: 109px; height: 20px;" title="Twitter Tweet Button" data-twttr-rendered="true"></iframe><script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
                            </div>
                            <div class="pinit_button">

                                &nbsp;&nbsp;<a count-layout="Horizontal" class="pin-it-button" href="http://pinterest.com/pin/create/button/">
                                    <img alt="Pin it" src="//assets.pinterest.com/images/PinExt.png"></a>
                            </div>
                        </div>-->


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
