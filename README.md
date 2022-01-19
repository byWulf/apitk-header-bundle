# apitk-header-bundle

## Overview

This bundle provides useful features for a symfony based RESTful API.

## Installation

Install the package via composer:

```bash
composer require check24/apitk-header-bundle
```

## Usage

### Header information

You can easily add information to the response headers by using the `HeaderInformation` service.
These information will automatically be added to the response and prefixed with `x-apitk-`

```php
public function index(HeaderInformation $headerInformation): array
{
    $users = $this->getUsers();

    $headerInformation->add('users-count', (string) count($users));

    return $users;
}
```

will result in a response header `x-apitk-users-count: 15`.

### Deprecations (apitk-deprecation-bundle)

You can mark actions as deprecated so developers can notice that they have to update their API
call to a newer version or to use a whole other endpoint.

[see CHECK24/apitk-deprecation-bundle](https://github.com/byWulf/apitk-deprecation-bundle)
