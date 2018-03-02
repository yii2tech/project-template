<?php
/**
 * @see \app\controllers\frontend\SiteController::actionAbout()
 */

use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('content', 'About {appName}', ['appName' => Yii::$app->name]);
$this->params['breadcrumbs'][] = Yii::t('content', 'About');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>