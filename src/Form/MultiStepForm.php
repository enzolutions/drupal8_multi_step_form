<?php

/**
 * @file
 * Contains Drupal\multi_step\Form\MultiStepForm.
 */

namespace Drupal\multi_step\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MultiStepForm extends ConfigFormBase
 {

  protected $step = 1;
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {}

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'multi_step_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $config = $this->config('multi_step.multi_step_form_config');

    if($this->step == 1) {
      $form['model'] = [
        '#type' => 'select',
        '#title' => $this->t('Model'),
        '#description' => $this->t(''),
              '#options' => array('1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015'),
              '#default_value' => $config->get('model'),
      ];
    }

    if($this->step == 2) {
      $form['body_style'] = [
        '#type' => 'checkboxes',
        '#title' => $this->t('Body Style'),
        '#description' => $this->t(''),
              '#options' => array('Coupe', 'Sedan', 'Convertible', 'Hatchbac', 'Station wagon', 'SUV', 'Minivan', 'Full-size van', 'Pick-up'),
              '#default_value' => $config->get('body_style'),
      ];
    }

    if($this->step == 3) {
      $form['gas_mileage'] = [
        '#type' => 'radios',
        '#title' => $this->t('Gas Mileage'),
        '#description' => $this->t(''),
              '#options' => array('20 mpg or less', '21 mpg or more', '26 mpg or more', '31 mpg or more', '36 mpg or more', '41 mpg or more'),
              '#default_value' => $config->get('gas_mileage'),
      ];
    }

    if($this->step < 3) {
      $button_label = $this->t('Next');
    }
    else {
      $button_label = $this->t('Find a Car');
    }
    $form['actions']['submit']['#value'] = $button_label;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    return parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if($this->step < 3) {
      $form_state->setRebuild();
      $this->step++;
    }
    else {
      parent::submitForm($form, $form_state);

      /*$this->config('multi_step.multi_step_form_config')
            ->set('model', $form_state->getValue('model'))
            ->set('body_style', $form_state->getValue('body_style'))
            ->set('gas_mileage', $form_state->getValue('gas_mileage'))
          ->save();*/
    }
  }
}
