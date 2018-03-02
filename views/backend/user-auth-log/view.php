<?php
/**
 * @see \app\controllers\backend\UserAuthLogController
 * @see \yii2tech\admin\actions\View
 */

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\UserAuthLog */
/* @var $controller app\controllers\backend\UserAuthLogController|yii2tech\admin\behaviors\ContextModelControlBehavior */

$controller = $this->context;
$contextUrlParams = $controller->getContextQueryParams();

$this->title = $model->user->username . ' ' . Yii::$app->formatter->asDatetime($model->date);
foreach ($controller->getContextModels() as $name => $contextModel) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Users'), 'url' => $controller->getContextUrl($name)];
    $this->params['breadcrumbs'][] = ['label' => $contextModel->username, 'url' => $controller->getContextModelUrl($name)];
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'User Auth Logs'), 'url' => array_merge(['index'], $contextUrlParams)];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-8">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'userId',
                'format' => 'raw',
                'value' => Html::a(Html::encode($model->user->username), ['/user/view', 'id' => $model->user->id]),
            ],
            'date:datetime',
            'cookieBased:boolean',
            'duration',
            [
                'attribute' => 'error',
                'value' => $model->error === null ? '-' : $model->error,
            ],
            'ip',
            'host',
            'url:url',
            'userAgent',
        ],
    ]) ?>
    </div>
</div>