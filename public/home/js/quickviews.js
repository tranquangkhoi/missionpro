window.dqdt = window.dqdt || {};
dqdt.init = function () {
	dqdt.showPopup();
	dqdt.hidePopup();	
};

/********************************************************
# Quickview
********************************************************/
initQuickView();
var product = {};
var currentLinkQuickView = '';
var option1 = '';
var option2 = '';
function setButtonNavQuickview() {
	$("#quickview-nav-button a").hide();
	$("#quickview-nav-button a").attr("data-index", "");
	var listProducts = $(currentLinkQuickView).closest(".slide").find("a.quick-view");
	if(listProducts.length > 0) {
		var currentPosition = 0;
		for(var i = 0; i < listProducts.length; i++) {
			if($(listProducts[i]).data("handle") == $(currentLinkQuickView).data("handle")) {
				currentPosition = i;
				break;
			}
		}
		if(currentPosition < listProducts.length - 1) {
			$("#quickview-nav-button .btn-next-product").show();
			$("#quickview-nav-button .btn-next-product").attr("data-index", currentPosition + 1);
		}
		if(currentPosition > 0) {
			$("#quickview-nav-button .btn-previous-product").show();
			$("#quickview-nav-button .btn-previous-product").attr("data-index", currentPosition - 1);
		}
	}
	$("#quickview-nav-button a").click(function() {
		$("#quickview-nav-button a").hide();
		var indexLink = parseInt($(this).data("index"));
		if(!isNaN(indexLink) && indexLink >= 0) {
			var listProducts = $(currentLinkQuickView).closest(".slide").find("a.quick-view");
			if(listProducts.length > 0 && indexLink < listProducts.length) {
				//$(".quickview-close").trigger("click");
				$(listProducts[indexLink]).trigger("click");
			}
		}
	});
}
function initQuickView(){
	$(document).on("click", "#thumblist_quickview li", function() {
		changeImageQuickView($(this).find("img:first-child"), ".product-featured-image-quickview");
	});
	$(document).on('click', '.quick-view', function(e) {
		e.preventDefault();
		
		dqdt.showPopup('.loading');
		
		var producthandle = $(this).data("handle");
		currentLinkQuickView = $(this);
		Bizweb.getProduct(producthandle,function(product) {
			console.log(product);
			var qvhtml = $("#quickview-modal").html();
			$(".quick-view-product").html(qvhtml);
			var quickview= $(".quick-view-product");
			var productdes = product.content.replace(/(<([^>]+)>)/ig,"");
			var featured_image = product.featured_image;
			var addTocart = (".quantity_wanted_p .btn_muahang");
			var addText = (".quantity_wanted_p .btn_muahang .text_buy");
			var giamgiaphantram = Math.round(100*(product.compare_at_price_min - product.price)/product.compare_at_price_min);

			// Reset current link quickview and button navigate in Quickview
			setButtonNavQuickview();
			productdes = productdes.split(" ").splice(0,60).join(" ");	
			if(featured_image != null){
				quickview.find(".view_full_size img").attr("src",featured_image);
			}


			quickview.find(".product-item").attr("id", "product-" + product.id);
			quickview.find(".variants").attr("id", "product-actions-" + product.id);
			quickview.find(".variants select").attr("id", "product-select-" + product.id);

			//console.log(" product id : " + product.id);
			quickview.find(".qwp-name").html('<a href="'+ product.alias +'" title="'+product.name+'">'+product.name +'</a>');
			quickview.find(".product-description .more_link").append('<a href="'+ product.alias +'" title="Xem chi tiết sản phẩm này">...Xem chi tiết</a>');
			quickview.find(".reviews .bizweb-product-reviews-badge").attr("data-id",product.id);
			if(product.vendor){
				quickview.find(".brand").append(""+product.vendor);
				quickview.find(".tags_name").append("<b>|&nbsp;</b>" + product.tags );
			}else{
				quickview.find(".brand").append("Không có");
				quickview.find(".tags_name").append("<span>|&nbsp;Không có tags</span>");
			}


			if(product.available){
				quickview.find(".availability").append("<b>&nbsp;Tình trạng: </b>Còn hàng");
			}else{                            
				quickview.find(".availability").append("<b>&nbsp;Tình trạng: </b>̀Hết hàng");
			}
			if(product.variants[0].sku){
				quickview.find(".product-sku").append("<b>Mã sản phẩm: </b>"+product.variants[0].sku);
			}else{
				quickview.find(".product-sku").append(" ");
			}
			quickview.find(".product-description .ct_pr").text(productdes);




			var variant = product.variants;
			console.log(variant);
			
			if(product.available){
				
					if (product.price_min < 1){
						quickview.find(".btn_muahang").removeClass('ajax_addtocart').attr('disabled', 'disabled');
						quickview.find(addText).html("Liên hệ");
						quickview.find(".on_sale").css("display", "none");
					}
					else if (product.compare_at_price_min > product.price_min) {
						quickview.find(".price-box .special-price .price").html(Bizweb.formatMoney(product.price_min, "{{amount_no_decimals_with_comma_separator}}đ"));
						quickview.find(".price-box .old-price .price").html(Bizweb.formatMoney(product.compare_at_price_min, "{{amount_no_decimals_with_comma_separator}}đ")).show();
						quickview.find(".sale_label .price_sale").html("-" + giamgiaphantram + "%");
						quickview.find(".on_sale").css("display", "block");
						quickview.find(".btn_muahang").addClass('ajax_addtocart').removeAttr('disabled', 'disabled');
						quickview.find(addText).html("Mua hàng");
					}
					else {
						quickview.find(".price-box .special-price .price").html(Bizweb.formatMoney(product.price_min, "{{amount_no_decimals_with_comma_separator}}đ"));
						quickview.find(".btn_muahang").addClass('ajax_addtocart').removeAttr('disabled', 'disabled');
						quickview.find(addText).html("Mua hàng");
						quickview.find(".on_sale").css("display", "none");
					}
				
				
			}else {
			quickview.find(".on_sale").css("display", "none");
			}
			


			quickview.find( ".sale_label:contains('-0%')" ).html( "-1%" ).css("padding", "5px");
			quickview.find( ".sale_label:contains('-100%')" ).html( "-99%" ).css("padding", "5px");






			if (!product.available) {
				quickview.find("select, input, .dec, .inc, .variants label").remove();
				quickview.find(".add_to_cart_detail").text("Unavailable").addClass("disabled").attr("disabled", "disabled");
				$(".quantity_wanted_p").css("display", "none");
			}
			else {
				quickViewVariantsSwatch(product, quickview);
				$(".quantity_wanted_p").removeAttr("style");
			}
			quickview.find('.more_info_block .page-product-heading li:first, .more_info_block .tab-content section:first').addClass('active');

			$("#quick-view-product").fadeIn(500);

			$(".view_scroll_spacer").removeClass("hidden");

			loadQuickViewSlider(product, quickview);

			//initQuickviewAddToCart();

			$(".quick-view").fadeIn(500);
			if ($(".quick-view .total-price").length > 0) {
				$(".quick-view input[name=quantity]").on("change", updatePricingQuickView)
			}
			updatePricingQuickView();
			// Setup listeners to add/subtract from the input
			$(".js-qty__adjust").on("click", function() {
				var el = $(this),
					id = el.data("id"),
					qtySelector = el.siblings(".js-qty__num"),
					qty = parseInt(qtySelector.val().replace(/\D/g, ''));

				var qty = validateQty(qty);

				// Add or subtract from the current quantity
				if (el.hasClass("js-qty__adjust--plus")) {
					qty = qty + 1;
				} else {
					qty = qty - 1;
					if (qty <= 1) qty = 1;
				}

				// Update the input's number
				qtySelector.val(qty);
				updatePricingQuickView();
			});
			$(".js-qty__num").on("change", function() {
				updatePricingQuickView();
			});
		});
		return false;
	});

}
function loadQuickViewSlider(n, r) {
	productImage();
	var loadingImgQuickView = $('.loading-imgquickview');
	var s = Bizweb.resizeImage(n.featured_image, "grande");
	r.find(".quickview-featured-image").append('<a href="' + n.url + '"><img src="' + s + '" title="' + n.title + '"/><div style="height: 100%; width: 100%; top:0; left:0 z-index: 2000; position: absolute; display: none; background: url(' + window.loading_url + ') 50% 50% no-repeat;"></div></a>');
	if (n.images.length > 0) {
		var o = r.find(".more-view-wrapper ul");
		for (i in n.images) {
			var u = Bizweb.resizeImage(n.images[i], "grande");
			var a = Bizweb.resizeImage(n.images[i], "compact");
			var f = '<li><a href="javascript:void(0)" data-imageid="' + n.id + '" data-image="' + n.images[i] + '" data-zoom-image="' + u + '" ><img src="' + u + '" alt="Proimage" /></a></li>';
			o.append(f)
		}
		o.find("a").click(function() {
			var t = r.find("#product-featured-image-quickview");
			if (t.attr("src") != $(this).attr("data-image")) {
				t.attr("src", $(this).attr("data-image"));
				loadingImgQuickView.show();
				t.load(function(t) {
					loadingImgQuickView.hide();
					$(this).unbind("load");
					loadingImgQuickView.hide()
				})
			}
		});
		o.owlCarousel({
			navigation: true,
			items: 3,
			margin:10,
			itemsDesktop: [1199, 3],
			itemsDesktopSmall: [979, 3],
			itemsTablet: [768, 3],
			itemsTabletSmall: [540, 3],
			itemsMobile: [360, 3]
		}).css("visibility", "visible")
	} else {        
		r.find(".quickview-more-views").remove();
		r.find(".quickview-more-view-wrapper-jcarousel").remove()
	}
}
function quickViewVariantsSwatch(t, quickview) {
	var v = '<input type="hidden" name="id" value="' + t.id + '">';
	quickview.find("form.variants").append(v);
	if (t.variants.length > 1) {
		for (var r = 0; r < t.variants.length; r++) {
			var i = t.variants[r];
			var s = '<option value="' + i.id + '">' + i.title + "</option>";
			quickview.find("form.variants > select").append(s)
		}
		var ps = "product-select-" + t.id;
		new Bizweb.OptionSelectors( ps, { 
			product: t, 
			onVariantSelected: selectCallbackQuickView
		});
		if (t.options.length == 1) {
			$(".selector-wrapper:eq(0)").prepend("<label>" + t.options[0].name + "</label>")
		}
		quickview.find("form.variants .selector-wrapper label").each(function(n, r) {
			$(this).html(t.options[n].name)
		})
	}
	else {
		quickview.find("form.variants > select").remove();
		var q = '<input type="hidden" name="variantId" value="' + t.variants[0].id + '">';
		quickview.find("form.variants").append(q);
	}
}
function productImage() {
	$('#thumblist').owlCarousel({
		navigation: true,
		items: 4,
		itemsDesktop: [1199, 4],
		itemsDesktopSmall: [979, 4],
		itemsTablet: [768, 4],
		itemsTabletSmall: [540, 4],
		itemsMobile: [360, 4]
	});

	
}
function updatePricingQuickView() {

	//Currency.convertAll(window.shop_currency, $("#currencies a.selected").data("currency"), "span.money", "money_format")

	var regex = /([0-9]+[.|,][0-9]+[.|,][0-9]+)/g;
	var unitPriceTextMatch = jQuery('.quick-view-product .price').text().match(regex);
	if (!unitPriceTextMatch) {
		regex = /([0-9]+[.|,][0-9]+)/g;
		unitPriceTextMatch = jQuery('.quick-view-product .price').text().match(regex);
	}
	if (unitPriceTextMatch) {
		var unitPriceText = unitPriceTextMatch[0];
		var unitPrice = unitPriceText.replace(/[.|,]/g,'');
		var quantity = parseInt(jQuery('.quick-view-product input[name=quantity]').val());
		var totalPrice = unitPrice * quantity;
		var totalPriceText = Bizweb.formatMoney(totalPrice, "{{amount_no_decimals_with_comma_separator}}₫" );
		totalPriceText = totalPriceText.match(regex)[0];
		var regInput = new RegExp(unitPriceText, "g");
		var totalPriceHtml = jQuery('.quick-view-product .price').html().replace(regInput ,totalPriceText);
		jQuery('.quick-view-product .total-price span').html(totalPriceHtml);
	}
}
$(document).on('click', '.quickview-close, #overlay, .quickview-overlay', function(e){
	$("#quick-view-product").fadeOut(0);
	dqdt.hidePopup('.loading');
});



	



