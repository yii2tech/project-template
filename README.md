Yii 2 Project Template
======================

Yii 2 Project Template.


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
