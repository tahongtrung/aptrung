<?php

if (!function_exists('modelCheckAdd')){
	/**
	 * Check data for table
	 *
	 * Check data for table before insert to database
	 * 
	 * @param array $tableDef Definition of table
	 * @param array $data Data to insert
	 */
	function modelCheckAdd($tableDef,$data){
		if (!isset($tableDef) || ! isset($data) || !is_array($tableDef) || !is_array($data)){
			return false;
		}
		
		$newdata = array();
		
		foreach ($tableDef as $name => $val){
			if ($val){
				if (!isset($data[$name]) || (strlen($data[$name])<1)){
					return false;
				}

				if ($val == 'number'){
					if (!is_numeric($data[$name])){
						return false;
					}
				}else{

				}
			}else{
				if (!isset($data[$name])){
					continue;
				}
			}
			
			$newdata[$name] = $data[$name];
		}
		
		if (!count($newdata)){
			return false;
		}
		
		return $newdata;
	}
}

if (!function_exists('LimitString')){

    function LimitString($chuoi,$gioihan,$etc="..."){
        if(strlen($chuoi)<=$gioihan)
        {
            return $chuoi;
        }
        else{
            if(strpos($chuoi," ",$gioihan) > $gioihan){
                $new_gioihan=strpos($chuoi," ",$gioihan);
                $new_chuoi = substr($chuoi,0,$new_gioihan).$etc;
                return $new_chuoi;
            }
            $new_chuoi = substr($chuoi,0,$gioihan).$etc;
            return $new_chuoi;
        }
    }
}

if (!function_exists('modelCheckEdit')){
	/**
	 * Check data for edit
	 *
	 * Check data for table before edit to database
	 * 
	 * @param array $tableDef Definition of table
	 * @param array $data Data to edit
	 * @param array $origindata Origin data
	 */
	function modelCheckEdit($tableDef,$data,$origindata){
		if (!isset($tableDef) || ! isset($data) || !is_array($tableDef) || !is_array($data)){
			return false;
		}
		
		$newdata = array();
		foreach ($tableDef as $name => $val){
			if (!isset($data[$name]) || ($origindata->$name == $data[$name]) || 
					($data[$name]=='')){
				continue;
			}

			if ($val == 'number'){
				if (!is_numeric($data[$name])){
					continue;
				}
			}else{

			}
			
			$newdata[$name] = $data[$name];
		}
		
		if (!count($newdata)){
			return false;
		}
		
		return $newdata;
	}
}

if (!function_exists('generateSalt')){
	function generateSalt($length=8){
		$salt = random_string('alnum',$length);
		
		return $salt;
	}
}


if (!function_exists('encryptPassword')){
	function encryptPassword($password,$salt){
		if (strlen($password) < 8){
			return 'Error: Password must longer than 8 character';
		}
		
		$newpassword = $password;
		$num = 0;
		for($i=0;$i<strlen($salt);$i++){
			$num+= ord($salt[$i]);
		}
		
		$num = round($num/8.8,0);
		
		for($i=0;$i<$num;$i++){
			if ($i%2>0){
				$newpassword = md5($newpassword.$salt);
			}else{
				$newpassword = substr(sha1($newpassword.$salt),0,32);
			}
		}
		
		return $newpassword;
	}
}

