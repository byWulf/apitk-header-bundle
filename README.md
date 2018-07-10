# api-bundle

## Overview
This bundle provides useful features for a symfony based RESTful API.

## Installation
Add this repository to your `composer.json` until it is available at packagist:
```
{
    "repositories": [{
            "type": "vcs",
            "url": "git@github.com:ofeige/api-bundle.git"
        }
    ]
}
```

After that, install the package via composer:
```
composer install ofeige/api-bundle:dev-master
```

## Usage
### Header information
You can easily add information to the response headers by using the `HeaderInformation` service. These information will automatically be added to the response and prefixed with `x-api-`
```
public function index(HeaderInformation $headerInformation): array
{
    $users = $this->getUsers();
    
    $headerInformation->add('users-count', count($users));

    return $users;
}
```
will result in a response header `x-api-users-count: 15`.

### Deprecations
You can mark actions as deprecated so developers can notice that they have to update their API call to a newer version or to use a whole other endpoint.
```
/**
 * Returns the users in the system.
 *
 * @Rest\Get("/v2/users")
 * @Rest\View()
 *
 * @Api\Deprecated(until="2018-10-09")
 
 * @param User[] $users
 * @return User[]
 */
 ```
 A notice is displayed inside the swagger documentation and a new response header `x-api-deprecated-removed-at: 2018-10-09` will be sent to the client.
