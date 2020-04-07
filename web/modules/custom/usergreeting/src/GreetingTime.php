<?php

declare(strict_types = 1);

namespace Drupal\usergreeting;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Provides a greeting service for users dependent on the time of  day.
 */
final class GreetingTime {

  use StringTranslationTrait;

  /**
   * The user account.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * The time output.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $timeOutput;

  /**
   * GreetingTime constructor.
   *
   * @param \Drupal\Component\Datetime\TimeInterface $timeOutput
   *   The timestamp output.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user account.
   */
  public function __construct(TimeInterface $timeOutput, AccountInterface $account) {
    $this->timeOutput = $timeOutput;
    $this->account = $account;
  }

  /**
   * Returns the greeting.
   *
   * @return string
   *   The greeting message output.
   */
  public function greetingMessage(): string {
    $time_output = (int) date('G', $this->timeOutput->getRequestTime());
    $user_displayname = $this->account->getDisplayname();

    if ($time_output >= 5 && $time_output < 12) {
      $greeting = $this->t('Good Morning');
    }
    elseif ($time_output >= 12 && $time_output < 18) {
      $greeting = $this->t('Good Afternoon');
    }
    else {
      $greeting = $this->t('Good Evening');
    }
    return implode(' ', [$greeting, $user_displayname]) . '!';
  }

}
