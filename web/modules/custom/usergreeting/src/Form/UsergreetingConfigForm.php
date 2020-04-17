<?php

declare(strict_types = 1);

namespace Drupal\usergreeting\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class UsergreetingConfigForm.
 */
class UsergreetingConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['usegreeting.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'usegreeting_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('usegreeting.settings');

    $form['usegreeting_settings']['morning_start'] = [
      '#type' => 'number',
      '#min' => 0,
      '#max' => 23,
      '#title' => $this->t('Set the start point of greeting "Good Morning", it will also be the end point of greeting "Good Evening"'),
      '#default_value' => $config->get('morning_start'),
      '#required' => TRUE,
    ];

    $form['usegreeting_settings']['afernoon_start'] = [
      '#type' => 'number',
      '#min' => 0,
      '#max' => 23,
      '#title' => $this->t('Set the start point of greeting "Good Afternoon", it will also be the end point of greeting "Good Morning"'),
      '#default_value' => $config->get('afernoon_start'),
      '#required' => TRUE,
    ];

    $form['usegreeting_settings']['evening_start'] = [
      '#type' => 'number',
      '#min' => 0,
      '#max' => 23,
      '#title' => $this->t('Set the start point of greeting "Good Evening", it will also be the end point of greeting "Good Afternoon"'),
      '#default_value' => $config->get('evening_start'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $morning = $form_state->getValue('morning_start');
    $afternoon = $form_state->getValue('afernoon_start');
    $evening = $form_state->getValue('evening_start');

    if ($morning == $afternoon) {
      $form_state->setErrorByName('morning_start', $this->t('The start point of morning can not be the same like the start point of afternoon'));
    }

    if ($afternoon == $evening) {
      $form_state->setErrorByName('afernoon_start', $this->t('The start point of afternoon can not be the same like the start point of evening'));
    }

    if ($evening == $morning) {
      $form_state->setErrorByName('evening_start', $this->t('The start point of evening can not be the same like the start point of morning'));
    }

    if ($morning > $afternoon || $morning > $evening) {
      $form_state->setErrorByName('morning_start', $this->t('The value of morning has to be less than the value of afternoon or evening'));
    }

    if ($afternoon > $evening) {
      $form_state->setErrorByName('afernoon_start', $this->t('The value of afternoon has to be less than the value of evening'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('usegreeting.settings')
      ->set('morning_start', $form_state->getValue('morning_start'))
      ->set('afernoon_start', $form_state->getValue('afernoon_start'))
      ->set('evening_start', $form_state->getValue('evening_start'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
