<?php
/* @var $this SeoController */
/* @var $model Seo */

$this->title_h3 = $header;

$this->breadcrumbs = array(
    'Зоны доставки' => $this->createUrl('zones/index'),
    $header
);

$this->menuActiveItems[BController::SETTINGS_ZONE_MENU_ITEM] = 1;

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

Yii::app()->clientScript->registerScriptFile(
    'https://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU',
    CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
    '/scripts/map-edit.js',
    CClientScript::POS_END
);
?>
<div>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => $model->formId,
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => false,
            'errorCssClass' => 'error',
            'afterValidate' => 'js:contentAfterClientValidate',
        ),
        'htmlOptions' => array('class' => 'form-horizontal', 'rel' => $this->createUrl('zones/index'), 'enctype' => 'multipart/form-data'),

    )); ?>

    <div class="control-group">
        <?php echo $form->label($model, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'title', array('class' => 'm-wrap large')); ?><br>
            <span class="help-inline"><?php echo $form->error($model, 'title'); ?></span>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->label($model, 'time', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model,'time', array(
                '60 мин'            =>  '60 мин',
                'до 90 минут'       =>  'до 90 минут',
                'более 90 минут'    =>  'более 90 минут',
            )) ?>
            <span class="help-inline"><?php echo $form->error($model, 'time'); ?></span>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model, 'restoran_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model,'restoran_id', $restorans) ?>
            <span class="help-inline"><?php echo $form->error($model, 'answer'); ?></span>
        </div>
    </div>

    <div class="control-group">
        <div id="YMapsID" style="width:600px;height:400px"></div>
    </div>

    <div class="control-group" style="display: none">
        <?php echo $form->label($model, 'params', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'params', array('id'=> 'maps-map','class' => 'm-wrap span6')); ?>
            <span class="help-inline"><?php echo $form->error($model, 'answer'); ?></span>
        </div>
    </div>




    <div class="form-actions large">
        <?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
        <?php if (!empty($model->id)) : ?>
            <a href="/seo/delete/<?php echo $model->id ?>/"
               onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
        <?php endif; ?>
        <?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
    </div>

    <?php echo $form->hiddenField($model, 'id'); ?>

    <?php $this->endWidget(); ?>

</div>
