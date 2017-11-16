<div class="content ">
	
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Новости</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>

	
	<div class="main-h2 mt-30">Новости</div>
	
	<ul class="action-list">
		<?php foreach ($news AS $key => $val):?>
		<li class="action-list-item" id="action-<?php echo $val['id']?>">
			<img src="<?php echo $val->imagesUrl."930x/".$val['id'].".jpg"?>">
			<div class="action-list-item-date"><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $val['dateStart']);?></div>
			<div class="action-list-item-name"><?php echo $val['name']?></div>
			<div class="action-list-item-text"><?php echo $val['text']?></div>
		</li>
		<?php endforeach;?>
	</ul>
		
	
</div><!-- .content-->