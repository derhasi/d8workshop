<?php

namespace Drupal\example\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class EventForm
 * @package Drupal\example\Form
 *
 *
 */
class EventForm extends ContentEntityForm {

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    drupal_set_message($this->t('Successfully saved the event %title', array(
      '%title' => $this->getEntity()->label(),
    )));

    //$form_state->setRedirect()
  }


}