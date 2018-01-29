<?php if(count($banners)) : ?>
    <div class="banner" xmlns="http://www.w3.org/1999/html">
        <div id="slider2_container"
             style="position: relative; top: 0px; left: 0px; width: 1349px; height: 430px; overflow: hidden;
                                  margin:0 auto; padding:0 auto">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <!--<div style="position: absolute; display: block; background: url(<?=base_url()?>assets/css/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
            </div>-->
            </div>

            <!-- Slides Container -->

            <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1349px; height: 430px; overflow: hidden;">
                <?php foreach($banners as $banner) : ?>
                    <div>
                        <img u="image" src="<?=@$banner->link;?>"/>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        <!-- Arrow Navigator Skin Begin -->

        <!-- Arrow Left -->
                                <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 163px; left: 0px;">
                                </span>
        <!-- Arrow Right -->
                                <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 163px; right: 0px">
                                </span>
        <!-- Jssor Slider End -->
    </div><!--end-------------------------------banner---->
<?php endif;?>
<section class="content clearfix">
    <div class="container">
        <div class="row">
            <div class="breadcrumb pull-right">
                <ul>
                    <li><a class="breadhome" href="<?=base_url()?>" title="<?=@$this->option->site_name;?>"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<?=lang('home');?></a> </li>
                    <li><a href="javascript:void(0)">&nbsp;|&nbsp;<?=lang('user-mana');?></a> </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="block-head clearfix">
                <h2 class="title-block"><?=lang('yourdetail');?></h2>
            </div>
        </div>
        <div class="row">
            <div class="block-content clearfix">
                <div class="pro_floo clearfix">
                    <div class="col-md-2 col-sm-2"  style="width: 20%">
                        <div class="row">
                            <div class="acount_nav">
                                <ul>
                                    <li>
                                        <i class="fa fa-user"></i> &nbsp;
                                        <a href="<?= base_url('user-info')?>"><?=lang('user-mana');?></a>
                                    </li>
                                    <!--     <li>
                                    <i class="fa fa-heart-o"></i>
                                    <a href="<?/*= base_url('acount-like')*/?>">Sản phẩm yêu thích</a>
                                </li>-->
                                    <li>
                                        <i class="fa fa-file-text-o"></i> &nbsp;
                                        <a href="<?= base_url('acount-order')?>"> <?=lang('order');?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-10"  style="width: 80%">
                        <div class="acount_tit"><?=lang('user-mana');?></div>
                        <div class="clearfix-10"></div>
                        <div class="infor_acount clearfix col-md-6  col-sm-6">
                            <div class="infor_tit"><?=lang('user-info');?></div>
                            <div class="clearfix"></div>
                            <form action="<?= base_url('user-info')?>" method="post" class="validate form-horizontal" enctype="multipart/form-data" role="form">
                                <div class="123">
                                    <div class="form-group">
                                        <label class="col-sm-3"><?=lang('account');?></label>
                                        <label class="col-sm-9"><?=@$user_item->email;?></label>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3"><?=lang('name');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="validate[required] form-control input-sm " name="fullname"
                                                   value="<?=@$user_item->fullname;?>" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group" style="display: none">
                                        <label class="col-sm-3">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="validate[required] form-control input-sm " name="email"
                                                   value="<?= @$user_item->email; ?>" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3"><?=lang('phone');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="validate[required] form-control input-sm " name="phone"
                                                   value="<?= @$user_item->phone; ?>" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3"><?=lang('diachi');?></label>
                                        <div class="col-sm-9">
                                            <textarea class="validate[required] form-control input-sm " name="address" placeholder=""/><?= @$user_item->address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group" style="display: none">
                                        <label class="col-md-3">Giới tính</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <label class="checkbox-inline" style="text-transform: none">
                                                    <input type="radio" value="122" name="cate_tour[]">
                                                    Nam
                                                </label>

                                                <label class="checkbox-inline" style="text-transform: none">
                                                    <input type="radio" value="122" name="cate_tour[]">
                                                    Nữ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-3"><?=lang('province');?></label>
                                        <div class="col-sm-9">
                                            <select id="location5" onclick="change_province($(this).val())" class="input-sm  form-control validate[required]" name="province">
                                                <option value="0">--<?=lang('slect-provin');?>--</option>
                                                <?php
                                                foreach(@$province as $t){?>
                                                    <option <?php if($t->provinceid == $user_item->province){echo 'selected="selected"';}?> value="<?=$t->provinceid;?>" >
                                                        <?=$t->name;?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3">&nbsp;</label>
                                        <div class="col-sm-9">
                                            <button name="update_profiler" type="submit"  class="btn btn-blue btn-sm pull-right" >
                                                <div  class="button-green">
                                                    <i class="icons icon-basket-2"></i><?=lang('update');?>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>


                                </div>
                            </form>
                        </div>
                        <div class="infor_acount clearfix col-md-6 col-sm-6"  style="border-left: 0">
                            <div class="infor_tit"><?=lang('chang-pass');?></div>
                            <div class="clearfix"></div>
                            <form action="<?=base_url('users_frontend/change_pass')?>" method="post"   class="validate form-horizontal" role="form">
                                <div class="123">
                                    <div class="form-group">
                                        <label class="col-sm-4"><?=lang('account');?></label>
                                        <label class="col-sm-8"><?=@$user_item->email;?></label>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-4"><?=lang('old-pass');?></label>
                                        <div class="col-sm-8">
                                            <div id="show_error_pass2"></div>
                                            <input type="password" class="validate[required] form-control"
                                                   onchange="check_pass($(this).val())"
                                                   name="id"  name="old_pass" placeholder="<?=lang('old-pass');?>">
                                            <input id="pass_check" name="pass_check" value="1" type="hidden">
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-4"><?=lang('new-pass');?></label>
                                        <div class="col-sm-8">
                                            <input type="password" class=" validate[required,custom[onlyLetterNumber,minSize[6]]] form-control"
                                                   id="new_pass" name="new_pass" placeholder="<?=lang('new-pass');?>">
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-4"><?=lang('re-pass');?></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="validate[required,equals[new_pass]] form-control"
                                                   name="id" name="re_pass" placeholder="<?=lang('re-pass');?>">
                                        </div>
                                    </div>
                                    <div class="clearfix-5"></div>
                                    <div class="form-group">
                                        <label class="col-sm-4">&nbsp;</label>
                                        <div class="col-sm-8">
                                            <button name="update_pass"  class="btn btn-blue btn-sm pull-right" >
                                                <div class="button-green">
                                                    <i class="icons icon-basket-2"></i><?=lang('update');?>
                                                </div>
                                            </button>
                                        </div
                                    </div>

                                    <div class="clearfix-5"></div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?= base_url('assets/js/site/users.js') ?>"></script>