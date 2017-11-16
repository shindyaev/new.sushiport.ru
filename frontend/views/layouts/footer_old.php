	<div class="footer">
		
		<div class="smartphone-footer-text">
			<div class="bolder">Закажите доставку с телефона или заберите сами</div>
			<div>Мобильные приложения: <a target="_blank" href="<?php echo $this->variables['iphoneLink']?>">iPhone</a>, <a target="_blank" href="<?php echo $this->variables['androidLink']?>">Android</a></div>
		</div>
		
		<div class="gray-line mb-25"></div>
		
		<div class="pull-left wd-200 bolder mr-30 lh-14">
			Узнавайте о новых акциях<br>
			и предложениях первым
		</div>
		
		<div class="mails-rss-block pull-left">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>$this->variables['emailModel']->formId,
				'action'=>'/site/addEmail/',
				'enableAjaxValidation'=>true,
				'enableClientValidation'=>false,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false,
					'errorCssClass'=>'error',
					'afterValidate'=>'js:contentAfterEmailAddValidate',
				),
		
			)); ?>
			<?php echo $form->textField($this->variables['emailModel'],'email',array('class'=>'wd-280 pull-left', 'placeholder'=>"Адрес вашей электронной почты")); ?>
			<?php echo CHtml::htmlButton('', array('class' => 'podp-button pull-left ml-5', 'type' => 'submit')); ?>
			<div class="hidden"><?php echo $form->error($this->variables['emailModel'],'email'); ?></div>
			
			<?php $this->endWidget(); ?>
		</div>
		
		
		
		
		<a class="instagram-icon pull-right" target="_blank" href="http://instagram.com/gedza_ru"></a>
		<a class="twitter-icon pull-right" target="_blank" href="https://twitter.com/gedza_ru"></a>
		<a class="facebook-icon pull-right" target="_blank" href="https://www.facebook.com/gedza.ru"></a>
		<a class="vk-icon pull-right" target="_blank" href="http://vk.com/gedza_ru"></a>
		
		<div class="clearfix"></div>
		<div class="gray-line mt-25 mb-25"></div>
		
		<div class="fs-12">
			© 2007–2014 Сеть ресторанов «GEDZA» и «Primasole»
		</div>
		
		<div class="mt-10">
			<div class="write-button pull-left" data-toggle="modal" data-target="#Write-modal"></div>
			<div class="pull-left pt-5 pl-10">
				<a href="<?php echo $this->createCPUUrl('/pages/24/');?>">Контакты</a>
				<a href="<?php echo $this->createCPUUrl('/pages/24/');?>" class="pl-10">Вакансии</a>
			</div>
			
			<div class="pull-right pt-5">
				<span class="bolder">Полезные ссылки</span>
				<a href="<?php echo $this->createCPUUrl('/menu/');?>" class="pl-10">Меню</a>
				<a href="<?php echo $this->createCPUUrl('/pages/24/');?>" class="pl-10">Рестораны</a>
				<a href="<?php echo $this->createCPUUrl('/action/');?>" class="pl-10">Акции</a>
			</div>
			
			<div class="vector-web-link">Разработано в <a href="http://www.vector-web.ru/" target="_blank">Вектор Web</a></div>
		</div>
		
	</div><!-- .footer -->

</div><!-- .wrapper -->


<div class="modal fade bs-example-modal-sm" id="city-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body">
		  <div class="text-center mt-20">Ваш город - <b>Самара</b></div>
		  <div class="text-center mt-20">
			<a href="/site/changeCity/1/">
				<button type="button" class="btn btn-success mr-50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Да&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a>
			<a href="javascript:void(0)" class="fs-12" id="modal-change-city-link">Нет, выбрать другой город</a>
		  </div>
		  <ul class="modal-change-city">
			<?php foreach ($this->variables['citys'] AS $key => $val):?>
				<li><a href="/site/changeCity/<?php echo $key;?>/"><?php echo $val?></a></li>
			<?php endforeach;?>
		</ul>
		
		<div class="text-center mt-20 fs-12">От вашего выбора зависит стоимость заказа и доставки.</div>
		
      </div>

    </div>
  </div>
</div>



