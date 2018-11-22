<?php

/**
 * @file
 * Contains \Drupal\goto_nid\Plugin\Block\goto_nid_block.
 */
namespace Drupal\goto_nid\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'goto node' block.
 *
 * @Block(
 *   id = "goto_nid_block",
 *   admin_label = @Translation("goto nid block"),
 *   category = @Translation("goto node block")
 * )
 */

class goto_nid_block extends BlockBase{

  /**
   * {@inheritdoc}
   */

  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\goto_nid\Form\form_source');
    return $form;
   }
}
