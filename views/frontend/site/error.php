<?php
/**
 * @see \app\controllers\frontend\SiteController
 * @see \yii\web\ErrorAction
 */

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
$this->context->layout = 'overall';

$contactUrl = Url::to(['help/contact']);
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= Yii::t('error', 'The above error occurred while the Web server was processing your request.') ?>
    </p>
    <p>
        <?= Yii::t('error', 'Please <a href="{contactUrl}">contact us</a> if you think this is a server error. Thank you.', ['contactUrl' => $contactUrl]) ?>
    </p>

</div>