if (!function_exists('make_alias')){
	function make_alias($str){
		$cleaner = array(
			'â'		=> 'a', 'Â'		=> 'A',
			'ă'		=> 'a', 'Ă'		=> 'A',
			'ạ'		=> 'a', 'Ạ'		=> 'A',
			'á'		=> 'a', 'Á'		=> 'A',
			'à'		=> 'a', 'À'		=> 'A',
			'ả'		=> 'a', 'Ả'		=> 'A',
			'ã'		=> 'a',	'Ã'		=> 'A',
			'ậ'		=> 'a', 'Ậ'		=> 'A',
			'ấ'		=> 'a', 'Ấ'		=> 'A',
			'ầ'		=> 'a', 'Ầ'		=> 'A',
			'ẩ'		=> 'a', 'Ẩ'		=> 'A',
			'ẫ'		=> 'a',	'Ẫ'		=> 'A',
			'ặ'		=> 'a', 'Ặ'		=> 'A',
			'ắ'		=> 'a', 'Ắ'		=> 'A',
			'ằ'		=> 'a', 'Ằ'		=> 'A',
			'ẳ'		=> 'a', 'Ẳ'		=> 'A',
			'ẵ'		=> 'a',	'Ẵ'		=> 'A',
			
			'đ'		=> 'd', 'Đ'		=> 'D',
			
			'ê'		=> 'e',	'Ê'		=> 'E',
			'é'		=> 'e',	'É'		=> 'E',
			'è'		=> 'e',	'È'		=> 'E',
			'ẹ'		=> 'e',	'Ẹ'		=> 'E',
			'ẻ'		=> 'e',	'Ẻ'		=> 'E',
			'ẽ'		=> 'e',	'Ẽ'		=> 'E',
			'ế'		=> 'e',	'Ế'		=> 'E',
			'ề'		=> 'e',	'Ề'		=> 'E',
			'ệ'		=> 'e',	'Ệ'		=> 'E',
			'ể'		=> 'e',	'Ể'		=> 'E',
			'ễ'		=> 'e',	'Ễ'		=> 'E',
			
			'í'		=> 'i', 'Í'		=> 'I',
			'ì'		=> 'i', 'Ì'		=> 'I',
			'ị'		=> 'i', 'Ị'		=> 'I',
			'ỉ'		=> 'i', 'Ỉ'		=> 'I',
			'ĩ'		=> 'i', 'Ĩ'		=> 'I',
			
			'ô'		=> 'o',	'Ô'		=> 'O',
			'ơ'		=> 'o',	'Ơ'		=> 'O',
			'ó'		=> 'o',	'Ó'		=> 'O',
			'ò'		=> 'o',	'Ò'		=> 'O',
			'ọ'		=> 'o',	'Ọ'		=> 'O',
			'ỏ'		=> 'o',	'Ỏ'		=> 'O',
			'õ'		=> 'o',	'Õ'		=> 'O',
			'ố'		=> 'o',	'Ố'		=> 'O',
			'ồ'		=> 'o',	'Ồ'		=> 'O',
			'ộ'		=> 'o',	'Ộ'		=> 'O',
			'ổ'		=> 'o',	'Ổ'		=> 'O',
			'ỗ'		=> 'o',	'Ỗ'		=> 'O',
			'ớ'		=> 'o',	'Ớ'		=> 'O',
			'ờ'		=> 'o',	'Ờ'		=> 'O',
			'ợ'		=> 'o',	'Ợ'		=> 'O',
			'ở'		=> 'o',	'Ở'		=> 'O',
			'ỡ'		=> 'o',	'Ỡ'		=> 'O',
			
			'ư'		=> 'u',	'Ư'		=> 'U',
			'ú'		=> 'u',	'Ú'		=> 'U',
			'ù'		=> 'u',	'Ù'		=> 'U',
			'ụ'		=> 'u',	'Ụ'		=> 'U',
			'ủ'		=> 'u',	'Ủ'		=> 'U',
			'ũ'		=> 'u',	'Ũ'		=> 'U',
			'ứ'		=> 'u',	'Ứ'		=> 'U',
			'ừ'		=> 'u',	'Ừ'		=> 'U',
			'ự'		=> 'u',	'Ự'		=> 'U',
			'ử'		=> 'u',	'Ử'		=> 'U',
			'ữ'		=> 'u',	'Ữ'		=> 'U',
			
			'ý'		=> 'y',	'Ý'		=> 'Y',
			'ỳ'		=> 'y',	'Ỳ'		=> 'Y',
			'ỵ'		=> 'y',	'Ỵ'		=> 'Y',
			'ỷ'		=> 'y',	'Ỷ'		=> 'Y',
			'ỹ'		=> 'y',	'Ỹ'		=> 'Y'
		);
		
		$result = $str;
		
		foreach ($cleaner as $a => $v){
			$result = str_replace($a, $v, $result);
		}
		
		$result = iconv('UTF-8','ASCII//TRANSLIT',$result);
		
		$result = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $result);
		$result = strtolower(trim($result, '-'));
		$result = preg_replace("/[\/_| -]+/", '-', $result);
		while (strstr($result,'--')){
			$result = str_replace('--','-',$result);
		}
		$result = trim($result,'-');
		
		return $result;
	}

}
function view_product_cate_select($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->id==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->id.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_product_cate_select($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ',$edit);
        }
    }
}
function view_product_hangsx_select($data,$parent=0,$text='',$edit=null){
    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->id==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->id.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_product_hangsx_select($data, $id, $text . '--&nbsp;&nbsp; ',$edit);
        }
    }
}
function show_cate($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->id==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->alias.'" '.$selected.'>'.$text.$v->name.'</option>';

            show_cate($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}
function show_menu_select($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id_menu;
            $v->id_menu==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->id_menu.'" '.$selected.'>'.$text.$v->name.'</option>';

            show_menu_select($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}

function view_product_cate_table($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->image)&&file_exists($v->image)){
                $img="<img src='".base_url($v->image)."' style='height:40px; max-width:100px'/>";
            }else $img='';

            ($v->home == 1)?$home='background:#000088':$home='';
            ($v->focus == 1)?$focus='background:#5cb85c':$focus='';


            echo "<tr>
                    <td><input type=\"checkbox\" name=\"checkone[]\" id=\"checkone\" value=\"$v->id\" ></td>
                    <td>
                        <input type='number' value='".@$v->sort."' data-item='".$v->id."' onchange='cat_sort($(this))' style='width: 45px; padding: 2px;border:1px solid #ddd'/>
                    </td>
                    <td>".$text.$v->name."</td>
                    <td>$img</td>
                    <td class=\"text-center\">



                     <div data-toggle='tooltip' data-placement='top' title='"._title_product_cate_home."'
                        data-value='$v->id' data-view='home'
                        class='view_color' style='border: 1px solid #000088;margin-right: 10px; ".$home."'></div>

                    <div data-toggle='tooltip' data-placement='top' title='Nổi bật'
                        data-value='$v->id' data-view='focus'
                        class='view_color' style='border: 1px solid #5cb85c;margin-right: 10px; ".$focus."'></div>
                    </td>


                <td class='text-center'>
                <a href='".base_url('adminvn/product/cat_edit/' . $v->id)."'
                        class=\"btn btn-xs btn-default\" title=\"Sửa\"><i class=\"fa fa-pencil\"></i></a>
                <a href='".base_url('adminvn/product/deletecategory/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_product_cate_table($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
        }
    }
}
function view_product_hangsx_table($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->image)&&file_exists($v->image)){
                $img="<img src='".base_url($v->image)."' style='height:30px'/>";
            }else $img='';

            echo "<tr>
                    <td>".$text.$v->sort."</td>
                    <td>$v->name</td>
                    <td>$img</td>
                    <td class=\"text-center\">
                      <a href='".base_url('adminvn/product/editprohangsx/' . $v->id)."'
                    class=\"btn btn-xs btn-default\" title=\"Sửa\"><i class=\"fa fa-pencil\"></i></a>

                <a href='".base_url('adminvn/product/deletehangsx/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_product_hangsx_table($data, $id, $text . ' -&nbsp;');
        }
    }
}
function view_product_type_tour_table($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->image)&&file_exists($v->image)){
                $img="<img src='".base_url($v->image)."' style='height:30px'/>";
            }else $img='';

            echo "<tr>
                    <td>".$text.$v->sort."</td>
                    <td>$v->name</td>
                    <td>$img</td>
                    <td class=\"text-center\">
                      <a href='".base_url('adminvn/product/addtravelstyle/' . $v->id)."'
                    class=\"btn btn-xs btn-default\" title=\"Sửa\"><i class=\"fa fa-pencil\"></i></a>

                <a href='".base_url('adminvn/product/deletetravelstyle/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_product_type_tour_table($data, $id, $text . ' -&nbsp;');
        }
    }
}
function view_product_cate_checklist($data,$parent=0,$text='',$edit=null){
    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $item=array('id_category'=> $v->id);
            if($edit!=null){
                in_array($item,$edit)?$selected='checked':$selected='';
            }else{
                $v->id==1?$selected='checked':$selected='';
            }
            echo "<li><ul>";
            echo '<div class="checkbox">
                        <label>
                          '.$text.'<input type="checkbox" name ="category[]" value="'.$v->id.'"'.@$selected.'
                          class="chk" id="'.$v->id.'">
                          '.$v->name.'
                                </label>
                      </div> ';

            view_product_cate_checklist($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$edit);
            echo "</ul><li>";

        }
    }
}

