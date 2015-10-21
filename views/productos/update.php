<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = 'Editar producto: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="productos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'img_model' => $img_model
    ]) ?>

   

</div>

<?php 
    $this->registerJsFile('/js/moment.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/moment-whth-locales.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/bootstrap-datetimepicker.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerJsFile('/js/calendario.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
?>

<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css" />
 