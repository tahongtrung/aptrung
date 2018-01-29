<div class="clearfix"></div>
<article>
    <?/*=$sliders*/?>
    <div class="clearfix"></div>
    <div class="container">
        <div class="row_pc">

            <div class="clearfix clearfix-20"></div>

            <div class="row_8">

                <div class="col-lg-800 col-md-9 col-sm-9 col-xs-12 col-page">
                <div class="row">
                </div>
                    <div class="">
                    <div class="title-left4">
                        <h2>
                            <ul>
                                <li><a href="<?=base_url()?>" title="<?=@$this->option->site_name?>">Trang chủ</a></li>
                                <li> <i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="javascript:void(0)" title="Liên hệ"> Liên hệ</a></li>
                                
                            </ul>
                        </h2>
                    </div><!--end title-sidebar-->

                    <div class="clearfix-15"></div>
                    
                    <div class="prd-home">
                        <?php echo $this->option->address?>
                        <div class="">
                            <?php
                            if($this->option->map_title !=''){
                                $map_title = '<div class="map_title"><b>'.$this->option->map_title.'</b></div>';
                            }
                            if($this->option->map_adrdress !=''){
                                $map_adrdress = '<div><b>Địa chỉ: </b>'.$this->option->map_adrdress.'</div>';
                            }

                            if($this->option->map_phone !=''){
                                $map_phone = '<div><b>Điện thoại: </b>'.$this->option->map_phone.'</div>';
                            }
                            $hien_map = "'".$map_title.''.$map_adrdress.''.$map_phone."'";
                            ?>
                            <div class="box_map1">
                                <div class="text_bando"><?=lang('map')?></div>
                                <div class="map_site">
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1w21tUvxObGqTgv2fKillyxFfQxICJbs&language=vi"></script>
                                    <script type="text/javascript">
                                        var map;
                                        var infowindow;
                                        var marker = new Array();
                                        var old_id = 0;
                                        var infoWindowArray = new Array();
                                        var infowindow_array = new Array();

                                        function initialize() {
                                            var defaultLatLng = new google.maps.LatLng<?=$this->option->hdfMap;?>;
                                            var myOptions = {zoom: 15, center: defaultLatLng, scrollwheel: false, mapTypeId: google.maps.MapTypeId.ROADMAP };
                                            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                            map.setCenter(defaultLatLng);
                                            var arrLatLng = new google.maps.LatLng<?=$this->option->hdfMap;?>;
                                            infoWindowArray[10349] =<?=$hien_map;?>;
                                            loadMarker(arrLatLng, infoWindowArray[10349], 10349);
                                            moveToMaker(10349);
                                        }
                                        function loadMarker(myLocation, myInfoWindow, id) {
                                            marker[id] = new google.maps.Marker({position: myLocation, map: map, visible: true});
                                            var popup = myInfoWindow;
                                            infowindow_array[id] = new google.maps.InfoWindow({ content: popup});
                                            google.maps.event.addListener(marker[id], 'mouseover', function () {
                                                if (id == old_id) return;
                                                if (old_id > 0) infowindow_array[old_id].close();
                                                infowindow_array[id].open(map, marker[id]);
                                                old_id = id;
                                            });
                                            google.maps.event.addListener(infowindow_array[id], 'closeclick', function () {
                                                old_id = 0;
                                            });
                                        }

                                        function moveToMaker(id) {
                                            var location = marker[id].position;
                                            map.setCenter(location);
                                            if (old_id > 0) infowindow_array[old_id].close();
                                            infowindow_array[id].open(map, marker[id]);
                                            old_id = id;
                                        }
                                    </script>
                                    <style type="text/css">
                                        body {
                                            margin: 0;
                                            padding: 0;
                                        }
                                    </style>
                                    <body onLoad="initialize()" onUnload="GUnload()">
                                    <div id="map_canvas" style="width:100%; height: 385px"></div>
                                </div>

                            
                        </div>
                            <div class="form-contact col-md-12">
                                <form action="" method="post" class="validate form-horizontal" role="form">
                                    <div class="alert alert-success alert-dismissible" role="alert"
                                         style="position: fixed; right: 450px;background:none;font-style:italic;
                                         top:250px; width: 650px;
                                         font-size:40px;padding: 2px; margin: auto; line-height: normal;
                                         color: red; border: none; text-shadow: 0px 0px 5px #ffff00;
                                         ">
                                        <?php if(isset($_SESSION['message'])){
                                            echo $_SESSION['message']; unset($_SESSION['message']);}  ?>
                                    </div>
                                    <script type="text/javascript">
                                        (function () {
                                            setTimeout(showTooltip, 1500)
                                        })();

                                        function showTooltip() {
                                            $('.alert-success').fadeOut();
                                        }
                                    </script>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label"><?=lang('name');?></label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i style="font-size:15px;" class="fa fa-user"></i></span>
                                                <input type="text" style="z-index: 0;" name="full_name" class="validate[required] form-control placeholder" id="personName"
                                                       placeholder="<?=lang('name');?>" data-bind="value: name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?=lang('phone');?></label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i style="font-size:20px;" class="fa fa-mobile"></i></span>
                                                <input  name="phone" class="validate[required,custom[phone]] form-control placeholder" id="phone"
                                                        data-original-title="Your activation email will be sent to this address."
                                                        data-bind="value: email, event: { change: checkDuplicateEmail }"
                                                        type="text" style="z-index: 0;" class="form-control"  placeholder="<?=lang('phone');?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?=lang('email');?></label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i style="font-size:10px;" class="fa fa-envelope-o"></i></span>
                                                <input type="text"  style="z-index: 0;"  placeholder=""
                                                       name="email" class="validate[required,custom[email]] form-control placeholder" id="email"
                                                       data-original-title="Your activation email will be sent to this address."
                                                       data-bind="value: email, event: { change: checkDuplicateEmail }">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?=lang('diachi');?></label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i style="font-size:10px;" class="fa fa-home"></i></span>
                                                <input type="text"  style="z-index: 0;" placeholder="<?=lang('diachi');?>"
                                                       name="address" class="validate[required] form-control placeholder" id="personName"
                                                       data-bind="value: name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label"><?=lang('ghichu');?></label>
                                        <div class="controls">
                                            <div class="input-group" style="z-index: 0;">
                                                <span  class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                <textarea  name="comment"   class="form-control placeholder"
                                                           rows="4" cols="78" placeholder="<?=lang('ghichu');?>"></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="controls" style="margin-left: 40%;margin-top: 10px;margin-bottom:15px;">
                                        <input type="submit"  name="sendcontact" id="signupuser"
                                               class="btn btn-primary btn-sm" value="Gửi đi" />
                                        <input type="reset" id="mybtn" class="btn btn-primary btn-sm" value="<?=lang('nhaplai');?>">
                                    </div><!--end form-contact-->
                                    </div>
                                </form>
                            </div>
                        </div><!--End from contact-->
                        </div>

                    </div>
                </div>
                <?=$sidebar?>
            </div>

        </div>
    </div>


</article>