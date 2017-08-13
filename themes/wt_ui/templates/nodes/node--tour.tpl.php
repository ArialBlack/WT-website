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

                    <a href="#" class="book-tour">Забронировать тур</a>

                    <a href="#" class="back-tour-search">Назад к поиску туров</a>

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





<ul class="nav nav-pills nav-justified">

    <li class="active"><a href="#base-info">Базовая информация</a></li>

    <li><a href="#steps">Этапы тура</a></li>

    <li><a href="#route-map">Карта маршрута</a></li>

    <li><a href="#in-cost">Что включено</a></li>

    <li><a href="#">Цены</a></li>

    <li><a href="#reviews">Отзывы</a></li>

    <li><a href="#similar-tours">Похожие туры</a></li>

</ul>



<div class="row" id="base-info">

    <div class="col-md-9">
    	<div class="inner">

        <?php if (!empty($content['field_tour_route'])):?>

            <?php print render($content['field_tour_route']); ?>

        <?php endif;?>



        <?php if(!empty($node->field_tour_date['und'][0]['value']) && !empty($node->field_tour_date['und'][0]['value2'])):?>

        <div>

            <span>Дни заездов:</span>

            <span>

                <?php print date("d/m/Y", strtotime($node->field_tour_date['und'][0]['value'])); ?>

                -

                <?php print date("d/m/Y", strtotime($node->field_tour_date['und'][0]['value2'])); ?>

            </span>

        </div>

        <?php endif;?>



        <?php if (!empty($node->field_tour_days['und'][0]['value'])):?>

            <div>

                <span>Продолжительность:</span>

                <span>

                    <?php print  wt_getRightWord($node->field_tour_days['und'][0]['value'], 'd'); ?>

                </span>

                </div>

        <?php endif;?>



        <?php if(!empty($node->field_old_tour_id['und'][0]['value'])):?>

            <div>

                <span>Номер тура:</span>

            <span>

                <?php print $node->field_old_tour_id['und'][0]['value']; ?>

            </span>

            </div>

        <?php endif;?>

        <?php if (!empty($content['field_tour_type'])):?>

            <?php print render($content['field_tour_type']); ?>

        <?php endif;?>

        <?php if (!empty($content['body'])):?>

            <div>

                <span>Короткое описание тура:</span>

                <span>

                <?php print render($content['body']); ?>

                </span>

            </div>

        <?php endif;?>
        </div>
    </div>

    <div class="col-md-3">

        <div class="row">

            <div class="col-md-12 links-block">

                <?php  print wt_nodetabs($node); ?>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12 manager-block"> <?php print wt_manager($node); ?> </div>

        </div>

    </div>

</div>



<?php if(isset($node->field_tour_step['und']) && count($node->field_tour_step['und'])>0):?>

    <div class="row" id="steps">

        <div class="col-md-12"><h2>Этапы тура (маршрут)</h2></div>

        <div class="panel-group" id="accordion">

        <?php $count=1; ?>

        <?php foreach ($node->field_tour_step['und'] as $key_s=>$step):?>

            <div class="panel panel-default">

                <div class="panel-heading">

                    <h4 class="panel-title">

                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php print $count; ?>">

                            <span><?php print $count;?></span>

                            <?php print $step['summary'];?>

                        </a>

                    </h4>

                </div>

                <div id="collapse<?php print $count; ?>" class="panel-collapse collapse <?php if($count==1):?>in<?php endif;?>">

                    <div class="panel-body">

                        <?php print $step['value'];?>

                    </div>

                </div>

            </div>

            <?php $count++; ?>

        <?php endforeach;?>

        </div>

    </div>

<?php endif;?>



