/* ========================================================
   === Main JavaScript ====================================
   === Author:Nikolay Kuchumov ============================
   === Date: 25.06.2016 ===================================
   ========================================================
*/
/* === Gallery products ================================ */
$(function(){
  $('.js-gallery-item').click(function(){
    var imgSrc = $(this).attr('href');
 
    $(".js-big-image").attr({ src: imgSrc });
    return false;
  });
});
/* === Tabs plugin ===================================== */
(function($){       
  jQuery.fn.lightTabs = function(options){
      
    var createTabs = function(){
      tabs = this;
      i = 0;
      
      showPage = function(i){
        $(tabs).children("div").children("div").hide();
        $(tabs).children("div").children("div").eq(i).show();
        $(tabs).children("ul").children("li").removeClass("active");
        $(tabs).children("ul").children("li").eq(i).addClass("active");
      }
                
      showPage(0);        
      
      $(tabs).children("ul").children("li").each(function(index, element){
        $(element).attr("data-page", i);
        i++;                        
      });
      
      $(tabs).children("ul").children("li").click(function(){
        showPage(parseInt($(this).attr("data-page")));
      });       
    };    
    return this.each(createTabs);
  };  
})(jQuery);
/* === Tabs run ======================================== */
$(document).ready(function(){
  $(".js-tabs").lightTabs();
});


/* === Carousel ======================================== */
$('.js-carousel').carouFredSel({
  prev: '.js-prev',
  next: '.js-next',
  pagination: ".js-pager",
  auto: false
});
/* === Similar products ================================ */
$(document).ready(function(){
  $('.js-products-plus').click(function(){
    var inputNum = $(this).parent().children('.js-products-num');
    var count = inputNum.val();
    count = parseInt(count);
    count++;
    inputNum.val(count);
  });
  $('.js-products-minus').click(function(){
    var inputNum = $(this).parent().children('.js-products-num');
    var count = inputNum.val();
    count = parseInt(count);
    if (count > 1)
      count--;
    inputNum.val(count);
  });
});

//================ Old theme script =================

$('#divcallBack').find('.btn-primary').on('click', function () {

        var btn = $(this);
        if ($("#callBack2").valid())
        {
			
            if(yaCounter27243872)
            {
                yaCounter27243872.reachGoal('CALL_SEND');
            }
            $.ajax({
                url: 'index.php?route=tool/mail/callBackSend',
                type: 'post',
                data: 'userName=' + $('#callBack2Name').val() + '&phone=' + $('#callBack2Phone').val() + '&city=' + $('#callBackCity').val() + '&selectedPhone=' + $('#callBackSelectedPhone').val(),
                dataType: 'json',
                beforeSend: function () {
                    btn.button('loading');
                },
                success: function () {
					
                    $('#divcallBack').find('.alert-success').removeClass('hidden');
					$('#callBack2').addClass('hidden');
					$('#divcallBack').find('.btn-primary').addClass('hidden');
                    setTimeout(
                     function() 
                        {
							btn.button('reset');
							
                        }, 2000);
                },
                error: function () {  
                }
            });
        }
});


function bindShippingEvents(){
    $('.shipping input').change(function () {
        $.ajax({
            url: 'index.php?route=checkout/shipping/shipping',
            type: 'post',
            data: 'shipping_method=' + $(this).val()
        }).success(function () {
            $('.shipping_errors').html('');
            $.ajax({
                url: 'index.php?route=common/cart/info',
                type: 'get',
            }).success(function (data) {
                var cart = $('#cart');
                var parent = cart.parent();
                cart.remove();
                parent.append($(data));
            });

            $.ajax({
                url: 'index.php?route=common/cart/info&getTotal=1',
                type: 'get',
            }).success(function (data) {
                $('.cartTotalPrice').html('');
                $('.cartTotalPrice').append($(data));
            });

        });
    });
}

