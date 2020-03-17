<?php

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the Ingredients field on the Product CT
 */

class IngredientValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint)
  {
    if(!isset($value)){
      return;
    }
    //TODO: writing the validation code
  }
}
