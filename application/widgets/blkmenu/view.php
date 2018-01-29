<ul class="nav navbar-nav">
    <li>
        <i class="icon-home"></i>
    </li>

    <?php foreach ($menu_root as $mn):?>
        <li <?php if(check_hassubs($mn->id_menu,$menu_sub)):?>class="dropdown"<?php endif;?>>
            <a href="" title="Sản phẩm" class="dropdown-toggle"><?=$mn->name?>                <?php if(check_hassubs($mn->id_menu,$menu_sub)):?> <span class="caret"></span> <?php endif;?></a>
            <?php if(check_hassubs($mn->id_menu,$menu_sub)):?>
                <ul class="dropdown-menu">
                    <?php foreach ($menu_sub as $mc):?>
                        <?php if($mc->parent_id == $mn->id_menu):?>
                            <li><a href="" title="Máy sản xuất cửa nhựa">Máy sản xuất cửa nhựa</a></li>
                        <?php endif;?>
                    <?php endforeach;?>

                </ul>
            <?php endif;?>
        </li>
    <?php endforeach;?>

</ul>