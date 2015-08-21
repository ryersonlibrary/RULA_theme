<?php

/**
 * @file
 * template.php
 */

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function rula_preprocess_page(&$variables) {
	// Add font awesome cdn.
	drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array(
		'type' => 'external'
	));

	// Add information about the number of sidebars.
	if ((!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) && !empty($variables['page']['sidebar_third'])) {
	$variables['content_column_class'] = ' class="col-sm-6"';
	}
	elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second']) || !empty($variables['page']['sidebar_third'])) {
	$variables['content_column_class'] = ' class="col-sm-9"';
	}
	else {
	$variables['content_column_class'] = ' class="col-sm-12"';
	}

  // Primary nav.
	$variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
  // Build links.
  $variables['primary_nav'] = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
    // Provide default theme wrapper function.
  $variables['primary_nav']['#theme_wrappers'] = array('menu_tree__primary');
	}

  // Secondary nav.
  $variables['secondary_nav'] = FALSE;
  if ($variables['secondary_menu']) {
  // Build links.
    $variables['secondary_nav'] = menu_tree(variable_get('menu_secondary_links_source', 'user-menu'));
    // Provide default theme wrapper function.
  $variables['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
  }

  $variables['navbar_classes_array'] = array('navbar');

  if (theme_get_setting('bootstrap_navbar_position') !== '') {
    $variables['navbar_classes_array'][] = 'navbar-' . theme_get_setting('bootstrap_navbar_position');
  }
  else {
    $variables['navbar_classes_array'][] = 'container';
  }
  if (theme_get_setting('bootstrap_navbar_inverse')) {
    $variables['navbar_classes_array'][] = 'navbar-inverse';
  }
    		else {
    $variables['navbar_classes_array'][] = 'navbar-default';
  }
  }

/**
 * Implements hook_process_page().
  *
  * @see page.tpl.php
  */
  function rula_process_page(&$variables) {
  $variables['navbar_classes'] = implode(' ', $variables['navbar_classes_array']);
}

/**
 * Returns HTML for an islandora_solr_facet_wrapper.
 *
 * @param array $variables
 *   An associative array containing:
 *   - title: A string to use as the header/title.
 *   - content: A string containing the content being wrapped.
 *
 * @ingroup themeable
 */


function rula_islandora_solr_facet_wrapper($variables) {
//	
//	<div class="panel-group" id="accordion">
//	<div class="panel panel-default">
//	<div class="panel-heading">
//	<h4 class="panel-title">
//	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
//	Collapsible Group Item #1
//	</a>
//	</h4>
//	</div>
//	<div id="collapseOne" class="panel-collapse collapse in">
//	<div class="panel-body">
//	...
//	</div>
//	</div>
//	</div>
//	
	
	$t = $variables["title"];
	$tl = strtolower($t);
	
	$output =  '<div class="islandora-solr-facet-wrapper">';
	$output .= '<div class="panel panel-default">';
	$output .= '<div class="panel-heading">';
	$output .= '<h3>' . $t . '</h3>';
	$output .= '<button type="button" class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapse-'.$tl.'">-</button>';
	$output .= '</div>';
	$output .= '<div id="collapse-'.$tl.'" class="panel-collapse collapse in">';
	$output .= '<div class="panel-body">';
	$output .= $variables['content'];
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';
	return $output;

}

