<?php
class Title extends CWidget
{
	public $title = null;

	public function run()
	{
		$this->renderContent();
	}

	protected function renderContent()
	{
		$this->render('title', array(
			'title'=>$this->title
		));
	}
}