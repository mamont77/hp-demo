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

$url = field_get_items('bean', $bean, 'field_url');
if ($url) {
  $url = field_view_value('bean', $bean, 'field_url', $url[0]);
  $url = $url['#element']['url'];
}

$image = field_get_items('bean', $bean, 'field_block_image');
if ($image) {
  $image = field_view_value('bean', $bean, 'field_block_image', $image[0]);
}
$image_path = image_style_url('presentation_block', $image['#item']['uri']);

$text = field_get_items('bean', $bean, 'field_text');
if ($text) {
  $text = field_view_value('bean', $bean, 'field_text', $text[0]);
  $text = $text['#markup'];
}

$image_alt = $title . ' - ' . variable_get('site_name', 'Drupal');

?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php if ($url): ?>
    <a href="<?php print $url; ?>">
      <?php endif; ?>
      <div class="carousel slide"
           data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="<?php print $image_path; ?>"
                 alt="<?php print $image_alt; ?>">

            <?php if ($title || $text): ?>
              <div class="carousel-caption">
                <?php if ($title): ?>
                  <h2><?php print $title; ?></h2>
                <?php endif; ?>
                <?php if ($text): ?>
                  <p><?php print $text; ?></p>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php if ($url): ?>
    </a>
  <?php endif; ?>
  </div>
</div>
