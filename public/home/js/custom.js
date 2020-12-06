//MAGNIFIC POPUP
$(document).ready(function() {
  $('.images-block').magnificPopup({
    delegate: 'a', 
    type: 'image',
    gallery: {
      enabled: true
    }
  });
});

function get_total(type){
    $.post(UrlDomain + "giohang/get_total",{
        type  : type
    },function(data){
       if(type=='1'){
          $( "#cart-total").html(data);
       }
       if(type=='2'){
          $( "#total_money").html(data+' VNĐ');
       }
    });
}

function tocart(id,qt,type='1'){
    var cart = $('.shopping-cart');
    if (type=='1'){
        var imgtodrag = $('#p'+id).find("img").eq(0);
    }
    if (type=='2'){
        var imgtodrag = $('#pn'+id).find("img").eq(0);
    }
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
        .offset({
            top: imgtodrag.offset().top,
            left: imgtodrag.offset().left
        })
        .css({
            'opacity': '0.5',
            'position': 'absolute',
            'height': '150px',
            'width': '150px',
            'z-index': '100'
        })
        .appendTo($('body'))
        .animate({
            'top': cart.offset().top + 10,
            'left': cart.offset().left + 10,
            'width': 75,
            'height': 75
        }, 1000, 'swing');
        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach()
        });
    }
    $.post(UrlDomain + "giohang/addcart",{
        id  : id
        ,quantity: qt
    },function(data){
       if(data){
           var msg = '<span style="color:#3c763d; font-size:30px; font-weight:bold;" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>  Bạn đã thêm sản phẩm vào giỏ hàng';
           $("#success").html(msg).fadeIn().delay(2000).fadeOut();
           get_total('2');
           get_total('1');
           get_short_cart();
       }else{
           var msg = '<span style="color:#3c763d; font-size:30px; font-weight:bold;" ><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></span>  Không thêm sản phẩm được vào giỏ hàng. Error ';
           $("#success").html(msg).fadeIn().delay(2000).fadeOut();           
       }
    });
}

function tocart2(id,qt) {
    var cart = $('.shopping-cart');
    var imgtodrag = $('#p'+id).find("img").eq(0);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
        .offset({
            top: imgtodrag.offset().top,
            left: imgtodrag.offset().left
        })
        .css({
            'opacity': '0.5',
            'position': 'absolute',
            'height': '150px',
            'width': '150px',
            'z-index': '100'
        })
        .appendTo($('body'))
        .animate({
            'top': cart.offset().top + 10,
            'left': cart.offset().left + 10,
            'width': 75,
            'height': 75
        }, 1000, 'easeInOutExpo');
                
        setTimeout(function () {
            cart.effect("shake", {
                times: 2
            }, 200);
        }, 1500);
    
        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach()
        });
    }

    $.post(UrlDomain + "giohang/addcart",{
        id  : id
        ,quantity: qt
    },function(data){
       if(data){
           var msg = '<span style="color:#3c763d; font-size:30px; font-weight:bold;" class="glyphicon glyphicon-thumbs-up"></span> Bạn đã thêm sản phẩm vào giỏ hàng';
           $("#success").html(msg).fadeIn().delay(2000).fadeOut();
           get_total('2');
           get_total('1');    
           get_short_cart();
           window.location.href = UrlDomain + "/order.html";
       }else{
           var msg = '<span style="color:#3c763d; font-size:30px; font-weight:bold;" class="glyphicon glyphicon-remove-circle"></span> Không thêm sản phẩm được vào giỏ hàng. Error ';
           $("#success").html(msg).fadeIn().delay(2000).fadeOut();
       }
    });        
}

function addtocart(idsp, t) {
    var cart = $('.cart-image');
    var imgtodrag = $('#box' + idsp + t + '').find("img").eq(0);
    if (imgtodrag) {
        var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'max-height': '322px',
                    'max-width': '322px',
                    'z-index': '100'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
                }, 1000, 'easeInOutExpo');

        setTimeout(function () {
            cart.effect("shake", {
                times: 2
            }, 200);
        }, 1500);

        imgclone.animate({
            'width': 0,
            'height': 0
        }, function () {
            $(this).detach()
        });
    }
    
    jQuery.ajax({
        type: "POST",
        url: "" + UrlDomain + "giohang/addcart",
        data: "{'ID':'" + id + "','quantity':'1'}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
           
           /*
            var product = response.d;
            if (product != "") {
                alert(product);
            }
            else {
                GetCart();
                GetListCart();
                jQuery("#shopping-cart").removeClass("shopping-cart");
                jQuery("#shopping-cart").addClass("adtive-cart");
                setTimeout("jQuery('#shopping-cart').removeClass('adtive-cart'); jQuery('#shopping-cart').addClass('shopping-cart');", 4000);
            }
            */
        },
        failure: function (msg) {
            alert(msg);
        }
    });
}
function get_short_cart(){
    $.post(UrlDomain + "giohang/short_cart",{
    },function(data){
        $( "#short-cart").html(data);
    });
}

jQuery(document).ready(function () {
    get_total('1');
    get_total('2');
    get_short_cart();
});

    function delete_item_cart(onid){
        var href     = $(onid).attr("myhref");
        var row_id     = $(onid).parent().parent().attr('id');
        $.ajax({
            type: "GET",
            url: href,
            success: function(response){
                if (response == "OK"){
                    $('#'+row_id).css("background-color","#f5f5f5");
                    $('#'+row_id).fadeOut(600, function(){
                        $('#'+row_id).remove();
                    });                    
                    get_total('1');
                    get_total('2');
                    get_short_cart();
                    return false;
                }else{
                    alert('Error delete');
                    return false;
                }
            }
        });
    }
$(document).ready(function (){
  $(".number").keypress(function (e){
         if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
   });
});

$('#checkcreatepass').click(function () {
    $('#contentcreatepass').toggle("slow");
});
$('#checkcreateadd').click(function () {
    $('#contentcreateadd').toggle("slow");
});

function sim_search(tagstr){
    if(tagstr == ''){
        alert("Hãy nhập chuỗi từ cần tìm kiếm");
        document.frmsearch.qsearch.focus();
        return false;
    }
} 


function fix_head_banner(){
    var height = $('.col_slideshow').height();
    $('.service_index').height(height);
    $('.service_index .service').height(height/3);
} 

$(document).ready(function() {
    $('.fancybox').fancybox();
    fix_head_banner();
});

$( window ).resize(function() {
  fix_head_banner();
});