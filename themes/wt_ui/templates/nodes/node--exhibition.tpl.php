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

	<?php

    $alias_country = "";

    $manager = "";

	$block = block_load('views', 'exhibitions-block_2');

	$block_content = _block_get_renderable_array(_block_render_blocks(array($block)));

	$file_url = file_create_url($node->field_pdf_file['und'][0]['uri']);

	$node_url = url(current_path(), array('absolute' => TRUE));

	$node_title = $node->title;

	$node_id = $node->nid;

	//return_node_title_and_url($node_id, $node_title, $node_url);

	print render($block_content);

    if(!empty($node->field_tour_country['und'][0]['target_id'])) {

      $alias_country = drupal_get_path_alias('node/' . $node->field_tour_country['und'][0]['target_id']);

      $manager_id = $node->field_tour_country['und'][0]['entity']->field_managers['und'][0]['target_id'];

			$manager = return_manager($manager_id);

    }

    $picture = !empty($manager->picture->uri) ? file_create_url($manager->picture->uri) : false;

    if (false !== $picture) {

      $image = theme_image([

        'path' => $picture,

        'alt' => $manager->name,

        'title' => $manager->name,

        'width' => $manager->picture->width,

        'height' => $manager->picture->height,

        'attributes' => [

          'class' => 'img-responsive',

        ],

      ]);

    }

    ?>

<div id="for-js-id" class="<?php print $node_title ?>"></div>

<div class="container">

<ul class="nav nav-pills nav-justified">

	<li class="active"><a href="#base-info">Базовая информация</a></li>

	<li><a href="#o-vystavke">О выставке</a></li>

	<li><a href="#in-cost">Что включено</a></li>

	<li><a href="#prices">Цены</a></li>

	<li><a href="#similar-exhibitions">Похожие выставки</a></li>

</ul>



