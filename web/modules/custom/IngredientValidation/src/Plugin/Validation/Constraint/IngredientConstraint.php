<?php

use Symfony\Component\Validator\Constraint;

/*
 * Make sure that the ingredients consist of a number, an amount an ingredient, and only one ingredient was written in one line.
 *
 * @Constraint(
 *  id = "ValidIngredient",
 *  label = @Translation("Prevent Product CT creation if it isn't matched with the required formula", context = "Validation"),
 *  type = "string"
 * )
 * */

class IngredientConstraint extends Constraint
{

  /*
   * Message shown when trying create Product CT without writing the ingredients in a correct way.
   *
   * @var string
   */

  public $message = 'Product creation failed: Ingredients must be in the correct form (Amount Unit Ingredient) and one in a line.';

  /**
   * {@inheritdoc}
   */


}
