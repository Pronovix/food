<?php

declare(strict_types = 1);

namespace Drupal\ingredient_validation\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Ingredients field on the Product CT.
 */
class IngredientConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint) {
    die('valami');
  }

}
