<?php

namespace Drupal\usergreeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Usergreeting' Block.
 *
 * @Block(
 *   id = "usergreeting_block",
 *   admin_label = @Translation("Usergreeting"),
 *   category = @Translation("Usergreeting"),
 * )
 */
class UsergreetingBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $username = $this->t(\Drupal::currentUser()->getUsername());
    $greetuser = $this->t(\Drupal::service('usergreeting.greeting')->greetingMessage());
    
    return array('#markup' => $greetuser . $username . '!');
  }
  
}
