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
    <table class="table table-striped table-bordered detail-view">
        <tr>
            <td>Descripción corta</td><td><?=$model->descripcion_corta ?></td>
        </tr>
        <tr>
            <td>Descripción larga</td><td><?=$model->descripcion_larga ?></td>
        </tr>
        <tr>
            <td>Precio</td><td><?=$model->precio ?></td>
        </tr>
        <tr>
            <td>Tipo</td><td>Por tiempo</td>
        </tr>
        <tr>
            <td>Fecha</td><td><?= $temporal->fecha ?></td>
        </tr>
        <tr>
            <td>Categoria</td><td><?=Categorias::findOne($model->categoria)->nombre ?></td>
        </tr>
    </table>
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
