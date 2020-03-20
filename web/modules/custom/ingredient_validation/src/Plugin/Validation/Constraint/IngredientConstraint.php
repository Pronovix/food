<?php

declare(strict_types = 1);

namespace Drupal\ingredient_validation\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Make sure that the ingredients are written correctly.
 *
 * @Constraint(
 * id = "ValidIngredient",
 * label = @Translation(" Not valid form of ingredients."),
 * type = "string"
 * )
 */
final class IngredientConstraint extends Constraint {
  /**
   * Message shown when validation fails.
   *
   * @var string
   */
  public $message = 'Product creation failed: Ingredients must be in the correct form (Amount Unit Ingredient) and one in a line.';

}
