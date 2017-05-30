<?php

/**
 * @file
 * Provides default Image styles presets that can be overridden by site administrators.
 */

/*
 * Implementation of hook_image_default_styles().
 */
function bootstrap_imagefield_gallery_image_default_styles() {
  $styles = array();

  $styles['bootstrap_imagefield_gallery_slide'] = array(
    'effects' => array(
      array(
        'name' => 'image_scale_and_crop',
        'data' => array('width' => 700, 'height' => 450),
        'weight' => '0',
      ),
    ),
  );
  return $styles;
}

