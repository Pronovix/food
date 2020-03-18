<?php

use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\Core\Field\FieldItemListInterface;
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
    $items =& $value;

    $entity = $this->context->getRoot()->getValue();


    //TODO: writing the validation code
  }
}
