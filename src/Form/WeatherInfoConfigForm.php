<?php

namespace Drupal\weather_info\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class WeatherInfoConfigForm extends ConfigFormBase {

  public function getFormId() {
    return 'weather_info_admin_settings';
  }

  protected function getEditableConfigNames() {
    return [
      'weather_info.settings',
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('weather_info.settings');

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#default_value' => $config->get('api_key'),
      '#required' => TRUE,
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('weather_info.settings')
      ->set('api_key', $form_state->getValue('api_key'))
      ->set('city', $form_state->getValue('city'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
