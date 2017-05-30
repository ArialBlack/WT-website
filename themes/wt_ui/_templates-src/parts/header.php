<div class="header-container">
    <header id="navbar" role="banner" class="navbar container navbar-default">
        <div class="<?php print $container_class; ?>">
            <div class="navbar-header">
                <?php if ($logo): ?>
                    <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                    </a>
                <?php endif; ?>

                <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <?php endif; ?>
            </div>

            <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
                <div class="navbar-collapse collapse">
                    <nav role="navigation">
                        <?php if (!empty($page['navigation'])): ?>
                            <?php print render($page['navigation']); ?>
                        <?php endif; ?>
                        <?php if (!empty($primary_nav)): ?>
                            <?php print render($primary_nav); ?>
                        <?php endif; ?>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </header>
</div>
