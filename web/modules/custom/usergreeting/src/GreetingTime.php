<?php

declare(strict_types = 1);

namespace Drupal\usergreeting;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslatableMarkup;
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
   * The time output.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $timeOutput;

  /**
   * GreetingTime constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The value of time.
   * @param \Drupal\Component\Datetime\TimeInterface $timeOutput
   *   The timestamp output.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $stringTranslation
   *   The sentences to be translated.
   */
  public function __construct(ConfigFactoryInterface $config_factory, TimeInterface $timeOutput, TranslationInterface $stringTranslation) {
    $this->configFactory = $config_factory;
    $this->timeOutput = $timeOutput;
    $this->stringTranslation = $stringTranslation;
  }

  /**
   * Returns the greeting.
   *
   * @return TranslatableMarkup
   *   The greeting message output.
   */
  public function greetingMessage(): TranslatableMarkup {
    $time_output = (int) date('G', $this->timeOutput->getRequestTime());
    $config_morning = $this->configFactory->get('usergreeting.settings')->get('morning_start');
    $config_afternoon = $this->configFactory->get('usergreeting.settings')->get('afternoon_start');
    $config_evening = $this->configFactory->get('usergreeting.settings')->get('evening_start');

    if ($time_output >= $config_morning && $time_output < $config_afternoon) {
      $greeting = $this->t('Good Morning');
    }
    elseif ($time_output >= $config_afternoon && $time_output < $config_evening) {
      $greeting = $this->t('Good Afternoon');
    }
    else {
      $greeting = $this->t('Good Evening');
    }

    return $greeting;

  }

}