function view_news_cate_select($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->id==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->id.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_news_cate_select($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}

function view_news_cate_table($data,$parent=0,$text=''){

    foreach ($data as $k=>$v) {

        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->icon)&&file_exists($v->icon)){
                $img="<img src='".base_url($v->icon)."' style='height:40px; max-width:100px'/>";
            }else $img='';

            ($v->home == 1)?$home='background:#000088':$home='';
            ($v->hot == 1)?$hot='background:red':$hot='';
            ($v->focus == 1)?$focus='background:#008855':$focus='';
            /*($v->hinhanh == 1)?$hinhanh='background:#cdcdcd':$hinhanh='';
            ($v->defaultnews == 1)?$defaultnews='background:#d6730e':$defaultnews='';*/


            echo "<tr>
                     <td><input type=\"checkbox\" name=\"checkone[]\" id=\"checkone\" value=\"$v->id\" ></td>
                     <td>
                        <input type='number' value='".@$v->sort."' data-item='".$v->id."' onchange='cat_sort($(this))' style='width: 45px; padding: 2px;border:1px solid #ddd'/>
                    </td>
                    <td>".$text.$v->name."</td>
                    <td>$img</td>
                    <td class=\"text-center\">

                     <div data-toggle='tooltip' data-placement='top' title='Home'
                        data-value='$v->id' data-view='home'
                        class='view_color' style='border: 1px solid #000088;margin-right: 10px; ".$home."'></div>

                    <div data-toggle='tooltip' data-placement='top' title='Hot'
                        data-value='$v->id' data-view='hot'
                        class='view_color' style='border: 1px solid red;margin-right: 10px;".$hot." '></div>

                    <div data-toggle='tooltip' data-placement='top' title='Focus'
                        data-value='$v->id' data-view='focus'
                        class='view_color' style='border: 1px solid #008855;margin-right: 10px;".$focus." '></div>
                    </td>

                <td class='text-center'>
                <a href='".base_url('adminvn/news/cat_edit/' . $v->id)."'
                        class=\"btn btn-xs btn-default\" title=\"S?a\"><i class=\"fa fa-pencil\"></i></a>
                <a href='".base_url('adminvn/news/deletecategory/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_news_cate_table($data, $id, $text . ' .&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
        }

    }
}




