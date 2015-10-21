<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Temporales */

$this->title = 'Create Temporales';
$this->params['breadcrumbs'][] = ['label' => 'Temporales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temporales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
