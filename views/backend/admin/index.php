<?php

use app\models\filedb\IdentityStatus;
use yii\grid\GridView;
use yii2tech\admin\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii2tech\admin\grid\DeleteStatusColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\backend\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Administrators');
$this->params['breadcrumbs'][] = $this->title;
$this->params['contextMenuItems'] = [
    ['create']
];
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'username',
        'email:email',
        [
            'class' => DeleteStatusColumn::className(),
            'attribute' => 'statusId',
            'filter' => ArrayHelper::map(IdentityStatus::find()->all(), 'id', 'name'),
            'value' => function($data) {return $data->status->name;},
        ],
        [
            'attribute' => 'createdAt',
            'format' => 'date',
            'filter' => false,
        ],
        /*[
            'attribute' => 'updatedAt',
            'format' => 'date',
            'filter' => false,
        ],*/

        ['class' => ActionColumn::className()],
    ],
]); ?>