<div class="row" id="base-info">
	<div class="act-buttons">
		<div class="download-button">

				<a href="<?php print $file_url ?>" download>

					<i class="fa fa-download fa-lg" aria-hidden="true"></i>

				</a>

			</div>
	</div>


	<div class="col-md-9">
		<div class="inner">
		<?php

		//var_dump($node->field_master_block['und'][0]['value']);

		//var_dump($node_title);

		?>

		<?php if(!empty($node->field_tour_country['und'][0]['target_id']) && !empty($node->field_parent_region['und'][0]['target_id'])):?>

			<div class="contry-town">

				<p>Страна, город:

					<a href="/<?php print $alias_country?>"><?php if (!empty($node->field_tour_country['und'][0]['entity']->title)):?>

						<?php print render($node->field_tour_country['und'][0]['entity']->title);?>

					<?php endif;?></a>,

					<?php if (!empty($node->field_parent_region['und'][0]['entity']->title)):?>

					<a href="/node/

						<?php print render($node->field_parent_region['und'][0]['target_id']);?>

					"><?php print render($node->field_parent_region['und'][0]['entity']->title); ?>

					<?php endif;?></a>

				</p>

			</div>

		<?php endif;?>



		<?php if(!empty($node->field_place_url["und"][0]['url']) && !empty($node->field_place_url["und"][0]['title'])):?>

			<div class="place">

				<span>Место: </span><span><a href="

					<?php print render($node->field_place_url["und"][0]['url']);?>

				">

					<?php print render($node->field_place_url["und"][0]['title']);?>

				</a></span>

			</div>

		<?php endif;?>



		<?php if(!empty($node->field_tour_date['und'][0]['value']) && !empty($node->field_tour_date['und'][0]['value2'])):?>

			<div class="terms-of">

				<span>Сроки проведения:</span>

            <span>

                <?php print date("d/m/Y", strtotime($node->field_tour_date['und'][0]['value'])); ?>

							-

							<?php print date("d/m/Y", strtotime($node->field_tour_date['und'][0]['value2'])); ?>

            </span>

			</div>

		<?php endif;?>



		<?php if (!empty($node->field_work_time['und'][0]['value'])):?>

			<div class="work-time">

				<span>Часы работы:</span>

                <span>

                    <?php print render($node->field_work_time['und'][0]['value']); ?>

                </span>

			</div>

		<?php endif;?>



		<?php if (!empty($node->field_organizator['und'][0]['value'])):?>

			<div class="sponsors">

				<span>Организаторы:</span>

                <span>

                    <?php print render($node->field_organizator['und'][0]['value']); ?>

                </span>

			</div>

		<?php endif;?>



		<?php if (!empty($node->field_website['und'][0]['url'])):?>

			<div class="website">

				<span>Website:</span>

                <span><a href="<?php print render($node->field_website['und'][0]['url']); ?>">

                    <?php print render($node->field_website['und'][0]['url']); ?>

                </a></span>

				<p class="website-info">перед поездкой проверьте информацию о выставке на её официальном сайте</p>

			</div>

		<?php endif;?>



		<?php if(!empty($node->field_kindof_activity['und'][0]['value'])):?>

			<div class="class-of-activity">

				<span>Вид деятельности (ОКВЭД):</span>

            <span>

                <?php print $node->field_kindof_activity['und'][0]['value']; ?>

            </span>

			</div>

		<?php endif;?>



		<?php if (!empty($node->field_main_groups['und'][0]['value'])):?>

			<div class="main-groups-of">

				<span>Основные группы товаров:</span>

                <span>

                <?php print render($node->field_main_groups['und'][0]['value']); ?>

                </span>

			</div>

		<?php endif;?>



		<?php if (!empty($content['field_tour_type'])):?>

			<?php print render($content['field_tour_type']); ?>

		<?php endif;?>


		</div>
	</div>

	<div class="col-md-3">

		<div class="row">

			<div class="col-md-12 links-block">

				<ul class="exhibition-right-block">

                    <li><a href="http://provisa.com.ua/" target="_blank">Виза</a></li>

                    <li><a href="/<?php print $alias_country?>"><?php if (!empty($node->field_tour_country['und'][0]['entity']->title)):?>

                          <?php print render($node->field_tour_country['und'][0]['entity']->title);?>

                        <?php endif;?></a></li>

                    <li><a href="/<?php print $alias_country?>/resorts">Курорты</a></li>

                    <li><a href="/<?php print $alias_country?>/excursions">Экскурсии</a></li>

                    <li><a href="#similar-exhibitions">Похожие Выставки</a></li>

                    <li><a href="/<?php print $alias_country?>/hotels">Отели</a></li>

                </ul>

			</div>

		</div>



		<div class="row">

			<div class="col-md-12 manager-block">

                <ul class="exhibition-right-block">

                  <?php if (!empty($manager->picture->uri)):?>

                    <li class="manager-img"><?php print render ($image)?></li>

                  <?php endif;?>

                  <?php if (!empty($manager->name)):?>

                      <li class="manager-name">

                        <?php print render ($manager->name)?>

                          <p>Ваш менеджер</p>

                      </li>

                  <?php endif;?>

                  <?php if (!empty($manager->field_skype['und'][0]['value'])):?>

                      <li class="manager-skype"><?php print render ($manager->field_skype['und'][0]['value'])?></li>

                  <?php endif;?>

                  <?php if (!empty($manager->mail)):?>

                      <li class="manager-mail"><?php print render ($manager->mail)?></li>

                  <?php endif;?>

                  <?php if (!empty($manager->field_tel_manager['und'][0]['value'])):?>

                      <li class="manager-tel"><?php print render ($manager->field_tel_manager['und'][0]['value'])?></li>

                  <?php endif;?>

                </ul>

            </div>

			<?php

			$block = block_load('block', '4');

			$block_content = _block_get_renderable_array(_block_render_blocks(array($block)));

			print render($block_content);

			?>

		</div>

	</div>

	<?php if (!empty($content['body']) && !empty($node->title) ):?>

		<div  class="container-fluid">

		<div id="o-vystavke" class="row">
		  <h2>О выставке</h2>

			<div  class="col-md-12">

				<?php print render($node->title); ?>

			<?php print render($content['body']); ?>

							<div id="click-button-form">

                <a class="colorbox-node" href="/content/contact-form" data-inner-width="950" data-inner-height="390">Запрос поездки</a>

							</div>

		</div>

		</div>

		</div>

	<?php endif;?>





	<?php if((isset($node->field_in_cost['und']) && count($node->field_in_cost['und'])>0) ||

		(isset($node->field_not_in_cost['und']) && count($node->field_not_in_cost['und'])>0)):?>

		<div class="panel with-nav-tabs panel-primary in-cost" >
		  <h2>Что включено</h2>
			<div id="in-cost" class="panel-heading">

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

	<?php if((isset($node->field_master_block['und'][0]['value']))):?>

	<div id ="prices" class="row">
		  <h2>Цены</h2>

		<div class="col-md-12">

			<table class="table row-vertical-align searchTable">

			<thead>

			<tr>

				<td data-bind="style:{display:(grouping.IsByTourDuration() || grouping.IsByTourDate() || grouping.IsEmptyGrouping())? 'table-cell': 'none'}, text:(grouping.IsByTourDuration() &amp;&amp; !grouping.IsByTourDate()?'Продолжительность':'Даты туров' )" style="display: table-cell;" width="13%">Даты туров</td>

				<td data-bind="style:{display:(grouping.IsByCityDeparture() || grouping.IsEmptyGrouping())? 'table-cell': 'none'}" style="display: table-cell;" width="10%">Город начала поездки</td>

				<td data-bind="style:{display:(grouping.IsByTourName() || grouping.IsEmptyGrouping()) ? 'table-cell': 'none'}" style="display: table-cell;" width="16%">Название тура</td>

				<td data-bind="style:{display:(grouping.IsByHotelName() || grouping.IsByHotelCity() || grouping.IsByHotelResort() || grouping.IsByHotelStars() || grouping.IsEmptyGrouping()) ? 'table-cell': 'none'}, text:searchResult.HotelColumnHeader" style="display: table-cell;" width="20%">Отель, город, курорт, категория</td>

				<td data-bind="style:{display:grouping.IsEmptyGrouping() ? 'table-cell': 'none'}" style="display: table-cell;" width="24%">Авиаперелет</td>

				<td width="10%">Цена от</td>

				<td width="7%"></td>

			</tr>

			</thead>

				<tbody data-bind="foreach:searchResult.Tours">

			<?php print $node->field_master_block['und'][0]['value'];?>

				</tbody>

				</table>

		</div>

	</div>



			<?php endif;?>

	<?php if( !empty(views_get_view_result('exhibitions', 'block_3', $node->field_exhibition_type['und'][0]['tid']))):?>

	<div class="container-fluid">

		<div class="row">

		<div id="similar-exhibitions" class="col-md-12">



		<h2><?php print t('Похожие выставки'); ?></h2>

			<?php print views_embed_view('exhibitions', 'block_3', $node->field_exhibition_type['und'][0]['tid']); ?>

		</div>

			</div>

	</div>

	<?php endif;?>

	<div class="up-arrow">

	<a href="#navbar" style="text-align: center;display: block;width:50px;height:50px;border: 1px solid #67401A;margin-left: 50%;">&uarr;</a>

	</div>



</div>

</div>
