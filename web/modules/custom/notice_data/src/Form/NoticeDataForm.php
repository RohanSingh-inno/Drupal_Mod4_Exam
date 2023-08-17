<?php

namespace Drupal\notice_data\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the notice data entity edit forms.
 */
class NoticeDataForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New notice data %label has been created.', $message_arguments));
        $this->logger('notice_data')->notice('Created new notice data %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The notice data %label has been updated.', $message_arguments));
        $this->logger('notice_data')->notice('Updated notice data %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.notice_data.canonical', ['notice_data' => $entity->id()]);

    return $result;
  }

}
