<?php

/**
 * @file
 * Theme and preprocess functions for pages.
 */

declare(strict_types = 1);

use Drupal\Core\Template\Attribute;

/**
 * Implements hook_preprocess_HOOK() for page.html.twig.
 */
function recipe_theme_preprocess_page(array &$variables): void {
  $variables['page_attributes'] = new Attribute();
  $route_name = \Drupal::routeMatch()->getRouteName();
  if ($route_name === 'entity.user.canonical') {
    $variables['is_userpage'] = TRUE;
  }

}
