# Services API (Drupal 11 Module)

Provides a RESTful API endpoint `/services` that returns a list of services in JSON format. Supports filtering by `serviceCode` and includes proper 404 error handling.

---

## Description

This Drupal 11 custom module demonstrates a clean, testable Web API using modern design patterns like the Repository Pattern and Dependency Injection. It's ideal for interview showcases and API architecture demonstrations.

---

## Features

- `/services`: Returns all services.
- `/services?serviceCode=FLY_TIPPING`: Returns a single service.
- Returns a `404 Not Found` if an invalid serviceCode is provided.
- Clean separation of concerns using SOLID principles.
- Includes unit and functional tests.

---

## Architecture & Best Practices

- **Repository Pattern**: Decouples data access logic from business logic.
- **Dependency Injection**: Controller depends on an interface, not a concrete class.
- **SOLID Principles**:
  - **Single Responsibility**: Controller and Repository do one thing each.
  - **Dependency Inversion**: Depends on abstractions.
  - **Interface Segregation**: Allows mocking in tests.

---

## Usage

### 1. Enable the module

```bash
drush en services_api
