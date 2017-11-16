<?php 

$this->title_h3='Заказы';

$this->breadcrumbs=array(
	'Заказы' => '/offers/index/',
	'Просмотр заказа'
);

$this->menuActiveItems[BController::OFFERS_MENU_ITEM] = 1;

?>
<div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$model->formId,
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>false,
			'errorCssClass'=>'error',
			'afterValidate'=>'js:contentAfterAjaxValidate',
		),
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel'=>$this->createUrl('offers/index')),

	)); ?>
	
		<div class="control-group">
			<label class="control-label" >Ресторан</label>
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo $restorans[$model->rest]->name;?></label>
			</div>
		</div>
	
		<div class="control-group">
			<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo $model->name;?></label>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'email',array('class'=>'control-label')); ?>
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo $model->email;?></label>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'phone',array('class'=>'control-label')); ?>
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo $model->phone;?></label>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'delivery',array('class'=>'control-label')); ?>
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo $model->deliveryTypes[$model->delivery];?></label>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'date',array('class'=>'control-label')); ?>
			<div class="controls">
				<label class="control-label text-left max-width">
					<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', $model->date);?>
				</label>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'status',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'status', $model->statusTypes); ?>
				<span class="help-inline"><?php echo $form->error($model,'status'); ?></span>
			</div>
		</div>
		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>

			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>

<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="icon-reorder"></i>Заказ</div>
		<div class="tools">
			<a class="collapse" href="javascript:;"></a>
		</div>
	</div>
	<div class="portlet-body" style="display: block;">
		<?php $i = 0;
			$allSum = 0;
		?>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'client-grid',
			'dataProvider'=>$dishes->search(),
			'filter'=>null,
			'enableSorting'=>false,
			'htmlOptions'=>array('class'=>'portlet-body'),
			'itemsCssClass'=>'table table-striped table-hover',
			'summaryText'=>'',
			'loadingCssClass'=>'',
			'columns'=>array(
				array(
					'header'=>Yii::t('main','ID'),
					'name'=>'id',
					'value'=>function ($data) use(&$i) {
						$i++;
						return $i;
					}
				),
				array(
					'header'=>'Блюдо',
					'name'=>'id',
					'value'=>function($data) {
						if (!empty($data->dish->name))
							return $data->dish->name;
					}
				),
				array(
					'header'=>'Количество',
					'name'=>'count',
				),
				array(
					'header'=>'Цена за еденицу(руб.)',
					'name'=>'price',
				),
				array(
					'header'=>'Цена общая(руб.)',
					'name'=>'price',
					'value'=>function ($data) use (&$allSum){
						$allSum += $data['count']*$data['price'];
						return $data['count']*$data['price'];
					}
				),
			),
			'pager'=>array('cssFile'=>false),
		)); ?>
		
		<h3 class="pull-right">Итого: <b><?php echo number_format($allSum, 0, ',', ' ');?> руб.</b></h3>
		<div class="clearfix"></div>
	</div>
</div>
