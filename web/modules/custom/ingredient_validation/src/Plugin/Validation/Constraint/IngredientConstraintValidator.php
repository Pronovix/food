<?php

declare(strict_types = 1);

namespace Drupal\ingredient_validation\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Ingredients field on the Product CT.
 */
final class IngredientConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint): void {
    $lines = explode(PHP_EOL, (string) $value->value);
    $pattern = "/^\d+\s\w+\s\w+\s\w+\r?$/";
    foreach ($lines as $line) {
      if (!preg_match($pattern, $line)) {
        $this->context->addViolation($constraint->message);
        return;
      }
    }
  }

}
