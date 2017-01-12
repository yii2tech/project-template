Yii 2 Project Template
======================

This project is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment.

[![Latest Stable Version](https://poser.pugx.org/yii2tech/project-template/v/stable.png)](https://packagist.org/packages/yii2tech/project-template)
[![Total Downloads](https://poser.pugx.org/yii2tech/project-template/downloads.png)](https://packagist.org/packages/yii2tech/project-template)
[![Build Status](https://travis-ci.org/yii2tech/project-template.svg?branch=master)](https://travis-ci.org/yii2tech/project-template)


REQUIREMENTS
------------

Requirements check script:

```
php requirements.php
```


INSTALLATION
------------

1. Clone the repository into the project destination directory.
2. Switch the project branch to the needed one: 'master', 'stage', 'live' etc.
3. Run the installation script using following command:

```
php install.php init/all
```


ASSET COMPRESSION
-----------------

For assets (CSS and JavaScript) compression use following command:

```
cd /path/to/project/root
php yii asset config/frontend-asset-compress.php config/frontend-assets.php
```

See `config/frontend-asset-compress.php` file for more details.

The 'backend' assets compression is performed as separated command:

```
cd /path/to/project/root
php yii asset config/backend-asset-compress.php config/backend-assets.php
```

See `config/backend-asset-compress.php` file for more details.


SELF-UPDATE
-----------

After successful installation 'stage' or 'production' server can be updated using 'self-update' command.

In order to perform an update, run the following commands:

```
cd /path/to/project/root
php yii self-update config/self-update.php
```


GII
---

Admin section generation:

```
php yii gii/adminCrud --modelClass="app\models\db\{NAME}" --controllerClass="app\controllers\backend\{NAME}Controller" --searchModelClass="app\models\backend\{NAME}Search" --viewPath="@app/views/backend/{NAME}" --enableI18N=1
```

Admin section with context generation:

```
php yii gii/adminCrud --modelClass="app\models\db\{NAME}" --controllerClass="app\controllers\backend\{NAME}Controller" --searchModelClass="app\models\backend\{NAME}Search" --viewPath="@app/views/backend/{NAME}" --contextClass="app\models\db\{CONTEXT}" --enableI18N=1
```


I18N
----

Translation messages generation:

```
php yii message messages/config.php
```

TESTING
-------

This project supports testing via [PHPUnit](https://phpunit.de/) as well as via [Codeception](http://codeception.com)

Regular PHPUnit tests are located under 'tests\unit' directory. In case you have PHPUnit installed you can run them
using `phpunit` command from the project root.

Please refer to [Codeception Testing](tests/codeception/README.md) manual for the details about Codeception tests setup and running.
