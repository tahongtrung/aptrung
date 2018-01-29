
 <link type="text/css" href="<?= base_url('assets/css/map_css.css') ?>" rel="stylesheet">
 <link type="text/css" href="<?= base_url('assets/css/jqueryui.css') ?>" rel="stylesheet">

 <script type="text/javascript" src="<?= base_url('assets/js/front_end/jquery-1.11.1.min.js') ?>"></script>
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1w21tUvxObGqTgv2fKillyxFfQxICJbs&language=vi"></script>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="<?= base_url('adminvn') ?>">Admin</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Cấu hình bản đồ map
                    </li>
                    <li >
                        <a onclick="history.back()" style="cursor: pointer"><i class="fa fa-reply"></i></a>
                    </li>
                </ol>
            </div>
            <form class="validate form-horizontal" role="form" id="form1" method="POST" action=""
                  enctype="multipart/form-data">
                <input type="hidden" name="edit" value="<?= @$row->id; ?>">
                <div class="col-md-9" style="font-size: 12px">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Cấu hình bản đồ map</h3>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                        class="fa fa-check"></i> Cập nhật
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
  <label  class="col-sm-12">Nhập địa chỉ tìm</label>
   <div class="col-sm-10">
                        <input id="address" type="text" size="50" onfocus="if (this.value == 'Vui lòng nhập địa chỉ để tìm kiếm trên bản đồ!') {this.value = '';} " onblur="if(this.value == ''){this.value = 'Vui lòng nhập địa chỉ để tìm kiếm trên bản đồ!';}" class="form-control input-sm" name="dia_chi_timkiem" value="<?=@$row->dia_chi_timkiem;?>">
 </div>
  <div class="col-sm-2">
  <input value="Tìm địa chỉ" onclick="codeAddress()" class="btn btn-success btn-xs" type="button" >
  </div>                         
                       
 </div>
 
  <div class="form-group">
  <div style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;" class="main_mapsmall" id="map_canvas_detail"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; transform-origin: 526px 24px 0px;"><div style="position: absolute; left: 0px; top: 0px; z-index: 200;"><div style="position: absolute; left: 0px; top: 0px; z-index: 101;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 201;"><div style="position: absolute; left: 0px; top: 0px; z-index: 102;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 202;"><div style="position: absolute; left: 0px; top: 0px; z-index: 104;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 100;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: 92px; top: -128px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 92px; top: 128px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -164px; top: -128px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -164px; top: 128px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 348px; top: -128px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 348px; top: 128px;"></div></div></div></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden; width: 529px; height: 302px;"><img src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/StaticMapService_002.png" style="width: 529px; height: 302px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: 92px; top: -128px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_007.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 92px; top: 128px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_003.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 348px; top: -128px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_004.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 348px; top: 128px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_006.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -164px; top: -128px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -164px; top: 128px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_010.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div></div></div></div><div style="margin: 2px 5px 2px 2px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a title="Click to see this area on Google Maps" href="http://maps.google.com/maps?ll=21.032327,105.783789&amp;z=15&amp;t=m&amp;hl=en-US&amp;mapclient=apiv3" target="_blank" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 24px; cursor: pointer;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/google_white.png" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 24px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></a></div><div style="z-index: 1000001; position: absolute; right: 220px; bottom: 0px;" class="gmnoprint"><div draggable="false" style="height: 19px; -moz-user-select: none; line-height: 19px; padding-right: 2px; padding-left: 50px; background: -moz-linear-gradient(left center , rgba(255, 255, 255, 0) 0px, rgba(255, 255, 255, 0.5) 50px) repeat scroll 0% 0% transparent; font-family: Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: underline; cursor: pointer; display: none;">Map Data</a><span style="">Map data ©2013 Google</span><span style=""> - </span><a target="_blank" href="http://www.google.com/intl/en-US_US/help/terms_maps.html" style="color: rgb(68, 68, 68); text-decoration: underline; cursor: pointer;">Terms of Use</a></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 115px; top: 61px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;">Map data ©2013 Google</div><div style="width: 10px; height: 10px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/imgs8.png" style="position: absolute; left: -18px; top: -44px; width: 68px; height: 67px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div><div style="position: absolute; right: 0px; bottom: 0px;" class="gmnoscreen"><div style="font-family: Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2013 Google</div></div><div style="font-size: 10px; height: 17px; background-color: rgb(245, 245, 245); border: 1px solid rgb(220, 220, 220); line-height: 19px; position: absolute; right: 125px; bottom: 0px;" class="gmnoprint"><a href="http://maps.google.com/maps?ll=21.032327,105.783789&amp;z=15&amp;t=m&amp;hl=en-US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Arial,sans-serif; font-size: 85%; font-weight: bold; bottom: 1px; padding: 1px 3px; color: rgb(68, 68, 68); text-decoration: none; position: relative;" title="Report errors in the road map or imagery to Google" target="_new">Report a map error</a></div><div draggable="false" style="position: absolute; -moz-user-select: none; margin-left: 5px; margin-top: 5px; width: 120px; height: 120px; right: 0px; bottom: 0px;" class="gmnoprint"><div style="background-color: rgb(255, 255, 255); border-left: 1px solid rgb(151, 151, 151); border-top: 1px solid rgb(151, 151, 151); overflow: hidden; width: 120px; height: 120px;"><div style="position: absolute; left: 7px; top: 7px; border: 1px solid rgb(151, 151, 151); width: 111px; height: 111px; background-color: rgb(229, 227, 223); overflow: hidden;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 200;"><div style="position: absolute; left: 0px; top: 0px; z-index: 101;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 201;"><div style="position: absolute; left: 0px; top: 0px; z-index: 102;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 202;"><div style="position: absolute; left: 0px; top: 0px; z-index: 104;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105;"><div style="border-left: 1px solid rgb(136, 136, 255); border-width: 1px; border-style: solid; border-color: rgb(136, 136, 255) rgb(17, 17, 85) rgb(17, 17, 85) rgb(136, 136, 255); position: absolute; margin-top: -19px; margin-left: -33px; width: 66px; height: 38px; left: 56px; top: 56px;"><div style="border: 1px solid rgb(68, 68, 187); position: absolute; width: 64px; height: 36px;"><div style="background: none repeat scroll 0% 0% rgb(102, 102, 204); opacity: 0.3; position: absolute; width: 64px; height: 36px;"></div></div></div><div style="border-left: 1px solid rgb(136, 136, 255); border-width: 1px; border-style: solid; border-color: rgb(136, 136, 255) rgb(17, 17, 85) rgb(17, 17, 85) rgb(136, 136, 255); position: absolute; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; margin-top: -19px; margin-left: -33px; width: 66px; height: 38px; left: 56px; top: 56px;"><div style="border: 1px solid rgb(68, 68, 187); position: absolute; width: 64px; height: 36px;"></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 100;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: -94px; top: -235px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -94px; top: 21px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 162px; top: -235px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 162px; top: 21px;"></div></div></div></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden; width: 111px; height: 111px;"><img src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/StaticMapService.png" style="width: 111px; height: 111px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; position: absolute; left: -94px; top: -235px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_005.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -94px; top: 21px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_009.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 162px; top: -235px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_008.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 162px; top: 21px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/vt_002.png" style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"></div></div></div></div></div></div></div></div><div style="width: 19px; height: 19px; position: absolute; cursor: pointer; left: 101px; top: 101px;"><div title="Close the overview map" style="width: 19px; height: 19px; overflow: hidden; position: absolute;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/mapcontrols3d7.png" style="position: absolute; left: -40px; top: -386px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 59px; height: 492px;"></div></div></div><div controlheight="124" controlwidth="78" draggable="false" style="margin: 5px; -moz-user-select: none; position: absolute; left: 0px; top: 0px;" class="gmnoprint"><div style="cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; width: 78px; height: 78px; position: absolute; left: 0px; top: 0px;" controlheight="80" controlwidth="78" class="gmnoprint"><div style="width: 78px; height: 78px; position: absolute; left: 0px; top: 0px;" controlheight="80" controlwidth="78" class="gmnoprint"><div style="visibility: hidden;"><svg viewBox="0 0 78 78" height="78px" width="78px" overflow="hidden" version="1.1" style="position: absolute; left: 0px; top: 0px;"><circle stroke="#f2f4f6" fill="#f2f4f6" fill-opacity="0.2" stroke-width="3" r="35" cy="39" cx="39"></circle><g transform="rotate(0 39 39)"><rect fill="#f2f4f6" stroke-width="1" stroke="#a6a6a6" height="11" width="12" ry="4" rx="4" y="0" x="33"></rect><polyline stroke="#000" fill="#f2f4f6" stroke-width="1.5" stroke-linejoin="bevel" points="36.5,8.5 36.5,2.5 41.5,8.5 41.5,2.5"></polyline></g></svg></div></div><div style="position: absolute; left: 10px; top: 11px;" controlheight="59" controlwidth="59" class="gmnoprint"><div style="width: 59px; height: 59px; overflow: hidden; position: relative;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/mapcontrols3d7.png" style="position: absolute; left: 0px; top: 0px; width: 59px; height: 492px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"><div title="Pan left" style="position: absolute; left: 0px; top: 20px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div><div title="Pan right" style="position: absolute; left: 39px; top: 20px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div><div title="Pan up" style="position: absolute; left: 20px; top: 0px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div><div title="Pan down" style="position: absolute; left: 20px; top: 39px; width: 19.6667px; height: 19.6667px; cursor: pointer;"></div></div></div></div><div style="position: absolute; left: 28px; top: 85px;" controlheight="39" controlwidth="22" class="gmnoprint"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/szc4.png" style="width: 22px; height: 39px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;"><div title="Zoom in" style="position: absolute; left: 0px; top: 0px; width: 22px; height: 17px; cursor: pointer;"></div><div title="Zoom out" style="position: absolute; left: 0px; top: 18px; width: 22px; height: 17px; cursor: pointer;"></div></div></div><div style="margin: 5px; z-index: 0; position: absolute; cursor: pointer; right: 0px; top: 0px;" class="gmnoprint"><div style="float: left;"><div title="Show street map" draggable="false" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(0, 0, 0); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 1px 6px; border: 1px solid rgb(113, 123, 135); box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); font-weight: bold; min-width: 29px;">Map</div><div style="background-color: white; z-index: -1; padding-top: 2px; border-width: 0px 1px 1px; border-style: none solid solid; border-color: -moz-use-text-color rgb(113, 123, 135) rgb(113, 123, 135); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); position: absolute; left: 0px; top: 21px; text-align: left; display: none;"><div title="Show street map with terrain" draggable="false" style="color: rgb(0, 0, 0); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 1px 8px 3px 5px; direction: ltr; text-align: left; white-space: nowrap;"><span style="position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px 1px 1px 1px; width: 13px; height: 13px; box-shadow: none; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Terrain</label></div></div></div><div style="float: left;"><div title="Show satellite imagery" draggable="false" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(51, 51, 51); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255); padding: 1px 6px; border-width: 1px 1px 1px 0px; border-style: solid solid solid none; border-color: rgb(113, 123, 135) rgb(113, 123, 135) rgb(113, 123, 135) -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); font-weight: normal; min-width: 54px;">Satellite</div><div style="background-color: white; z-index: -1; padding-top: 2px; border-width: 0px 1px 1px; border-style: none solid solid; border-color: -moz-use-text-color rgb(113, 123, 135) rgb(113, 123, 135); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4); position: absolute; right: 0px; top: 21px; text-align: left; display: none;"><div title="Zoom in to show 45 degree view" draggable="false" style="color: rgb(184, 184, 184); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 1px 8px 3px 5px; direction: ltr; text-align: left; white-space: nowrap; display: none;"><span style="position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(241, 241, 241); border-radius: 1px 1px 1px 1px; width: 13px; height: 13px; box-shadow: none; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">45°</label></div><div title="Show imagery with street names" draggable="false" style="color: rgb(0, 0, 0); font-family: Arial,sans-serif; -moz-user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 1px 8px 3px 5px; direction: ltr; text-align: left; white-space: nowrap;"><span style="position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px 1px 1px 1px; width: 13px; height: 13px; box-shadow: none; vertical-align: middle;" role="checkbox"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img draggable="false" src="%C4%90%C4%83ng%20tin%20rao%20v%E1%BA%B7t%20-%20C%C3%B4ng%20ty%20c%E1%BB%95%20ph%E1%BA%A7n%20L%C6%B0u%20C%C3%B4ng_files/imgs8.png" style="position: absolute; left: -52px; top: -44px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Labels</label></div></div></div></div></div></div>
   <input name="hdfInfo" id="hdfInfo" type="hidden">
                        <input name="hdfMap" id="hdfMap" type="hidden"  value="<?=@$row->hdfMap;?>" >
  </div>
 <div class="form-group">
  <label  class="col-sm-4">Map title</label>
   <div class="col-sm-8">
   <input name="map_title" type="text" class="form-control input-sm"
                               value="<?=@$row->map_title;?>" placeholder="">
   </div>
  </div>
   <div class="form-group">
  <label  class="col-sm-4">Map địa chỉ</label>
   <div class="col-sm-8">
   <input name="map_adrdress" type="text" class="form-control input-sm"
                               value="<?=@$row->map_adrdress;?>" placeholder="">
   </div>
  </div>
   <div class="form-group">
  <label  class="col-sm-4">Map điện thoại</label>
   <div class="col-sm-8">
   <input name="map_phone" type="text" class="form-control input-sm"
                               value="<?=@$row->map_phone;?>" placeholder="">
   </div>

						 

                            <div class="text-right" style="padding-bottom: 15px">
                                <button type="submit" class="btn btn-success btn-xs" name="addnews"><i
                                        class="fa fa-check"></i> Cập nhật
                                </button>
                            </div>


                        </div>
                    </div>
                </div>

                


            </form>




        </div>
        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->


        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

