<h2>Информация о заказчике</h2>
<table>
	<tr>
		<td style="width: 400px;">
			Ресторан:
		</td>
		<td>
			<?php echo $restorans[$offer['rest']]->name?>
		</td>
	</tr>
	<tr>
		<td style="width: 400px;">
			Имя:
		</td>
		<td>
			<?php echo $data['name']?>
		</td>
	</tr>

	<tr>
		<td>
			Телефон:
		</td>
		<td>
			<?php echo $data['phone']?>
		</td>
	</tr>
	
	<tr>
		<td>
			Город:
		</td>
		<td>
			<?php echo $data['city']->name?>
		</td>
	</tr>
	
	<?php if ($data['smart'] == 1):?>
	<tr>
		<td>
			Элетронная почта:
		</td>
		<td>
			<?php echo $data['email']?>
		</td>
	</tr>

	<tr>
		<td>
			Способ получения:
		</td>
		<td>
			<?php echo $offer->deliveryTypes[$data['delivery']]?>
		</td>
	</tr>
	<?php endif;?>
	
	<?php if ($data['smart'] == 0):?>
	
		<tr>
			<td>
				Улица:
			</td>
			<td>
				<?php echo $data['street']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Дом:
			</td>
			<td>
				<?php echo $data['home']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Корпус/строение:
			</td>
			<td>
				<?php echo $data['str']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Квартира/офис:
			</td>
			<td>
				<?php echo $data['kv']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Подъезд:
			</td>
			<td>
				<?php echo $data['pd']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Этаж:
			</td>
			<td>
				<?php echo $data['fl']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Нужна сдача с:
			</td>
			<td>
				<?php echo $data['money']?> руб.
			</td>
		</tr>
		
		<tr>
			<td>
				Время и дата доставки:
			</td>
			<td>
				<?php if ($data['delivery-type'] == 1):?>
					Как можно скорее
				<?php else :?>
					<?php echo $data['date']?>, <?php echo sprintf("%02d", $data['hour'])?>:<?php echo sprintf("%02d", $data['minuts'])?> 
				<?php endif;?>
			</td>
		</tr>
		
		<tr>
			<td>
				Комментарий к заказу:
			</td>
			<td>
				<?php echo $data['comment']?>
			</td>
		</tr>
		
		<tr>
			<td>
				Промо-код:
			</td>
			<td>
				<?php echo $data['promo']?>
			</td>
		</tr>
	
	<?php endif;?>
	
	<?php if ($firstOrder):?>
		<tr>
		<td>
			Первый заказ:
		</td>
		<td>
			-200 руб.
		</td>
	</tr>
	<?php endif;?>		
</table>

<h2>Заказ</h2>
<table style="width: 100%;">
	<tr>
		<td>#</td>
		<td>Название</td>
		<td>Цена за еденицу</td>
		<td>Количество</td>
		<td>Цена общая</td>
	</tr>

	<?php	$sum = 0; 
	foreach($data['dishes'] AS $key => $val) :?>
		<tr>
			<td><?php echo ($key + 1)?></td>
			<td><?php echo $val['name']?></td>
			<td><?php echo $val['price']?> руб. <?php echo $val['action']?></td>
			<td><?php echo $val['count']?> шт.</td>
			<td><?php echo $val['price']*$val['count']; $sum += $val['price']*$val['count'];?> руб.</td>
		</tr>
	<?php endforeach;?>
	<?php if (!empty($present)):?>
		<tr>
			<td></td>
			<td><?php echo $present->dish->name?></td>
			<td>подарок</td>
			<td>1 шт.</td>
			<td>0 руб.</td>
		</tr>
	<?php endif;?>
	<tr style="border-top: solid">
		<td colspan="4">ИТОГО:</td>
		<td>
			<?php if ($firstOrder):?>
				<?php echo ($sum - 200)?> руб.
			<?php else :?>
				<?php echo $sum?> руб.
			<?php endif;?>
		</td>
	</tr>
</table>
