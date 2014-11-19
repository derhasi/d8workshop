<?php

namespace Drupal\example\Plugin\Currency;

use Drupal\example\CurrencyInterface;

/**
 * Class Euro
 *
 * @Currency(
 *   id = "paulcoin",
 *   title = @Translation("PaulCoin"),
 *   symbol = "P",
 *   abbreviation = "PAC",
 * )
 */
class PaulCoin extends CurrencyBase {
}