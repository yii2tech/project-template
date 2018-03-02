<?php
/**
 * @see \app\controllers\backend\AdminAuthLogController
 * @see \yii2tech\admin\actions\View
 */

use yii\bootstrap\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\AdminAuthLog */
/* @var $controller app\controllers\backend\AdminAuthLogController|yii2tech\admin\behaviors\ContextModelControlBehavior */

$controller = $this->context;
$contextUrlParams = $controller->getContextQueryParams();

$this->title = $model->admin->username . ' ' . Yii::$app->formatter->asDatetime($model->date);
foreach ($controller->getContextModels() as $name => $contextModel) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Administrators'), 'url' => $controller->getContextUrl($name)];
    $this->params['breadcrumbs'][] = ['label' => $contextModel->username, 'url' => $controller->getContextModelUrl($name)];
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Administrator Auth Logs'), 'url' => array_merge(['index'], $contextUrlParams)];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-8">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'adminId',
                'format' => 'raw',
                'value' => Html::a(Html::encode($model->admin->username), ['/admin/view', 'id' => $model->admin->id]),
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