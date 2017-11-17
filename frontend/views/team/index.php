<div class="content">
		
	<div class="team-contain">
		<div class="main-h2 lh-40">
			Каждый день 198 сотрудников и единомышленников GEDZA делают то, что умеют лучше других.
		</div>
		
		<div class="fs-14 text-center mt-30">
			Оригинальная кухня ресторана предполагает, прежде всего, тщательный подход к выбору ингредиентов. Их
			разнообразное сочитание и обработка, использование редких продуктов и деликатесов - основа высокой
			кухни. Превосходные блюда из рыбы можете попробовать в ресторане «Терасса» в Санкт-Петербурге или
			знаменитые вонголе в соусе из белого вина в ресторане «Марио» на Климашкина в Москве.
			<br><br>
			Мы предпочитаем готовить другие блюда – все, что вы любите на каждый день.
		</div>
		
		<div class="text-center mt-20">
			<img src="/img/gedza-cirkle.jpg">
		</div>
		
		<ul class="worker-list mt-20">
			<?php foreach ($workers AS $key => $val):?>
			<li class="worker-list-item">
				<img src="<?php echo $val->imagesUrl."200x200/".$val['id'].".jpg"?>">
				<div class="worker-list-item-red-layer"></div>
				<div class="worker-list-item-text-layer">
					<div class="worker-name"><?php echo $val['name']?></div>
					<div class="worker-like">Любимое блюдо в меню GEDZA:</div>
					<div class="worker-like-href"><a><?php echo $val['dish']?></a></div>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		
		<div class="clearfix"></div>
		
	</div>
	
	<div class="clearfix mt-30"></div>
	
	<div class="team-slider mt-30">
		<ul>
			<?php foreach ($images AS $key => $val):?>
				<li>
					<img src="<?php echo $val->imagesUrl."1000x460/".$val['id'].".jpg"?>">
					<?php if ($key == 0):?>
						<div class="team-slider-big-text">Ваша еда <br>в хороших руках.</div>
						<div class="team-slider-small-text">Наши шефы - невероятно <br>талантливы и требовательны к<br> подаче самых лучших блюд из<br> свежих продуктов для вас.</div>
					<?php endif;?>
				</li>
			<?php endforeach;?>
		</ul>
		<div class="team-slider-left-arrow"></div>
		<div class="team-slider-right-arrow"></div>
	</div>
	
	<br><br><br><br>
	
</div><!-- .content-->

<script type="text/javascript">


$(document).ready(function() {
	$(".team-slider-left-arrow").click(function() {
		var left = parseInt($(this).parent().find("ul").css("left"));
		if (left < 0) {
			left += 1000;
			$(this).parent().find("ul").animate({left: left});
		}
	})
	
	$(".team-slider-right-arrow").click(function() {
		var left = parseInt($(this).parent().find("ul").css("left"));
		var count = $(this).parent().find("ul li").length;

		if (left > -(count - 1)*1000) {
			left -= 1000;
			$(this).parent().find("ul").animate({left: left});
		}
	})
	
	var slideShow = function() {
		var left = parseInt($(".team-slider ul").css("left"));

		var count = $(".team-slider ul li").length;
		if (left > -(count - 1)*1000) {
			left -= 1000;
		} else {
			left = 0
		}

		$(".team-slider ul").animate({left: left});
	}
	
 	setInterval(slideShow, 5000);
	
})

	
</script>
