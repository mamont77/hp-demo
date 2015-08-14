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

 /*&#9654;*/

$field_stars_amount = (!empty($row->field_field_stars_amount)) ? $row->field_field_stars_amount[0]['rendered']['#markup'] : '';
$field_reviews_amount = (!empty($row->field_field_reviews_amount)) ? $row->field_field_reviews_amount[0]['rendered']['#markup'] : '';
$field_stars_by_reviews = (!empty($row->field_field_stars_by_reviews)) ? $row->field_field_stars_by_reviews[0]['rendered']['#markup'] : '';
$field_stars_by_reviews = explode('-', $field_stars_by_reviews);
$stars_by_reviews = array();
foreach ($field_stars_by_reviews as $reviews) {
  $reviews = explode(':', $reviews);
  $stars_by_reviews[$reviews[0]] = $reviews[1];
}
$stars_by_reviews = array_reverse($stars_by_reviews, TRUE);

$field_stars_amount_float = explode('-', $field_stars_amount);
$field_stars_amount_float = implode('.', $field_stars_amount_float);

$data = '<div class=\'header\'>' . $field_stars_amount_float . ' out of 5 stars</div>';
$data .= '<table>';
foreach ($stars_by_reviews as $key => $item) {
  $data .= '
<tr>
<td>
<a class=\'rating\' href=\''. url('node/' . $row->nid) . '#reviews\'>' . $key . ' star</a>
</td>
<td class=\'data\'>
<div class=\'progress\'>
  <div class=\'progress-bar\' role=\'progressbar\' aria-valuenow=\'' . $item . '\' aria-valuemin=\'0\' aria-valuemax=\'100\' style=\'width: ' . $item . '%;\'>
    <span class=\'sr-only\'>' . $item . '%</span>
  </div>
</div>
</td>
<td>
<span class=\'percentage\'>' . $item . '%</span>
</td>
</tr>';
}
$data .= '</table>';

$data .= '<div class=\'see_all_reviews\'><a href=\''. url('node/' . $row->nid) . '#reviews\'>See all ' . $field_reviews_amount . ' reviews <span class=\'glyphicon glyphicon-triangle-right\'></span></a></div>';


?>

<span class="pop" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-html="true" data-content="<?php print $data; ?>">
  <span class="stars-wrapper">
    <span class="stars votes-<?php print $field_stars_amount; ?>" data-toggle="popover"></span>
    <span class="arrow">&#9660</span>
  </span>
</span>
<a class="count" href="<?php print url('node/' . $row->nid); ?>#reviews"><?php print $field_reviews_amount; ?></a>
