<?php

namespace Drupal\services_api\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\services_api\Service\ServiceRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller for the Services API.
 */
class ServicesApiController extends ControllerBase
{

  /**
   * The service repository.
   *
   * @var \Drupal\services_api\Service\ServiceRepositoryInterface
   */
  protected ServiceRepositoryInterface $repository;

  /**
   * Constructs a new ServicesApiController object.
   *
   * @param \Drupal\services_api\Service\ServiceRepositoryInterface $repository
   *   The service repository.
   */
  public function __construct(ServiceRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Returns a list of all services.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response with all services.
   */
  // The controller method that handles GET requests to /services
  public function list(Request $request): JsonResponse
  {
    // Retrieves the value of the "serviceCode" query parameter from the request URL
    $code = $request->query->get('serviceCode');

    // If a specific serviceCode was provided by the user
    if ($code) {
      // Fetch the service details by its code using the repository
      $service = $this->repository->getByCode($code);

      // If the service code is not found, throw a 404 Not Found exception
      if (!$service) {
        throw new NotFoundHttpException('Service not found.');
      }

      // If found, return the service as a JSON response
      return new JsonResponse($service);
    }

    // If no serviceCode is provided, return the full list of services as JSON
    return new JsonResponse($this->repository->getAll());
  }
}
