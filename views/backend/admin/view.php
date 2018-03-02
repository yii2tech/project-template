<?php
/**
 * @see \app\controllers\backend\AdminController
 * @see \yii2tech\admin\actions\View
 */

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Admin */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Administrators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['contextMenuItems'] = [
    ['update', 'id' => $model->id],
    ['delete', 'id' => $model->id],
];
if ($model->isActive) {
    $this->params['contextMenuItems'][] = [
        'label' => Yii::t('admin', 'Suspend Account'),
        'icon' => 'remove',
        'class' => 'btn-warning',
        'data' => [
            'confirm' => Yii::t('admin', 'Are you sure you want to suspend this account?'),
            'method' => 'post',
        ],
        'url' => ['suspend', 'id' => $model->id],
    ];
} elseif (!$model->isDeleted) {
    $this->params['contextMenuItems'][] = [
        'label' => Yii::t('admin', 'Activate Account'),
        'icon' => 'repeat',
        'class' => 'btn-success',
        'data' => [
            'confirm' => Yii::t('admin', 'Are you sure you want to activate this account?'),
            'method' => 'post',
        ],
        'url' => ['activate', 'id' => $model->id],
    ];
}

$this->params['contextMenuItems'][] = [
    'label' => Yii::t('admin', 'Auth Logs'),
    'icon' => 'log-in',
    'url' => ['/admin-auth-log/index', 'adminId' => $model->id],
];
?>
<div class="row">
    <div class="col-lg-8 detail-view-wrap">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'email:email',
                [
                    'attribute' => 'statusId',
                    'value' => $model->status->name,
                ],
                'createdAt:date',
                'updatedAt:date',
                [
                    'label' => Yii::t('auth', 'Last Login Date'),
                    'format' => 'datetime',
                    'value' => $model->id === Yii::$app->user->identity->id ? $model->preLastLoginDate : $model->lastLoginDate,
                ],
            ],
        ]) ?>
    </div>
</div>