(function ($) {
Drupal.behaviors.bootstrap_imagefield_gallery = {
  attach: function (context, settings) {
    
    $( ".bootstrapimagefieldgallery" ).each(function() {
        items = $(this, context);
        if (items.length) {
            items.find('.carousel-inner .item:first-child').addClass('active');
	        items.find('.carousel-indicators .li:first-child').addClass('active'); 
        }
    });

   

    
  }
};
})(jQuery);
