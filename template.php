<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function thl_zen5_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  thl_zen5_preprocess_html($variables, $hook);
  thl_zen5_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function thl_zen5_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function thl_zen5_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function thl_zen5_preprocess_node(&$variables, $hook) {
  $variables['featured'] = ($variables['view_mode'] == 'featured') ? TRUE : FALSE;
  $node = $variables['node'];
  // Add a Read More link to the Featured (teaser-like) Display Mode
  if($variables['featured']) {
    // Add read more url variable as node path. !!NEED TO DEAL WITH ALIASES!!
    $variables['rmurl'] = 'node/' . $node->nid;
    // Create read more link
    $rmlink = l(t('Read more') . '...', $variables['rmurl']);
    // insert read more link at end of the last paragraph of the body
    $body = $variables['content']['body'][0]['#markup'];
    $variables['content']['body'][0]['#markup'] = substr_replace($body, ' ' . $rmlink . '</p>',  strrpos($body, '</p>'));
  }
  
  // Add read more link at end of body content so it can be in-line
  if($variables['teaser'] && isset($variables['field_teaser_node_link'][0])) {
    // Add readmore url variable which is value of link field
    $variables['rmurl'] = $variables['field_teaser_node_link'][0]['url'];
    // Create link without any wrappers
    $rmlink = l($variables['field_teaser_node_link'][0]['title'], $variables['rmurl']);
    // Add link around teaser node image
    $variables['content']['field_teaser_node_image']['#prefix'] = '<a href="' . $variables['rmurl'] . '">';
    $variables['content']['field_teaser_node_image']['#suffix'] = '</a>';
    // insert read more link at end of the last paragraph of the body
    $body = $variables['content']['body'][0]['#markup'];
    $variables['content']['body'][0]['#markup'] = substr_replace($body, ' ' . $rmlink . '</p>',  strrpos($body, '</p>'));
  }

  // Optionally, run node-type-specific preprocess functions, like
  // thl_zen5_preprocess_node_page() or thl_zen5_preprocess_node_story().
  /*$function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }*/
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function thl_zen5_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function thl_zen5_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function thl_zen5_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
