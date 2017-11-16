<div class="small-banner lk-banner">
	Личный кабинет
</div>

<div class="wrapper menu-page">

	<div class="middle">

		<div class="contain">
			<div class="content">
				<div class="addr-headline">Ваши адреса</div>
				<table class="lk-addr-table">
					<thead>
						<tr>
							<td class="lk-addr-table-col1">Улица</td>
							<td class="lk-addr-table-col2">Дом</td>
							<td class="lk-addr-table-col3">Строение</td>
							<td class="lk-addr-table-col4">Подъезд</td>
							<td class="lk-addr-table-col5">Этаж</td>
							<td class="lk-addr-table-col6">Квартира/ офис</td>
							<td class="lk-addr-table-col7">Домофон</td>
							<td class="lk-addr-table-col8"></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($model->search()->getData() AS $key => $val):?>
						<tr>
							<td class="lk-addr-table-col1"><?php echo $val['street']?></td>
							<td class="lk-addr-table-col2"><?php echo $val['house']?></td>
							<td class="lk-addr-table-col3"><?php echo $val['str']?></td>
							<td class="lk-addr-table-col4"><?php echo $val['pd']?></td>
							<td class="lk-addr-table-col5"><?php echo $val['fl']?></td>
							<td class="lk-addr-table-col6"><?php echo $val['kv']?></td>
							<td class="lk-addr-table-col7"><?php echo $val['df']?></td>
							<td class="lk-addr-table-col8"><a href="<?php echo $this->createCPUUrl('/user/deleteAddr/'.$val['id'].'/');?>" class="lk-delete-addr"></a></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<div class="clearfix mb-25"></div>
				<a href="javascript:void(0);" class="lk-add-adr" id="add-addr-link">Добавить адрес</a>
				<div class="clearfix mb-25"></div>
				<div class="portlet lk-add-adr-portlet" style="display: none;" id="lk-add-adr-portlet">
					<div class="portlet-body">
						
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>$model->formId,
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
								'validateOnSubmit'=>true,
								'validateOnChange'=>false,
								'errorCssClass'=>'error',
								'afterValidate'=>'js:contentAfterAjaxValidate',
							),
							'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('/user/addr/', array('id' => $model->id))),
						
						)); ?>
						
						<div class="control-group width-50 pull-left h32">
							<label class="input-text-label">*Улица</label>
						</div>
						
						<div class="control-group width-400 pull-left mr-25">
							<?php echo $form->textField($model,'street', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-180 pull-left h16">
							<label class="input-text-label"><?php echo $form->error($model,'street'); ?></label>
						</div>
						
						<div class="clearfix mb-15"></div>
						
						<div class="control-group width-50 pull-left h32">
							<label class="input-text-label">*Дом</label>
						</div>
						
						<div class="control-group width-70 pull-left mr-25">
							<?php echo $form->textField($model,'house', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-70 pull-left h32">
							<label class="input-text-label">Строение</label>
						</div>
						
						<div class="control-group width-70 pull-left mr-25">
							<?php echo $form->textField($model,'str', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-70 pull-left h32">
							<label class="input-text-label">Подъезд</label>
						</div>
						
						<div class="control-group width-70 pull-left mr-25">
							<?php echo $form->textField($model,'pd', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-180 pull-left h16">
							<label class="input-text-label"><?php echo $form->error($model,'house'); ?></label>
						</div>
						
						<div class="clearfix mb-15"></div>
						
						<div class="control-group width-50 pull-left h32">
							<label class="input-text-label">Этаж</label>
						</div>
						
						<div class="control-group width-70 pull-left mr-25">
							<?php echo $form->textField($model,'fl', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-70 pull-left h32">
							<label class="input-text-label">*Квартира</label>
						</div>
						
						<div class="control-group width-70 pull-left mr-25">
							<?php echo $form->textField($model,'kv', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-70 pull-left h32">
							<label class="input-text-label">Домофон</label>
						</div>
						
						<div class="control-group width-70 pull-left mr-25">
							<?php echo $form->textField($model,'df', array('class' => 'input-text max')); ?>
						</div>
						
						<div class="control-group width-180 pull-left h16">
							<label class="input-text-label"><?php echo $form->error($model,'kv'); ?></label>
						</div>
						
						<div class="clearfix mb-25"></div>
					
						<?php echo CHtml::htmlButton('Сохранить', array('class' => 'cart-button clearfix ', 'type' => 'submit')); ?>
						
						<div class="clearfix"></div>
						
						<?php $this->endWidget(); ?>					
					
					</div>
				</div>
				
			</div>
			
		</div>
			
		<div class="left-sidebar">
			<ul class="left-menu-block cart-list-products">
				<li><a href="<?php echo $this->createCPUUrl('/user/offers/');?>">Мои заказы</a></li>
				<li><a href="<?php echo $this->createCPUUrl('/user/edit/');?>">Мои данные</a></li>
				<li class="active"><a>Адресная книга</a></li>
				<li><a href="<?php echo $this->createCPUUrl('/user/mailer/');?>">Рассылки</a></li>
				
			</ul>
		</div><!-- .left-sidebar -->
			

	</div>

</div><!-- .wrapper -->

<div class="bottom-border"></div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#add-addr-link").click(function() {
			$("#lk-add-adr-portlet").slideDown();
		})
		return false;
	})
</script>