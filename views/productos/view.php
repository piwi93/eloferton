<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Categorias;
use app\models\Temporales;
use app\models\Stock;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        $tipo = $model->tipo;
        if ($tipo == 0){
            $tipo = 'Normal';
        }
        elseif($tipo == 1){
            $tipo = 'Por tiempo';
        }
        else{
            $tipo = 'Hasta agotar stcok';
        }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descripcion_corta',
            'descripcion_larga',
            'precio',
            ['attribute'=>'tipo',
            'value' => $tipo,
                ],
                
            ['attribute'=>'categoria',
            'value' => Categorias::findOne($model->categoria)->nombre,
                ],
            'condiciones',
            'ubicacion',
        ],
    ]) ?>
<p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->activa == 0){
            echo Html::a('Activar', ['activacion', 'id' => $model->id], ['class' => 'btn btn-success']);
        }
        else{
            echo Html::a('Desactivar', ['activacion', 'id' => $model->id], ['class' => 'btn btn-warning']);
        }?>
    </p>
</div>
