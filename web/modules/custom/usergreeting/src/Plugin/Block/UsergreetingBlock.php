<?php

declare(strict_types = 1);

namespace Drupal\usergreeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\usergreeting\GreetingTime;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Usergreeting' Block.
 *
 * @Block(
 *   id = "usergreeting_block",
 *   admin_label = @Translation("Usergreeting"),
 *   category = @Translation("Usergreeting"),
 * )
 */
class UsergreetingBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The greeting message.
   *
   * @var \Drupal\usergreeting\GreetingTime
   */
  protected $greeting;

  /**
   * Construct a UsergreetingBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\usergreeting\GreetingTime $greeting
   *   The greeting message.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, GreetingTime $greeting) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->greeting = $greeting;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition,
      $container->get('usergreeting.greeting')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $greetuser = $this->greeting->greetingMessage();

    $build['greetuser'] = $greetuser;

    $build['#cache']['max-age'] = 0;
    return $build;

  }

}