<?php if(isset($node->field_tour_gallery['und']) && count($node->field_tour_gallery['und'])>0):?>

    <div id="galleryCarousel" class="carousel slide tour-gallery" data-ride="carousel">

			<h2>Галерея</h2>
        <!-- Indicators -->



        <ol class="carousel-indicators">

            <?php for($count=0; $count<count($node->field_tour_gallery['und']); $count++):?>

                <li data-target="#galleryCarousel" data-slide-to="<?php echo $count; ?>" <?php if($count==0):?>class="active"<?php endif;?>></li>

            <?php endfor;?>

        </ol>



        <!-- Wrapper for slides -->

        <div class="carousel-inner">

            <?php foreach ($node->field_tour_gallery['und'] as $key=>$slide):?>

                <div class="item <?php if($key==0):?>active<?php endif;?>">

                    <img class="img-responsive" src="<?php echo file_create_url($slide['uri'])?>"

                         alt="<?php echo $slide['alt']; ?>"

                         title="<?php echo $slide['title']; ?>"

                         width="<?php echo $slide['metadata']['width']; ?>"

                         height="<?php echo $slide['metadata']['height']; ?>"/>

                </div>

            <?php endforeach;?>

        </div>



        <!-- Left and right controls -->

        <a class="left carousel-control" href="#galleryCarousel" data-slide="prev">

            <span class="glyphicon glyphicon-chevron-left"></span>

            <span class="sr-only">Previous</span>

        </a>

        <a class="right carousel-control" href="#galleryCarousel" data-slide="next">

            <span class="glyphicon glyphicon-chevron-right"></span>

            <span class="sr-only">Next</span>

        </a>

    </div>

<?php endif; ?>



<?php if((isset($node->field_in_cost['und']) && count($node->field_in_cost['und'])>0) ||

    (isset($node->field_not_in_cost['und']) && count($node->field_not_in_cost['und'])>0)):?>

<div class="panel with-nav-tabs panel-primary in-cost" id="in-cost">
		<h2>Что включено</h2>

    <div class="panel-heading">

        <ul class="nav nav-tabs">

            <?php if(isset($node->field_in_cost['und']) && count($node->field_in_cost['und'])>0):?>

                <li class="active"><a href="#include" data-toggle="tab">В стоимость входит</a></li>

            <?php endif;?>

            <?php if(isset($node->field_not_in_cost['und']) && count($node->field_not_in_cost['und'])>0):?>

                <li class=""><a href="#not-include" data-toggle="tab">В стоимость не включено</a></li>

            <?php endif;?>

        </ul>

    </div>

    <div class="panel-body">

        <div class="tab-content">

            <?php if(isset($node->field_in_cost['und']) && count($node->field_in_cost['und'])>0):?>

                <div class="tab-pane fade active in" id="include">

                    <ul class="tour-cost">

                        <?php foreach ($node->field_in_cost['und'] as $key_in=>$in_cost):?>

                            <li class="tour-cost">

                                <?php print $in_cost['value'];?>

                            </li>

                        <?php endforeach;?>

                    </ul>

                </div>

            <?php endif;?>

            <?php if(isset($node->field_not_in_cost['und']) && count($node->field_not_in_cost['und'])>0):?>

                <div class="tab-pane fade" id="not-include">

                    <ul class="tour-cost">

                        <?php foreach ($node->field_not_in_cost['und'] as $key_not_in=>$not_in_cost):?>

                            <li>

                                <?php print $not_in_cost['value'];?>

                            </li>

                        <?php endforeach;?>

                    </ul>

                </div>

            <?php endif;?>

        </div>

    </div>

</div>

<?php endif;?>



<?php if (!empty($content['field_coord_route'])):?>

    <h2><?php print t('Карта маршрута');?></h2>

    <div id="route-map">

        <?php print render($content['field_coord_route']); ?>

    </div>

<?php endif;?>



<?php if( !empty(views_get_view_result('countries_tours', 'block', $node->field_tour_type['und'][0]['value']))):?>

    <div id="similar-tours">

        <h2><?php print t('Похожие туры'); ?></h2>

        <?php print views_embed_view('countries_tours', 'block', $node->field_tour_type['und'][0]['value']); ?>

    </div>

<?php endif;?>



<?php if( !empty(views_get_view_result('feedback_views', 'block_1', $node->nid))):?>

    <div id="reviews">

        <h2><?php print t('Отзывы'); ?></h2>

        <?php print views_embed_view('feedback_views', 'block_1', $node->nid); ?>

    </div>

<?php endif;?>




<?php print render($content['comments']); ?>