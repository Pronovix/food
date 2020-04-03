<?php

namespace Drupal\usergreeting;

/**
 * GreetingTime is a greeting service for users
 * dependent on the time of the day
 */
class GreetingTime {
    private $greeting = '';

  /**
   * {@inheritdoc}
   */
  public function greetingMessage () {
    $time_output = gmdate('i', \Drupal::time()->getRequestTime());

    if ($time_output >= 5 || $time_output < 12) {
      $greeting = "Good Morning ";
    }
    if ($time_output >= 12 || $time_output < 17) {
      $greeting = "Good Afternoon ";
    }
    if ($time_output >= 17 || $time_output < 5) {
      $greeting = "Good Evening ";
    }
    return $greeting;
  }

}