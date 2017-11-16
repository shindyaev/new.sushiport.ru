var product = [];

$(document).ready(function(){

	$(".header-text-line").on("click", ".header-text-line-go-to-cart-disabled", function() {
		return false;
	})
	
	$(".promocode-check").click(function() {
		
		
		$.ajax({
			cache 		: false,
			type 		: 	'POST',
			url			:	'/cart/checkPromo/',
			data		:	{code: $("#normal-order-promo").val()},
			dataType	:	'json',
			success		:	function(response) {
				$("#promo-code-note").html(response);
			},
		})
		
		
	})

	basket_top();
	
	$(document).scroll( function(){
		basket_top();
	});
	
	// Баннер для мобильных устройств
    $.smartbanner({
        layer: true,
        title: 'Доставка СъелБыСам',
        author: 'Serg Shindyaev',
        price: 'FREE',
        appStoreLanguage: 'ru',
        inAppStore: 'В App Store',
        inGooglePlay: 'В Google Play',
        icon: '/img/icon175x175.png',
        button: 'УСТАНОВИТЬ'
    });

	$("#Write_phone").inputmask({"mask": "+7 (999) 999-99-99"});
	$("#CallMe_phone").inputmask({"mask": "+7 (999) 999-99-99"});
	
	
	$(".detailDish").click(function() {
		var dish = $(this).parent();
		$('#number_current_detail_product').val($(dish).index());

		product = [];
		product['id'] = dish.find(".dish-id").eq(0).val();
		product['name'] = dish.find(".dish-name").eq(0).val();
		product['text'] = dish.find(".dish-text").eq(0).val();
		product['price'] = dish.find(".dish-price").eq(0).val();
		product['weight'] = dish.find(".dish-weight").eq(0).val();
		product['ccal'] = dish.find(".dish-ccal").eq(0).val();
		product['weightType'] = dish.find(".dish-weightType").eq(0).val();
		product['hit'] = dish.find(".dish-hit").eq(0).val();
		product['hot'] = dish.find(".dish-hot").eq(0).val();
		product['new'] = dish.find(".dish-new").eq(0).val();
		product['vegan'] = dish.find(".dish-vegan").eq(0).val();
		product['count'] = 1;
		product['rest'] = dish.find(".dish-rest").eq(0).val();

		$("#dish-modal-weight").html('');

		$("#dish-modal-img").attr('src', '/data/menu/dish/500x500/' + product['id'] + '.jpg');
		$("#dish-modal-name").html(product['name']);
		$("#dish-modal-text").html(product['text']);
		$("#dish-modal-price").html(product['price']);
		if (product['weight'])
			$("#dish-modal-weight").html("Вес: " + product['weight'] + ' ' + product['weightType']);
		if (product['ccal'] > 0)
			$("#dish-modal-weight").html($("#dish-modal-weight").html() + "<br />Калорийность: " + product['ccal'] + 'ккал');
		$("#dish-modal .dish-count").val(1);
		$("#dish-modal .count-dish").html(1);

		if (product['hit'] == 1) { $("#dish-modal .hhvn-hit").show();} 
		else { $("#dish-modal .hhvn-hit").hide(); }

		if (product['hot'] == 1) { $("#dish-modal .hhvn-hot").show();} 
		else { $("#dish-modal .hhvn-hot").hide(); }

		if (product['vegan'] == 1) { $("#dish-modal .hhvn-vegan").show();} 
		else { $("#dish-modal .hhvn-vegan").hide(); }

		if (product['new'] == 1) { $("#dish-modal .hhvn-new").show();} 
		else { $("#dish-modal .hhvn-new").hide(); }			

		$("#dish-modal").modal('show');

		$.cookie.json = true;
		var showedDish = $.cookie('showedDish');
		if (!showedDish) {
			showedDish = new Array();
		}
		var find = false;
		for(var i = 0; i < showedDish.length; i++) {
			if (showedDish[i] == product['id']) {
				find = true;
				break;
			}
		}
		if (!find)
			showedDish.push(product['id']);

		if (showedDish.length > 6)
			showedDish.shift();
		            			
		$.cookie('showedDish', showedDish, { expires: 7, path: '/' });
		
	});

	$('.dish-modal-arrow-right').click(function() {
		var ncdp = parseInt( $('#number_current_detail_product').val() );
		var next_ncdp = ncdp + 1;
		if ($(".menu-dish-list-item:eq("+next_ncdp+")").size() == 0) {
			next_ncdp = 0;
		}
		$('#dish-modal-img').attr('src', '');
		$(".menu-dish-list-item:eq("+next_ncdp+") .detailDish").trigger('click');
	});
	$('.dish-modal-arrow-left').click(function() {
		var ncdp = parseInt( $('#number_current_detail_product').val() );
		var next_ncdp = ncdp - 1;
		if ($(".menu-dish-list-item:eq("+next_ncdp+")").size() < 0) {
			next_ncdp = $('.menu-dish-list-item').size();
		}
		$('#dish-modal-img').attr('src', '');
		$(".menu-dish-list-item:eq("+next_ncdp+") .detailDish").trigger('click');
	});

	$(".count-dish-block .plus").click(function() {
		var count = parseInt($(this).parent().find(".dish-count").eq(0).val());
		count ++;
		$(this).parent().find(".dish-count").eq(0).val(count);
		$(this).parent().find(".count-dish").html(count);
	})

	$(".count-dish-block .minus").click(function() {
		var count = parseInt($(this).parent().find(".dish-count").eq(0).val());
		count --;
		if (count == 0)
			return;
		$(this).parent().find(".dish-count").eq(0).val(count);
		$(this).parent().find(".count-dish").html(count);
	})

	$(".other-dish-block-menu-list").click(function() {
		var id = $(this).attr("rel");
		$(".other-dish-block-dish-list").hide();
		$(".other-dish-block-menu-list").removeClass("active");
		$(this).addClass('active');
		$("#"+id).show();
	})

	$('.add-to-like-block').on('click', '.add-to-like', function(){
		var _this = $(this);
		$.ajax({
			cache 		: false,
			type 		: 	'POST',
			url			:	'/menu/addToLike/',
			data		:	{dishId : $(this).attr('rel')},
			dataType	:	'json',
			success		:	function(response) {
					_this.html('Удалить из Моего меню').addClass('remove-to-like').removeClass('add-to-like');
			},
		})
		return false;
	})

	$('.add-to-like-block').on('click', '.remove-to-like', function(){
		var _this = $(this);
		$.ajax({
			cache 		: false,
			type 		: 	'POST',
			url			:	'/menu/removeToLike/',
			data		:	{dishId : $(this).attr('rel')},
			dataType	:	'json',
			success		:	function(response) {
					_this.html('Добавить в Мое меню').removeClass('remove-to-like').addClass('add-to-like');
			},
		})
		return false;
	})
	
	
	
	$(".milimon-action-list-item").click(function() {
		var rel = $(this).attr("rel");
		
		$(".milimon-action-list-item").removeClass("active");
		$(this).addClass("active");
		
		$(".milimon-action-content-item").removeClass("active");
		$(".milimon-action-content-item-"+rel).addClass("active");		
		
	})
	
	
});


