<?php
class Lib_ThumbImage
{

	/**
	 * Stores function type's name
	 *
	 * @var string $type
	 */	 
	private $type;
	/**
	 * Flag for error
	 *
	 * @var boolean $error
	 */	
	private $error;	
	/**
	 * Stores error numbers and description
	 *
	 * @var array $debug
	 */	
	public $debug = array();
	/**
	 * Stores the output
	 *
	 * @var string $result
	 */	
	 public $result;
	 /**
	 * source image file path
	 *
	 * @var string $srcPath
	 */	
	 private $srcPath;	
	 /**
	 * destination path
	 *
	 * @var string $destPath
	 */	
	 private $destPath;	
	 /**
	 * width of output image
	 *
	 * @var integer $width
	 */	
	 private $width;		
	/**
	 * the thumbnail quality
	 *
	 * @var integer $quality
	 */ 
    private $quality = 100;

	/**
	 * the prefix of the image
	 *
	 * @prefix integer $quality
	 */ 
    private $prefix='';

	
	/**
	 * Constructs a Lib_ThumbImage object with given parameters
	 * also it will invoke thumb image process
	 * 
	 * @param string $type
	 * @param string $srcPath
	 * @param string $destPath	 	 
	 * @param integer $width	 
	 * @return Lib_ThumbImage
	 */
	 
	public function Lib_ThumbImage($type,$srcPath,$destPath,$width)
	{
		$this->type = $type;
		$this->srcPath = $srcPath;
		$this->destPath = $destPath;
		$this->width = $width;
		
		if($this->isValidCall())
			$this->makeThumb();	
	}
	
	/**
	 * Check whether the function call is valid or not
	 *
	 * @return bool
	 */
	 
	private function isValidCall()
	{
		if(strtolower($this->type)!='thumb')
		{
			echo '<b>Component Error!<b> Invalid argument <i>type</i> - thumb parameter keyword missing';
			exit();
		}	
		elseif(empty($this->srcPath))
		{
			echo '<b>Component Error!<b> Invalid argument data type  <i>srcPath</i> - file path missing';
			exit();	
		}
		elseif(!file_exists($this->srcPath))
		{
			echo '<b>Invalid Argument Error!<b> Invalid source file <i>'.$this->srcPath.'</i> - file not found';
			exit();	
		}	
		elseif(empty($this->destPath))
		{
			echo '<b>Invalid Argument Error!<b> Invalid argument  <i>destPath</i> - destination directory name missing';
			exit();	
		}
		elseif(!is_writable($this->destPath))
		{
			echo '<b>Folder Permission Error!<b> Access Denied  <i>'.$this->destPath.'</i> - destination path not writable';
			exit();	
		}
		elseif(empty($this->width))
		{
			echo '<b>Invalid Argument Error!<b> Invalid argument data type  <i>height</i> - height expected';
			exit();	
		}
		elseif(!is_numeric($this->width))
		{
			echo '<b>Invalid Argument Error!<b> Invalid argument data type  <i>height</i> - height must be numeric';
			exit();	
		}
		return true;		
	}	
	
	/**
	 * create thumb image
	 *	 
	 * @return bool 	 
	 */
	 
	private function makeThumb()
	{
		$source_image=$this->srcPath;
		$thumb_width=$this->width;
        $supported_types = array(1, 2, 3, 7);
        list($width_orig, $height_orig, $image_type) = getimagesize($source_image);
        if(!in_array($image_type, $supported_types))
        {
			$this->error = 1;
			$this->debug['errinfo'] = array(1001=>'Unsupported Image Type: ' . $image_type);
			return false;
        }
        else
        {
            $path_parts = pathinfo($source_image);
            $filename = $this->prefix.$path_parts['filename'];
			$dirname = $path_parts['dirname'];
			
            $aspect_ratio = (float) $height_orig/$width_orig;			
            //$thumb_width = round($thumb_height * $aspect_ratio);				
				
            $thumb_height = round($thumb_width*$aspect_ratio);
			
            $source = imagecreatefromstring(file_get_contents($source_image));
            $thumb = imagecreatetruecolor($thumb_width,$thumb_height);
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $thumb_width,$thumb_height, $width_orig, $height_orig);
            imagedestroy($source);
            switch ( $image_type )
            {
                case 1:
                    $thumbnail = $this->destPath.'/'.$filename . '.gif';
					imagegif($thumb, $thumbnail);
                    break;

                case 2:
                    $thumbnail = $this->destPath.'/'.$filename . '.jpg';
                    imagejpeg($thumb, $thumbnail, $this->quality);
                    break;

                case 3:
                    $thumbnail = $this->destPath.'/'.$filename . '.png';
                    imagepng($thumb, $thumbnail);
                    break;

                case 7:
                    $thumbnail = $this->destPath.'/'.$filename . '.bmp';
					imagewbmp($thumb, $thumbnail);
                    break;
            }
			$this->result="true";
			return true;
        }
	 }
	
}
?>