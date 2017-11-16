<div class="content">

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
			<li><a href="<?php echo $this->createCPUUrl('/user/offers/');?>">Заказы</a></li>
			<li class="active"><a >Профиль</a></li>
		</ul>
		
	</div>
	<div class="inner-page-right lk-like">
		<div class="main-h2">Мой профиль</div>
		
		<div style="height: 4px;"></div>
		
		<div class="lk-portlet">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
			    'id'=>$model->formId,
			    'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false,
					'errorCssClass'=>'error',
					'afterValidate'=>'js:contentAfterAjaxValidate',
				),
			    'htmlOptions'=>array(
			        'rel' => $this->createUrl('user/edit')
			    )
			)); ?>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<?php echo $form->textField($model,'email', array('placeholder'=>'example@gmail.com', 'class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'email'); ?></p>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Имя и Фамилия</label>
				<?php echo $form->textField($model,'name', array('placeholder'=>'Иван Иванов', 'class' => 'form-control')); ?>
				<p class="control-label"></p>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Телефон</label>
				<?php echo $form->textField($model,'phone', array('placeholder'=>'+7 (846) 123-34-56', 'class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'phone'); ?></p>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Пароль</label>
				<?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'password'); ?></p>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Повторите пароль</label>
				<?php echo $form->passwordField($model,'confirmPassword', array('class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'confirmPassword'); ?></p>
			</div>
		
			<?php echo CHtml::htmlButton('Сохранить', array('class' => 'btn btn-default', 'type' => 'submit')); ?>
			
			<?php $this->endWidget(); ?>
		</div>
		
	</div>
	
</div><!-- .content-->
