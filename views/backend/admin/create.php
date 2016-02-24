<?php

/* @var $this yii\web\View */
/* @var $model app\models\db\Admin */

$this->title = Yii::t('admin', 'Create Admin');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Administrators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
