<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */
?>


<?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
    <header>
        <?php print render($title_prefix); ?>
        <?php if (!$page && !empty($title)): ?>
            <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

    </header>
<?php endif; ?>

<?php if(isset($node->field_country_images['und']) && count($node->field_country_images['und'])>0):?>
    <div id="countryCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->

        <ol class="carousel-indicators">
            <?php for($count=0; $count<count($node->field_country_images['und']); $count++):?>
                <li data-target="#countryCarousel" data-slide-to="<?php echo $count; ?>" <?php if($count==0):?>class="active"<?php endif;?>></li>
            <?php endfor;?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php foreach ($node->field_country_images['und'] as $key=>$slide):?>
                <div class="item <?php if($key==0):?>active<?php endif;?>">
                    <img class="img-responsive" src="<?php echo file_create_url($slide['uri'])?>"
                         alt="<?php echo $slide['alt']; ?>"
                         title="<?php echo $slide['title']; ?>"
                        width="<?php echo $slide['metadata']['width']; ?>"
                        height="<?php echo $slide['metadata']['height']; ?>"/>
                    <p><?php echo $slide['image_field_caption']['value']; ?></p>
                </div>
            <?php endforeach;?>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#countryCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#countryCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif; ?>


<div class="row">
    <div class="col-md-10">
        <?php if (!empty($content['field_country_currency'])):?>
            <?php print render($content['field_country_currency']); ?>
        <?php endif;?>
        <?php if (!empty($content['field_country_language'])):?>
            <?php print render($content['field_country_language']); ?>
        <?php endif;?>
        <?php if (!empty($content['field_country_capital'])):?>
            <?php print render($content['field_country_capital']); ?>
        <?php endif;?>
        <?php if (!empty($content['field_coutry_time'])):?>
            <?php print render($content['field_coutry_time']); ?>
        <?php endif;?>
        <?php if (!empty($content['field_country_visa'])):?>
            <?php print render($content['field_country_visa']); ?>
        <?php endif;?>
    </div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12">
                <?php  print wt_nodetabs($node); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> <?php print wt_manager($node); ?> </div>
        </div>
    </div>
</div>

<?php if (!empty($content['field_country_geography'])):?>
    <h2><?php print $content['field_country_geography']['#title']; ?></h2>
    <div class="row">
        <?php if (!empty($node->field_country_geography['und'][0])):?>
            <div class="col-md-6">
                <?php echo $node->field_country_geography['und'][0]['image_field_caption']['value']; ?>
            </div>
        <?php endif;?>
        <?php if (!empty($node->field_country_geography['und'][0])):?>
            <div class="col-md-6">
              <img class="img-responsive" src="<?php echo file_create_url($node->field_country_geography['und'][0]['uri'])?>"
                 alt="<?php echo $node->field_country_geography['und'][0]['alt']; ?>"
                 title="<?php echo $node->field_country_geography['und'][0]['title']; ?>"
                 width="<?php echo $node->field_country_geography['und'][0]['metadata']['width']; ?>"
                 height="<?php echo $node->field_country_geography['und'][0]['metadata']['height']; ?>"/>
            </div>
        <?php endif;?>
    </div>
<?php endif;?>

<?php if (!empty($content['field_country_transport'])):?>
    <h2><?php print $content['field_country_transport']['#title']; ?></h2>
    <div class="row">
        <?php if (!empty($node->field_country_transport['und'][0])):?>
            <div class="col-md-6">
                <?php echo $node->field_country_transport['und'][0]['image_field_caption']['value']; ?>
            </div>
        <?php endif;?>
        <?php if (!empty($node->field_country_transport['und'][0])):?>
            <div class="col-md-6">
                <img class="img-responsive" src="<?php echo file_create_url($node->field_country_transport['und'][0]['uri'])?>"
                     alt="<?php echo $node->field_country_transport['und'][0]['alt']; ?>"
                     title="<?php echo $node->field_country_transport['und'][0]['title']; ?>"
                     width="<?php echo $node->field_country_transport['und'][0]['metadata']['width']; ?>"
                     height="<?php echo $node->field_country_transport['und'][0]['metadata']['height']; ?>"/>
            </div>
        <?php endif;?>
    </div>
<?php endif;?>

<?php if (!empty($content['field_country_info'])):?>
    <h2><?php print $content['field_country_info']['#title']; ?></h2>
    <div class="row">
        <?php if (!empty($node->field_country_info['und'][0])):?>
            <div class="col-md-6">
                <?php echo $node->field_country_info['und'][0]['image_field_caption']['value']; ?>
            </div>
        <?php endif;?>
        <?php if (!empty($node->field_country_info['und'][0])):?>
            <div class="col-md-6">
                <img class="img-responsive" src="<?php echo file_create_url($node->field_country_info['und'][0]['uri'])?>"
                     alt="<?php echo $node->field_country_info['und'][0]['alt']; ?>"
                     title="<?php echo $node->field_country_info['und'][0]['title']; ?>"
                     width="<?php echo $node->field_country_info['und'][0]['metadata']['width']; ?>"
                     height="<?php echo $node->field_country_info['und'][0]['metadata']['height']; ?>"/>
            </div>
        <?php endif;?>
    </div>
<?php endif;?>

<?php //you can use views_get_view_result() if you need customize all blocks parts  ?>
<?php //dpm(views_get_view_result('block_best_tours', 'block_1', $node->nid, $node->title)); ?>

    <?php if( !empty(views_get_view_result('block_best_tours', 'block', $node->nid, $node->title))):?>
        <h2><?php print t('Лучшие туры: ').$node->title; ?></h2>
        <?php print views_embed_view('block_best_tours', 'block', $node->nid, $node->title); ?>
    <?php endif;?>
    <?php if( !empty(views_get_view_result('block_best_tours', 'block_1', $node->nid, $node->title))):?>
        <h2><?php print t('Лучшие отели: ').$node->title; ?></h2>
        <?php print views_embed_view('block_best_tours', 'block_1', $node->nid, $node->title); ?>
    <?php endif;?>

    <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    ?>


