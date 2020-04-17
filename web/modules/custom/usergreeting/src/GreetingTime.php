<?php

declare(strict_types = 1);

namespace Drupal\usergreeting;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;

/**
 * Provides a greeting service for users dependent on the time of  day.
 */
final class GreetingTime {

  use StringTranslationTrait;

  /**
   * The value of time.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

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
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The value of time.
   * @param \Drupal\Component\Datetime\TimeInterface $timeOutput
   *   The timestamp output.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user account.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $stringTranslation
   *   The sentences to be translated.
   */
  public function __construct(ConfigFactoryInterface $config_factory, TimeInterface $timeOutput, AccountInterface $account, TranslationInterface $stringTranslation) {
    $this->configFactory = $config_factory;
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
    $config_morning = $this->configFactory->get('usegreeting.settings')->get('morning_start');
    $config_afternoon = $this->configFactory->get('usegreeting.settings')->get('afernoon_start');
    $config_evening = $this->configFactory->get('usegreeting.settings')->get('evening_start');

    if ($time_output >= $config_morning && $time_output < $config_afternoon) {
      $greeting = $this->t('Good Morning');
    }
    elseif ($time_output >= $config_afternoon && $time_output < $config_evening) {
      $greeting = $this->t('Good Afternoon');
    }
    else {
      $greeting = $this->t('Good Evening');
    }

    return [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $greeting,
      '#cache' => [
        'contexts' => [
          'timezone',
          'user',
        ],
      ],
      'username' => [
        '#theme' => 'username',
        '#account' => $this->account,
      ],
      'exclamiation_mark' => [
        '#plain_text' => '!',
      ],
    ];

  }

}
