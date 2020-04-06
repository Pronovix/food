<?php

declare(strict_types = 1);

namespace Drupal\usergreeting;

/**
 * Provides a greeting service for users dependent on the time of  day.
 */
class GreetingTime {

  /**
   * {@inheritdoc}
   */
  public function greetingMessage() {
    $time_output = intval(date('H', \Drupal::time()->getRequestTime()));

    if ($time_output >= 5 && $time_output < 12) {
      $greeting = 'Good Morning ';
    }
    elseif ($time_output < 17) {
      $greeting = 'Good Afternoon ';
    }
    else {
      $greeting = 'Good Evening ';
    }
    return $greeting;
  }

}
