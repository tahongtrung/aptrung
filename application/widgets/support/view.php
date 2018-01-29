<h4 class="tit-dm">
    <a href="" title="">
        <?=lang('support');?>
    </a>
</h4>
<div class="img"><a href="" title=""><img src="<?=base_url()?>assets/css/img/images (1).png"></a></div>
<?php foreach($supports as $support) : ?>
    <div class="contact">
        <a href="">
            <img src="<?=base_url()?>assets/css/img/skype.png" alt="" class="item">
        </a>
        <a href="#">
            <img src="<?=base_url()?>assets/css/img/ic-1.png" alt="" class="item">
        </a>
        <span class="item"><?=@$support->name;?></span>
    </div><!--end contact-->
<?php endforeach;?>
<div class="call">
    <img src="<?=base_url()?>assets/css/img/ic-2.png" alt="" style="margin-top:-10px;">
    <span class="dt"><?=@$this->option->hotline1;?></span>
</div><!--end call-->