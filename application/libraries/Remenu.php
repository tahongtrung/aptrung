<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of auth
 *
 * @author daibkz@gmail.com
 */
class Remenu{
    public function createMenu($sourceArr,$parents =0){
        $this->recursiveMenu($sourceArr,$parents = 0,$newMenu,'nav-menu menu');
        //return $newMenu;
        return str_replace('<ul class="nav-dropdown rm-m"></ul>','',$newMenu);
    }

    public function recursiveMenu($sourceArr,$parents = 0,&$newMenu,$class=''){

        if(count($sourceArr)>0){
            $idUL = '';
            $newMenu .= '<ul class="'.$class.'">';
            //$newMenu .= '<li><a href="'.base_url().'"> Trang chủ</a></li>';
            foreach ($sourceArr as $key => $value){
                if($value['parent_id'] == $parents){
                    $liMenu = '';
                    if($value['url'] == 'trang-chu'){
                        $newMenu .= '<li class="menu-item"><a class="menu-link" href="' . base_url() . '">' . $value['name'] . '</a>';
                    }
                    else{
                        $newMenu .= '<li class="menu-item menubox"><a class="menu-link" href="' . base_url($value['url']) . '">' . $value['name'] . '</a>';
                    }

                    $newParents = $value['id_menu'];
                    unset($sourceArr[$key]);
                    $class = "nav-dropdown rm-m";
                    $this->recursiveMenu($sourceArr,$newParents, $newMenu,$class);
                    $newMenu .= '</li>';
                }
            }
            $newMenu .= '</ul>';
        }
    }

}