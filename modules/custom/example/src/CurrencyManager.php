<?php

namespace Drupal\example;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

class CurrencyManager extends DefaultPluginManager {

  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Currency',
      $namespaces,
      $module_handler,
      'Drupal\example\CurrencyInterface',
      'Drupal\example\Annotation\Currency'
    );

    $this->alterInfo('currency');
    $this->setCacheBackend($cache_backend, 'currency_plugins');
  }


}