function shippingCheckout(e){
    e.preventDefault();
    var checked = $('.shipping input[type=radio]:checked');
    if(checked.length > 0){
        $('.shipping_errors').html('');
        window.location = $('#showShippingModal').data('href');
    }
    else{
        $('.shipping_errors').html('Необходимо указать тип доставки!');
    }
}

function animatePhone(el) {
    if (el > 42)
    {
        $('.phone_img').css({backgroundPosition: '0px 0px'}).delay(5000);
        animatePhone(0);
    }
    else {
        $('.phone_img').delay(10).animate({backgroundPosition: '-' + el * 30}, 1, function () {
            animatePhone(el + 1);
        });
    }
}

function closeModalWindow(){
    $("#add_product_modal_window")
        .animate({opacity: 0, top: "45%"}, 200,
        function(){
            $(this).css("display", "none");
            $("#add_product_overlay").fadeOut(400);
        });
}

function visualEffectOnProductAdd(){        
    $("#add_product_overlay").fadeIn(400,
        function(){
            $("#add_product_modal_window")
                .css("display", "block")
                .animate({opacity: 1, top: "50%"}, 200);
        });
}

$(document).ready(function () {
    
    //disabling .dropdown hiding on body click
    $('.btn-group').on('click', '.dropdown-menu > li', function(e) {
            e.stopPropagation();
    });
    
    //closing modal window
        $("#add_product_modal_close").click(function(){
            closeModalWindow();
        });
    
    /* delivery modal window
    $('.btnCheckout').on('click', function(e){
        shippingCheckout(e);
    });
    uncomment if want to use ?route=checkout/checkout
    */ 
    $('menu.categories .dropdown').on('click', function (e) {
        if ($(e.target).hasClass('dropdown-toggle'))
        {
            e.preventDefault();
            if ($(this).hasClass('open'))
            {
                window.location = $(this).find('a').prop('href');
                return false;
            }
            return true;
        }
    });
    $('a.up').on('click', function(e){
        e.preventDefault();
        $('html, body').animate({scrollTop: $('body').offset().top}, 300, 'linear');
    });
    /*
    $('#shippingModal').modal({
        keyboard: false,
        backdrop: 'static',
        show: false
    }).find('.btn-primary').on('click', function (e) {
        shippingCheckout(e);
    });
    */
    $('#shippingModal').on('show.bs.modal', function(){
        $.ajax({
                url: $('#showShippingModal').prop('href'),
                type: 'get',
                beforeSend: function () {
                },
                complete: function () {
                },
                success: function (data) {
                    $('#shippingModal .modal-body').html(data);
                    bindShippingEvents();
                }
            });
    });
    $('#showShippingModal').on('click', function (e) {
        e.preventDefault();
        $('#shippingModal').modal('toggle');
    });
    
    /*
    $('#callBackModal').modal({
        keyboard: false,
        backdrop: 'static',
        show: false
    }).find('.btn-primary').on('click', function () {
        var btn = $(this);
        if ($('#callBack').valid())
        {
            if(yaCounter27243872)
            {
                yaCounter27243872.reachGoal('CALL_SEND');
            }
            $.ajax({
                url: 'index.php?route=tool/mail/callBackSend',
                type: 'post',
                data: 'userName=' + $('#callBackName').val() + '&phone=' + $('#callBackPhone').val() + '&city=' + $('#callBackCity').val() + '&selectedPhone=' + $('#callBackSelectedPhone').val(),
                dataType: 'json',
                beforeSend: function () {
                    btn.button('loading');
                },
                success: function () {
                    $('#callBackModal').find('.alert-success').removeClass('hidden');
                    setTimeout(
                     function() 
                        {
                          $('#callBackModal').modal('toggle');
                          btn.button('reset');
                        }, 2000);
                },
                error: function () {
                    $('#callBackModal').find('.alert-danger').removeClass('hidden');
                }
            });
        }
    });
    */
    $('.header_info .phone a').on('click', function (e) {
        e.preventDefault();
        $('#callBackModal').find('.alert-success').addClass('hidden');
        $('#callBackModal').find('.alert-danger').addClass('hidden');
        $('#callBackName').val('');
        $('#callBackPhone').val('');
        
        $('#callBackCity').val($('.header_info .phone .table:first').data('city'));
        $('#callBackSelectedPhone').val($(this).parent().parent().data('phone'));
        if(yaCounter27243872)
        {
            yaCounter27243872.reachGoal('CALL_MODAL');
        }
        $('#callBackModal').modal('toggle');
    });
    $(function () {
        $('input[placeholder], textarea[placeholder]').placeholder();
    });

    animatePhone(0);

    var loadedNews = 0;
    $('#loadNews').on('click', function () {
        loadedNews++;
        var btn = $(this);
        $.ajax({
            url: 'index.php?route=module/news/index',
            type: 'get',
            data: 'isAjax=1&page=' + loadedNews,
            beforeSend: function () {
                btn.button('loading');
            },
            complete: function () {
                btn.button('reset');
            },
            success: function (data) {
                if (data !== undefined && data !== null && data.length > 0 && data !== '</div>')
                {
                    $('#news').append(data);
                }
                else {
                    btn.remove();
                }
            }
        });
    });
});//end ready

