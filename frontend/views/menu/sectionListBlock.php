<?php foreach ($sections AS $key => $val) :?>

<div class="menu-section-list-item">
	<a href="<?php echo $this->createCPUUrl('/menu/'.$val['id'].'/');?>">
		<img src="<?php echo $val->imagesUrl.'225x125/'.$val['id']?>.png">
		<div class="menu-section-list-item-name"><?php echo $val['name']?></div>
	</a>
</div>
<?php endforeach;?>