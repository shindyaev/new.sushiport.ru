<div class="content">
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter">&rarr;</li>
		<li>
			<a class="text-black">Рестораны Milimon</a>
		</li>
	</ul>
	<div class="clearfix"></div>
</div>
<div class="deliv-block mt-30">
	<div class="deliv-block-header">
		Мы доставляем удовольствие и еду, и делаем вашу жизнь ярче
	</div>
	
	<div class="deliv-block-text ff-Philosopher">
		Мы существуем, благодаря нашим гостям и
		клиентам. Каждый день мы демонстрируем, как
		высоко мы ценим наших гостей, работая
		с энтузиазмом, доставляя им удовольствия,
		превосходя их ожидания. Мы относимся к гостям,
		как к самим себе. Мы поднимаем настроение
		обслуживанием, восхищаем вкусом блюд
		и напитков, создаем уникальную атмосферу
		в наших заведениях.
	</div>

	<a href="http://www.milimon-family.ru" class="deliv-block-buttontext-href" target="_blank">
	<div class="deliv-block-buttontext ff-Philosopher">Milimon Family</div>
	</a>
<br><br><br>
</div>

<div class="deliv-main-h2">Доставка из ресторанов в Самаре</div>

<?php if (!empty($restorans)):?>
<ul class="main-rest-list deliv-page-rest-list">
<?php foreach ($restorans AS $key => $val):?>
<li>
	<div class="main-rest-list-s-cont">
		<div class="main-rest-img-container">
			<img src="<?php echo $val->images[0]->imagesUrl."222x170/".$val->images[0]->id.".jpg"?>">
			<div class="main-rest-img-container-logo-contaier" style="background: #fff url(../<?php echo $val->imagesUrl."100x100/".$val->id.".png"?>) no-repeat center center">
			</div>
		</div>
		<div class="main-rest-list-name"><?php echo $val->name?></div>
		
		<div class="rest-block">
			
			<div class="rest-block-circle-num <?php if (empty($val['addr2'])): ?>bhidden<?php endif;?>">1</div>
			<div class="rest-block-addr"><?php echo $val->addr?></div>
			<?php if (!empty($val->map)) :?>
				<div class="rest-block-map"><a href="#" data-toggle="modal" data-target="#ya-map1-<?php echo $val->id?>">Смотреть на карте</a></div>
				<div  class="modal fade" id="ya-map1-<?php echo $val->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<?php echo $val->map?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="rest-block-phone"><?php echo $val->phone?></div>
		</div>
		
		<?php if (!empty($val['addr2'])): ?>
			<div class="rest-block">
				<div class="rest-block-circle-num">2</div>
				<div class="rest-block-addr"><?php echo $val->addr2?></div>
				<?php if (!empty($val->map2)) :?>
					<div class="rest-block-map"><a href="#" data-toggle="modal" data-target="#ya-map2-<?php echo $val->id?>">Смотреть на карте</a></div>
					<div  class="modal fade" id="ya-map2-<?php echo $val->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<div style ="display: block;"><?php echo $val->map2?></div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="rest-block-phone"><?php echo $val->phone2?></div>
			</div>
		<?php endif;?>
		
		<?php if (!empty($val['site'])): ?>
			<a target="_blank" class="rest-block-link" href="<?php echo $val['site']?>">Сайт ресторана</a>
		<?php endif;?>
	</div>
</li>
<?php endforeach;?>
<div class="clearfix"></div>
</ul>
<?php endif;?>

<div class="write-us-headline">
	Напишите нам
</div>	
<div class="write-us-block">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$model->formId,
		'enableAjaxValidation'=>true,
//		'enableClientValidation' => true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>false,
			'errorCssClass'=>'error',
			'afterValidate'=>'js:contentAfterAjaxValidateAlert',
		),
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('/')),

	)); ?>
	
	<div class="control-group">
		<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'name',array('class'=>'input-wus')); ?><br>
			<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="control-group">
		<?php echo $form->label($model,'email',array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'email',array('class'=>'input-wus')); ?><br>
			<span class="help-inline"><?php echo $form->error($model,'email'); ?></span>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="control-group">
		<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
		<div class="controls">
			<?php echo $form->textArea($model,'text',array('class'=>'input-wus input-wus-textarea')); ?><br>
			<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<?php // if(CCaptcha::checkRequirements() && false): /*проверка загружена ли каптча*/ ?>
		<div class="control-group">
			<?php echo $form->label($model,'verifyCode',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'verifyCode',array('class'=>'input-wus input-wus-small')); ?>
				<?php $this->widget('CCaptcha'); /*выводим саму каптчу*/?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php // endif;?>
	<br>
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<?php echo CHtml::htmlButton('Отправить', array('class' => 'write-us-submit-button', 'type' => 'submit')); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<br><br><br><br><br><br>
	
	
	
	<?php $this->endWidget(); ?>
	
</div>

<script src="<?php $_SERVER['SERVER_NAME'] ?>/js/useragent.js" type="text/javascript"></script>

<script type="text/javascript">

function contentAfterAjaxValidateAlert (form, data, hasError) {
	
	if (hasError) {
		for (var key in data) {
			Alert(data[key][0]);
			return false;
		}
	}
	
	$("#writeus-form")[0].reset();
	
	Alert("Ваше сообщение отправлено!");
}

</script>
