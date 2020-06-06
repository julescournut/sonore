<?php

namespace Drupal\connection_header\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ConnectionHeaderBlock' block.
 *
 * @Block(
 *  id = "connection_header",
 *  admin_label = @Translation("Connection Header"),
 * )
 */
class ConnectionHeaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
      $message = "";
      $user = \Drupal::currentUser();
      $name = $user->getUsername();
      if ($user->isAuthenticated()) {
          $message .= '<a class="log-button" href="/user/logout">Se déconnecter</a>';
      } else {
          $message = '<a class="log-button" href="/user/login">Se connecter</a>';
      }
    $build = [];
    $build['#theme'] = 'connection_header';
     $build['connection_header']['#markup'] = $message;

    return $build;
  }

}
