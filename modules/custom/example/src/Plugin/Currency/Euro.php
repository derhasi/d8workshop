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
class Euro extends CurrencyBase {
}