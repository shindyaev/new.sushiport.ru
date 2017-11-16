<div class="cart">
	<div class="cart-headline">ВАШ ЗАКАЗ</div>
	<div class="order-list">

		<div data-bind="foreach: cartItems">
			<div class="order-list-item clearfix">
				<div class="name" data-bind="text: fullName"></div>
				<div class="price">
					<b data-bind="text: fullPrice"></b> руб.
				</div>
				<div class="remove" data-bind="click: $root.removeGoods">X</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="order-list-item result clearfix">
			<div class="name">ИТОГО</div>
			<div class="price">
				<b data-bind="text: totalPrice()">0</b> руб.
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<input type="button" class="btn" value="Заказать" id="show-order-form">							
</div>