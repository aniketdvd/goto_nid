<?php

/**
 * @file
 * Contains \Drupal\goto_nid\Plugin\Block\GotoNidBlock.
 */
namespace Drupal\goto_nid\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'goto node' block.
 *
 * @Block(
 *   id = "GotoNidBlock",
 *   admin_label = @Translation("goto nid block"),
 *   category = @Translation("goto node block")
 * )
 */

class GotoNidBlock extends BlockBase{

  /**
   * {@inheritdoc}
   */

  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\goto_nid\Form\FormSource');
    return $form;
   }
}