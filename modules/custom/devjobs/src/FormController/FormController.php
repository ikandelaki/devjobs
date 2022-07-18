<?php

namespace Drupal\devjobs\FormController;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FormController extends FormBase {
  public function getFormId() {
    return 'search_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'item',
    ];

    $form['title'] = [
      '#type' => 'textfield', 
      '#attributes' => [
        'placeholder' => $this->t('Filter by title...')
      ],
    ];

    $form['location'] = [
      '#type' => 'textfield',
      '#attributes' => [
        'placeholder' => $this->t('Filter by location...')
      ] 
    ];

    $form['full_time'] = [
      '#type' => 'checkbox'
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['#method'] = 'get';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $title = $form_state->getValue('title');
    $location = $form_state->getValue('location');
    $full_time = $form_state->getValue('full-time');

    
  }
}

?>