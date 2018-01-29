<div class="" style="margin-top: 15px">

    <?php
    if(isset($comments)&& !empty($comments)){?>
       <p></p>
        <?php foreach($comments as $v){
            if($v->reply==0){
                ?>
                <!-- First Comment -->
                <article class="list_comment">
                    <div>
                        <div class="col-md-1 col-sm-1 col-xs-1" style="padding-right: 0">
                            <figure class="thumbnail">
                                <?php if(file_exists(@$v->avatar)){?>
                                    <img class="img-responsive" src="<?=base_url(@$v->avatar)?>" />
                                <?php  }else{?>
                                    <img class="img-responsive" src="<?=base_url('img/default-avatar.jpg')?>" />
                                <?php }?>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-10" >
                            <div class="">
                                <header class="text-left">
                                    <div class="comment-user"><i class="icon-user"></i> <b><?=$v->fullname;?></b></div>
                                    <time class="comment-date" datetime="<?= date('d-m-Y H:i',$v->time);?>"><i class="icon-time-3"></i> <?= date('d-m-Y',$v->time);?></time>
                                </header>

                                <div class="comment-post">
                                    <p>
                                        <?= $v->comment;?>
                                    </p>
                                </div>
                                <p class="btn-reply hidden "><a
                                        <?php if($this->session->userdata('userid')){?>
                                            onclick="show_reply('<?=$v->id?>')"
                                        <?php  }else{?>
                                            data-toggle="modal" data-target=".bs-example-modal-sm"
                                        <?php  }?> >Trả lời</a> </p>

                                <?php
                                foreach($comments_sub as $v2){
                                    if($v2->reply==$v->id){ ?>
                                        <!-- Second Comment Reply -->
                                        <article class="" style="margin-top: 10px">
                                            <div class="col-md-1 col-sm-1   col-xs-1" style="padding-left: 0">
                                                <figure class="thumbnail">
                                                    <?php if(file_exists($v2->avatar)){?>
                                                        <img class="img-responsive" src="<?=base_url($v2->avatar)?>" />
                                                    <?php  }else{?>
                                                        <img class="img-responsive" src="<?=base_url('img/default-avatar.jpg')?>" />
                                                    <?php }?>


                                                </figure>
                                            </div>

                                            <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0">

                                                    <div class="panel-body row" style="padding-top: 0px">
                                                        <header class="text-left">
                                                            <div class="comment-user"><i class="fa fa-user"></i> <?=$v2->fullname;?></div>
                                                            <time class="comment-date" datetime="<?= date('d-m-Y H:i',$v2->time);?>">
                                                                <i class="fa fa-clock-o"></i> <?= date('d-m-Y H:i',$v2->time);?></time>
                                                        </header>
                                                        <div class="comment-post">
                                                            <p>
                                                                <?= @$v2->comment;?>
                                                            </p>
                                                        </div>
                                                    </div>

                                            </div>
                                        </article>
                                        <div class="clearfix"></div>
                                        <!-- Third Comment -->
                                    <?php }
                                }?>

                                <article class="row" style="display: none" id="<?=$v->id?>">
                                    <div class="col-md-2 col-sm-2   hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive" src="<?=base_url('img/default-avatar.jpg')?>" />
                                        </figure>
                                    </div>


                                    <div class="col-md-10 col-sm-10" style="padding-left: 0" >

                                            <div style="position: relative;"  >
                                                <textarea  class="form-control"
                                                           id="txt_<?=$v->id?>"
                                                           onblur="blur_comments('<?=$v->id?>',$(this))"></textarea>
                                                <button style="position: absolute; top: 10px; right: 10px"
                                                        data-content="txt_<?=$v->id?>" data-reply="<?=$v->id?>"
                                                        data-items="<?=$product_id;?>"
                                                        onclick="send_reply($(this))"
                                                    >Gửi</button>
                                            </div>

                                    </div>
                                </article>

                            </div>


                        </div>
                    </div>

                </article>
                <div class="clearfix"></div>
                <!-- Third Comment -->
            <?php
            }
        }?>
        <div class="clearfix col-xs-12">
            <a onclick="show_comment()" style="cursor: pointer">Xem thêm</a>
        </div>

    <?php }
    else echo '<div class="col-md-12">Chưa có bình luận nào.</div>';
    ?>

</div>
<style>
    .comment-date{
        font-size: 12px;
        opacity: 0.9;
    }
    article{
        box-shadow: none !important;
        background: transparent;
    }
</style>
