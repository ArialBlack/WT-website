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

$ntype = $node->type;

if (($ntype == 'page_tab' || $ntype == 'region' || $ntype == 'hotel') && isset($node->field_paren_node)) {
  $parent_nid = $node->field_paren_node['und'][0]['target_id'];
}

if ($ntype == 'tour' && isset($node->field_tour_country)) {
  $parent_nid = $node->field_tour_country['und'][0]['target_id'];
}

if ($ntype == 'country') {
  $parent_nid = $node->nid;
  //$ntitle = $title . ' - информация о стране'; todo
}

$alias = drupal_get_path_alias('node/' . $parent_nid );

$query = db_select('field_data_field_paren_node', 'pn');
$query->innerJoin('field_data_field_tab_type', 'tt', 'pn.entity_id = tt.entity_id');
$query->fields('pn', array('entity_id'));
$query->fields('tt', array('field_tab_type_value'));
$query->condition('pn.field_paren_node_target_id', $parent_nid);
$query->orderBy('tt.field_tab_type_value');
$nodes = $query->execute()->fetchAll();

$qlinks = '<ul>';
foreach ($nodes as $row) {
  if ($row->field_tab_type_value == 'Спецпредложения / Цены') {
    $qlinks = $qlinks . '<li><a href="/node/' . $row->entity_id .'">' . $row->field_tab_type_value . '</a></li>'; //проверять не пустое ли боди
  }
}
$qlinks = $qlinks . '<li><a href="/node/' . $parent_nid .'">Информация о стране</a></li>';
foreach ($nodes as $row) {
  if ($row->field_tab_type_value != 'Спецпредложения / Цены') {
    $lnode = node_load($row->entity_id);
    if(count($lnode->body) > 0) {
      $qlinks = $qlinks . '<li><a href="/node/' . $row->entity_id . '">' . $row->field_tab_type_value . '</a></li>'; //проверять не пустое ли боди
    }
  }
}

$qlinks = $qlinks . '<li><a href="/' . $alias . '/hotels">Отели</a>';
$qlinks = $qlinks . '</ul>';


$query = db_select('field_data_field_paren_node', 'pn');
$query->fields('pn', array('entity_id'));
$query->condition('pn.field_paren_node_target_id', $parent_nid);
$query->condition('pn.bundle', 'region');
$result = $query->execute()->fetchAll();

$qlinks2 = '<ul>';
foreach($result as $rows) {
  $rnode = node_load($rows->entity_id);
  $qlinks2 = $qlinks2 . '<li><a href="/node/' . $rows->entity_id .'">' . $rnode->title . '</a></li>';
}
$qlinks2 = $qlinks2 . '</ul>';

?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && !empty($title)): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
    <span class="submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </span>
    <?php endif; ?>
  </header>
  <?php endif; ?>
  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    print $qlinks;
  print '<p>---------------------</p>';
    print $qlinks2;

  //dsm($node);
  if ( ($ntype == 'page_tab' && isset($node->field_paren_node) && $node->field_tab_type['und'][0]['value'] == 'Спецпредложения / Цены') || ($ntype = 'region' && isset($node->field_paren_node))) {
    $n = date('Y-m-d 00:00:00');

    $my_field = field_info_field('field_tour_type');
    $allowed_values = list_allowed_values($my_field);

    foreach ($allowed_values as $key=>$value){
     //dsm($key,$key);

      $query = db_select('node', 'n');
      $query->innerJoin('field_data_field_tour_country', 'c', 'c.entity_id = n.nid');
      $query->innerJoin('field_data_field_tour_type', 't', 't.entity_id = n.nid');
      $query->fields('n', array('nid'));
      $query->condition('n.type', 'tour');
      $query->condition('n.status', 1);
      $query->condition('c.field_tour_country_target_id', $parent_nid);
      $query->condition('t.field_tour_type_value', $key);
      $result = $query->execute()->fetchAll();

      $tlist = array();
      foreach ($result as $row) {
        $ltour = node_load($row->nid);
        if($ltour->field_tour_date['und'][0]['value2'] >= $n) {
         // dsm($ltour);
          if(!in_array($ltour, $tlist)){
            array_push($tlist, $ltour);
          }

        }
      }

      if (count($tlist) > 0) {

        $output = '<a role="button" data-toggle="collapse" href="#tour-type-' . $key . '" aria-controls="tour-type-' . $key . '">';
        $output = $output . $value . '</a>';
        $output = $output . '<div class="collapse in" id="tour-type-' . $key . '"><div class="well"><table class="table">';

        foreach ($tlist as $list) {
          //$output = $output . $list->title . $list->nid;


          $output = $output . '<tr>';
          $output = $output . '<td><a href="/node/' . $list->nid . '" title="' . $list->field_old_tour_id['und'][0]['value'] . '">' . $list->title . '</a><br>' . substr($list->field_tour_date['und'][0]['value'], 0, -8)  . ' - ' . substr($list->field_tour_date['und'][0]['value2'], 0, -8) . ' от ' . $list->field_tour_price['und'][0]['value'] . '</td>';
          $output = $output . '<td>' . strip_tags($list->body['und'][0]['summary']) . '<br>Продолжительность тура ' . $list->field_tour_days['und'][0]['safe_value'] . '</td>';

          if(count($list->field_tour_file) > 0) {
            $file = file_load($list->field_tour_file['und'][0]['fid']);
            $uri = $file->uri;
            $url = file_create_url($uri);

            if ($url) {
              $output = $output . '<td>' . '<a href="' . $url . '">Скачать ПДФ</a></td>';
            } else {
              $output = $output . '<td></td>';
            }
          }

          $output = $output . '</tr>';



        }

        $output = $output . '</table></div></div>';

        print $output;

      }

    }




  }




    print render($content);
  ?>
  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
  <footer>
    <?php print render($content['field_tags']); ?>
    <?php print render($content['links']); ?>
  </footer>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
</article>
