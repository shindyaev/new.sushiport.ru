<div class="small-banner lk-banner">
	Личный кабинет
</div>

<div class="wrapper menu-page">

	<div class="middle">

		<div class="contain">
			<div class="content">
			
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
				        'class' => 'form-horizontal', 'rel' => $this->createUrl('user/mailer')
				    )
				)); ?>
			
				<div class="addr-headline">Подписаться на:</div>
				
				<div class="clearfix mb-15"></div>
				
				<?php echo $form->checkBox($model,'mailerAction'); ?>
				<label class="checkbox-custom" for="User_mailerAction">Акции</label>
				
				<div class="clearfix mb-15"></div>
				
				<?php echo $form->checkBox($model,'mailerNews'); ?>
				<label class="checkbox-custom" for="User_mailerNews">Новости</label>
				
				<div class="clearfix mb-15"></div>
				
				<?php echo $form->checkBox($model,'mailerNewMenu'); ?>
				<label class="checkbox-custom" for="User_mailerNewMenu">Новинки меню</label>
						
				<div class="clearfix mb-40"></div>
				
				<?php echo CHtml::htmlButton('Сохранить', array('class' => 'cart-button clearfix mr-20', 'type' => 'submit')); ?>
				
				<div class="clearfix mb-15"></div>
				
				<div class="hidden"><?php echo $form->error($model,'mailerAction'); ?></div>
				
				<?php $this->endWidget(); ?>
				
			</div>
			
		</div>
			
		<div class="left-sidebar">
			<ul class="left-menu-block cart-list-products">
				<li><a href="<?php echo $this->createCPUUrl('/user/offers/');?>">Мои заказы</a></li>
				<li><a href="<?php echo $this->createCPUUrl('/user/edit/');?>">Мои данные</a></li>
				<li><a href="<?php echo $this->createCPUUrl('/user/addr/');?>">Адресная книга</a></li>
				<li class="active"><a>Рассылки</a></li>
				
			</ul>
		</div><!-- .left-sidebar -->
			

	</div>

</div><!-- .wrapper -->

<div class="bottom-border"></div>
