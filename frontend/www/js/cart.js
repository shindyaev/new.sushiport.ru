var cart = false;
$(document).ready(function() {
	// Class to represent a row in the seat reservations grid
	function Goods(product) {
		var self = this;
		
		var rests = ['', 'Бенджамин', 'СъелБыСам', 'OMNI Чайхана', 'Кембридж'];
		
		self.id = product['id'];
		self.name = product['name'];
		self.price = parseInt(product['price']);
		self.count = ko.observable(product['count']);
		self.text = product['text'];
		self.is_gift = (typeof product['is_gift'] !== 'undefined') ? product['is_gift'] : false;
		self.weight = parseInt(product['weight']);
		self.weightType = product['weightType'];
		self.rest = product['rest'];
		
		self.fullPrice = ko.computed(function() {
			return self.price * self.count();
		})
		
		self.fullPriceRZ = ko.computed(function() {
			var total = self.fullPrice() + '';
			total = total.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
			return total;
		})
		
		self.restName = ko.computed(function() {
			return rests[self.rest];
		})
		
		self.img = ko.computed(function() {
			return "/data/menu/dish/90x60/" + self.id + ".jpg";			
		})

		self.addGoodsCount = function (count) {
			self.count = ko.observable(parseInt(self.count()) + parseInt(count));
		}
	}
	
	// Overall viewmodel for this screen, along with initial state
	function CartViewModel() {
	    var self = this;
	
	    // Editable data
	    self.cartItems = ko.observableArray([]);

		self.tmp_added_product = null;

		self.add_to_cart_error = $("#add-to-cart-error");

	    self.load = function() {
            if ($.jStorage.get('cart') !== null) {
	    		var goods = JSON.parse($.jStorage.get('cart'));
	    		for (var i = 0; i < goods.length; i++) {
	    			var tm = [];
	    			
	    			tm['id'] = goods[i].id;
	    			tm['name'] = goods[i].name;
	    			tm['price'] = goods[i].price;
	    			tm['text'] = goods[i].text;
	    			tm['count'] = goods[i].count;
	    			tm['weight'] = goods[i].weight;
	    			tm['weightType'] = goods[i].weightType;
	    			tm['rest'] = goods[i].rest;
					tm['is_gift'] = (typeof goods[i].is_gift !== 'undefined') ? goods[i].is_gift : false;

	    			self.cartItems.push(new Goods(tm));
	    		}
	    	}

			self.add_to_cart_error.on('hide', function () {
				self.tmp_added_product = null;
			}.bind(self));

	    }
	    
	    self.load();
	    
	    self.save = function() {
	    	var data = [];
	    	var cart = self.cartItems();
	    	
	    	for (var i = 0; i < cart.length; i++) {
	    		data[i] = new Object;
	    		data[i].id = cart[i].id;
	    		data[i].name = cart[i].name;
	    		data[i].price = cart[i].price;
	    		data[i].count = cart[i].count();
	    		data[i].text = cart[i].text;
	    		data[i].weight = cart[i].weight;
	    		data[i].weightType = cart[i].weightType;
	    		data[i].rest = cart[i].rest;
				data[i].is_gift = (typeof cart[i].is_gift !== 'undefined') ? cart[i].is_gift : false;
	    	}
	    	var jsonCart = JSON.stringify(data);
	
	    	$.jStorage.set('cart', jsonCart);
	    }
	    
	    self.addGoods = function(product) {
			
			var cart = self.cartItems();

			if (cart.length > 0 && cart[0].rest != product.rest) {
				self.tmp_added_product = product;
				self.add_to_cart_error.modal();
			} else {
				if ($goods = self.getGoodsFromCartById(product['id'])){
					$goods.addGoodsCount(product['count']);
				} else {
					self.cartItems.push(new Goods(product));
				}
				self.save();
				Info("Товар добавлен в корзину!");
			}
	    };

		self.getGoodsFromCartById = function(product_id){
			for(var i = 0; i < self.cartItems().length; i++)
			{
				if(self.cartItems()[i].id == product_id){
					 return self.cartItems()[i];
				}
			}
			return false;
		};

	    self.removeGoods = function(goods) {
			var id = goods['id'];
	    	self.cartItems.remove(goods);
	    	self.save();
			$.ajax({
				url: '/sailplay/RemoveGift/',
				data: {sku:id}
			});
	    };

	    self.removeAllGoods = function() {
	    	for (var i = self.cartItems().length - 1; i > -1; i--) {
	    		self.cartItems.remove(self.cartItems()[i]);
	    	}

	    	self.save();

			if (self.tmp_added_product) {
				self.addGoods(self.tmp_added_product);
			}
	    }
	    
	    self.totalPrice = ko.computed(function() {
	       var total = 0;
	       for (var i = 0; i < self.cartItems().length; i++)
	           total += self.cartItems()[i].fullPrice();
	       return total;
	    });
	    
	    self.totalPriceRZ = ko.computed(function() {
	       var total = self.totalPrice() + '';
	       total = total.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
	       return total;
	    });
	    
	    self.totalCount = ko.computed(function() {
	    	var total = 0;
	       for (var i = 0; i < self.cartItems().length; i++)
	           total += parseInt(self.cartItems()[i].count());
	       return parseInt(total);
	    });
	    
	    self.totalCountText = ko.computed(function() {
	    	var count = self.totalCount();
	    	var textCount = '';
	    	if ((count > 4 && count < 21) ||
					count % 10 == 0 || 
					(count % 10 >= 5 && count % 10 <= 9))
	    			textCount = "товаров";
				else if(count % 10 == 1 )
					textCount = "товар";
				else if(count % 10 >= 2 && count % 10 <= 4)
					textCount = "товара";
	    	
		    return textCount;
		});
		
		self.delivPrice = ko.computed(function() {
			if (self.totalPrice() < 700)
				return 150;
			
			return 0; 
		});
		
		self.workRestStyle = ko.computed(function() {
			
			var cart = self.cartItems();
			if(cart.length > 0) {
				var rst = cart[0].rest;
				
				if (restorans[rst] == 0) {
					
					$("#normal-order-delivery-2").parent().find("label").click();
					$("#normal-order-delivery-1").parent().remove();
					
					return 0;
				}
			} else {
				return 0;
			}
			
			return 1;
		});
		
		self.restLink = ko.computed(function() {
			
			var cart = self.cartItems();
			if(cart.length > 0) {
				var rst = cart[0].rest;
				
				return '/menu/' + rst + '/';
			} else {
				return '/rest/';
			}
			
			return '/rest/';
		});
		
		self.cartId = ko.computed(function() {
			
			var cart = self.cartItems();
			if(cart.length > 0) {
				var rst = cart[0].rest;
				
				return rst;
			} else {
				return 0;
			}
			
			return 0;
		});
		
		self.cartClass = ko.computed(function() {
			
			var cart = self.cartItems();
			if(cart.length > 0) {
				return 'header-text-line-go-to-cart';
			} else {
				return 'header-text-line-go-to-cart header-text-line-go-to-cart-disabled';
			}
		});
		
	}
	
	cart = new CartViewModel()
	ko.applyBindings(cart);
});


