<?php

namespace Drupal\services_api\Service;

/**
 * Defines an interface for accessing service data.
 */
interface ServiceRepositoryInterface
{

  /**
   * Returns all available services.
   *
   * @return array
   *   A list of service arrays.
   */
  public function getAll(): array;

  /**
   * Returns a single service by its code.
   *
   * @param string $code
   *   The service code to look up.
   *
   * @return array|null
   *   The service details array if found, or NULL.
   */
  public function getByCode(string $code): ?array;
}
