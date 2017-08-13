<section class="block block-views clearfix">
  <div class="view view-image-block-for-cooperation-page view-id-image_block_for_cooperation_page view-display-id-block">
    <div class="view-content">
      <div class="views-row views-row-1 views-row-odd views-row-first views-row-last">
        <div class="views-field views-field-field-image">
        <div class="field-content">
          <img typeof="foaf:Image" class="img-responsive" src="http://wt-website-2.dev/sites/default/files/styles/slider_image/public/cooperation_page_bg.jpg" width="1920" height="830" alt="">
        </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="cooperation-content">
<div class="row">

    <div class="col-sm-6">

        <?php if (!empty($content['field_text_static_page'][0])):?>

            <?php print_r(render($content['field_text_static_page'][0]));?>

        <?php endif;?>

    </div>

    <div class="col-sm-6">

        <div>

            <?php if (!empty($content['field_image_cooperation'][0])):?>

            <?php print_r (render($content['field_image_cooperation'][0]));?>

        </div>

        <?php endif;?>

        <div>

            <?php if (!empty($content['field_image_cooperation'][1])):?>

                <?php print_r (render($content['field_image_cooperation'][1]));?>

            <?php endif;?>

        </div>

    </div>

</div>

<div class="row info">

    <?php

    $block = block_load('block', 3); // выводим блок с ID 3

    $out1 = _block_render_blocks(array($block));

    $out2 = _block_get_renderable_array($out1);

    print_r(drupal_render($out2));



    ?>

</div>

<h2>  О нас</h2>

<div class="row">

    <div class="col-sm-6">

        <?php if (!empty($content['field_text_static_page'][1])):?>

            <?php print_r(render($content['field_text_static_page'][1]));?>

        <?php endif;?>

    </div>

    <div class="col-sm-6">

        <?php if (!empty($content['field_image_cooperation'][2])):?>

            <?php print_r (render($content['field_image_cooperation'][2]));?>

        <?php endif;?>

    </div>



</div>
</div>



