<?php $this->renderPartial("//layouts/header"); ?>

<div class="small-banner menu-banner">
	Меню
</div>

<div class="wrapper menu-page">

	<div class="middle">

		<div class="contain">
			<div class="content">
				
				<?php echo $content;?>				
				
			</div><!-- .content-->
		</div><!-- .container-->

		<div class="left-sidebar">
			
			<?php echo $this->variables['sectionLeftMenu'] ?>
			
		</div><!-- .left-sidebar -->

	</div><!-- .middle-->

</div><!-- .wrapper -->

<div class="bottom-border"></div>
<?php $this->renderPartial("//layouts/footer"); ?>


<!-- Modal -->
<div class="modal fade" id="dishModal" tabindex="-1" role="dialog" aria-labelledby="dishModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-head">
			<div class="modal-dish-name">Лапша удон с овощами и говядиной</div>
			<div class="close-modal" data-dismiss="modal" aria-hidden="true"></div>
		</div>
		<div class="modal-body clearfix">
			<div class="left-block">
				<img class="modal-dish-img" src="/img/temp/dish-bigl-img-1.jpg">
			</div>
			<div class="right-block">
				<div class="modal-text">
					<div class="modal-dish-text">Морковь, маяш, кит.капуста, сливочное масло, чеснок, лапша удон, лук зеленый, соус ланч, специи. </div>
					<div class="modal-dish-weight"></div>
				</div>
<!-- 				
				<table class="table-dish-param">
					<tr>
						<td colspan="3">Пищевая ценность</td>
					</tr>
					<tr>
						<td></td>
						<td>В 100г.</td>
						<td>Порция</td>
					</tr>
					<tr>
						<td>Белки</td>
						<td><div class="modal-dish-proteins100">310гр.</div></td>
						<td><div class="modal-dish-proteinsAll">310гр.</div></td>
					</tr>
					<tr>
						<td>Жиры</td>
						<td><div class="modal-dish-fats100">310гр.</div></td>
						<td><div class="modal-dish-fatsAll">310гр.</div></td>
					</tr>
					<tr>
						<td>Углеводы</td>
						<td><div class="modal-dish-carbohydrates100">310гр.</div></td>
						<td><div class="modal-dish-carbohydratesAll">310гр.</div></td>
					</tr>
					<tr>
						<td>Калории</td>
						<td><div class="modal-dish-call100">310гр.</div></td>
						<td><div class="modal-dish-callAll">310гр.</div></td>
					</tr>
				</table>
 -->				
				<div class="menu-dish-list-item-actions">
					<div class="menu-dish-list-item-actions-price">
						<div class="menu-dish-list-item-actions-price-num modal-dish-price">150</div>
						руб.
					</div>
					<div class="menu-dish-list-item-actions-count">
						<div class="menu-dish-list-item-actions-count-cirk">1</div>
						<div class="menu-dish-list-item-actions-count-left"></div>
						<div class="menu-dish-list-item-actions-count-right"></div>
						<input type="hidden" class="dish-count" value="1">
					</div>
					
					<div data-target="#dishModal" data-toggle="modal" class="menu-dish-list-item-actions-cart" 
						data-bind="click:function(data, bind) {
									var self = $(bind.currentTarget);
									var count = self.parent().parent().parent().find('.dish-count').val();
									var name = self.parent().parent().parent().find('.dish-name').val();
									var text = '';
									if (self.parent().parent().parent().find('.dish-weight').val() != 0)
										text = self.parent().parent().parent().find('.dish-weight').val() + self.parent().parent().parent().find('.dish-weightType').val();
									var price = self.parent().parent().parent().find('.dish-price').val();
									var id = self.parent().parent().parent().find('.dish-id').val();
				
									addGoods(id,
											name,
											price,
											text,
											count
									);
								}"> 
					</div>
				</div>
				
				<input type="hidden" class="dish-id" value="">
				<input type="hidden" class="dish-name" value="">
				<input type="hidden" class="dish-weight" value="">
				<input type="hidden" class="dish-weightType" value="">
				<input type="hidden" class="dish-text" value="">
				<input type="hidden" class="dish-price" value="">
				<input type="hidden" class="dish-proteins100" value="">
				<input type="hidden" class="dish-proteinsAll" value="">
				<input type="hidden" class="dish-fats100" value="">
				<input type="hidden" class="dish-fatsAll" value="">
				<input type="hidden" class="dish-carbohydrates100" value="">
				<input type="hidden" class="dish-carbohydratesAll" value="">
				<input type="hidden" class="dish-call100" value="">
				<input type="hidden" class="dish-callAll" value="">
				
			</div>
		</div>
    </div>
  </div>
</div>


</body>
</html>