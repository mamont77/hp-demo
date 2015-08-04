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
$yesterday_timestamp = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
$content_timestamp = mktime(0, 0, 0, date('m', $output), date('d', $output),
  date('Y', $output));
?>

<?php if ($content_timestamp > $yesterday_timestamp): ?>
  <p class="hour left black">
    <span><?php print date('H\hi', $output); ?></span>
  </p>
<?php else: ?>
  <p class="date maj left black">
    <span><?php print date('j', $output); ?></span>
    <?php print date('M Y', $output); ?>
  </p>
<?php endif; ?>
