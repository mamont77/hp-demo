<?php

/**
 * Implements template_preprocess_html().
 *
 * @see html.tpl.php
 */
function groupe_studyrama_preprocess_html(&$variables) {
  //include the js file in the header
//  drupal_add_js('http://commons.studyrama.com/js/utils.js');

}

/**
 * Override or insert variables into the page template.
 */
function groupe_studyrama_preprocess_page(&$vars) {
}

/**
 * Override or insert variables into the node template.
 */
//function groupe_studyrama_preprocess_node(&$variables) {
//
//}


/**
 * Implements hook_html_head_alter().
 * This will overwrite the default meta character type tag with HTML5 version.
 */
//function groupe_studyrama_html_head_alter(&$head_elements) {
//  $head_elements['system_meta_content_type']['#attributes'] = array(
//    'charset' => 'utf-8'
//  );
//}

/**
 * Overrides theme_breadcrumb().
 *
 * @param $variables
 * @return bool|string
 */
//function groupe_studyrama_breadcrumb($variables) {
//  if (!empty($variables['breadcrumb'])) {
//    $output = '';
//    $output .= '<div class="arianne">';
//    $output .= '<p>';
//    $output .= implode(' >> ', $variables['breadcrumb']);
//    if (!drupal_is_front_page()) {
//      $output .= ' >> <span class="arianne_color">' . drupal_get_title() . '</span>';
//    }
//    $output .= '</p>';
//    $output .= '</div>';
//    return $output;
//  }
//
//  // Return false if no breadcrumbs.
//  return FALSE;
//}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
//function groupe_studyrama_menu_local_tasks(&$variables) {
//  $output = '';
//
//  if (!empty($variables['primary'])) {
//    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
//    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
//    $variables['primary']['#suffix'] = '</ul>';
//    $output .= drupal_render($variables['primary']);
//  }
//  if (!empty($variables['secondary'])) {
//    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
//    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
//    $variables['secondary']['#suffix'] = '</ul>';
//    $output .= drupal_render($variables['secondary']);
//  }
//  return $output;
//}

//function groupe_studyrama_page_alter($page) {
//
//}

/**
 * Add javascript files for front-page jquery slideshow.
 */
//if (drupal_is_front_page()) {
//  drupal_add_js(drupal_get_path('theme', 'groupe_studyrama') . '/js/jquery.cycle.all.min.js');
//  drupal_add_js(drupal_get_path('theme', 'groupe_studyrama') . '/js/slide.js');
//}

/**
 * @param $form
 * @param $form_state
 * @param $form_id
 */
//function groupe_studyrama_form_alter(&$form, $form_state, $form_id) {
////  if ($form_id == 'search_block_form') {
////    $form['search_block_form']['#attributes']['placeholder'][] = t('Rechercher su Studyrama Pro');
////    $form['actions']['submit']['#value'] = 'OK';
////  }
//}
