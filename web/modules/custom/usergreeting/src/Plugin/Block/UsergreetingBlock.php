<?php

declare(strict_types = 1);

namespace Drupal\usergreeting\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
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
   * The user account.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

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
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user account.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, GreetingTime $greeting, AccountInterface $account) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->greeting = $greeting;
    $this->account = $account;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static($configuration, $plugin_id, $plugin_definition,
      $container->get('usergreeting.greeting'),
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $greetuser = $this->greeting->greetingMessage();
    $message = [
      '#cache' => [
        'max-age' => 0,
      ],
      '#prefix' => $greetuser,
      '#suffix' => '!',
    ];

    if ($this->account->isAuthenticated() === TRUE) {
      $message['#theme'] = 'username';
      $message['#account'] = $this->account;
    }

    return $message;
  }

}
