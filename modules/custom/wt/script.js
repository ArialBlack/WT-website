(function ($, Drupal, undefined) {
    Drupal.behaviors.ggproject = {
        attach: function (context, settings) {


            $( document ).ready(function() {
                $('#edit-path-alias').val(Drupal.settings.wt.translatedPath);
                console.log(Drupal.settings.wt.translatedPath);
            });
        }
    };
})(jQuery, Drupal);