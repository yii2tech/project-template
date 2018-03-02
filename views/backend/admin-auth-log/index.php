<?php
/**
 * @see \app\controllers\backend\AdminAuthLogController
 * @see \yii2tech\admin\actions\Index
 */

use app\models\db\AdminAuthLog;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii2tech\admin\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\backend\AdminAuthLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $controller app\controllers\backend\AdminAuthLogController|yii2tech\admin\behaviors\ContextModelControlBehavior */

$controller = $this->context;
$contextUrlParams = $controller->getContextQueryParams();

$this->title = Yii::t('admin', 'Administrator Auth Logs');
foreach ($controller->getContextModels() as $name => $contextModel) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Administrators'), 'url' => $controller->getContextUrl($name)];
    $this->params['breadcrumbs'][] = ['label' => $contextModel->username, 'url' => $controller->getContextModelUrl($name)];
}
$this->params['breadcrumbs'][] = $this->title;

$authErrorLabels = $searchModel->authErrorLabels();
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions' => function ($model, $key, $index, $grid) {
        /* @var $model AdminAuthLog */
        if ($model->error === null) {
            return ['class' => 'success'];
        } else {
            return ['class' => 'danger'];
        }
    },
    'columns' => [
        'id',
        [
            'attribute' => 'date',
            'format' => 'datetime',
        ],
        [
            'attribute' => 'cookieBased',
            'format' => 'boolean',
            'filter' => [
                '1' => Yii::t('yii', 'Yes'),
                '0' => Yii::t('yii', 'No'),
            ],
        ],
        'duration',
        [
            'attribute' => 'error',
            'filter' => array_merge([
                '-' => '-',
            ], $authErrorLabels),
            'value' => function ($model) use ($authErrorLabels) {
                if ($model->error === null) {
                    return '-';
                }
                if (isset($authErrorLabels[$model->error])) {
                    return $authErrorLabels[$model->error];
                }
                return $model->error;
            },
        ],
        'ip',
        'host',
        'url:url',
        'userAgent',
        [
            'attribute' => 'username',
            'header' => $searchModel->getAttributeLabel('username'),
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a(Html::encode($model->admin->username), ['/admin/view', 'id' => $model->admin->id]);
            },
            'visible' => !$controller->isContextActive('admin')
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{view}',
        ],
    ],
]); ?>
