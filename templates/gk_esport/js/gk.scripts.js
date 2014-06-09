window.addEvent('domready', function(){
	// smooth anchor scrolling
	new SmoothScroll(); 
	// style area
	if(document.id('gkStyleArea')){
		$$('#gkStyleArea a').each(function(element,index){
			element.addEvent('click',function(e){
	            e.stop();
				changeStyle(index+1);
			});
		});
	}
	// font-size switcher
	if(document.id('gkTools') && document.id('gkComponentWrap')) {
		var current_fs = 100;
		var content_fx = new Fx.Tween(document.id('gkComponentWrap'), { property: 'font-size', unit: '%', duration: 200 }).set(100);
		document.id('gkToolsInc').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs < 150) { 
				content_fx.start(current_fs + 10); 
				current_fs += 10; 
			} 
		});
		document.id('gkToolsReset').addEvent('click', function(e){ 
			e.stop(); 
			content_fx.start(100); 
			current_fs = 100; 
		});
		document.id('gkToolsDec').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs > 70) { 
				content_fx.start(current_fs - 10); 
				current_fs -= 10; 
			} 
		});
	}
	// login popup
	if(document.id('gkPopupLogin') || document.id('gkPopupRegister') || document.id('gkPopupCart')) {
		var popup_overlay = document.id('gkPopupOverlay');
		popup_overlay.setStyles({'display': 'block', 'opacity': '0'});
		popup_overlay.fade('out');

		var opened_popup = null;
		var popup_login = null;
		var popup_login_h = null;
		var popup_login_fx = null;
		var popup_register = null;
		var popup_register_h = null;
		var popup_register_fx = null;
		var popup_cart = null;
		var popup_cart_h = null;
		var popup_cart_fx = null;
		
		if(document.id('gkPopupLogin')) {
			popup_login = document.id('gkPopupLogin');
			popup_login.setStyle('display', 'block');
			popup_login_h = popup_login.getElement('.gkPopupWrap').getSize().y;
			popup_login_fx = new Fx.Morph(popup_login, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0 }); 
			document.id('btnLogin').addEvent('click', function(e) {
				new Event(e).stop();
				popup_overlay.fade(0.45);
				popup_login_fx.start({'opacity':1, 'height': popup_login_h});
				opened_popup = 'login';
				
				(function() {
					if(document.id('modlgn-username')) {
						document.id('modlgn-username').focus();
					}
				}).delay(600);
			});
		}
		
		if(document.id('gkPopupRegister')) {
			popup_register = document.id('gkPopupRegister');
			popup_register.setStyle('display', 'block');
			popup_register_h = popup_register.getElement('.gkPopupWrap').getSize().y;
			popup_register_fx = new Fx.Morph(popup_register, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0 }); 
			document.id('btnRegister').addEvent('click', function(e) {
				new Event(e).stop();
				popup_overlay.fade(0.45);
				popup_register_fx.start({'opacity':1, 'height': popup_register_h});
				opened_popup = 'register';
			});
		}
		
		if(document.id('gkPopupCart')) {
			popup_cart = document.id('gkPopupCart');
			popup_cart.setStyle('display', 'block');
			popup_cart_h = popup_cart.getElement('.gkPopupWrap').getSize().y;
			popup_cart_fx = new Fx.Morph(popup_cart, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0 }); 
			var wait_for_results = true;
			var wait = false;
			var loadingText = document.id('btnCart').getElement('span').innerHTML;
			document.id('btnCart').getElement('span').dispose();
			var baseText = document.id('btnCart').innerHTML;
			
			document.id('btnCart').addEvent('click', function(e) {
				new Event(e).stop();	
				
				if(!wait) {
					new Request.HTML({
						url: $GK_URL + 'index.php?tmpl=cart',
						onRequest: function() {
							document.id('btnCart').innerHTML = loadingText;
							wait = true;
						},
						onComplete: function() {
							var timer = (function() {
								if(!wait_for_results) {
									popup_overlay.fade(0.45);
									popup_cart_fx.start({'opacity':1, 'height': popup_cart_h});
									opened_popup = 'cart';
									wait_for_results = true;
									wait = false;
									clearInterval(timer);
									document.id('btnCart').innerHTML = baseText;
								}
							}).periodical(200);
						},
						onSuccess: function(nodes, xml, text) {
							document.id('gkAjaxCart').innerHTML = text;
							popup_cart.setStyle('display', 'block');
							popup_cart_h = popup_cart.getElement('.gkPopupWrap').getSize().y;
							popup_cart_fx = new Fx.Morph(popup_cart, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0 }); 
							wait_for_results = false;
							wait = false;
						}
					}).send();
				}
			});
			
			if(document.id('gkVmCartSmall')) {
				document.id('gkVmCartSmall').addEvent('click', function(e) {
					new Event(e).stop();	
					
					if(!wait) {
						new Request.HTML({
							url: $GK_URL + 'index.php?tmpl=cart',
							onRequest: function() {
								document.id('gkVmCartSmall').addClass('loading');
								wait = true;
							},
							onComplete: function() {
								var timer = (function() {
									if(!wait_for_results) {
										popup_overlay.fade(0.45);
										popup_cart_fx.start({'opacity':1, 'height': popup_cart_h});
										opened_popup = 'cart';
										wait_for_results = true;
										wait = false;
										clearInterval(timer);
										document.id('gkVmCartSmall').removeClass('loading');
										new Fx.Scroll(window).toTop();
									}
								}).periodical(200);
							},
							onSuccess: function(nodes, xml, text) {
								document.id('gkAjaxCart').innerHTML = text;
								popup_cart.setStyle('display', 'block');
								popup_cart_h = popup_cart.getElement('.gkPopupWrap').getSize().y;
								popup_cart_fx = new Fx.Morph(popup_cart, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0 }); 
								wait_for_results = false;
								wait = false;
							}
						}).send();
					}
				});
			}
		}
		
		popup_overlay.addEvent('click', function() {
			if(opened_popup == 'login')	{
				popup_overlay.fade('out');
				popup_login_fx.start({
					'opacity' : 0,
					'height' : 0
				});
			}
			
			if(opened_popup == 'register') {
				popup_overlay.fade('out');
				popup_register_fx.start({
					'opacity' : 0,
					'height' : 0
				});
			}
			
			if(opened_popup == 'cart')	{
				popup_overlay.fade('out');
				popup_cart_fx.start({
					'opacity' : 0,
					'height' : 0
				});
			}	
		});
	}
	
	if(document.id('gkHiddenCart')) {		
		if(document.id('gkHiddenCart').getElement('.vm_cart_products .container').getChildren().length != 0) {
			document.id('gkVmCartSmall').setProperty('class', 'full');		
		} else {
			document.id('gkVmCartSmall').setProperty('class', 'empty');
		}
		
		(function() {
			if(document.id('gkHiddenCart').getElement('.vm_cart_products .container').getChildren().length != 0) {
				document.id('gkVmCartSmall').setProperty('class', 'full');		
			} else {
				document.id('gkVmCartSmall').setProperty('class', 'empty');
			}
		}).periodical(3000);
	}
});
// function to set cookie
function setCookie(c_name, value, expire) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expire);
	document.cookie=c_name+ "=" +escape(value) + ((expire==null) ? "" : ";expires=" + exdate.toUTCString());
}
// Function to change styles
function changeStyle(style){
	var file1 = $GK_TMPL_URL+'/css/style'+style+'.css';
	var file2 = $GK_TMPL_URL+'/css/typography/typography.style'+style+'.css';
	new Asset.css(file1);
	new Asset.css(file2);
	Cookie.write('gk_eSport_16_style', style, { duration:365, path: '/' });
}