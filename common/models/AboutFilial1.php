<?php

class AboutFilial1 extends EFormModel
{
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/about/filial1/';
		$this->imagesUrl = '/data/about/filial1/';
		$this->imageSizes = array(array(715, 477), array(192, 128));
	}
	
}
