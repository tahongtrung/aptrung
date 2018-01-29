</div>
<style>
    .btn{border-radius: 0px}
</style>
<link rel="stylesheet" href="<?= base_url('assets/plugin/ValidationEngine/style/validationEngine.jquery.css') ?>">
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine-en.js') ?>"
        charset="utf-8"></script>
<script src="<?= base_url('assets/plugin/ValidationEngine/js/jquery.validationEngine.js') ?>"></script>

<script src="<?= base_url('assets/plugin/autonumber/autoNumeric.js') ?>"></script>
<script src="<?= base_url('assets/plugin/autonumber/jquery.number.js') ?>"></script>

<div id="show_success_mss" style="position: fixed; top: 20px; right: 20px">
    <?php if(isset($_SESSION['mess'])){?>

        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?=$_SESSION['mess'];?>
        </div>

        <?php
        unset($_SESSION['mess']);
    }?>
</div>
<script>
    setTimeout(function(){
        $('#show_success_mss').fadeOut().empty();
    }, 5000);

    function base_url(){
        return '<?php echo base_url();?>';
    }
</script>
<div id="show_alert" style="position: fixed; top: 5px; right: 5px;z-index: 99999 ">
    <?php if(isset($this->session->userdata['alert'])){?>
        <div class="alert alert-<?=$this->session->userdata['alert']['type']?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?=$this->session->userdata['alert']['mess'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <script>
            setTimeout(function(){
                $('#show_alert').fadeOut().empty();
            }, 3000);

        </script>
        <?php
        unset($_SESSION['alert']);
    }?>
</div>
<script src="<?=base_url('assets/js/admin/main_site.js')?>"></script>
<style>

    #image_review{
        width: 100%;
        max-height: 200px;
        margin-top: 10px;
    }
</style>
<input type="hidden" value="<?=base_url()?>" id="baseurl">
</body>

</html>