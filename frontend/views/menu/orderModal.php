<!-- Order -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body">

		<div class="order-step-content-container">
			<div class="order-step-content-container-footcloth">
				
				<div class="order-step-content step-1" id="order-modal-content-step1">
					<div class="order-cart-list">
						<div data-bind="foreach: {data :cartItems, afterRender: afterRenderFunction}">
							<div class="order-cart-item clearfix">
								<div class="img-container">
									<img src="/img/dish-1.jpg" data-bind="attr: { src: img}">
								</div>
								
								<div class="text-container">
									<div class="name" data-bind="text: name">
										Роллы
									</div>
									<div class="text" data-bind="text: text">
										Курица, сыр, филадельфия, огурец.
									</div>
								</div>
								<div class="count-container">
									<select class="span1 no-margin count" data-bind="value: count">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								
								</div>
								<div class="price-container" data-bind="text: fullPrice">
									120
								</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<div class="order-cart-item-result clearfix">
							<div class="text-container">
								Итого
							</div>
							<div class="price-container" data-bind="text: totalPrice()">
								120
							</div>
						</div>
					</div>
					<input type="button" class="order-modal-go-to-step-2" value="Оформить">
				</div>
				
				<div class="order-step-content step-2" id="order-modal-content-step2">
					<form>
						<div class="radio-group-text">Способ доставки</div>
						<div class="radiobuttons-group clearfix">
							<div class="pull-left">
								<input type="radio" name="Order[deviliry]" id="deviliry1" value="1">
								<label class="radio-custom" for="deviliry1">Забрать с собой( скидка -15%)</label>
							</div>
							<div class="pull-left">
								<input type="radio" name="Order[deviliry]" id="deviliry2" value="2" checked>
								<label class="radio-custom" for="deviliry2">Доставка курьером</label>
							</div>
						</div>
						<div class="radiobuttons-group clearfix">
							<div class="pull-left">
								<input type="radio" name="Order[firstOrder]" id="firstOrder1" value="1" checked>
								<label class="radio-custom" for="firstOrder1">Заказываете впервые</label>
							</div>
							<div class="pull-left">
								<input type="radio" name="Order[firstOrder]" id="firstOrder2" value="2">
								<label class="radio-custom" for="firstOrder2">Заказывал(а) ранее</label>
							</div>
						</div>
						<div class="line"></div>
						<input type="text" name="Order[phone]"  placeholder="Контактный номер телефона" class="input-text input-280" id="orderPhone">
						<div class="placeholder-text">
							Укажите действующий номер номер телефона для связи с оператором доставки. Например, для мобильного: «+79171234567», для городского: «+73472123456»
						</div>
						<div class="line"></div>
						<input type="text" name="Order[email]" placeholder="Электронная почта" class="input-text input-280">
						<div class="line"></div>
						<div id="order-add-block">
							<input type="text" name="Order[street]" placeholder="Улица" class="input-text input-280">
							<div class="two-small-inp-container clear">
								<input type="text" name="Order[house]" placeholder="Дом" class="input-text input-130 fleft">
								<input type="text" name="Order[porch]" placeholder="Подъезд" class="input-text input-130 fright" id="orderPorch">
								<div class="clear"></div>
							</div>
							<div class="two-small-inp-container clear">
								<input type="text" name="Order[building]" placeholder="Строение" class="input-text input-130 fleft">
								<input type="text" name="Order[floor]" placeholder="Этаж" class="input-text input-130 fright"  id="orderFloor">
								<div class="clear"></div>
							</div>
							<div class="two-small-inp-container clear">
								<input type="text" name="Order[housing]" placeholder="Корпус" class="input-text input-130 fleft">
								<input type="text" name="Order[apartment]" placeholder="Квартира" class="input-text input-130 fright"  id="orderApartment">
								<div class="clear"></div>
							</div>
							<div class="line"></div>
						</div>
						<div class="radio-group-text">Способ оплаты</div>
						<div class="radiobuttons-group clearfix">
							<div class="pull-left">
								<input type="radio" name="Order[payType]" id="payType1" value="1">
								<label class="radio-custom" for="payType1">Карта</label>
							</div>
							<div class="pull-left">
								<input type="radio" name="Order[payType]" id="payType2" value="2" checked>
								<label class="radio-custom" for="payType2">Наличные</label>
							</div>
						</div>
						<input type="text" name="Order[oddMoney]" placeholder="Сдача с ..." class="input-text input-130" id="orderOddMOney">
						<div class="line"></div>
						<div class="radio-group-text">Дата и время доставки</div>
						<div class="radiobuttons-group clearfix">
							<div class="pull-left">
								<input type="radio" name="Order[dateType]" id="dateType1" value="1" checked>
								<label class="radio-custom" for="dateType1">Как можно скорее</label>
							</div>
							<div class="pull-left">
								<input type="radio" name="Order[dateType]" id="dateType2" value="2">
								<label class="radio-custom" for="dateType2">К определенному времени</label>
							</div>
						</div>
						<div id="order-time-block" style="display:none;">
							<input type="text" name="Order[date]" placeholder="Дата" class="input-text input-130" id="orderDate">
							<input type="text" name="Order[hour]" placeholder="Часы" class="input-text input-70" style="margin-left:18px;" id="orderHour">
							<input type="text" name="Order[min]" placeholder="Мин" class="input-text input-70" style="margin-left:5px;" id="orderMin">
						</div>
						<div class="line"></div>
						<input type="text" name="Order[personCount]" placeholder="Количество персон" class="input-text input-130" id="orderPersonCount">
						<div class="line"></div>
						<input type="text" name="Order[howKnow]" placeholder="Как узанли про нас" class="input-text input-280">
						<div class="line"></div>
						<textarea class="textarea textarea-280" name="Order[comment]" placeholder="Комментарий к заказу"></textarea>
						<div class="order-edit-container ">
							<a href="javascript:void(0);" class="order-modal-go-to-step-1">Редактрировать заказ</a>
						</div>
						<input type="button" class="order-modal-go-to-step-3" value="Оформить">
					</form>
				</div>
				
				<div class="order-step-content step-3" id="order-modal-content-step3">
					<div class="order-success-headline">Ваш заказ отправлен!</div>
					<div class="order-success-img-container">
						<img src="/img/order-success.png">
					</div>
					<div class="order-success-text">
						Спасибо, что воспользовались службой доставки ресторана «Гости»!<br>
						Ожидайте звонок оператора Call-center для подтверждения
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="clear"></div>
				
			</div>
		</div>
		<div class="clear"></div>
	  </div>
	</div>
  </div>
</div>