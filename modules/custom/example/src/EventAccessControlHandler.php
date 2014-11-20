<?php

namespace Drupal\example;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Session\AccountInterface;

class EventAccessControlHandler extends EntityAccessControlHandler {


  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {
    return parent::checkAccess($entity, $operation, $langcode, $account); // TODO: Change the autogenerated stub
  }

  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    $parent = parent::checkCreateAccess($account, $context, $entity_bundle);
    if ($parent->isNeutral()) {
      return AccessResult::allowedIfHasPermission($account, 'event.add');
    }
    return $parent;

  }
}