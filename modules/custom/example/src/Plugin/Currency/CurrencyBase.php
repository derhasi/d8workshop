<?php

namespace Drupal\example\Plugin\Currency;

use Drupal\example\CurrencyInterface;

/**
 * Class Euro
 *
 * @Currency(
 *   id = "euro",
 *   title = @Translation("Euro"),
 *   symbol = "€",
 *   abbreviation = "EUR",
 * )
 */
abstract class CurrencyBase implements CurrencyInterface {

  protected $definition;

  public function __construct($configuration, $plugin_id, $plugin_definition) {
    $this->definition = $plugin_definition;
  }

  public function getTitle() {
    return (string) $this->definition['title'];
  }

  public function getSymbol() {
    return (string) $this->definition['symbol'];
  }

  public function getAbbreviation() {
    return (string) $this->definition['abbrevation'];
  }
}