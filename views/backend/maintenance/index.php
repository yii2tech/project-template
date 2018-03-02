<?php
/**
 * @see \app\controllers\backend\MaintenanceController::actionIndex()
 */

use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('admin', 'Maintenance');
$this->params['breadcrumbs'][] = $this->title;

$rows = [
    [
        'title' => Yii::t('admin-content', 'Flush Cache'),
        'description' => Yii::t('admin-content', 'Clear application runtime cache, making sure recent changes appear.'),
        'url' => ['flush-cache'],
        'icon' => 'refresh',
        'options' => [
            'class' => 'btn btn-primary',
        ],
    ],
    [
        'title' => Yii::t('admin-content', 'Generate Sitemap'),
        'description' => Yii::t('admin-content', 'Generates sitemap (regenerates if exists), applying recent changes to it.'),
        'url' => ['generate-sitemap'],
        'icon' => 'align-left',
        'options' => [
            'class' => 'btn btn-primary',
        ],
    ],
];
?>
<div class="row">
    <div class="col-lg-6">
        <p><?= Yii::t('admin-content', 'This section allows you to perform some maintenance of your system.') ?></p>
        <p><?= Yii::t('admin-content', 'Note: some actions may take long time to be performed.') ?></p>

        <table class="table table-bordered table-striped">
            <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td>
                        <b><?php echo $row['title']; ?></b><br>
                        <?php echo $row['description']; ?>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <?= Html::a(Html::icon($row['icon']) . ' ' . $row['title'], $row['url'], $row['options']); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>