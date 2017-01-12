Codeception Testing
===================

This project uses Codeception as a test framework.
There are already some sample tests prepared in `tests` directory of `frontend` and `backend`.
In order for the following procedure to work, it is assumed that the application has been initialized using
the `dev` environment.
Tests require an **additional database**, which will be cleaned up between tests.
Create database e.g. `myproject_test` in mysql (according to config in `config/local.php`).
You should ensure testing database is applied at local configuration file. Following configuration code
may provide this:

```php
// file `config/local.php`

$config = [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=127.0.0.1;dbname=myproject' . (YII_ENV === 'test' ? '_test' : ''),
            // ...
        ],
        // ...
    ],
];

// ...

return $config;
```

You will need to apply migrations for the test database. This can be performed executing following command:

```
php tests/codeception/yii migrate
```

Then all sample tests can be started by running:

```
composer exec 'codecept run' -vv
```

It is recommended to keep your tests up to date. If a class, or functionality is deleted, corresponding tests should be deleted as well.
You should run tests regularly, or better to set up Continuous Integration server for them.

Please refer to [Yii2 Framework Case Study](http://codeception.com/for/yii) to learn how to configure Codeception for your application.


### Frontend

Frontend tests contain unit tests, functional tests, and acceptance tests.
Execute them by running:

```
composer exec 'codecept run -- -c tests/codeception/frontend' -vv
```

Description of test suites:

* `unit` - classes related to frontend application only.
* `functional` - application internal requests/responses (without a web server).
* `acceptance` - web application, user interface and javascript interactions in real browser.

By default acceptance tests are not supported, to run them use:

#### Running Acceptance Tests

To execute acceptance tests do the following:

1. Rename `tests/codeception/frontend/acceptance.suite.yml.example` to `tests/codeception/frontend/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer

    ```
    composer update
    ```

4. Auto-generate new support classes for acceptance tests:

    ```
    composer exec 'codecept build -- -c tests/codeception/frontend' -vv
    ```

5. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

6. Start web server:

    ```
    php -S 127.0.0.1:8080 -t frontend/web
    ```

7. Now you can run all available tests

   ```
   composer exec 'codecept run acceptance -- -c tests/codeception/frontend' -vv
   ```

You can always skip acceptance tests from run using following command:

```
composer exec 'codecept run -s acceptance' -vv
```


## Backend

Backend application contain unit and functional test suites. Execute them by running:

```
composer exec 'codecept run -- -c tests/codeception/backend' -vv
```

Setup of the acceptance tests for backend is similar to the one used at frontend.