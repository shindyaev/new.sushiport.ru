<?php

class EFormModel extends CFormModel
{
	private $_imgExt = array(1 => 'gif',
							 2 => 'jpg',
							 3 => 'png');
	
	private $_imagesPath;
	private $_imagesUrl;
	private $_imageSizes;
	
	public $id;
	
	public $image;
	
	public function init()
	{
		parent::init();
		$this->id = md5(date('YmdHis'));
	}
	
	public function getImagesPath() {
		return $this->_imagesPath;
	}
	public function setImagesPath($data) {
		$this->_imagesPath = $data;
	}
	
	public function getImagesUrl() {
		return $this->_imagesUrl;
	}
	public function setImagesUrl($data) {
		$this->_imagesUrl = $data;
	}
	
	public function getImageSizes() {
		return $this->_imageSizes;
	}
	public function setImageSizes($data) {
		$this->_imageSizes = $data;
	}
	/**
	 * default form ID for the current model. Defaults to get_class()+'-form'
	 */
	private $_formId;

	public function setFormId($value)
	{
		$this->_formId = $value;
	}

	public function getFormId()
	{
		if (null !== $this->_formId)
			return $this->_formId;
		else
		{
			$this->_formId = strtolower(get_class($this)) . '-form';
			return $this->_formId;
		}
	}

	public function saveImage($filePath, $crop = false, $format = CImageHandler::IMG_JPEG) {
		if (!file_exists($this->imagesPath.'original/'))
			mkdir($this->imagesPath.'original/');
		if (!file_exists($this->imagesPath.'admin_preview/'))
			mkdir($this->imagesPath.'admin_preview/');
			
		$ih = Yii::app()->ih
		->load($filePath)
		->save($this->imagesPath.'original/'.$this->id.".".$this->_imgExt[$format], $format)
		->adaptiveThumb(200,150)
		->save($this->imagesPath.'admin_preview/'.$this->id.".".$this->_imgExt[$format], $format);
			
		foreach ($this->imageSizes AS $key => $val) {
			if (!file_exists($this->imagesPath.$val[0].'x'.$val[1].'/'))
				mkdir($this->imagesPath.$val[0].'x'.$val[1].'/');
			$ih->reload();
			if ($val[0] == false || $val[1] == false || !$crop) {
				if (!empty($val[0]) && $ih->getWidth() > $val[0] || !empty($val[1]) && $ih->getHeight() > $val[1])
					$ih->resize($val[0], $val[1]);
			} else {
				$ih->adaptiveThumb($val[0], $val[1]);
			}
			$ih->save($this->imagesPath.$val[0].'x'.$val[1].'/'.$this->id.".".$this->_imgExt[$format], $format);
		}
	}

	public function deleteImage($name) {
		if (file_exists($this->imagesPath.'original/'.$name))
			unlink($this->imagesPath.'original/'.$name);
		if (file_exists($this->imagesPath.'admin_preview/'.$name))
			unlink($this->imagesPath.'admin_preview/'.$name);
	
		foreach($this->_imageSizes AS $key => $val) {
			if (file_exists($this->imagesPath.$val[0].'x'.$val[1].'/'.$name))
				unlink($this->imagesPath.$val[0].'x'.$val[1].'/'.$name);
		}
	}
	
	public function getImages() {
		if (!file_exists($this->imagesPath."original/"))
			return array();
		$images = scandir($this->imagesPath."original/");
		$imgs = array();
		foreach ($images AS &$image) {
			if(preg_match('/\.(jpeg|jpg|gif|png)/', $image)){
				$imgs[] = $image;
			}
		}
		return $imgs;
	}

}
		