/********************************************************
# Offcanvas menu
********************************************************/


/********************************************************
# Slider */

/********************************************************


/********************************************************
# Dropdown
********************************************************/


/********************************************************
# Tab
********************************************************/



/********************************************************
# SHOW NOITICE
********************************************************/
dqdt.showNoitice = function (selector) {   
	$(selector).animate({right: '0'}, 500);
	setTimeout(function() {
		$(selector).animate({right: '-300px'}, 500);
	}, 3500);
};

/********************************************************
# SHOW LOADING
********************************************************/
dqdt.showLoading = function (selector) {    
	var loading = $('.loader').html();
	$(selector).addClass("loading").append(loading);  
}

/********************************************************
# HIDE LOADING
********************************************************/
dqdt.hideLoading = function (selector) {  
	$(selector).removeClass("loading"); 
	$(selector + ' .loading-icon').remove();
}


/********************************************************
# SHOW POPUP
********************************************************/
dqdt.showPopup = function (selector) {
	$(selector).addClass('active');
};

/********************************************************
# HIDE POPUP
********************************************************/
dqdt.hidePopup = function (selector) {
	$(selector).removeClass('active');
}


/************************************************/
$(document).on('click',' #overlay, .close-popup', function() {   
	dqdt.hidePopup('.dqdt-popup'); 
	setTimeout(function(){
		$('.loading').removeClass('loaded-content');
	},500);
	return false;
})









