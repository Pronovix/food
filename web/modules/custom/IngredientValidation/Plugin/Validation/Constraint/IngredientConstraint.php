<?php

declare(strict_types = 1);

namespace Drupal\ingredient_validation\src\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Make sure that the ingredients are written correctly.
 *
 * @Constraint(
 * id = "ValidIngredient",
 * label = @Translation("Prevent Product CT creation
 * if it isn't matched with the required formula", context = "Validation"),
 * type = "string"
 * )
 */
class IngredientConstraint extends Constraint {
  /**
   * Message shown when validation fails.
   *
   * @var string
   */
  public $message = 'Product creation failed: Ingredients must be in the correct form (Amount Unit Ingredient) and one in a line.';

  /*
   * {@inheritdoc}
   */


}
