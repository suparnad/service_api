<?php

namespace Drupal\Tests\services_api\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Functional tests for the Services API controller.
 *
 * @group services_api
 */
class ServicesApiControllerTest extends BrowserTestBase
{

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['services_api'];

  /**
   * The default theme for testing.
   *
   * @var string
   */
  protected $defaultTheme = 'stark';

  /**
   * A logged-in user with required permissions.
   *
   * @var \Drupal\user\UserInterface|null
   */
  protected $authenticatedUser;

  /**
   * Set up test user and login.
   */
  protected function setUp(): void
  {
    parent::setUp();

    $this->authenticatedUser = $this->drupalCreateUser(['access content']);
    $this->drupalLogin($this->authenticatedUser);

    $this->assertNotNull($this->authenticatedUser, 'User should be logged in for testing.');
  }

  /**
   * Test GET /services returns the full list of services.
   */
  public function testGetAllServices(): void
  {
    $this->drupalGet('/services?_format=json', [], ['Accept' => 'application/json']);
    $this->assertSession()->statusCodeEquals(200);

    $data = json_decode($this->getSession()->getPage()->getContent(), TRUE);

    $this->assertIsArray($data, 'Response should be an array.');
    $this->assertCount(4, $data, 'There should be exactly 4 services.');
    $this->assertEquals('Fly Tipping', $data[3]['description']);
  }

  /**
   * Test GET /services?serviceCode=FLY_TIPPING returns one service.
   */
  public function testGetServiceByCode(): void
  {
    $this->drupalGet('/services?serviceCode=FLY_TIPPING&_format=json', [], ['Accept' => 'application/json']);
    $this->assertSession()->statusCodeEquals(200);

    $data = json_decode($this->getSession()->getPage()->getContent(), TRUE);

    $this->assertIsArray($data);
    $this->assertEquals('FLY_TIPPING', $data['serviceCode']);
    $this->assertEquals('Fly Tipping', $data['description']);
  }

  /**
   * Test GET with invalid serviceCode returns 404.
   */
  public function testInvalidServiceCodeReturns404(): void
  {
    $this->drupalGet('/services?serviceCode=INVALID_CODE&_format=json', [], ['Accept' => 'application/json']);
    $this->assertSession()->statusCodeEquals(404);
  }
}
