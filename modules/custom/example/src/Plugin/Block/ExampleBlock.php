<?php

namespace Drupal\example\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Block(
 *   id = "example_block",
 *   admin_label = @Translation("Example block"),
 *   category = @Translation("Example")
 * )
 */
class ExampleBlock extends BlockBase {

  public function defaultConfiguration() {
    return array(
      'row_count' => 10,
      'range' => array(
        'min' => 0,
        'max' => 100,
      ),
    );
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['row_count'] = array(
      '#type' => 'number',
      '#title' => $this->t('Row count'),
      '#default_value' => $this->configuration['row_count'],
    );

    $form['range']['min'] = array(
      '#type' => 'number',
      '#title' => $this->t('Range (min)'),
      '#default_value' => $this->configuration['range']['min'],
    );

    $form['range']['max'] = array(
      '#type' => 'number',
      '#title' => $this->t('Range (max)'),
      '#default_value' => $this->configuration['range']['max'],
    );
    return $form;
  }


  /**
   * Builds and returns the renderable array for this block plugin.
   *
   * @return array
   *   A renderable array representing the content of the block.
   *
   * @see \Drupal\block\BlockViewBuilder
   */
  public function build() {

    $row_count = $this->configuration['row_count'];
    $min = $this->configuration['range']['min'];
    $max = $this->configuration['range']['max'];

    $table = array(
      '#type' => 'table',
      '#header' => array(
        $this->t('Random number'),
        $this->t('Row'),
      ),
    );

    for ($i = 1; $i <= $row_count; $i++) {
      $table[] = array(
        array('#markup' => rand($min, $max)),
        array('#markup' => $i),
      );
    }

    return $table;
  }



}