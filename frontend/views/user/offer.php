<div class="content ">
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Личный кабинет</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>
</div>
<div>

	<div class="inner-page-left-sidebar">
		
		<ul class="left-sidebar-menu mt-10 lk-menu">
			<li>
				<a>Мое меню</a>
			
				<ul class="lk-menu-submenu">
					<?php foreach($this->variables['rests'] AS $key => $val):?>
						<li><a href="<?php echo $this->createCPUUrl('/user/likeDish/'.$val['id'].'/');?>"><?php echo $val['name']?></a></li>
					<?php endforeach;?>
				</ul>
			</li>
			<li class="active"><a  href="<?php echo $this->createCPUUrl('/user/offers/');?>">Заказы</a></li>
			<li><a href="<?php echo $this->createCPUUrl('/user/edit/');?>">Профиль</a></li>
		</ul>
		
	</div>
	<div class="inner-page-right lk-like">
		<div class="main-h2">Заказ № <?php echo $model['id']?></div>
		<div class="main-h2-cart-rest-name">Доставка из ресторана: <span id="rest-name"><?php echo $this->variables['rests'][$model['rest']]['name']?></span></div>
		
		<div class="fs-12 gray-text text-center mt-10">Отправлен <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model['date']);?> в <?php echo Yii::app()->dateFormatter->format('HH:mm', $model['date']);?></div>
		
		<div style="height: 46px;"></div>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th></th>
					<th class="bolder">Наименование</th>
					<th class="bolder">Кол-во</th>
					<th class="bolder">Сумма</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dishes AS $key => $val):?>
				<tr valign="bottom" class="repeated-dish">
					<td><img src="<?php echo $val->dish->imagesUrl."90x60/".$val->dish->id.".jpg"?>"></td>
					<td class="v-center"><?php echo $val->dish->name?></td>
					<td class="v-center"><?php echo $val['count']?> шт.</td>
					<td class="v-center"><?php echo $val['price']?> руб.</td>
					
					<input type="hidden" class="dish-id" value="<?php echo $val->dish['id']?>">
					<input type="hidden" class="dish-name" value="<?php echo htmlspecialchars($val->dish['name'])?>">
					<input type="hidden" class="dish-weight" value="<?php echo $val->dish['weight']?>">
					<input type="hidden" class="dish-ccal" value="<?php echo $val->dish['ccal']?>">
					<input type="hidden" class="dish-weightType" value="<?php echo $val->dish->units[$val->dish['weightType']]?>">
					<input type="hidden" class="dish-text" value="<?php echo htmlspecialchars($val->dish['text'])?>">
					<input type="hidden" class="dish-price" value="<?php if ($val->dish['action']) echo $val->dish['action']['price']; else echo $val->dish['price']?>">
					<input type="hidden" class="dish-hit" value="<?php echo $val->dish['hit']?>">
					<input type="hidden" class="dish-hot" value="<?php echo $val->dish['hot']?>">
					<input type="hidden" class="dish-new" value="<?php echo $val->dish['new']?>">
					<input type="hidden" class="dish-vegan" value="<?php echo $val->dish['vegan']?>">
					<input type="hidden" class="dish-action" value="<?php if ($val->dish['action']) echo 1; else echo 0;?>">
					<input type="hidden" class="dish-rest" value="<?php echo $val->dish['rest']?>">
					<input type="hidden" class="dish-count" value="<?php echo $val['count']?>">
					
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<th></th>
				<th class="bolder">Итого:</th>
				<th></th>
				<th><?php echo number_format($model['sum'], 0, ',', ' ');?> руб.</th>
			</tfoot>
		</table>
		
		<br>
		<a href="javascript:;" class="green-button mt-30" id="repeat-order">
			Повторить заказ
		</a>
		
		<br>
		<div class="text-center gray-text">Вы можете изменить содержание заказа далее</div>
	</div>
	
</div><!-- .content-->


<script type="text/javascript">
	
	var order_rest = <?php echo $model['rest']?>;
	
	$(document).ready(function() {
		$("#repeat-order").click(function() {
			
			var trds = $(".repeated-dish");
			
			for (var i = 0; i < trds.length; i++) {
				
				
				
				var dish = trds.eq(i);
				
				product = [];
				product['id'] = dish.find(".dish-id").eq(0).val();
				product['name'] = dish.find(".dish-name").eq(0).val();
				product['text'] = dish.find(".dish-text").eq(0).val();
				product['price'] = dish.find(".dish-price").eq(0).val();
				product['weight'] = dish.find(".dish-weight").eq(0).val();
				product['ccal'] = dish.find(".dish-ccal").eq(0).val();
				product['weightType'] = dish.find(".dish-weightType").eq(0).val();
				product['hit'] = dish.find(".dish-hit").eq(0).val();
				product['hot'] = dish.find(".dish-hot").eq(0).val();
				product['new'] = dish.find(".dish-new").eq(0).val();
				product['vegan'] = dish.find(".dish-vegan").eq(0).val();
				product['count'] = dish.find(".dish-count").eq(0).val();;
				product['rest'] = dish.find(".dish-rest").eq(0).val();
				
				
				if (order_rest != product['rest']) {
					$("#add-to-cart-error").modal();
					return false;
				}
				
				cart.addGoods(product);
				
			}
			
		})		
	});	
</script>
