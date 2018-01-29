<?php

function view_menu_option($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id_menu;
            $v->id_menu==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->id_menu.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_menu_option($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}
?>

<option value="0">Lựa chọn</option>


<?php view_menu_option($menu,0,'');?>