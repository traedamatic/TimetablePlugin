<?php
class UploadfileComponent extends Component {
	/**
	 * @var string name
	 */
	public $name = 'Uploadfile';    
   
	/**
	 * @var components settings
	 */
	public $settings = null;
	
	/**
	 * @var lastfile name saved
	 */
	public $lastFileUploaded = null;
	
	/**
	 *
	 */
	public $supportedFileExtensions = array(
				'image/jpeg' => 'jpeg',
				'image/png' => 'png',
				'image/gif' => 'gif'
	);
	
	
   public function initialize(Controller $controller) {
		parent::initialize($controller);	
		
		$defaultSettings = array(
			'uploadPath' => APP . 'media' . DS,
			'desired_width' => 100
			);
				
		if(!empty($this->settings)) 
			$this->settings = array_merge($defaultSettings,$this->settings);
	
		
   }
    
    
    /**
     *
     * uploadFile - upload the form submit file
     *
     * @params array $file submitted file
     * @params string $path path to folder
     */    
   public function upload($file) {
                
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		$filename = basename($file['name'],$ext);
        
		$fileNameMd5 = md5($filename.time()).'.'.$ext;
		
      $uploadPath = $this->settings['uploadPath'].DS.$fileNameMd5;
        
        
		if (move_uploaded_file($file['tmp_name'], WWW_ROOT.DS.$uploadPath)) {
			$this->lastFileUploaded = $fileNameMd5;
			return true;                          
		} 
        
      return false;
        
   }
    
   public function uploadImageWithThumb($file) {
        
		
		  
		$ext  = pathinfo($file['name'], PATHINFO_EXTENSION);
		$filename = basename($file['name'],$ext);
    
		
		$fileNameMd5NoExt = md5($filename.time());
		$fileNameMd5WithExt = md5($filename.time()).'.'.$ext;
				
      $uploadPath = $this->settings['uploadPath'].DS.$fileNameMd5WithExt;
		$uploadPathThumb = $this->settings['uploadPath'].DS."t_".$fileNameMd5WithExt;
		
		if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
			
			$this->lastFileUploaded = $fileNameMd5WithExt;
			
			$mimeType = mime_content_type($uploadPath);
			
			if(key_exists($mimeType,$this->supportedFileExtensions)) {
				if($this->makeThumbnail($uploadPath,$uploadPathThumb,$this->supportedFileExtensions[$mimeType])) {
					return true;
				} else {
					return false;
				}
			} 
			
			return false;                          
		}
		
		return false;
        
	}
	
	
	/***
	 *
	 * the create thumbnail function
	 * a lot taken from http://davidwalsh.name/create-image-thumbnail-php
	 *
	 */
	private function makeThumbnail($source = null,$dest = null , $ext = null){
		if(is_null($source) || is_null($ext)) {
			
		}
		
		$sourceImage = false;
		
		$desired_width = $this->settings['desired_width'];
		
		switch($ext) {
			case "jpeg":
				$sourceImage = imagecreatefromjpeg($source);
				break;
			case "gif":
				$sourceImage = imagecreatefromgif($source);
				break;
			case "png":
				$sourceImage = imagecreatefrompng($source);
				break;
			default:
				break;
		}
		
		if($sourceImage === false) return false;
		
		 /* read the source image */		
		$width = imagesx($sourceImage);
		$height = imagesy($sourceImage);
		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $sourceImage, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);		
		
		switch($ext) {
			case "jpeg":
				$result = imagejpeg($virtual_image, $dest);				
				break;
			case "gif":
				$result = imagegif($virtual_image, $dest);							
				break;
			case "png":
				$result = imagepng($virtual_image, $dest);
				break;
			default:
				break;
		}
		
		/* create the physical thumbnail image to its destination */
		return $result;
		
	}
		
    
    
   public function uploadMultipleFiles($files) {
        
		foreach ($files as $index => $file) {
			 $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		 $filename = basename($file['name'],$ext);
		
		 $fileNameMd5 = md5($filename).'.'.$ext;
	 
		 $uploadPath = $this->settings['uploadPath'].$fileNameMd5;
			 
			 if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
				  $error[$fileName] = false;                          
			 } else {
				  $error[$fileName] = true;                          
			 }
				  
		}
		
		return $error;
        
   }
}