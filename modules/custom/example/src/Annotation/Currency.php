<?php

namespace Drupal\example\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Class Currency
 *
 * @Annotation (
 *
 * )
 */
class Currency extends Plugin {
  public $id;
  public $title;
  public $symbol;
  public $abbrevation;
}
