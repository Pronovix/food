<?php

declare(strict_types = 1);

namespace Drupal\ingredient_validation\Plugin\Validation\IngredientTerm;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\taxonomy\Plugin\views\argument;

/**
 * Validates the Ingredients field on the Product CT.
 */
final class IngredientConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static($configuration, $plugin_id, $plugin_definition, $container
    ->get('entity_type.manager')
    ->getStorage('taxonomy_term'));
  }

}
