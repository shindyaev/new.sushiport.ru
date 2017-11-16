<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<?php
	/** @var $this LoginController */
	/** @var $model LoginForm */
	/** @var $form CActiveForm  */
	?>
	
	<?php $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'login-form',
	    'enableClientValidation'=>true,
	    'clientOptions'=>array(
	        'validateOnSubmit'=>true,
	    ),
	    'htmlOptions'=>array(
	        'class' => 'form-vertical login-form'
	    )
	)); ?>
	<h3 class="form-title">Авторизация</h3>
	<?php //echo $form->errorSummary($model); ?>
	<div class="alert alert-error hide">
	    <button class="close" data-dismiss="alert"></button>
	    <span>Введите e-mail и пароль</span>
	</div>
	<?php
	if ($model->hasErrors()) {
	    ?>
	    <div class="alert alert-error"><?php echo $form->error($model,'password'); ?></div>
	
	    <?php
	}
	?>
	
	<div class="control-group">
	    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
	<!--    <label class="control-label visible-ie8 visible-ie9">Email</label>-->
	    <?php echo $form->labelEx($model,'username', array('class' => 'control-label visible-ie8 visible-ie9')); ?>
	    <div class="controls">
	        <div class="input-icon left">
	            <i class="icon-envelope"></i>
	            <?php echo $form->textField($model,'username',array('class' => 'm-wrap placeholder-no-fix', 'placeholder' => 'Email')); ?>
	        </div>
	        <?php echo $form->error($model,'username'); ?>
	    </div>
	</div>
	<div class="control-group">
	    <?php echo $form->labelEx($model,'password', array('class' => 'control-label visible-ie8 visible-ie9')); ?>
	    <div class="controls">
	        <div class="input-icon left">
	            <i class="icon-lock"></i>
	            <?php echo $form->passwordField($model,'password',array('class' => 'm-wrap placeholder-no-fix', 'placeholder' => 'Пароль')); ?>
	
	        </div>
	    </div>
	</div>
	
	<div class="form-actions">
	    <label class="checkbox">
	        <?php echo $form->checkBox($model,'rememberMe', array('value' => 1)); ?>
	        <?php echo $form->labelEx($model,'rememberMe', array('style' => 'display:inline;')); ?>
	    </label>
	    <button type="submit" class="btn green pull-right">
	        Войти <i class="m-icon-swapright m-icon-white"></i>
	    </button>
	</div>
	<?php $this->endWidget(); ?>
	<!-- END LOGIN FORM -->
</div>