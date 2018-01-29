<section class="block-type-title">
    <div class="container">
        <h3>Thương hiệu nổi tiếng</h3>
    </div>
</section>
<section class="container">
    <section class="row">
        <div class="brand-list">
            <ul class="list-cat">
                <?php foreach($users as $user){?>
                    <li class="col-md-4 cat-item">
                        <a href="<?=base_url($user->alias.'-b'.$user->id)?>">
                            <img src="<?=base_url($user->avatar)?>" alt="<?=$user->fullname;?>"> </a>
                        </a>
                        <div class="cat-info">
                            <div class="cat-title"><?=$user->fullname;?></div>
                            <div class="cat-name">Recipe Book</div>
                            <a href="<?=base_url($user->alias.'-b'.$user->id)?>" class="cat-link btn btn-default">Chi tiết</a>
                        </div>
                    </li>
                <?php }?>
            </ul>
        </div>
    </section>
    <section class="row" style="text-align: center">
        <div class="pagination"><?=$this->pagination->create_links();?></div>
    </section>
</section>