<?php

namespace Drupal\Tests\services_api\Unit;

use Drupal\services_api\Service\ServiceRepository;
use PHPUnit\Framework\TestCase;

/** 
 * Unit tests for the ServiceRepository class. * * @group services_api 
 */
class ServiceRepositoryTest extends TestCase
{
  /** 
   * The repository under test. 
   *  
   *  @var \Drupal\services_api\Service\ServiceRepository 
   */

  protected ServiceRepository $repository;

  /** 
   * Sets up the test case. 
   */
  protected function setUp(): void
  {
    parent::setUp();
    $this->repository = new ServiceRepository();
  }
  /** 
   * Tests that getAll() returns all services. 
   */
  public function testGetAllReturnsAllServices(): void
  {
    $services = $this->repository->getAll();
    $this->assertIsArray($services);
    $this->assertCount(4, $services);
    foreach ($services as $service) {
      $this->assertArrayHasKey('serviceCode', $service);
      $this->assertArrayHasKey('description', $service);
    }
  }
  /** 
   * Tests getByCode() for a known service code. 
   */
  public function testGetByCodeReturnsCorrectService(): void
  {
    $service = $this->repository->getByCode('FLY_TIPPING');
    $this->assertNotNull($service);
    $this->assertEquals('Fly Tipping', $service['description']);
  }
  /** 
   * Tests getByCode() for an unknown service code. 
   */
  public function testGetByCodeReturnsNullForInvalidCode(): void
  {
    $service = $this->repository->getByCode('INVALID_CODE');
    $this->assertNull($service);
  }
}
