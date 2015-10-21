<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->username; //'Mi usuario: '; . ' ' . $model->nombre;
//$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php 
    $this->registerJsFile('/js/moment.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/moment-whth-locales.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/bootstrap-datetimepicker.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerJsFile('/js/calendario.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
?>

<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css" />