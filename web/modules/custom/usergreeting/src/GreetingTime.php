<?php

declare(strict_types = 1);

namespace Drupal\usergreeting;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

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
   * The string to translation.
   *
   * @var \Drupal\usergreeting\Drupal\Core\StringTranslation\TranslationInterface
   */
  protected $stringTranslation;

  /**
   * GreetingTime constructor.
   *
   * @param \Drupal\Component\Datetime\TimeInterface $timeOutput
   *   The timestamp output.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user account.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $stringTranslation
   *   The sentences to be translated.
   */
  public function __construct(TimeInterface $timeOutput, AccountInterface $account, TranslationInterface $stringTranslation) {
    $this->timeOutput = $timeOutput;
    $this->account = $account;
    $this->stringTranslation = $stringTranslation;
  }

  /**
   * Returns the greeting.
   *
   * @return string
   *   The greeting message output.
   */
  public function greetingMessage(): array {
    $time_output = (int) date('G', $this->timeOutput->getRequestTime());

    if ($time_output >= 5 && $time_output < 12) {
      $greeting = $this->t('Good Morning');
    }
    elseif ($time_output >= 12 && $time_output < 18) {
      $greeting = $this->t('Good Afternoon');
    }
    else {
      $greeting = $this->t('Good Evening');
    }

    $time_zone = $this->account->getTimeZone();
    $your_timezone = $this->t('Your timezone is:');
    $time_zone = implode(' ', [$your_timezone, $time_zone]);

    return [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $greeting,
      '#cache' => [
        'contexts' => [
          'user',
        ],
      ],
      'username' => [
        '#theme' => 'username',
        '#account' => $this->account,
      ],
      'felkialtojel' => [
        '#plain_text' => '!',
      ],
      'time_zone' => [
        '#type' => 'html_tag',
        '#tag' => 'p',
        '#value' => $time_zone,
      ],

    ];

  }

}
