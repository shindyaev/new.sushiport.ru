Здраствуйте, <?php echo $model -> name?>.
<br><br>
Вы зарегистрировались на сайте объеденённой службы доставки Milimon (<a href="http://<?php echo Yii::app()->params['site'] ?>"><?php echo Yii::app()->params['site'] ?></a>).
<br>
Чтобы авторизоваться проследуйте по ссылке: <a href="<?php echo Yii::app()->createAbsoluteUrl('/user/login/')?>"><?php echo Yii::app()->createAbsoluteUrl('/user/login/')?></a>
<br><br>
Объеденённая служба доставки Milimon - самый большой выбор блюд, которые вы любите.
<br><br>
Спасибо,<br>
Команда, Milimon
<?php
/*
Для завершения регистрации необходимо пройти по <a href="http://<?php echo trim(Yii::app()->params['site'], '.')?>/user/registrationDone/<?php echo $model->getActivateSoult($model->email)?>/">ссылке</a>.
 */
?>