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
			<li class="active"><a>Заказы</a></li>
			<li><a href="<?php echo $this->createCPUUrl('/user/edit/');?>">Профиль</a></li>
		</ul>
		
	</div>
	<div class="inner-page-right lk-like">
		<div class="main-h2">Мои заказы</div>
		
		<div style="height: 46px;"></div>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Дата</th>
					<th>Ресторан</th>
					<th>Сумма</th>
					<th></th>					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($offers AS $key => $val):?>
				<tr>
					<td><?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $val['date']);?></td>
					<td><?php echo $this->variables['rests'][$val['rest']]['name']?></td>
					<td><?php echo $val['sum']?> руб</td>
					<td><a href="<?php echo $this->createCPUUrl('/user/offers/'.$val['id'].'/');?>" class="bolder">Подробнее</a></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<br><br><br>
	</div>
	
</div><!-- .content-->
