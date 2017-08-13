(function($) {
    $(function() {

        function buildMasonry() {
            $('.field-name-field-photos .field-items').masonry({
                itemSelector: '.field-item',
                percentPosition: true,
                columnWidth: '.field-item'
            });
        }

        function calcSizes() {
            var ww = $(window).width();
            if (ww >=992) {
                var $containerMargin = parseInt(jQuery('#navbar').css('margin-left'), 10);
                $('.paragraphs-item-wide-media-teaser-with-link .content').css('width', ww - $containerMargin + 'px');
            } else {
                $('.paragraphs-item-wide-media-teaser-with-link .content').css('width', '100%');
            }
        }

        function numParagraphs() {
            var $par = $('.entity-paragraphs-item');

            $par.each(function(index){
                $(this).attr('id', 'section-' + index);
            });
        }

        function buildMultyCarousel() {
            // Instantiate the Bootstrap carousel

            // for every ` in carousel, copy the next slide's item in the slide.
            // Do the same for the next, next item.
            $('#block-views-slider-portfolio-block-1 .carousel .item').each(function(){
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                if (next.next().length>0) {
                    next.next().children(':first-child').clone().appendTo($(this));
                } else {
                    $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
                }
            });
        }

        $(document).ready(function() {
            $('.carousel').carousel();
            calcSizes();
            numParagraphs();
            //buildMultyCarousel();

            $(".sscroll").click(function(event) {
                event.preventDefault();

                var id = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(id).offset().top
                }, 1000);
            });

            // for (var n = 1; n<10; n++) {
            //   var carItem ='.carousel-inner .item:nth-child(' + n + ') p';
            //   if ($(carItem).Height() > 210) {
            //     $(carItem).css('font-size', '22px');
            //   }
            // }


            $(".node-type-tour .nav.nav-pills.nav-justified, .page-node .nav.nav-pills.nav-justified").on("click","a", function (event) {

              event.preventDefault();

              var id  = $(this).attr('href'),

                top = $(id).offset().top;

              $('body,html').animate({scrollTop: top}, 1000);
            });

            // if ($(window).width() <= 1260) {
            //   $('.page-contacts .geofieldMap.geofield-processed-processed').css('width', '620px !important');
            // };

        });

        $(window).load(function() {
           // buildMasonry();
        });

        $(window).resize(function () {
            calcSizes();
        });
        }); // end of document ready
})(jQuery); // end of jQuery name space
