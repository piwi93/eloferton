<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Temporales */

$this->title = $model->idproducto;
$this->params['breadcrumbs'][] = ['label' => 'Temporales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temporales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idproducto], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idproducto',
            'fecha_inicio',
            'fecha_fin',
        ],
    ]) ?>

</div>
