	<div class="footer">
		
		<div class="smartphone-footer-text">
			<div class="bolder">Закажите доставку ресторанов «СъелБыСам» с телефона</div>
			<div>Скачать бесплатно для: <a target="_blank" href="https://itunes.apple.com/app/apple-store/id990580933?mt=8">iPhone</a>, <a target="_blank" href="https://play.google.com/store/apps/details?id=air.com.rework.sielbysam">Android</a></div>
		</div>
		
		<div class="gray-line mb-25"></div>

		<div class="footer-mailer">
			<div class="pull-left wd-200 bolder mr-30 lh-14">
				Узнавайте о новых акциях<br>
				и предложениях первыми
			</div>
			
			<div class="mails-rss-block pull-left">
				<!--<?php $form=$this->beginWidget('CActiveForm', array(
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
			<?php echo CHtml::htmlButton('Подписаться', array('class' => 'podp-button pull-left ml-5', 'type' => 'submit')); ?>
			<div class="hidden"><?php echo $form->error($this->variables['emailModel'],'email'); ?></div>
			
			<?php $this->endWidget(); ?>-->
				
				<form id="email-form-pulse" action="scripts/pulse.php" method="post">
					<input class="wd-280 pull-left" placeholder="Адрес вашей электронной почты" name="Email" id="Email_email" type="text" maxlength="64">
					<button class="podp-button pull-left ml-5" type="submit" name="yt0">Подписаться</button>
					<div class="hidden"><div class="errorMessage" id="Email_email_em_" style="display: none;"></div></div>
				</form>
			
			<script>
				$('#email-form-pulse').submit(function(){
					//Проверяем, не отправляется ли уже форма в текущий момент времени
					if($(this).data('formstatus') !== 'submitting'){
					
						//Устанавливаем переменные
						var form = $(this),
							formData = form.serialize(),
							formUrl = form.attr('action'),
							formMethod = form.attr('method'), 
							responseMsg = $('#signup-response');
						
						//Показываем соообщение с просьбой подождать
						responseMsg.hide()
							.addClass('response-waiting')
							.text('Пожалуйста, подождите...')
							.fadeIn(200);
						
						//Отправляем данные на сервер для проверки
						$.ajax({
							url: formUrl,
							type: formMethod,
							data: formData,
							success:function(data){
								
								//Устанавливаем переменные
								var responseData = jQuery.parseJSON(data), 
									klass = '';
								
								//Состояния ответа
								switch(responseData.status){
									case 'error':
										klass = 'response-error';
									break;
									case 'success':
										klass = 'response-success';
										$('#email-form-pulse').trigger("reset");
									break;	
								}
								
								//Показываем сообщение ответа
								responseMsg.fadeOut(200,function(){
									$(this).removeClass('response-waiting')
										.addClass(klass)
										.text(responseData.message)
										.fadeIn(200,function(){
											
											//Устанавливаем таймаут для скрытия сообщения ответа
											setTimeout(function(){
												responseMsg.fadeOut(200,function(){
													$(this).removeClass(klass);
													form.data('formstatus','idle');
												});
											},3000)
										});
									});
								}
							});
						}
						
						//Предотвращаем отправку формы
						return false;
					});
				</script>
				
			</div>
		</div>
		
		<p id="signup-response"></p>
		
		
		<div class="clearfix"></div>
		<div class="gray-line mt-25 mb-25"></div>
		
		<div class="footer-mailer">
			<div style=""><p style="font-size: 14px;text-align: center;">Если есть замечания или предложения  по улучшению качества обслуживания, <br>звоните <span class="bolder">+7 937 064-82-43</span></p></div>
		</div>
		
		<div class="clearfix"></div>
		<div class="gray-line mt-25 mb-25"></div>
		
		<div class="pull-left">
			<a class="vk-icon pull-left" target="_blank" href="http://vk.com/sielbysam"></a>
			<a class="facebook-icon pull-left" target="_blank" href="https://www.facebook.com/"></a>
			<a class="instagram-icon pull-left" target="_blank" href="http://instagram.com/sielbysam_restaurants/"></a>
		</div>
		
		<div class="pull-right mr-132">
			<img src="/img/footer-logo.png">
		</div>
		
		<div class="clearfix"></div>
		
		<div class="mt-10">
			<div class="pull-left pt-5">
				<span class="bolder">Полезные ссылки:</span>
				<a href="<?php echo $this->createCPUUrl("/delivery/")?>">Условия доставки</a>,
				<a href="<?php echo $this->createCPUUrl("/action/")?>" >Акции</a>,
				<a href="<?php echo $this->createCPUUrl("/restaurants/")?>" >Адреса ресторанов</a>
				<br>
				<a target="_blank" href="http://www.milimon-family.ru">Перейти на сайт www.milimon-family.ru</a><br><br>
				
			<br></div>
			
		</div>
		
		<div class="pull-right">
			<div class="footer-copyright">
				<?php
					$copyright = '&copy;&nbsp;2012-' . date('Y') . '&nbsp;Milimon Family';
					echo $copyright;
				?>
			</div>
			<div class="footer-creater">
				Разработка сайта: <a target="_blank" href="http://www.sekvoy.ru">Секвой Медиа Сеть</a>
			</div>
		</div>
		
	</div><!-- .footer -->

</div><!-- .wrapper -->


<div class="modal fade bs-example-modal-sm" id="city-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body">
		  <div class="text-center mt-20">Ваш город - <b>Самара</b></div>
		  <div class="text-center mt-20">
			<a href="site/changeCity/1/index.html">
				<button type="button" class="btn btn-success mr-50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Да&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
			</a>
			<a href="javascript:void(0)" class="fs-12" id="modal-change-city-link">Нет, выбрать другой город</a>
		  </div>
		  <ul class="modal-change-city">
							<li><a href="site/changeCity/1/index.html">Самара</a></li>
							<li><a href="site/changeCity/2/index.html">Уфа</a></li>
					</ul>
		
		<div class="text-center mt-20 fs-12">От вашего выбора зависит стоимость заказа и доставки.</div>
		
      </div>

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="Info-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body" id="Info-modal-content">
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
      	
      	<form class="form-horizontal" id="callme-form" action="/site/callMe/" method="post">			
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Имя</label>
			    <div class="col-sm-10">
			      <input placeholder="Сергей" class="form-control" name="CallMe[name]" id="CallMe_name" type="text" />			      <div class="errorMessage" id="CallMe_name_em_" style="display:none"></div>			    </div>
			</div>
			
			
			<div class="form-group">
				<label class="col-sm-2 control-label">Телефон</label>
				<div class="col-sm-10">
					<input placeholder="+7 (846) 123-34-56" class="form-control" name="CallMe[phone]" id="CallMe_phone" type="text" />					<div class="errorMessage" id="CallMe_phone_em_" style="display:none"></div>				</div>
			</div>
			
			<button class="btn btn-default" type="submit" name="yt1">Перезвоните мне</button>			
			</form>      	
      </div>
      
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dish-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="dish-modal-arrow-left"></div>
    <div class="modal-content">
      <div class="modal-body">
		<div class="model-dish-img-container">
			<img src="" id="dish-modal-img">
			<div class="hhvn-block">

				<div class="hhvn-hit"></div>
				<div class="hhvn-hot"></div>
				<div class="hhvn-vegan"></div>
				<div class="hhvn-new"></div>

			</div>
		</div>
		<div class="model-dish-content-container">
			<div class="fs-24 mt-40" id="dish-modal-name">Роллы</div>
			<div class="menu-dish-list-item-price mt-10">
				<span  id="dish-modal-price">165</span> 
				<i class="fa fa-rub"></i>
			</div>
			<div class="clearfix"></div>
			<div class="dish-modal-count-order-block">
				<div class="menu-dish-list-item-order pull-left mr-20" data-bind="click:function(data, bind) {
						var _this = $(bind.currentTarget).parent().parent();

						product['count'] = _this.find('.dish-count').val();
						addGoods(product);
						}">Заказать</div>
				<div class="count-dish-block pull-left">
					<div class="minus">&ndash;</div>
					<div class="count-dish">1</div>
					<div class="plus">+</div>
					<input type="hidden" class="dish-count" value="1" autocomplete="off">
				</div>
				<div class="clearfix"></div>
			</div>
			
			<div class="dish-modal-detail-text">
				<div class="mt-20 gray-text" id="dish-modal-text">
					лосось, тунец, угорь, креветка, водоросли чука, масага, соус "Унаги"
				</div>
				<div class="mt-20 gray-text" id="dish-modal-weight"></div>
			</div>
			<input type="hidden" id="number_current_detail_product" value="0">
		</div>
		<div class="popur-close" data-dismiss="modal"><span aria-hidden="true"></div>
      </div>
    </div>
	<div class="dish-modal-arrow-right"></div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="add-to-cart-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
		
		<div class="add-to-cart-error-div1">
			Пожалуйста оформите текущий<br>
			заказ, чтобы продолжить выбор по<br>
			меню другого ресторана Milimon.
		</div>
		
		<div class="add-to-cart-error-div2">
			1 ресторан - 1 заказ
		</div>
		
		<div class="add-to-cart-error-div3">
			Мы объеденим все заказы в одну доставку<br>
			по вашему желанию. Просто спросите.
		</div>
		
		<a href="/cart/" class="no-underline">
			<div class="delivery-popap-button center-block">Оформить заказ</div>
		</a>
		
		<div class="add-to-cart-error-div4" data-dismiss="modal" onclick="javascript: cart.removeAllGoods();">
			Начать новый заказ и<br>
			удалить текущий
		</div>
		
		
		<div class="popur-close" data-dismiss="modal"><span aria-hidden="true"></div>
      </div>
    </div>
  </div>
</div>

<script src="http://smr.milimon.ru/js/device.min.js" type="text/javascript"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter35938970 = new Ya.Metrika({
                    id:35938970,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/35938970" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>
