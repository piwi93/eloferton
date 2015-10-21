<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cupones */

$this->title = 'Create Cupones';
$this->params['breadcrumbs'][] = ['label' => 'Cupones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cupones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
