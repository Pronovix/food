<?php

declare(strict_types = 1);

namespace Drupal\recommended_recipe\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RecommendedRecipeController.
 */
class RecommendedRecipeController extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   *
   *
   * @param \Drupal\Core\Entity\EntityTypeManager $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManager $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Returns the recipe title and url in a JSON format.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The recipe output.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @throws \Drupal\Core\Entity\EntityMalformedException
   */
  public function content(): JsonResponse {
    return new JsonResponse(
      [
        'data' => $this->getResults(),
        'method' => 'GET',
      ]
    );

  }

  /**
   * Get the data of the random recipe .
   *
   * @return array
   *   The title and the url of the recipe
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   * @throws \Drupal\Core\Entity\EntityMalformedException
   */
  private function getResults(): array {

    $ids = \Drupal::entityQuery('node')
      ->condition('type', 'article')
      ->condition('status', 1)
      ->condition('field_type_of_food.entity.name', 'Breakfast')
      ->execute();

    $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($ids);
    shuffle($nodes);
    $firstItem = reset($nodes);

    return [
      'Recipe name' => $firstItem->title->value,
      'url' => \Drupal::request()->getHost() . $firstItem->toUrl()->toString(),
    ];
  }

}
