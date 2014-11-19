<?php

namespace Drupal\example;

interface CurrencyInterface {
  public function getTitle();
  public function getSymbol();
  public function getAbbreviation();
}