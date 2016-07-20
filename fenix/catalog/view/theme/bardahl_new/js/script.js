$(document).ready(function() {
    
    $(".fancybox").fancybox();
 
  var owl = $("#hitsOwl");
 
  owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      pagination: false,
  });
 
  // Custom Navigation Events
  $(".hitNext").click(function(){
    owl.trigger('owl.next');
  })
  $(".hitPrev").click(function(){
    owl.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl.trigger('owl.stop');
  })
  
  var owl5 = $("#partners");
 
  owl5.owlCarousel({
      items : 4, //10 items above 1000px browser width
      pagination: false,
  });
 
  // Custom Navigation Events
  $(".hitpartnerNext").click(function(){
    owl5.trigger('owl.next');
  })
  $(".hitpartnerPrev").click(function(){
    owl5.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl5.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl5.trigger('owl.stop');
  })
  
  
    var owl6 = $("#posts");
 
  owl6.owlCarousel({
      items : 4, //10 items above 1000px browser width
      pagination: false,
  });
 
  // Custom Navigation Events
  $(".postNext").click(function(){
    owl6.trigger('owl.next');
  })
  $(".postPrev").click(function(){
    owl6.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl6.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl6.trigger('owl.stop');
  })
  
  
  


var owl2 = $("#sertificats");
 
  owl2.owlCarousel({
      items : 1, //10 items above 1000px browser width
      pagination: false,
  });
 
  // Custom Navigation Events
  $(".lastNext").click(function(){
    owl2.trigger('owl.next');
  })
  $(".lastPrev").click(function(){
    owl2.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl2.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl2.trigger('owl.stop');
  })
  
  
  
  var owl3 = $("#review");
 
  owl3.owlCarousel({
      items : 1, //10 items above 1000px browser width
      pagination: false,
  });
 
  // Custom Navigation Events
  $(".reviewNext").click(function(){
    owl3.trigger('owl.next');
  })
  $(".reviewPrev").click(function(){
    owl3.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl3.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl3.trigger('owl.stop');
  })
  
  
  
  var owl4 = $("#mainSlider");
 
  owl4.owlCarousel({
      items : 2, //10 items above 1000px browser width
      pagination: true,
      autoPlay: true,
      
  });
 
  // Custom Navigation Events
  $(".sliderNext").click(function(){
    owl4.trigger('owl.next');
  })
  $(".sliderPrev").click(function(){
    owl4.trigger('owl.prev');
  })
  $(".play").click(function(){
    owl4.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $(".stop").click(function(){
    owl4.trigger('owl.stop');
  })
 
});

$(document).ready(function() {
    
    $(".fancybox").fancybox();
});
