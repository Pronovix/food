<?php

namespace Drupal\usergreeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;

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
   * @var AccountInterface $account
   */
  protected $account;

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $account) {
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
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
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
