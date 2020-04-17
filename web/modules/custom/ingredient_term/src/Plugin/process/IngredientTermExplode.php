<?php

declare(strict_types = 1);

/**
 * @file
 * Contains \Drupal\ingredient_term\Plugin\callback\IngredientTermExplode.
 */

namespace Drupal\ingredient_term\Plugin\process;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * @MigrateProcessPlugin(
 *   id = "explode", missing short description
 * )
 */
class IngredientTermExplode extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) { //transform does not have return type or @return annotation. does not have @param annotation for parameter $destination_property and $value
    $value = $fields['field_ingredients']; //fileds is undefined
    $ingredients[] = explode($this->configuration[' '], $value);
    return $ingredients[];
  }

}
