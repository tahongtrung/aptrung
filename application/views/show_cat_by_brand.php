<?php
function show_cat($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->alias==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->alias.'" '.$selected.'>'.$text.$v->name.'</option>';

            show_cat($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}

    echo '<option value="">--Loại đồ uống--</option>';
    show_cat($cat);

?>