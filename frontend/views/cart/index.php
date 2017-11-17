<div class="content">
	
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Корзина</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>
		
	<div class="cart-container">
	
		<div class="main-h2">Корзина</div>
		<div class="main-h2-cart-rest-name">Доставка из ресторана: <span id="rest-name"></span></div>
	
		<div class="cart-container-left">
			<span data-bind="attr:workRestStyle"></span>
			
			<ul class="cart-dish-list" data-bind="foreach: cartItems">
				<li class="cart-dish-list-item">
					<div class="cart-dish-list-item-img-cont">
						<img data-bind="attr: { src: img}">
					</div>
					<div class="cart-dish-list-item-name" >
						<span data-bind="text: name"></span>
						<br>
						<span class="cart-dish-list-item-name-rest" data-bind="text: restName"></span>
					</div>
					<div></div>
					
					<div class="remove-cart-dish" data-bind="click: $root.removeGoods"></div>
					
					<div class="cart-dish-price"><span data-bind="text: fullPriceRZ">1 100</span> <i class="fa fa-rub"></i></div>
					
					<div class="cart-count-dish-block count-dish-block" data-bind="visible: !is_gift">
						<div class="minus">&ndash;</div>
						<div class="count-dish" data-bind="text: count">1</div>
						<div class="plus">+</div>
						<input type="hidden" class="dish-count" value="1" autocomplete="off" data-bind="value: count, event: { change: $root.save }">
					</div>
					
					<div class="clearfix"></div>
				</li>
			</ul>
			
			<a class="cart-add-new-dish" data-bind="attr: { href: restLink}">
				Добавить новое блюдо
				<br>
				в корзину 
			</a>
			
			<div class="mt-20 text-center red-text" id="pr-text">
				Добавьте блюдо к вашему заказу и получите подарок!
			</div>
			
			
			<?php foreach ($presents AS $key => $val):?>
			<?php if (empty($val->dish)) continue; ?>
			<div class="cart-present hidden" rel="<?php echo $val['price']?>" alt="<?php echo $val['restoranId']?>">
				<div class="cart-present-img">
					<img src="<?php echo $val->dish->imagesUrl."90x60/".$val->dish->id.".jpg"?>">
				</div>
				<div class="cart-present-name">
					<?php echo $val->dish->name?>
					<div class="fs-12 lh-14"><?php echo $val->dish->text?></div>
				</div>
				<div class="present-note gray-text">
					Если сумма заказа больше
					<div class="fs-18 mt-5 black-text"><?php echo $val['price']?> <i class="fa fa-rub"></i></div>
				</div>
				<div class="present-lenta"></div>
			</div>
			<?php endforeach;?>
		</div>
		
		<div class="cart-container-right">
		
			<div class="cart-order-button-block">
				<div class="cart-order-button-block-all-sum-block">Итого: 
					<span data-bind="text: totalPriceRZ, attr: { rel: totalPrice}" class="bolder" id="all-sum"></span>
					<i class="fa fa-rub"></i>
					<a href="javascript: void(0);"><img src="/img/uppd-refresh.png"></a>
				</div>
				<div class="cart-order-button-block-note gray-text">Уточните стоимость доставки <br>до вашего дома у оператора</div>
				<div class="cart-order-button-block-normal-order-button" id="cart-order-button-block-normal-order-button" onclick="yaCounter26860266.reachGoal('cart-order-button-block-normal-order-button'); return true;" data-toggle="modal" data-target="#normal-order-modal"></div>
				<div class="cart-order-button-block-smart-order-button" id="cart-order-button-block-smart-order-button" onclick="yaCounter26860266.reachGoal('cart-order-button-block-smart-order-button'); return true;" data-toggle="modal" data-target="#smart-order-modal">Заберу сам</div>
			</div>
		
		</div>
	
		<div class="clearfix"></div>
	
	</div>
	
	
</div><!-- .content-->