/*
$(window).load(function () {

    $('.slide-main').flexslider({
        animation: "slide",
        slideshowSpeed: 9000,
        useCSS: false
    });

});
*/

//Plugin placeholder
(function (b) {
    function d(a) {
        this.input = a;
        a.attr("type") == "password" && this.handlePassword();
        b(a[0].form).submit(function () {
            if (a.hasClass("placeholder") && a[0].value == a.attr("placeholder"))
                a[0].value = ""
        })
    }
    d.prototype = {show: function (a) {
            if (this.input[0].value === "" || a && this.valueIsPlaceholder()) {
                if (this.isPassword)
                    try {
                        this.input[0].setAttribute("type", "text")
                    } catch (b) {
                        this.input.before(this.fakePassword.show()).hide()
                    }
                this.input.addClass("placeholder");
                this.input[0].value = this.input.attr("placeholder")
            }
        },
        hide: function () {
            if (this.valueIsPlaceholder() && this.input.hasClass("placeholder") && (this.input.removeClass("placeholder"), this.input[0].value = "", this.isPassword)) {
                try {
                    this.input[0].setAttribute("type", "password")
                } catch (a) {
                }
                this.input.show();
                this.input[0].focus()
            }
        }, valueIsPlaceholder: function () {
            return this.input[0].value == this.input.attr("placeholder")
        }, handlePassword: function () {
            var a = this.input;
            a.attr("realType", "password");
            this.isPassword = !0;
            if (b.browser.msie && a[0].outerHTML) {
                var c = b(a[0].outerHTML.replace(/type=(['"])?password\1/gi,
                        "type=$1text$1"));
                this.fakePassword = c.val(a.attr("placeholder")).addClass("placeholder").focus(function () {
                    a.trigger("focus");
                    b(this).hide()
                });
                b(a[0].form).submit(function () {
                    c.remove();
                    a.show()
                })
            }
        }};
    var e = !!("placeholder"in document.createElement("input"));
    b.fn.placeholder = function () {
        return e ? this : this.each(function () {
            var a = b(this), c = new d(a);
            c.show(!0);
            a.focus(function () {
                c.hide()
            });
            a.blur(function () {
                c.show(!1)
            });
            b.browser.msie && (b(window).load(function () {
                a.val() && a.removeClass("placeholder");
                c.show(!0)
            }),
                    a.focus(function () {
                        if (this.value == "") {
                            var a = this.createTextRange();
                            a.collapse(!0);
                            a.moveStart("character", 0);
                            a.select()
                        }
                    }))
        })
    }
})(jQuery);


function getURLVar(key) {
    var value = [];

    var query = String(document.location).split('?');

    if (query[1]) {
        var part = query[1].split('&');

        for (i = 0; i < part.length; i++) {
            var data = part[i].split('=');

            if (data[0] && data[1]) {
                value[data[0]] = data[1];
            }
        }

        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    } else { 			// Изменения для seo_url от Русской сборки OpenCart 2x
        var query = String(document.location.pathname).split('/');
        if (query[query.length - 1] == 'cart')
            value['route'] = 'checkout/cart';
        if (query[query.length - 1] == 'checkout')
            value['route'] = 'checkout/checkout';

        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
}

$(document).ready(function () {


    // Highlight any found errors
    $('.text-danger').each(function () {
        var element = $(this).parent().parent();

        if (element.hasClass('form-group')) {
            element.addClass('has-error');
        }
    });

    // Currency
    $('#currency .currency-select').on('click', function (e) {
        e.preventDefault();

        $('#currency input[name=\'code\']').attr('value', $(this).attr('name'));

        $('#currency').submit();
    });

    // Language
    $('#language a').on('click', function (e) {
        e.preventDefault();

        $('#language input[name=\'code\']').attr('value', $(this).attr('href'));

        $('#language').submit();
    });

    /* Search */

    $('#search input[name=\'search\']').on('keydown', function (e) {
        if (e.keyCode == 13) {
            url = 'http://' + window.location.host + '/index.php?route=product/search';

            var value = $('#header input[name=\'search\']').val();

            if (value) {
                url += '&search=' + encodeURIComponent(value);
            }

            location = url;
        }
    });

    // Menu
    $('#menu .dropdown-menu').each(function () {
        var menu = $('#menu').offset();
        var dropdown = $(this).parent().offset();

        var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

        if (i > 0) {
            $(this).css('margin-left', '-' + (i + 5) + 'px');
        }
    });

    // Product List
    $('#list-view').click(function () {
        $('#content .product-layout > .clearfix').remove();

        //$('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');
        $('#content .row > .product-layout').attr('class', 'product-layout product-list col-xs-12');

        localStorage.setItem('display', 'list');
    });

    // Product Grid
    $('#grid-view').click(function () {
        $('#content .product-layout > .clearfix').remove();

        // What a shame bootstrap does not take into account dynamically loaded columns
        cols = $('#column-right, #column-left').length;

        if (cols == 2) {
            $('#content .product-layout').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
        } else if (cols == 1) {
            $('#content .product-layout').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
        } else {
            $('#content .product-layout').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
        }

        localStorage.setItem('display', 'grid');
    });

    if (localStorage.getItem('display') == 'list') {
        $('#list-view').trigger('click');
    } else {
        $('#grid-view').trigger('click');
    }
    
    bindShippingEvents();
});

// Cart add remove functions
var cart = {
    'add': function (product_id, quantity, oversell, callback) {
        if(oversell === undefined || oversell === null)
        {
            oversell = 0;
        }
        else
        {
            oversell = parseInt(oversell, 10);
            if(isNaN(oversell))
            {
                oversell = 0;
            }
        }
        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: 'product_id=' + product_id + '&quantity=' + (typeof (quantity) != 'undefined' ? quantity : 1) + "&isOversell=" + oversell,
            dataType: 'json',
            success: function (json) {


                if (json['redirect']) {
                    location = json['redirect'];
                }

                if (json['success']) {
                    
                    var jsonArr = json['total'].replace(/\(|\)/g, '').split(' ');
                    var boxInner = "<br>На сумму: <b>"+jsonArr[3]+" р</b>";
                    
                    $('#cart-total').html(
                        jsonArr[0]+" "+jsonArr[1]+" шт."+boxInner
                    );
                    
                    /*
                    $('#cart > ul').load('index.php?route=common/cart/info ul li', function () {
                        $('#showShippingModal').on('click', function (e) {
                            e.preventDefault();
                            $('#shippingModal').modal('toggle');
                        });
                    });
                    uncomment if want to use ?route=checkout/checkout
                    */
                   
                    $('.box-list').load('index.php?route=common/cart/info .box-list');
                   
                    if($.isFunction(callback))
                    {
                        callback();
                    }
                    visualEffectOnProductAdd();
                }
            }
        });

    },
    'update': function (key, quantity) {
        $.ajax({
            url: 'index.php?route=checkout/cart/edit',
            type: 'post',
            data: 'key=' + key + '&quantity=' + (typeof (quantity) != 'undefined' ? quantity : 1),
            dataType: 'json',
            beforeSend: function () {
                $('#cart > button').button('loading');
            },
            complete: function () {
                $('#cart > button').button('reset');
            },
            success: function (json) {
                // Need to set timeout otherwise it wont update the total
                setTimeout(function () {
                    $('#cart > a').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                }, 100);

                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout2/checkout2') {
                    location = 'index.php?route=checkout/cart';
                }
            }
        });
    },
    'custUpdate': function (key, quantity) {
        $.ajax({
            url: 'index.php?route=checkout/cart/custEdit',
            type: 'post',
            data: 'key=' + key + '&quantity=' + (typeof (quantity) != 'undefined' ? quantity : 1),
            dataType: 'json',
            beforeSend: function () {
                $('#cart > button').button('loading');
            },
            complete: function () {
                $('#cart > button').button('reset');
            },
            success: function (json) {
                // Need to set timeout otherwise it wont update the total
                setTimeout(function () {
                    $('#cart > a').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                }, 100);

                if(json['redirect']){
                    location = "index.php?route=checkout/cart";
                }
                
                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout2/checkout2') {
                    location = 'index.php?route=checkout/cart';
                }else {
		    $('#cart > ul').load('index.php?route=common/cart/info ul li');
		}
            }
        });
    },
    'remove': function (key) {
        $.ajax({
            url: 'index.php?route=checkout/cart/remove',
            type: 'post',
            data: 'key=' + key,
            dataType: 'json',
            success: function (json) {
                var jsonArr = json['total'].replace(/\(|\)/g, '').split(' ');
                var boxInner = "<br>На сумму: <b>"+jsonArr[3]+" р</b>";
                    
                $('#cart-total').html(
                        jsonArr[0]+" "+jsonArr[1]+" шт."+boxInner
                    );

                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                    location = 'index.php?route=checkout/cart';
                } else {
                    $('.box-list').load('index.php?route=common/cart/info .box-list');
                }
                
            }
        });
    }
}