var Info = function(text) {
	$("#Info-modal-content").html(text);
	var modal = $("#Info-modal").modal();
	var info_modal_timer = setTimeout(
		function() {
			$("#Info-modal").modal('hide');
		}
		, 1500
	);

	// При наведение сбрасывает таймер и модальное окно остаётся
	//$("#Info-modal").hover(function() {
	//	clearTimeout(info_modal_timer);
	//});
};

var Alert = function(text) {
	$("#Alert-modal-content").html(text);
	$("#Alert-modal").modal();
}

basket_top = function() {
	var new_top = 56 - parseInt($(document).scrollTop());
	if(new_top < 0) new_top = 0;
	$('#cart').css('top', new_top);
} 

function contentAfterAjaxValidate (form, data, hasError) {
	$('#'+form.context.id).find('.control-group.error').removeClass('error');

	if (hasError) {
		for (var key in data) {
			$('#'+form.context.id).find('#'+key).parent().parent().addClass('error');
		}
		return false;
	}
	
	window.location = form.attr('rel');
}

function contentAfterEmailAddValidate (form, data, hasError) {
	$('#'+form.context.id).find('.control-group.error').removeClass('error');

	if (hasError) {
		for (var key in data) {
			Alert(data[key]);
		}
		return false;
	}
	
	$("#email-form")[0].reset();
	Alert('Спасибо. Вы подписаны на рассылку!');	
}

function contentAfterWriteUsValidate (form, data, hasError) {
	$('#'+form.context.id).find('.control-group.error').removeClass('error');

	if (hasError) {
		for (var key in data) {
			$('#'+form.context.id).find('#'+key).parent().parent().addClass('error');
		}
		return false;
	}
	$("#Write-modal").modal('hide');
	$("#writeus-form")[0].reset();
	Alert('Ваше сообщение отправлено!');	
}

function contentAfterCallMeValidate (form, data, hasError) {
	$('#'+form.context.id).find('.control-group.error').removeClass('error');

	if (hasError) {
		for (var key in data) {
			$('#'+form.context.id).find('#'+key).parent().parent().addClass('error');
		}
		return false;
	}
	$("#call-me-modal").modal('hide');
	$("#callme-form")[0].reset();
	Alert('Ваше сообщение отправлено!');	
}

function contentAfterBookTableValidate (form, data, hasError) {
	$('#'+form.context.id).find('.control-group.error').removeClass('error');

	if (hasError) {
		for (var key in data) {
			$('#'+form.context.id).find('#'+key).parent().parent().addClass('error');
		}
		return false;
	}
	$("#book-table-modal").modal('hide');
	$("#booktable-form")[0].reset();
	Alert('Столик забронирован!');	
}