function view_product_cate_select2($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->alias==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->alias.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_product_cate_select2($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}
function view_news_cate_select2($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->alias==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->alias.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_news_cate_select2($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}




function check_img2($link=null,$width=30,$height=30){
    if($link!=null&&file_exists($link)){
        echo '<img src="'.base_url($link).'" width="'.$width.'" height="'.$height.'"/>';
    }else{
        echo '<img src="'.base_url('upload/img/avatar/no_image.jpg').'" width="'.$width.'" height="'.$height.'"/>';
    }
}

function view_bottom_menu($data,$parent=0,$text=''){
    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $p_open='';$p_close='';$cl='';
            if($v->parent_id==0){
                $p_open='<p>';
                $p_close='</p>';
                $cl='col-md-2 col-sm-4 col-xs-12';
            }
            if(isset($_SESSION['tinh_thanh'])){
                $link=base_url('deal-'.$_SESSION['tinh_thanh'].'/'.$v->alias);
            }else {
                $link= base_url('deal-tat-ca'.'/'.$v->alias);
            }
            echo '<li class="'.$cl.'">
                    <a href="'.$link.'">'.$p_open.$v->name.$p_close.'</a>
                    <ul>';
            //view_bottom_menu($data, $id, $text);
            echo '</ul>
                </li>';
        }
    }
}
function creat_crum(){
    $tem='';

}
function creat_break_crum($module_link='products',$data=null,$id=null){
    $temp = '';
    if(is_array($data)&&$id!=null){
        if($module_link=='products'){
            $arr=array(
                'cat'=>'pc',
                'item_cat'=>'c',
                'item'=>'p',
            );
        }else{
            $arr=array(
                'cat'=>'nc',
                'item_cat'=>'c',
                'item'=>'n',
            );
        }
        foreach($data as $key => $row){
            if($row->id==$id){
                $id=$row->parent_id;
                $temp .= '<li>&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="'.base_url(@$row->alias.'.html').'">  '.@$row->name.' </a></li>';
                unset($data[$key]);
                creat_break_crum($module_link,$data,$id);
            }
        }
    }
    echo $temp;
}



