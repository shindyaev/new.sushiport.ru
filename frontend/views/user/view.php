<?php
/* @var $this UserController */
/* @var $model User */
?>

	<div class="form-horizontal">
		
		<div class="control-group">
			<?php echo CHtml::activeLabel($model,'email', array('class' => 'control-label')); ?>
		  	<div class="controls">
		  		<label class="control-label">
		  			<?php echo $model->email;?>
		  		</label>
			</div>	
		</div>
		
		<?php if ($model->id == Yii::app()->user->id) :?>
		<div class="control-group">
	    	<div class="controls">
	    		<a href="<?php echo $this->createCPUUrl('/user/edit/'.$model->id.'/');?>">
	      			<?php echo CHtml::htmlButton('Редактировать', array('class' => 'btn')); ?>
	      		</a>
	    	</div>
	 	</div>
	 	<?php endif;?>
		
	</div>
