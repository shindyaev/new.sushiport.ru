<?php
/**
 * EActiveRecord class
 *
 * Some cool methods to share amount your models
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class EActiveRecord extends CActiveRecord
{
	private $_imgExt = array(1 => 'gif',
							 2 => 'jpg',
							 3 => 'png');
	
	private $_imagesPath;
	private $_imagesUrl;
	private $_imageSizes;
	
	public $image;
	
	private $_defaultFormat = CImageHandler::IMG_JPEG;
	
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

	/**
	 * default grid ID for the current model. Defaults to get_class()+'-grid'
	 */
	private $_gridId;

	public function setGridId($value)
	{
		$this->_gridId = $value;
	}

	public function getGridId()
	{
		if (null !== $this->_gridId)
			return $this->_gridId;
		else
		{
			$this->_gridId = strtolower(get_class($this)) . '-grid';
			return $this->_gridId;
		}
	}

	/**
	 * default list ID for the current model. Defaults to get_class()+'-list'
	 */
	private $_listId;

	public function setListId($value)
	{
		$this->_listId = $value;
	}

	public function getListId()
	{
		if (null !== $this->_listId)
			return $this->_listId;
		else
		{
			$this->_listId = strtolower(get_class($this)) . '-list';
			return $this->_listId;
		}
	}

	/**
	 * Logs the record update information.
	 * Updates the four columns: create_user_id, create_date, last_update_user_id and last_update_date.
	 */
	protected function logUpdate()
	{
		$userId = php_sapi_name() === 'cli'
			? -1
			: Yii::app()->user->id;

		foreach (array('create_user_id' => $userId, 'create_date' => time()) as $attribute => $value)
			$this->updateLogAttribute($attribute, $value, (!($userId===-1 || Yii::app()->user->isGuest) && $this->isNewRecord));

		foreach (array('last_update_user_id' => $userId, 'last_update_date' => time()) as $attribute => $value)
			$this->updateLogAttribute($attribute, $value, (!($userId===-1 || Yii::app()->user->isGuest) && !$this->isNewRecord));
	}

	/**
	 * Helper function to update attributes
	 * @param $attribute
	 * @param $value
	 * @param $check
	 */
	protected function updateLogAttribute($attribute, $value, $check)
	{

		if ($this->hasAttribute($attribute) && $check)
			$this->$attribute = $value;

	}

	/**
	 * updates the log fields before saving
	 * @return boolean
	 */
	public function beforeSave()
	{
		$this->logUpdate();
		return parent::beforeSave();
	}
	
	public function saveImage($filePath) {
		if (!file_exists($this->imagesPath.'original/'))
			mkdir($this->imagesPath.'original/');
		if (!file_exists($this->imagesPath.'admin_preview/'))
			mkdir($this->imagesPath.'admin_preview/');
		
		
		$ih = Yii::app()->ih
		->load($filePath)
		->save($this->imagesPath.'original/'.$this->id.".".$this->_imgExt[CImageHandler::IMG_PNG], CImageHandler::IMG_PNG)
		->adaptiveThumb(200,150)
		->save($this->imagesPath.'admin_preview/'.$this->id.".".$this->_imgExt[CImageHandler::IMG_PNG], CImageHandler::IMG_PNG);
			
		foreach ($this->imageSizes AS $key => $val) {
			if (!file_exists($this->imagesPath.$val[0].'x'.$val[1].'/'))
				mkdir($this->imagesPath.$val[0].'x'.$val[1].'/');
			$ih->reload();
			
			if ($val[0] == false || $val[1] == false || empty($val[2])) {
				if (!empty($val[0]) && $ih->getWidth() > $val[0] || !empty($val[1]) && $ih->getHeight() > $val[1])
					$ih->resize($val[0], $val[1]);
			} else {
				$ih->adaptiveThumb($val[0], $val[1]);
			}
			
			if (empty($val[3]) || empty($this->_imgExt[$val[3]]))
				$format = $this->_defaultFormat;
			else 
				$format = $val[3];
			
						
			$ih->save($this->imagesPath.$val[0].'x'.$val[1].'/'.$this->id.".".$this->_imgExt[$format], $format);
		}
	}

	public function deleteFull() {
		if (file_exists($this->imagesPath.'original/'.$this->id.".".$this->_imgExt[CImageHandler::IMG_PNG]))
			unlink($this->imagesPath.'original/'.$this->id.".".$this->_imgExt[CImageHandler::IMG_PNG]);
		if (file_exists($this->imagesPath.'admin_preview/'.$this->id.".".$this->_imgExt[CImageHandler::IMG_PNG]))
			unlink($this->imagesPath.'admin_preview/'.$this->id.".".$this->_imgExt[CImageHandler::IMG_PNG]);
	
		if (!empty($this->_imageSizes)) {
			foreach($this->_imageSizes AS $key => $val) {
				
				if (empty($val[3]) || empty($this->_imgExt[$val[3]]))
					$format = $this->_defaultFormat;
				else 
					$format = $val[3];
				
				if (file_exists($this->imagesPath.$val[0].'x'.$val[1].'/'.$this->id.".".$this->_imgExt[$format]))
					unlink($this->imagesPath.$val[0].'x'.$val[1].'/'.$this->id.".".$this->_imgExt[$format]);
			}
		}
		$this->delete();
	}
	
	public function attributeLabels()
	{
		return array(
			'image' => 'Изображение',
		);
	}
}