function view_post_cate_table($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->image)&&file_exists($v->image)){
                $img="<img src='".base_url($v->image)."' style='height:30px'/>";
            }else $img='';

            echo "<tr>

                    <td>".$text.$v->sort.'. '.$v->name."</td>
                    <td>$img</td>
                    <td class=\"text-center\">
                      <a href='".base_url('adminvn/raovat/cat_raovat_edit/' . $v->id)."'
                    class=\"btn btn-xs btn-default\" title=\"Sửa\"><i class=\"fa fa-pencil\"></i></a>

                <a href='".base_url('adminvn/raovat/cat_raovat_delete/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_product_cate_table($data, $id, $text . ' -&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
        }
    }
}
function ConvertPriceText($price)
{
//        if($price>2200000000) return 'so qua lon';

    $price = str_replace(',', '', $price);
    $price = trim($price);

    $priceTy = floor($price / 1000000000);

//        $priceTrieu = floor(($price % 1000000000)/1000000);

    $priceTrieu = floor(($price - floor($price / 1000000000) * 1000000000) / 1000000);


//        $priceNgan = floor((($price % 1000000000))%1000000/1000);

    $priceNgan = floor(($price - floor($price / 100000) * 100000) / 1000);

//        $priceDong = floor((($price % 1000000000))%1000000%1000);
    $priceDong = floor(($price - floor($price / 100) * 100) / 1);

    $strTextPrice = "";
    if ($priceTy > 0 && $price > 900000000)
        $strTextPrice = $strTextPrice . " " . $priceTy . " tỷ ";
    if ($priceTrieu > 0)
        $strTextPrice = $strTextPrice . " " . $priceTrieu . " triệu ";
    if ($priceNgan > 0)
        $strTextPrice = $strTextPrice . " " . $priceNgan . " nghìn ";
    if ($priceDong > 0)
        $strTextPrice = $strTextPrice . " " . $priceDong . " đồng ";

    return $strTextPrice;
}
if (!function_exists('date_fomat_en')) {
    function date_fomat_en($input)
    {
        //change fomat d-m-Y to Y-m-d

        $a = explode('-', $input);
        if(sizeof($a==3)){
            return @$a[2] . '-' . @$a[1] . '-' . @$a[0];
        }else return '0000-00-00';

    }
}

function check_hassubs($id_root,$arr_sub){
    $check = false;
    foreach($arr_sub as $v){
        if($v->parent_id == $id_root){
            $check = true;
        }
    }
    return $check;
}
function check_hassub($id_root,$arr_sub){
    foreach($arr_sub as $v){
        if($v->parent_id==$id_root){
            /*echo  '<i class="fa fa-chevron-circle-down"></i>';*/
            return true;
            break;
        }
        else /*echo '';*/return false;
    }
}

if (!function_exists('date_fomat_en')) {
    function date_fomat_en($input)
    {
        //change fomat d-m-Y to Y-m-d

        $a = explode('-', $input);
        if(sizeof($a==3)){
            return @$a[2] . '-' . @$a[1] . '-' . @$a[0];
        }else return '0000-00-00';

    }
}

