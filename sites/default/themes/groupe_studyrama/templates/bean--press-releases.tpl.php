<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
$text = field_get_items('bean', $bean, 'field_text');
if ($text) {
  $text = field_view_value('bean', $bean, 'field_text', $text[0]);
  $text = $text['#markup'];
}

// Get the field collection items.
$fc_fields = field_get_items('bean', $bean, 'field_block_content');

// Extract the field collection item ids
$ids = array();
foreach ($fc_fields as $fc_field) {
  $ids[] = $fc_field['value'];
}

// Load up the field collection items
$items = field_collection_item_load_multiple($ids);

// Loop through the items and extract field values
$data = array();
foreach ($items as $key => $item) {
  $url = field_get_items('field_collection_item', $item, 'field_url');
  if ($url) {
    $url = field_view_value(
      'field_collection_item',
      $item,
      'field_url',
      $url[0]
    );
    $data[$key]['url'] = $url['#element']['url'];
  }

  $image = field_get_items('field_collection_item', $item, 'field_block_image');
  if ($image) {
    $image = field_view_value(
      'field_collection_item',
      $item,
      'field_block_image',
      $image[0]
    );
    $data[$key]['image_path'] = image_style_url(
      'press_release_block',
      $image['#item']['uri']
    );
  }
}

$image_alt = $title . ' - ' . variable_get('site_name', 'Drupal');

?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php foreach ($data as $item): ?>
      <div class="item">
        <?php if (isset($item['url'])): ?>
        <a href="<?php print $item['url']; ?>">
          <?php endif; ?>
          <img src="<?php print $item['image_path']; ?>"
               alt="<?php print $image_alt; ?>">
          <?php if ($title || $text): ?>
            <div class="flip-caption">
              <?php if ($title): ?>
                <h2><?php print $title; ?></h2>
              <?php endif; ?>
              <?php if ($text): ?>
                <p><?php print $text; ?></p>
              <?php endif; ?>
            </div>
          <?php endif; ?>
          <?php if (isset($item['url'])): ?>
        </a>
      <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
