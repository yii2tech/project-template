<?php

use app\models\filedb\IdentityStatus;
use yii\grid\GridView;
use yii2tech\admin\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Html;
use yii2tech\admin\grid\DeleteStatusColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\backend\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= GridView::widget([
    'as clientScript' => yii\jquery\GridViewClientScript::class,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'username',
        'email:email',
        [
            '__class' => DeleteStatusColumn::class,
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

        [
            '__class' => ActionColumn::class,
        ],
    ],
]); ?>