/*Sailplay data
 {
 eventName: 'gift',
 gift: {
 gift_sku: артикул подарка,
 gift_type: тип подарка: gift || coupon,
 points_delta: потраченные балы,
 gift_public_key: публичный ключ транзакции выдачи подарка
 }
 }
 */
function SPready(SP) {
	SP.events.subscribe('gift', function (data) {
		//if (data['eventName']=='gift' && data['gift']['gift_type'] == 'gift' && data['gift']['gift_sku']) {
		//	alert('Всетаки есть это собыите SP.events.subscribe(\'gift\', function (data){})');
		//}
		$.ajax({
			url: '/Session/GetSessionData/',
			data: {session_data:'sailplay_gifts'}
		}).done(function (data) {
			if (data['sailplay_gifts']) {
				$.each(data['sailplay_gifts'], function(key, value){
					if (!cart.getGoodsFromCartById(value['id'])) {
						cart.addGoods(value)
					}
				});
			}
		});
	});

	SP.bindCallback('afterPopupClose', function(){
		//$.ajax({
		//	url: '/Session/GetSessionData/',
		//	data: {session_data:'sailplay_gifts'}
		//}).done(function (data) {
		//	if (data['sailplay_gifts']) {
		//		$.each(data['sailplay_gifts'], function(key, value){
		//			if (!cart.getGoodsFromCartById(value['id'])) {
		//				cart.addGoods(value)
		//			}
		//		});
		//	}
		//});

	});

}
