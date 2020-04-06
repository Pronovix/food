<?php

declare(strict_types = 1);

namespace Drupal\usergreeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
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
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, AccountInterface $account) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, string $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition,
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $greetuser = $this->t(\Drupal::service('usergreeting.greeting')->greetingMessage());
    $uid = $this->account->getDisplayname();

    $build['current_user']['#markup'] = '<p>' . $greetuser . $uid . '!</p>';

    return $build;
  }

}
