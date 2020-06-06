<?php

namespace Drupal\monmodule\Controller;

class MonModuleController {
    public function hello() {
        return array(
            '#title' => 'Hello',
            '#markup' => 'Ceci est mon module'
        );
    }
}