if (!function_exists('get_subcat_array')){

    function get_subcat_array($cat_array, $id_cat)
    {
        if (isset($cat_array) && !empty($cat_array)) {
            $arr[] = $id_cat;
            foreach ($cat_array as $k => $v) {
                if ($id_cat == $v->parent_id) {

                    $arr = array_unique(array_merge($arr, get_subcat_array($cat_array, $v->id)));
                    unset($cat_array[$k]);
                }
            }
        }
        return $arr;
    }
}
function view_hangsx_cate_checklist($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $item=array('id_hangsx'=> $v->id);
            if($edit!=null){
                in_array($item,$edit)?$selected='checked':$selected='no';
            }

            echo "<li><ul>";
            echo $text.'<input type="checkbox" name ="type[]" value="'.$v->id.'"'.@$selected.' class="chk" id="'.$v->id
                    .'"/>
                            <label class=" " for="'.$v->id.'"> '.$v->name.'</label>';
            view_hangsx_cate_checklist($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$edit);
            echo "</ul><li>";

        }
    }
}
if (!function_exists('date_fomat_by_string')) {
    function date_fomat_by_string($date,$string)
    {
        $phpdate = strtotime($date );
        $mysqldate = date($string, $phpdate );

        return $mysqldate;
    }
}
function view_inuser_cate_table($data,$parent=0,$text=''){

    foreach ($data as $k=>$v) {

        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->icon)&&file_exists($v->icon)){
                $img="<img src='".base_url($v->icon)."' style='height:40px; max-width:100px'/>";
            }else $img='';

            ($v->home == 1)?$home='background:#000088':$home='';
            ($v->focus == 1)?$focus='background:#008855':$focus='';


            echo "<tr>
                     <td>
                        <input type='number' value='".@$v->sort."' data-item='".$v->id."' onchange='cat_sort($(this))' style='width: 45px; padding: 2px;border:1px solid #ddd'/>
                    </td>
                    <td>".$text.$v->name."</td>
                    <td>$img</td>
                    <td class=\"text-center\">

                     <div data-toggle='tooltip' data-placement='top' title='"._title_product_cate_home."'
                        data-value='$v->id' data-view='home'
                        class='view_color' style='border: 1px solid #000088;margin-right: 10px; ".$home."'></div>

                     <div data-toggle='tooltip' data-placement='top' title='"._title_product_cate_focus."'
                        data-value='$v->id' data-view='focus'
                        class='view_color' style='border: 1px solid #008855;margin-right: 10px;".$focus." '></div>

                    </td>

                <td class='text-center'>
                <a href='".base_url('adminvn/inuser/cat_edit/' . $v->id)."'
                        class=\"btn btn-xs btn-default\" title=\"S?a\"><i class=\"fa fa-pencil\"></i></a>
                <a href='".base_url('adminvn/inuser/deletecategory/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_inuser_cate_table($data, $id, $text . ' .&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
        }

    }
}
function view_inuser_cate_select2($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->alias==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->alias.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_news_cate_select2($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}
function view_inuser_cate_select($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            $v->id==$edit?$selected='selected':$selected='';
            echo '<option value="'.$v->id.'" '.$selected.'>'.$text.$v->name.'</option>';

            view_inuser_cate_select($data, $id, $text . '. &nbsp;&nbsp; ',$edit);
        }
    }
}
function view_media_cate_table($data,$parent=0,$text='',$edit=null){

    foreach ($data as $k=>$v) {
        if ($v->parent_id == $parent) {
            unset($data[$k]);
            $id = $v->id;
            if(isset($v->image)&&file_exists($v->image)){
                $img="<img src='".base_url($v->image)."' style='height:40px; max-width:100px'/>";
            }else $img='';

            ($v->home == 1)?$home='background:#000088':$home='';
            ($v->focus == 1)?$focus='background:#008855':$focus='';


            echo "<tr>
                    <td>
                        <input type='number' value='".@$v->sort."' data-item='".$v->id."' onchange='cat_sort($(this))' style='width: 45px; padding: 2px;border:1px solid #ddd'/>
                    </td>
                    <td>".$text.$v->name."</td>
                    <td>$img</td>
                    <td class=\"text-center\">
                     <div data-toggle='tooltip' data-placement='top' title='"._title_product_cate_home."'
                        data-value='$v->id' data-view='home'
                        class='view_color' style='border: 1px solid #000088;margin-right: 10px; ".$home."'></div>

                     <div data-toggle='tooltip' data-placement='top' title='"._title_product_cate_focus."'
                        data-value='$v->id' data-view='focus'
                        class='view_color' style='border: 1px solid #008855;margin-right: 10px;".$focus." '></div>

                    </td>
                <td class='text-center'>
                <a href='".base_url('adminvn/media/cat_edit/' . $v->id)."'
                        class=\"btn btn-xs btn-default\" title=\"Sửa\"><i class=\"fa fa-pencil\"></i></a>
                <a href='".base_url('adminvn/media/deletecategory/' . $v->id)."'
                       onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\"
                       class=\"btn btn-xs btn-danger\"title=\"Xóa\" style=\"color: #fff\"><i class=\"fa fa-times\"></i> </a>
                    </td>
                </tr>";

            view_media_cate_table($data, $id, $text . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ');
        }
    }
}
function gettimeDay($day)
{
    $thu = '';
    switch($day)
        {
            case 0:
                $thu="Chủ Nhật";
            break;
                        case 1:
                            $thu="Thứ Hai";
            break;
                        case 2:
                            $thu="Thứ Ba";
            break;
                        case 3:
                            $thu="Thứ Tư";
            break;
                        case 4:
                            $thu="Thứ Năm";
            break;
                        case 5:
                            $thu="Thứ Sáu";
            break;
                        case 6:
                            $thu="Thứ 7";
            break;
        }
    echo $thu;
}
function currentcy($lang){
    if($lang == 'vi'){
        echo "vnđ";
    }
    if($lang == 'en'){
        echo "usd";
    }
}