<div class="modal fade" id="smart-order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	
      	<div class="cart-smart-order-form">
			
			<div class="cart-smart-order-form-headline">
				Заберу сам
			</div>
			
			<div class="cart-smart-order-form-input-container">
				<input type="text" class="text-input" placeholder="Имя" id="order-name" autocomplete="off" 
				<?php if (!Yii::app()->user->isGuest): ?>value="<?php echo Yii::app()->user->name?>"<?php endif;?>>
			</div>
			<div class="cart-smart-order-form-input-container">
				<input type="text" class="text-input" placeholder="+7 (___) ___-__-__" id="order-phone" autocomplete="off"
				<?php if (!Yii::app()->user->isGuest): ?>value="<?php echo Yii::app()->user->phone?>"<?php endif;?>>
			</div>
			<div class="cart-smart-order-form-input-container">
				<input type="text" class="text-input" placeholder="Адрес электронной почты" id="order-email" autocomplete="off"
				<?php if (!Yii::app()->user->isGuest): ?>value="<?php echo Yii::app()->user->email?>"<?php endif;?>>
			</div>
			
			<div class="cart-smart-order-form-input-container">
				<input type="hidden" class="checkbox inline" id="order-delivery" value="1">
				<span class="dark-green-text italic text-box-custom"></span>
			</div>
			
			<div class="cart-smart-order-form-line"></div>
			
			<div class="cart-smart-order-form-result">
				Итого: <span data-bind="text: totalPriceRZ, attr: {rel: totalPrice}" class="bolder" id="all-sum"></span> <span class="bolder">Р</span>
			</div> 
			<div class="cart-smart-order-form-result-recalculate">
				<a href="javascript: void(0)" >Пересчитать</a>
			</div>
			
			<div class="cart-smart-order-form-order-button" id="submit-order"></div>
			
		</div>
      	
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="normal-order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      	<a class="normal-order-modal-back" href="javascript: void(0)" data-dismiss="modal">Редактировать заказ</a>
      	<div class="main-h2">Оформить заказ</div>
      	<div class="normal-order-modal-left">
      		<div class="normal-order-form">
	      		<div class="normal-order-modal-form-contral clearfix">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Ваше имя
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-300" id="normal-order-name" <?php if (!Yii::app()->user->isGuest): ?>value="<?php echo Yii::app()->user->name?>"<?php endif;?>>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formPhone">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Контактный телефон
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="tel" class="normal-order-modal-form-contral-input-text w-300" id="normal-order-phone" <?php if (!Yii::app()->user->isGuest): ?>value="<?php echo Yii::app()->user->phone?>"<?php endif;?>>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formStreet">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Улица
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-300" id="normal-order-street">
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formHouse">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Дом
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-70" id="normal-order-home">
		      			
		      			<div class="pull-right formKorpus">
		      				<div class="pull-left text-right w-140 lh-32 mr-15">
				      			Корпус/строение
				      		</div>
				      		<div class="pull-right  w-70">
				      			<input type="text" class="normal-order-modal-form-contral-input-text w-70" id="normal-order-str">
				      		</div>
		      			</div>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formApartment">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Квартира/офис
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-70" id="normal-order-kv">
		      			
		      			<div class="pull-right formEntrance">
		      				<div class="pull-left text-right w-140 lh-32 mr-15">
				      			Подъезд
				      		</div>
				      		<div class="pull-right  w-70">
				      			<input type="text" class="normal-order-modal-form-contral-input-text w-70" id="normal-order-pd">
				      		</div>
		      			</div>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formStage">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Этаж
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-70" id="normal-order-fl">
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formChange">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Нужна сдача с 
		      		</div>
		      		<div class="pull-right  w-300">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-70 pull-left mr-15" id="normal-order-money">
		      			<div class="pull-left lh-32">руб.</div>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formTime">
		      		<div class="pull-left text-right w-160">
		      			Время и дата доставки 
		      		</div>
		      		<div class="pull-right  w-300">
		      			<div>
		      				<input type="radio" value="1" name="normal-order-delivery" id="normal-order-delivery-1" checked>
		      				<label class="radio-custom" for="normal-order-delivery-1">Доставка как можно скорее</label>
		      			</div>
		      			<div>
		      				<input type="radio" value="2" name="normal-order-delivery" id="normal-order-delivery-2">
		      				<label class="radio-custom" for="normal-order-delivery-2">Доставка ко времени</label>
		      			</div>
		      			<div class="clearfix formSelectDate">
		      				<div class="pull-left">
				      			<select class="custom-select w-140" id="normal-order-date">
				      				<?php for ($i=0; $i < 8; $i++):?>
				      					<?php 
				      						$dt = Yii::app()->dateFormatter->format('d MMMM, eee', strtotime('+'.$i.' day')); 
				      					?>
				      					<option value='<?php echo $dt?>'><?php echo $dt?></option>
				      				<?php endfor;?>
								</select>
							</div>
							
							
							
							<div class="pull-right lh-32 formSelectTimeMin">
								<select class="custom-select  w-55" id="normal-order-date-minuts">
									<?php for ($i = 0; $i < 60; $i++):?>
										<option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
									<?php endfor;?>
								</select>
							</div>
							<div class="pull-right lh-32 mr-10">
								:
							</div>
							<div class="pull-right lh-32 mr-10 formSelectTimeHour">
								<select class="custom-select w-55" id="normal-order-hour">
									<?php for ($i = 12; $i < 24; $i++):?>
										<option value="<?php echo $i; ?>"><?php echo sprintf("%02d", $i); ?></option>
									<?php endfor;?>
								</select>
							</div>
							<div class="pull-right lh-32 mr-10">
								в
							</div> 
		      			</div>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formComment">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Комментарий к заказу 
		      		</div>
		      		<div class="pull-right  w-300">
		      			<textarea class="normal-order-modal-form-contral-input-textarea w-300 h-90" id="normal-order-comment"></textarea>
		      		</div>
	      		</div>
	      		
	      		<div class="normal-order-modal-form-contral clearfix formPromo">
		      		<div class="pull-left text-right w-160 lh-32">
		      			Промо-код
		      		</div>
		      		<div class="pull-right w-300 clearfix">
		      			<input type="text" class="normal-order-modal-form-contral-input-text w-150 pull-left mr-15" id="normal-order-promo">
		      			<div class="confirm-button pull-left promocode-check"></div>
						<div id="promo-code-note"></div>
		      		</div>
	      		</div>
	      		
      		</div>
      		
      	</div>      	
      	<div class="normal-order-modal-right">
      		<div class="cart-order-button-block h-185">
				<div class="cart-order-button-block-all-sum-block">Итого: 
					<span data-bind="text: totalPriceRZ, attr: { rel: totalPrice}" class="bolder" id="all-sum"></span>
					<i class="fa fa-rub"></i>
				</div>
				<div class="cart-order-button-block-note gray-text">Уточните стоимость доставки <br>до вашего дома у оператора</div>
				<div class="normal-order-modal-order-button  normal-order-form-submit"></div>
			</div>
      	</div>
      	<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="success-order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      		<br>
      		<div class="cart-order-finish-headline">Спасибо!</div>
			<br><br>
			<div class="cart-order-finish-note">Почти готово. Осталось уточнить 
				<br>несколько деталей. Дождитесь звонка 
				<br>оператора в течении 5 минут.</div>
      		<br><br>
      		<a href="/" class="green-button">
				Закрыть
			</a>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
	var product = [];
	var time = <?php echo strtotime("now")?>;
	$(document).ready(function() {

		$('.custom-select').selectric();
			
		showPresents();
		
		$(".remove-cart-dish").click(function() {
			showPresents();
		})
		
		$(".count-dish-block .plus").click(function() {
			$(this).parent().find(".dish-count").eq(0).change();
			showPresents();
		})

		$(".count-dish-block .minus").click(function() {
			$(this).parent().find(".dish-count").eq(0).change();
			showPresents();
		})

		$("#order-phone").inputmask({"mask": "+7 (999) 999-99-99"});
		$("#normal-order-phone").inputmask({"mask": "+7 (999) 999-99-99"});
		


		$("#submit-order").click(function() {
			var data = new Object;
			data['order'] = new Object;
			var tm;

			var dishes = JSON.parse($.jStorage.get('cart'));

			if (dishes.length == 0) {
				Alert("Ваша корзина пуста!");
				return;
			}
			
			tm = $("#order-name").val();
			if (tm == "") {
				Alert("Необходимо указать имя!");
				return;
			}
			data['order']['name'] = tm;

			tm = $("#order-phone").val();
			if(!$("#order-phone").inputmask("isComplete")){
				Alert("Необходимо указать номер телефона!");
				return false;
		    }
		    data['order']['phone'] = tm;
		    
			tm = $("#order-email").val();
			if (tm == "") {
				Alert("Необходимо указать Email!");
				return;
			}
			data['order']['email'] = tm;

			data['order']['delivery'] = 0;
			if ($("#order-delivery").is(":checked")) {
				data['order']['delivery'] = 1;
			}

			data['order']['dishes'] = dishes;

			data['order']['smart'] = 1;

			data['order']['time'] = time;
			$.ajax({
				cache 		: false,
				type 		: 	'POST',
				url			:	'/cart/submitOffer/',
				data		:	data,
				dataType	:	'json',
				success		:	function(response) {
					$("#smart-order-modal").modal('hide');
					$("#success-order-modal").modal('show');
					cart.removeAllGoods();
					
					yaCounter26860266.reachGoal('submit-order');
					
				},
			})
			
		})


		$(".normal-order-form-submit").click(function() {

			var data = new Object;
			data['order'] = new Object;
			var tm;

			var dishes = JSON.parse($.jStorage.get('cart'));

			if (dishes.length == 0) {
				Alert("Ваша корзина пуста!");
				return;
			}
			
			tm = $("#normal-order-name").val();
			if (tm == "") {
				Alert("Необходимо указать имя!");
				return;
			}
			data['order']['name'] = tm;

			tm = $("#normal-order-phone").val();
			if(!$("#normal-order-phone").inputmask("isComplete")){
				Alert("Необходимо указать номер телефона!");
				return false;
		    }
		    data['order']['phone'] = tm;
		    
		    tm = $("#normal-order-street").val();
			data['order']['street'] = tm;

			tm = $("#normal-order-home").val();
			data['order']['home'] = tm;

			tm = $("#normal-order-str").val();
			data['order']['str'] = tm;

			tm = $("#normal-order-kv").val();
			data['order']['kv'] = tm;

			tm = $("#normal-order-pd").val();
			data['order']['pd'] = tm;

			tm = $("#normal-order-fl").val();
			data['order']['fl'] = tm;

			tm = $("#normal-order-money").val();
			data['order']['money'] = tm;

			if ($("#normal-order-delivery-2").is(":checked"))
				data['order']['delivery-type'] = 2;
			else 
				data['order']['delivery-type'] = 1;

			tm = $("#normal-order-date").val();
			data['order']['date'] = tm;

			tm = $("#normal-order-hour").val();
			data['order']['hour'] = tm;

			tm = $("#normal-order-date-minuts").val();
			data['order']['minuts'] = tm;

			tm = $("#normal-order-comment").val();
			data['order']['comment'] = tm;

			tm = $("#normal-order-promo").val();
			data['order']['promo'] = tm;
			
			data['order']['smart'] = 0;

			data['order']['dishes'] = dishes;

			data['order']['time'] = time;
			$.ajax({
				cache 		: false,
				type 		: 	'POST',
				url			:	'/cart/submitOffer/',
				data		:	data,
				dataType	:	'json',
				success		:	function(response) {
// 					if (response['cityId'] == 1)
//  						window.location = '/smr/cart/success/';
// 					else if (response['cityId'] == 2)
// 						window.location = '/ufa/cart/success/';
// 					else 
// 						window.location = '/cart/success/';					
					$("#normal-order-modal").modal('hide');
					$("#success-order-modal").modal('show');
					cart.removeAllGoods();
				},
			})

		})

		var rests = new Array();
		<?php foreach($rests as $key => $val):?>
			rests[<?php echo $val['id']?>] = '<?php echo $val['name']?>';
		<?php endforeach;?>
		
		var id = cart.cartId();
		$("#rest-name").html(rests[id]);
		
	})
	
	var showPresents = function() {
		var id = cart.cartId();
		$(".cart-present").addClass('hidden');
		var allSum = parseInt($("#all-sum").attr('rel'));
		var presents = $(".cart-present");
		
		pressent_text();
		
		
		
		
		for (var i = 0; i < presents.length; i++) {
			if (parseInt(presents.eq(i).attr("rel")) <= allSum && parseInt(presents.eq(i).attr("alt")) == id) {
				presents.eq(i).removeClass('hidden');
				break;
			}
		}
	}
	
	var pressent_text = function() {
		var id = cart.cartId();
		var presents = $(".cart-present");
		
		var minp = 1000000;

		for (var i = 0; i < presents.length; i++) {
			if (id > 0) {
				if (presents.eq(i).attr('alt') == id) {
					if (minp > presents.eq(i).attr('rel'))
						minp = presents.eq(i).attr('rel');
				} 
			} else {
				if (minp > presents.eq(i).attr('rel'))
						minp = presents.eq(i).attr('rel');
			}
		}
		
		var a = minp - cart.totalPrice();
		if (a > 0 && minp < 1000000) {
			$("#pr-text").html("Вам не хватает " + a + " <i class='fa fa-rub'></i>, что бы получить подарок.");
		} else {
			$("#pr-text").html("");
		}
		
		
		
	}
	
</script>


