$(document).ready( function() {
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	//Для мобильных
		$('.header-text-line-cart b').after('<br />');
		
		var menuWrap = $('.header-main-menu');
		var banner = $('.main-banner-block');
		$(menuWrap).before('<div class="menuIcon"><i class="fa fa-bars" aria-hidden="true"></i></div>');
		$(menuWrap).before('<div class="clearfix"></div>');
		var menuBtn = $('.menuIcon');
		$(menuBtn).click(function() {
			$(menuWrap).slideToggle();
		})
		
		$('.menu-dish-list-item-img-container > img').attr('src',function(i,e){
		    return e.replace("/229x229/","/500x500/");
		})
		
		$('.mobile .cart-dish-list-item-img-cont > img').attr('src',function(i,e){
		    return e.replace("/90x90/","/229x229/");
		})
		
		//$('.menu-dish-list-item-img-container>img').click(function() {
			var mainParent = $('#dish-modal .model-dish-content-container');
			$('#dish-modal .menu-dish-list-item-price').appendTo(mainParent);
			$('#dish-modal .dish-modal-count-order-block').appendTo(mainParent);
		//})
		
		$('#dish-modal .popur-close').after('<div class="back"></div>');
		//$('.cart-dish-list-item-name').before('<div class="cartInfoWrapper">');
		//$('.cart-dish-price').after('</div>');
		$('#Alert-modal button').click(function() {
			$('#normal-order-modal').css('overflow', 'overlay');
		})
			
	}
})