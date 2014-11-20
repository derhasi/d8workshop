<?php

namespace Drupal\example\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\Annotation\FieldType;
use Drupal\Core\Field\BaseFieldDefinition;


/**
 * @ContentEntityType (
 *   id = "event",
 *   label = @Translation("Event"),
 *   handlers = {
 *     "access" = "Drupal\example\EventAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\example\Form\EventForm",
 *     },
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "title",
 *   },
 *   base_table = "event",
 *   permission_granularity = "entity_type",
 * )
 */
class Event extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $definitions = array();

    $definitions['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setReadOnly(TRUE)
      ->setSetting('unsigned', TRUE);

    $definitions['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setReadOnly(TRUE);

    $definitions['title'] = BaseFieldDefinition::create('string')
      ->setLabel('Title')
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', array(
        'weight' => 0,
      ))
      ->setDisplayOptions('view', array(
        'weight' => 0,
      ))
      ->setDisplayConfigurable('form', TRUE);

    return $definitions;
  }


}