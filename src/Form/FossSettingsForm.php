<?php

/**
 * @file
 * Contains Drupal\foss\Form\FossSettingsForm
 */

namespace Drupal\foss\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class FossSettingsForm extends ConfigFormBase {
  /*
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'foss_settings';
  }

  /*
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['foss.settings'];
  }

  /*
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('foss.settings');

    $form['foss'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('FOSS Settings'),
    );

    $form['foss']['link'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('FOSS Link'),
      '#default_value' => $config->get('foss.link'),
      '#required' => TRUE,
    );

    $form['foss']['username'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('FOSS Username'),
      '#default_value' => $config->get('foss.username'),
      '#required' => TRUE,
    );

    $form['foss']['password'] = array(
      '#type' => 'password',
      '#title' => $this->t('FOSS Password'),
      '#default_value' => $config->get('foss.password'),
      '#required' => TRUE,
    );

    return $form;
  }
  /*
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $config = $this->config('foss.settings');
    $config->set('foss.link', $form_state->getValue('link'));
    $config->set('foss.username', $form_state->getValue('username'));
    $config->set('foss.password', $form_state->getValue('password'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }
}