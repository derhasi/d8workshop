<?php

namespace Drupal\example\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\example\CurrencyManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Block(
 *   id = "example_block",
 *   admin_label = @Translation("Example block"),
 *   category = @Translation("Example")
 * )
 */
class ExampleBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\example\CurrencyManager
   */
  protected $currencyManager;

  /**
   * Creates an instance of the plugin.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container to pull out services used in the plugin.
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   *
   * @return static
   *   Returns an instance of this plugin.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $currency_manager = $container->get('plugin.manager.currency');
    return new static($configuration, $plugin_id, $plugin_definition, $currency_manager);
  }

  public function __construct($configuration, $plugin_id, $plugin_definition, CurrencyManager $currency_manager) {
    $this->currencyManager = $currency_manager;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  public function defaultConfiguration() {
    return array(
      'currency' => 'euro',
      'row_count' => 10,
      'range' => array(
        'min' => 0,
        'max' => 100,
      ),
    );
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['currency'] = array(
      '#type' => 'select',
      '#title' => t('Currency'),
      '#default_value' => $this->configuration['currency'],
      '#options' => $this->currencyManager->getOptions(),
    );

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

    $currency = $this->currencyManager->createInstance($this->configuration['currency']);
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
        //@todo: check_plain
        array('#markup' => rand($min, $max) . ' ' . $currency->getSymbol()),
        array('#markup' => $i),
      );
    }

    return array(
      'table' => $table,

    );
  }



}