var voucher = {
    'add': function () {

    },
    'remove': function (key) {
        $.ajax({
            url: 'index.php?route=checkout/cart/remove',
            type: 'post',
            data: 'key=' + key,
            dataType: 'json',
            beforeSend: function () {
                $('#cart > button').button('loading');
            },
            complete: function () {
                $('#cart > button').button('reset');
            },
            success: function (json) {
                // Need to set timeout otherwise it wont update the total
                setTimeout(function () {
                    $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                }, 100);

                if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                    location = 'index.php?route=checkout/cart';
                } else {
                    $('#cart > ul').load('index.php?route=common/cart/info ul li');
                }
            }
        });
    }
}

var wishlist = {
    'add': function (product_id) {
        $.ajax({
            url: 'index.php?route=account/wishlist/add',
            type: 'post',
            data: 'product_id=' + product_id,
            dataType: 'json',
            success: function (json) {
                $('.alert').remove();

                if (json['success']) {
                    $('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['info']) {
                    $('#content').parent().before('<div class="alert alert-info"><i class="fa fa-info-circle"></i> ' + json['info'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                $('#wishlist-total span').html(json['total']);
                $('#wishlist-total').attr('title', json['total']);

                $('html, body').animate({scrollTop: 0}, 'slow');
            }
        });
    },
    'remove': function () {

    }
}

var compare = {
    'add': function (product_id) {
        $.ajax({
            url: 'index.php?route=product/compare/add',
            type: 'post',
            data: 'product_id=' + product_id,
            dataType: 'json',
            success: function (json) {
                $('.alert').remove();

                if (json['success']) {
                    $('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#compare-total').html(json['total']);

                    $('html, body').animate({scrollTop: 0}, 'slow');
                }
            }
        });
    },
    'remove': function () {

    }
}