<?php

namespace Drupal\services_api\Service;

/**
 * A simple service repository with hardcoded service data.
 */
class ServiceRepository implements ServiceRepositoryInterface
{

  /**
   * A list of predefined services.
   *
   * @var array
   */
  protected array $services = [
    [
      'serviceCode' => 'BLOCKED_DRAIN_GULLY',
      'description' => 'Blocked Drain',
      'metadata' => true,
      'type' => 'realtime',
    ],
    [
      'serviceCode' => 'CAR_PARK_CLEANSING',
      'description' => 'Car Park Cleansing',
      'metadata' => true,
      'type' => 'realtime',
    ],
    [
      'serviceCode' => 'DEAD_ANIMAL',
      'description' => 'Dead Animals',
      'metadata' => true,
      'type' => 'realtime',
    ],
    [
      'serviceCode' => 'FLY_TIPPING',
      'description' => 'Fly Tipping',
      'metadata' => true,
      'type' => 'realtime',
    ],
  ];

  /**
   * {@inheritdoc}
   */
  public function getAll(): array
  {
    return $this->services;
  }

  /**
   * {@inheritdoc}
   */
  public function getByCode(string $code): ?array
  {
    foreach ($this->services as $service) {
      if ($service['serviceCode'] === $code) {
        return $service;
      }
    }
    return null;
  }
}
