<?php if (!empty($page['footer'])): ?>
    <footer class="footer ">
      <div class= "<?php print $container_class; ?>">
       <div class="row">
      <div class="col-md-1 footer-logo">
       <a href="/"><img src="http://wt-website-2.dev/sites/default/files/logo_2.png"></a>

      </div>


        <?php if (!empty($page['footer']['menu_block_2'])): ?>
            <div class="col-md-2 col-md-offset-1">
                <?php print render($page['footer']['menu_block_2']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($page['footer']['menu_block_3'])): ?>
            <div class="col-md-3">
                <?php print render($page['footer']['menu_block_3']); ?>
            </div>
        <?php endif; ?>

        <?php if ($page['footer']['menu_menu-footer-menu-center']): ?>
            <div class="col-md-1 col-md-offset-1">
                <?php print render($page['footer']['menu_menu-footer-menu-center']); ?>
            </div>
        <?php endif; ?>

        <div class="col-md-2 col-md-offset-1">
            <?php if ($page['footer']['multiblock_1']): ?>
                <?php print render($page['footer']['multiblock_1']); ?>
            <?php endif; ?>
            <?php if ($page['footer']['block_2']): ?>
                <?php print render($page['footer']['block_2']); ?>
            <?php endif; ?>
        </div>



<div>


        <?php //print render($page['footer']['#stored']); ?>
        <?php //print render($page['footer']['#theme_wrappers']); ?>
        <?php //print render($page['footer']['#region']); ?>
        <?php //print render($page['footer']['#printed']); ?>
        <?php //print render($page['footer']['#children']); ?>
        </div>
    </footer>

<?php endif; ?>


