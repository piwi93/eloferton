<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = 'Crear oferta';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'categorias' => $categorias, 'img_model' => $img_model
    ]) ?>

</div>

<?php 
    $this->registerJsFile('/js/moment.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/moment-whth-locales.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/bootstrap-datetimepicker.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerJsFile('/js/calendario.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
?>

<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css" />