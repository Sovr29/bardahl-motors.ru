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
                
      showPage(3);        
      
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