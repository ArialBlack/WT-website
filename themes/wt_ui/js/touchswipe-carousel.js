(function($) {
  $(function() {

    function center_full_project_buttons(){
      //console.log('script pashet nakonecta!!');
      if(window.innerWidth > 769){
        $('.view-slider-portfolio .item-list ul').css('width',$('.view-slider-portfolio .item-list ul li').length*(window.innerWidth/3)+'px');
        $('.view-slider-portfolio .item-list ul li').css('width',(window.innerWidth/3)+'px');
        //console.log('script pashet!!');
      }else{
        $('.view-slider-portfolio .item-list ul').css('width',$('.view-slider-portfolio .item-list ul li').length*(window.innerWidth*0.8)+'px');
        $('.view-slider-portfolio .item-list ul li').css('width',(window.innerWidth*0.8)+'px');
      }

      var min_height = $('.img-block img').first().height();
      $('.img-block img').each(function(index, value){
          if($(this).height() < 50) return 1;
          if($(this).height() < min_height)
            min_height = $(this).height();
        }
      );
      var center_top = $('.view-slider-portfolio .item-list ul').height()/2;

      $('.view-slider-portfolio .item-list ul li').css('max-height',min_height);
     // $('.full-project-block-in-footer span').css('top',center_top);
     // $('.fi-arrow-previous, .fi-arrow-newest').css('height',min_height).css('padding-top',center_top-30);
    }

    $(window).resize(function () { center_full_project_buttons()});
    $(document).ready(function () { center_full_project_buttons()});
    $(document).ready(function(){

      $(".colorbox-load").click(function(e) {
        e.preventDefault;
        //console.log("video pashet tozhe!");
      });

      $('.fi-arrow-previous').click(function(){
        $( ".view-slider-portfolio .item-list ul" ).offset({ left:  Math.min(-15,$( ".view-slider-portfolio .item-list ul li" ).offset().left+(window.innerWidth/3))});
      });
      $('.fi-arrow-newest').click(function(){
        $( ".view-slider-portfolio .item-list ul" ).offset({ left:  Math.max(-($('.view-slider-portfolio .item-list ul li').length-3)*(window.innerWidth/3),$( ".view-slider-portfolio .item-list ul" ).offset().left-(window.innerWidth/3))});
      });
    });
  }); // end of document ready
})(jQuery); // end of jQuery name space
