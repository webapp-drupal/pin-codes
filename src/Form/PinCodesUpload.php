<?php

namespace Drupal\pin_codes\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements PinCodesUpload form controller.
 *
 * This is required for form buildin to upload file with pin codes
 * File upload Form
 */

class PinCodesUpload extends FormBase {

  /**
   * {@inheritdoc}
   */

  public function getFormId() {
    return 'pin_codes_upload';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // File.
    $form['file'] = [
      '#type' => 'managed_file',
      '#title' => 'Upload CSV file with Pin Codes',
      '#description' => $this->t('Only : @extentions File type ',['@extentions' => 'csv']),
      '#upload_validators' => [
      'file_validate_extensions' => ['csv'],
    ],
      '#upload_location' => 'public://pin_codes/',
    ];
    $form ['submit'] =[

      '#type' => 'submit',
      '#value' => $this->t('Upload'),
      '#description' => $this->t('Upload file, #type = submit'),

    ];
      return $form;




}

/**
 * {@inheritdoc}
 */
public function submitForm(array &$form, FormStateInterface $form_state) {

  $connection = \Drupal::database();
$query = $connection->query("SELECT pin_code, status FROM pin_codes");
$result = $query->fetchAll();

  drupal_set_message(t('File uploaded'));

  }

}