/* top search */

$('.search_text').click(function(){
	$(this).next().slideToggle(200);
	$('.list_search').show();
})

$('.list_search .search_item').on('click', function (e) {
	$('.list_search').hide();

	var optionSelected = $(this);

	/*
  var id = optionSelected.attr('data-coll-id');
  var handle = optionSelected.attr('data-coll-handle');
  var coll_name = optionSelected.attr('data-coll-name');
  */

	var title = optionSelected.text();
	//var filter = '(collectionid:product' + (id == 0 ? '>=0' : ('=' + id)) + ')';


	//console.log(coll_name);
	$('.search_text').text(title);
	var h = $(".collection-selector").width() + 10;

	$('.site-header form input').css('padding-left',h + 'px');

	/*
  $('.ultimate-search .collection_id').val(filter);
  $('.ultimate-search .collection_handle').val(handle);
  $('.ultimate-search .collection_name').val(coll_name);
  */

	$(".search-text").focus();
	optionSelected.addClass('active').siblings().removeClass('active');
	//console.log($('.kd_search_text').innerWidth());


	//$('.list_search').slideToggle(0);

	/*
  sessionStorage.setItem('last_search', JSON.stringify({
    title: title,
    handle: handle,
    filter: filter,
    name: coll_name
  }));
  */  
});


