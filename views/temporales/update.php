<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Temporales */

$this->title = 'Update Temporales: ' . ' ' . $model->idproducto;
$this->params['breadcrumbs'][] = ['label' => 'Temporales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproducto, 'url' => ['view', 'id' => $model->idproducto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temporales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
