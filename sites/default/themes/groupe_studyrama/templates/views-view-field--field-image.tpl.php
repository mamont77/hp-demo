<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */

$raw = $row->field_field_image[0]['raw'];
$image_alt = $row->node_title . ' - ' . variable_get('site_name', 'Drupal');
$image_path = image_style_url('slider', $raw['uri']);
?>

<a href="<?php print url('node/' . $row->nid); ?>">
  <img
    src="<?php print $image_path; ?>"
    alt="<?php print $image_alt; ?>"
    title="<?php print $raw['title']; ?>"
    >
</a>
