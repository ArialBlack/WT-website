<?php
/**
 * @file
 * Template file for the galleryformatter default formatter
 */

/**
 * Only edit this file for switching order of the slides info, adding classes or other minor changes within the overall html structure.
 * KEEP the original html structure or you'll run into problems with the JS.
 * IDs on the slides and the hash for the thumb links MUST be there for the gallery to function.
 * width and height must be set inline for gallery-slides container, the gallery-thumbs, and the li's inside it.
 *
 * Available variables:
 *
 * $dimensions - Array containing both slides and thumbs dimensions
 * $slides - Array containing all slide images, its sanatized title & alt ready to print, its hash id and the full image URL if you need it
 * $thumbs - Array containing all thumbnail images ready to print and their hash
 * $settings - The settings for galleryformatter as configured for this field instance.




?>
<div id="bootstrapimagefieldgallery_<?php print $gal_id; ?>" class="bootstrapimagefieldgallery carousel slide  data-ride="carousel" data-interval="false">
 
 */

$gal_id = generateRandomString();
$sc = count($slides);
?>
<div class="carousel-container">
<div id="bootstrapimagefieldgallery_<?php print $gal_id; ?>" class="bootstrapimagefieldgallery carousel slide scount-<?php print $sc; ?>"" data-ride="carousel">
      <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php foreach ($slides as $id => $data): ?>
           <?php if ($id == 0) $activeclass='active'; else $activeclass=''; ?>
       	 <li data-target="#bootstrapimagefieldgallery" data-slide-to="<?php print $data['hash_id']; ?>" class="<?php print $activeclass; ?>"></li>
        <?php endforeach; ?>
       
      </ol>
      <div class="carousel-inner" role="listbox">
       
	   <?php foreach ($slides as $id => $data): ?>
       <?php if ($id == 0) $activeclass='active'; else $activeclass=''; ?> 
	    <div class="item <?php print $activeclass; ?>">
           <?php print $data['image']; ?>
          <?php if (!empty($data['title']) || !empty($data['alt'])): ?>
          <div class="container">
            <div class="carousel-caption">
                <?php if ($data['alt']): ?><h4><?php print $data['alt']; ?></h4><?php endif; ?>
                <?php if ($data['title']): ?><p><?php print $data['title']; ?></p><?php endif; ?>
                <p></p>
              </div>
            </div>
           <?php endif; ?>
        </div>
      <?php endforeach; ?>
</div>

      <a class="left carousel-control" href="#bootstrapimagefieldgallery_<?php print $gal_id; ?>" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
      <a class="right carousel-control" href="#bootstrapimagefieldgallery_<?php print $gal_id; ?>" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
    </div>
    </div>  




