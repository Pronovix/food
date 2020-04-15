<?php

declare(strict_types = 1);

/**
 * @file
 * Contains \Drupal\ingredient_term\Plugin\migrate\callback\IngredientTermExplode.
 */

namespace Drupal\ingredient_term\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * @MigrateProcessPlugin(
 *   id = "explode",
 * )
 */
class Explode extends ProcessPluginBase {

  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $value = $fields['field_ingredients'];
    $ingredients[] = explode($this->configuration[' '], $value);
    return $ingredients[];
  }

}
