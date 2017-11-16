<?php

class AboutFilial2 extends EFormModel
{
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/about/filial2/';
		$this->imagesUrl = '/data/about/filial2/';
		$this->imageSizes = array(array(715, 477), array(192, 128));
	}
	
}
