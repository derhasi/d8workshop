<?php

namespace Drupal\example\Controller;

class ExampleController {

    public function content() {
      return array(
        '#markup' => 'hello',
      );
    }

}