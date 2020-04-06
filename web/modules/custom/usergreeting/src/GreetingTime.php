<?php

declare(strict_types = 1);

namespace Drupal\usergreeting;

use Drupal\Component\Datetime\TimeInterface;

/**
 * Provides a greeting service for users dependent on the time of  day.
 */
class GreetingTime {

  /**
   * The user account.
   *
   * @var \Drupal\usergreeting\Drupal\Component\Datetime\TimeInterface
   */
  protected $timeOutput;

  /**
   * Construct the Timeinterface object.
   *
   * @param \Drupal\Component\Datetime\TimeInterface $timeOutput
   *   The timestamp output.
   */
  public function __construct(TimeInterface $timeOutput) {
    $this->timeOutput = $timeOutput;
  }

  /**
   * {@inheritdoc}
   */
  public function greetingMessage() {
    $time_output = intval(date('H', $this->timeOutput->getRequestTime()));

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