<div class="modal fade bs-example-modal-sm" id="Alert-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body" id="Alert-modal-content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="call-me-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body" id="call-me-modal-content">
      	
      	<div data-dismiss="modal" class="popur-close"><span aria-hidden="true"></span></div>
      	
      	<div class="call-me-header">Заказать звонок</div>
      	
      	<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>$this->variables['callMeModel']->formId,
      			'action'=>'/site/callMe/',
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false,
					'errorCssClass'=>'error',
					'afterValidate'=>'js:contentAfterCallMeValidate',
				),
				'htmlOptions' => array('class' => 'form-horizontal')
			
			)); ?>
			
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Имя</label>
			    <div class="col-sm-10">
			      <?php echo $form->textField($this->variables['callMeModel'],'name', array('placeholder'=>'Сергей', 'class' => 'form-control')); ?>
			      <?php echo $form->error($this->variables['callMeModel'],'name'); ?>
			    </div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Телефон</label>
				<div class="col-sm-10">
					<?php echo $form->textField($this->variables['callMeModel'],'phone', array('placeholder'=>'+7 (846) 123-34-56', 'class' => 'form-control')); ?>
					<?php echo $form->error($this->variables['callMeModel'],'phone'); ?>
				</div>
			</div>
			
			<?php echo CHtml::htmlButton('Перезвоните мне', array('class' => 'btn btn-default', 'type' => 'submit')); ?>
			
			<?php $this->endWidget(); ?>
      	
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="Write-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body" id="Write-modal-content">
    	
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      	
      	<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>$this->variables['writeModel']->formId,
      			'action'=>'/site/writeUs/',
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false,
					'errorCssClass'=>'error',
					'afterValidate'=>'js:contentAfterWriteUsValidate',
				),
			
			)); ?>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Имя</label>
				<?php echo $form->textField($this->variables['writeModel'],'name', array('placeholder'=>'Сергей', 'class' => 'form-control')); ?>
				<?php echo $form->error($this->variables['writeModel'],'name'); ?>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<?php echo $form->textField($this->variables['writeModel'],'email', array('placeholder'=>'example@gmail.com', 'class' => 'form-control')); ?>
				<?php echo $form->error($this->variables['writeModel'],'email'); ?>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Телефон</label>
				<?php echo $form->textField($this->variables['writeModel'],'phone', array('placeholder'=>'+7 (846) 123-34-56', 'class' => 'form-control')); ?>
				<?php echo $form->error($this->variables['writeModel'],'phone'); ?>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Текст сообщения</label>
				<?php echo $form->textArea($this->variables['writeModel'],'text', array('class' => 'form-control', 'resize'=>'false')); ?>
				<?php echo $form->error($this->variables['writeModel'],'text'); ?>
			</div>
			
			<?php echo CHtml::htmlButton('Отправить', array('class' => 'btn btn-default', 'type' => 'submit')); ?>
			
			<?php $this->endWidget(); ?>
      	
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dish-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
		<div class="model-dish-img-container">
			<img src="/img/big-dish.jpg" id="dish-modal-img">
			<div class="hhvn-block">

				<div class="hhvn-hit"></div>
				<div class="hhvn-hot"></div>
				<div class="hhvn-vegan"></div>
				<div class="hhvn-new"></div>

			</div>
		</div>
		<div class="model-dish-content-container">
			<div class="fs-24 bolder" id="dish-modal-name">Роллы</div>
			<div class="mt-20 gray-text" id="dish-modal-text">
				лосось, тунец, угорь, креветка, водоросли чука, масага, соус "Унаги"
			</div>
			<div class="mt-20 gray-text" id="dish-modal-weight"></div>
			<div class="menu-dish-list-item-price mt-20">
				<span  id="dish-modal-price">165</span> Р
			</div>
			<div class="dish-modal-count-order-block">
				<div class="count-dish-block">
					<div class="minus"></div>
					<div class="count-dish">1</div>
					<div class="plus"></div>
					<input type="hidden" class="dish-count" value="1" autocomplete="off">
				</div>
				<div class="menu-dish-list-item-order pull-right" data-bind="click:function(data, bind) {
						var _this = $(bind.currentTarget).parent().parent();

						product['count'] = _this.find('.dish-count').val();
						addGoods(product);
						}"></div>
			</div>
		</div>
		<div class="popur-close" data-dismiss="modal"><span aria-hidden="true"></div>
      </div>
    </div>
  </div>
</div>

<?php if ($this->variables['firstVisit']):
//if($_SERVER['REMOTE_ADDR'] == '62.106.107.157'):?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#city-modal").modal('show');
		
		$("#modal-change-city-link").click(function() {
			$(this).parent().parent().find(".modal-change-city").slideDown();
		})
		
	})
</script>
<?php endif;?>


<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '2ed5Br7KVN';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/geo-widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->




<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter26860266 = new Ya.Metrika({id:26860266,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/26860266" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->




<?php if ($this->variables['city-id'] == 1):?>
			<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-53221278-2', 'auto');
ga('send', 'pageview');

</script>
<?php endif;?>
		
<?php if ($this->variables['city-id'] == 2):?>
			<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-53221278-1', 'auto');
ga('send', 'pageview');

</script>
<?php endif;?>

<?php if (false):?>
<script charset="utf-8" type="text/javascript">
  var _sp_options = {
      publicKey: "<?php echo $this->variables['sailPlayPublicKey']?>",
      partnerId: "734",
      position: ["center", "left"],
      notifications: {
        enabled: true,
        skin: {type: 'horizontal', position: ['bottom', 'right']}
      }
  };
  (function() {
      var sp = document.createElement("script");
      sp.type = "text/javascript"; sp.async = true; sp.charset = "utf-8";
      sp.src = ("https:" == document.location.protocol ? "https://" : "http://") +
        "sailplay.ru/popup-sdk/js/sailplay/734/";
      var scr = document.getElementsByTagName("script")[0]; scr.parentNode.insertBefore(sp, scr);
  })();
</script>


<?php if ($this->variables['sailPlayFirstPopap']):?>
<script type="text/javascript">
	var sailPlayPopap = function() {
		SP.showPopup();
	}
	$(document).ready(function() {
	
		setTimeout(sailPlayPopap, 10000);
	})
</script>		
<?php endif;?>
<?php endif;?>

<script src="https://myshopapp.ru/js/openboom.js?a=2805"></script>

</body>
</html>
