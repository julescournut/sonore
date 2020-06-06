<?php

namespace Drupal\module_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
  * @Block(
  *   id = "module_block",
  *   admin_label = @Translation("Module Block"),
  * )
  */
class ModuleBlock extends BlockBase {
    /**
      * {@inheritdoc}
      */
    public function build() {
        return array(
            '#title' => 'Hello',
            '#markup' => $this->t('Ceci est mon module block')
        );
    }
}
