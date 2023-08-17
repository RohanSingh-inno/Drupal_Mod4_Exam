<?php

namespace Drupal\custom_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Custom form settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_form.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('your_module.admin_settings');

    $form['fullName'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#default_value' => $config->get('fullName'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email Id'),
      '#default_value' => $config->get('email'),
    ];

    $form['phoneNumber'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#default_value' => $config->get('phoneNumber'),
    ];

    $form['stream'] = [
      '#type' => '',
      '#title' => $this->t('Stream'),
      '#options'  => [
        'Science'    => $this->t('Science'),
        'Commerce'  => $this->t('Commerce'),
        'Arts'    => $this->t('Arts'),
      ],
      '#default_value' => $config->get('stream'),
    ];

    $form['joining_year'] = [
      '#type' => 'date',
      '#title' => $this->t('Joining Year'),
      '#default_value' => $config->get('joining_year'),
    ];

    $form['passing_year'] = [
      '#type' => 'date',
      '#title' => $this->t('Passing Year'),
      '#default_value' => $config->get('passing_year'),
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#default_value' => $config->get('password'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_form.settings')
      ->set('fullName', $form_state->getValue('full_name'))
      ->set('email', $form_state->getValue('email'))
      ->set('phoneNumber', $form_state->getValue('phone_number'))
      ->set('stream', $form_state->getValue('stream'))
      ->set('joining_year', $form_state->getValue('joining_year'))
      ->set('passing_year', $form_state->getValue('passing_year'))
      ->set('password', $form_state->getValue('password'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
