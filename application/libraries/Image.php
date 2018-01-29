<?php
/*
 * jdflsjgd
 */
require_once('Img.php');
require_once('My_Utf8.php');
class Image
{
    public function resize($filename, $width, $height) {
    	if(!file_exists(ROOT_PATH .'upload/' . $filename) || !is_file(ROOT_PATH .'upload/' . $filename))
        {
            die('here');
            return;
	    }
	$utf8 = new My_Utf8();
    //$this->load->library('my_utf8');

	$info = pathinfo($filename);
	$extension = $info['extension'];
		
	$old_image = $filename;
        $new_image = 'img/' . $utf8->utf8_substr($filename, 0, $utf8->utf8_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
		
	if(!file_exists(ROOT_PATH . $new_image) || (filemtime(ROOT_PATH .'upload/' . $old_image) > filemtime(ROOT_PATH . $new_image))){
            $path = '';
			
            $directories = explode('/', dirname(str_replace('../', '', $new_image)));
			
            foreach ($directories as $directory) {
		$path = $path . '/' . $directory;
				
		if (!file_exists(ROOT_PATH . $path)) {
                    @mkdir(ROOT_PATH . $path, 0777);
		}		
            }
			
            //$this->load->library('img');;
            $image = new Img(ROOT_PATH .'upload/' . $old_image);
            //$this->img(ROOT_PATH .'img/' . $old_image);
            $image->resize($width, $height);
            $image->save(ROOT_PATH . $new_image);
	}
	
        /*
	if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            return HTTPS_IMAGE . $new_image;
	}else{
            return HTTP_IMAGE . $new_image;
	}
         * 
         */
        //var_dump($new_image);
        return base_url()  . $new_image;
    }    
}
?>