$('.header_search form button').click(function(e) {
	e.preventDefault();
	searchCollection();
	setSearchStorage('.header_search form');
});

$('#mb_search').click(function(){
	$('.mb_header_search').slideToggle('fast');
});

$('.fi-title.drop-down').click(function(){
	$(this).toggleClass('opentab');
});



function searchCollection() {
	var collectionId = $('.list_search .search_item.active').attr('data-coll-id');
	var searchVal = $('.header_search input[type="search"]').val();
	var url = '';
	if(collectionId == 0) {
		url = '/search?q='+ searchVal;
	}
	else {
		url = '/search?q=collections:'+ collectionId +' AND name:' + searchVal;
		/*
    if(searchVal != '') {
      url = '/search?type=product&q=' + searchVal + '&filter=(collectionid:product=' + collectionId + ')';
    }
    else {
      url = '/search?type=product&q=filter=(collectionid:product=' + collectionId + ')';
    }
    */
	}
	window.location=url;
}


/*** Search Storage ****/

function setSearchStorage(form_id) {
	var seach_input = $(form_id).find('.search-text').val();
	var search_collection = $(form_id).find('.list_search .search_item.active').attr('data-coll-id');
	sessionStorage.setItem('search_input', seach_input);
	sessionStorage.setItem('search_collection', search_collection);
}
function getSearchStorage(form_id) {
	var search_input_st = ''; // sessionStorage.getItem('search_input');
	var search_collection_st = ''; // sessionStorage.getItem('search_collection');
	if(sessionStorage.search_input != '') {
		search_input_st = sessionStorage.search_input;
	}
	if(sessionStorage.search_collection != '') {
		search_collection_st = sessionStorage.search_collection;
	}
	$(form_id).find('.search-text').val(search_input_st);
	$(form_id).find('.search_item[data-coll-id="'+search_collection_st+'"]').addClass('active').siblings().removeClass('active');
	var search_key = $(form_id).find('.search_item[data-coll-id="'+search_collection_st+'"]').text();
	if(search_key != ''){
		$(form_id).find('.collection-selector .search_text').text(search_key);
	}
	//$(form_id).find('.search_collection option[value="'+search_collection_st+'"]').prop('selected', true);
}
function resetSearchStorage() {
	sessionStorage.removeItem('search_input');
	sessionStorage.removeItem('search_collection');
}
$(window).load(function() {
	getSearchStorage('.header_search form');
	resetSearchStorage();
	var h = $(".collection-selector").width() + 10;
	$('.site-header form input').css('padding-left',h + 'px');

	$('.product-box .product-thumbnail a img').each(function(){
		var t1 = (this.naturalHeight/this.naturalWidth);
		var t2 = ($(this).parent().height()/$(this).parent().width());
		if(t1< t2){
			$(this).addClass('bethua');
		}
		var m1 = $(this).height();
		var m2 = $(this).parent().height();
		if(m1 < m2){
			$(this).css('padding-top',(m2-m1)/2 + 'px');
		}
	});

	$('.bot-header-left').mouseover(function(e){
		$('.catogory-other-page').addClass('active');
	})

	$('body').mouseover(function(event) {
		if (!$(event.target).closest('.bot-header-left').length && !$(event.target).closest('.catogory-other-page').length){
			$('.catogory-other-page').removeClass('active');
		};
	});



});