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
 * @see     template_preprocess()
 * @see     template_preprocess_node()
 * @see     template_process()
 *
 * @ingroup themeable
 */
?>

<article id="node-<?php print $node->nid; ?>"
         class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ((!$page && !empty($title)) || !empty($title_prefix)
    || !empty($title_suffix)
    || $display_submitted
  ): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && !empty($title)): ?>
        <h2<?php print $title_attributes; ?>><a
            href="<?php print $node_url; ?>"><?php print $title; ?></a>
        </h2>
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
  hide($content['field_image']);
  hide($content['field_price']);
  hide($content['field_tags']);
  hide($content['field_stars_amount']);
  hide($content['field_reviews_amount']);
  hide($content['field_stars_by_reviews']);
  ?>
  <div class="row product-data">
    <div class="col-xs-12 col-sm-4 col-md-4">

      <div class="clearfix">
        <?php
        print render($content['field_image']);
        ?>
      </div>
      <div class="roll-wrapper">
        <div class="roll-over">Roll over image to zoom in</div>
        <div class="roll-over">
          <a href="#" class="open-as-popup colorbox-load" rel="">Сlick for a
            larger image</a>
        </div>
      </div>


    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>

      <div class="price">
        <?php
        print render($content['field_price']);
        ?>
      </div>


      <?php if (isset($content['field_best_seller_text'])
        && !empty($content['field_best_seller_text'])
      ): ?>
        <div class="best-seller">
          <?php
          print render($content['field_best_seller_text']);
          ?>
        </div>
      <?php endif; ?>

      <div class="clearfix">

        <?php
        print render($content['field_product_description']);
        ?>
      </div>
      <?php
      $stars = $content['field_stars_amount'];
      $stars = field_get_items('node', $node, 'field_stars_amount');
      if ($stars) {
        $stars = field_view_value(
          'node',
          $node,
          'field_stars_amount',
          $stars[0]
        );
        $stars = $stars['#markup'];
      }
      ?>
      <div class="rate">
        <span class="stars votes-<?php print $stars; ?>"></span>
        <a href="#reviews"> <?php
          print render($content['field_reviews_amount']);
          ?></a> customer reviews
      </div>

    </div>
    <div class="col-xs-12 col-sm-2 col-md-2">
      <div class="add-to-card-wrapper">
        <a class="btn btn-default btn-lg" href="/node/246">Add to
          cart</a>
      </div>

    </div>
  </div>
  <?php
  print render($content);
  ?>
  <?php if (!empty($content['field_tags'])
    || !empty($content['links'])
  ): ?>
    <footer>
      <?php print render($content['field_tags']); ?>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
</article>
<div class="a-video-wrapper">
  <a class="cloud-zoom-gallery-video video_icon colorbox-inline" href="?inline=true#show-video"><img src="/sites/default/themes/hp/images/video_preview.png" width="40" height="40" alt=""></a>
</div>
