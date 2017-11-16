<div class="recomended">
	<div class="recomended-headline">РЕКОМЕНДУЕМ</div>
	<div class="recomended-list">
		<div class="border"></div>
		<?php foreach($dish AS $key => $val) :?>
		<div class="recomended-list-item">
			<div>
				<a rel="<?php echo $val['id']?>" class="detailDish" href="javascript:void(0);">
					<img src="<?php echo $val->imagesUrl."199x129/".$val['id'].".jpg"?>" class="img">
				</a>
			</div>
			<div class="name"><?php echo $val['name']?></div>
			<div class="text"><?php echo $val['text']?></div>
			<div class="call fright"><?php echo $val['calories']?> Ккал.</div>
			<div class="weight"><?php echo $val['weight']?> <?php echo $val->units[$val['weightType']]?></div>
			<div class="vline">|</div>
			<div class="price"><span><?php echo $val['price']?></span> руб.</div>
			<div class="clear"></div>
		</div>
		<?php endforeach;?>
	</div>
</div>