<?php
if($row->hdfMap == ''){
	$bien = '(21.03487, 105.78940)';
}else{
	$bien = $row->hdfMap;
}
?>

<script type="text/javascript">
                           
                            function setDesc(input) {
                                //alert(input.value);
                                $("#hdfInfo").val(input.value);
                            }
                            function getDesc() {
                                //alert(input.value);
                                $("#infoMap").val($("#hdfInfo").val());
                            }
                            function initialize() {
                                geocoder = new google.maps.Geocoder();
                                var myOptions = {
                                    zoom: 16,
                                    center: new google.maps.LatLng<?=$bien; ?>,
                                    disableDefaultUI: true,
                                    panControl: true,
                                    zoomControl: true,
                                    mapTypeControl: true,
                                    overviewMapControl: true,
                                    overviewMapControlOptions: { opened: true },
                                    MarkerOptions: { draggable: true },
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                map = new google.maps.Map(document.getElementById("map_canvas_detail"),
                                  myOptions);
                                google.maps.event.addListener(map, 'click', function (e) {
                                    initialize();
                                    map.setCenter(e.latLng);
                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: e.latLng,
                                        draggable: true
                                    });
                                    $("#hdfMap").val(marker.position);
                                    google.maps.event.addListener(marker, "dragstart", function () {
                                        getDesc();
                                    });
                                    google.maps.event.addListener(marker, "dragend", function () {
                                        getDesc();
                                        $("#hdfMap").val(marker.position);
                                    });
                                    google.maps.event.addListener(marker, "click", function () {
                                        infowindow.open(map, marker);
                                        getDesc();
                                    });
                                });
                            }

                            function codeAddress() {
                                initialize();
                                var address = document.getElementById("address").value;
                                geocoder.geocode({ 'address': address }, function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        map.setCenter(results[0].geometry.location);
                                        var marker = new google.maps.Marker({
                                            map: map,
                                            position: results[0].geometry.location,
                                            draggable: true
                                        });
                                        $("#hdfMap").val(marker.position);
                                        google.maps.event.addListener(marker, "dragstart", function () {
                                            getDesc();
                                        });
                                        google.maps.event.addListener(marker, "dragend", function () {
                                            getDesc();
                                            $("#hdfMap").val(marker.position);
                                        });
                                        google.maps.event.addListener(marker, "click", function () {
                                            infowindow.open(map, marker);
                                            getDesc();
                                        });
                                    } else {
                                        alert("Geocode was not successful for the following reason: " + status);
                                    }
                                });
                            }

                            $(document).ready(function () {
                                initialize();
                            });
                        </script>