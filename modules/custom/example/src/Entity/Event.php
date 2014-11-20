<?php

namespace Drupal\example\Entity;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;


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
 *   links = {
 *     "canonical" = "entity.event.canonical",
 *     "add-form" = "entity.event.add_form",
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

    $definitions['date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date'))
      ->setDisplayOptions('form', array(
        'weight' => 10,
      ))
      ->setDisplayOptions('view', array(
        'weight' => 10,
        'settings' => array(
          'format_type' => 'long',
        ),
      ))
      ->setRequired('TRUE');

    $definitions['location'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Location'))
      ->setDescription(t('The place where the event takes place.'))
      ->setDisplayOptions('form', array(
        'weight' => 20,
      ))
      ->setDisplayOptions('view', array(
        'weight' => 0,
      ));

    $definitions['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('form', array('weight' => 30))
      ->setDisplayOptions('view', array('weight' => 30));

    $definitions['participants'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Participants'))
      ->setSetting('target_type', 'user')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setDisplayOptions('form', array('weight' => 40))
      ->setDisplayOptions('view', array('weight' => 40));


    return $definitions;
  }


}