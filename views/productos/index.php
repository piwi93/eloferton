<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
?>
<div class="productos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar oferta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'nombre',
            'descripcion_corta',
        //    'descripcion_larga',
            'precio',
            // 'tipo',
            ['attribute'=>'tipo',
            'value'=>'tipoLabel'
                ],
            // 'categoria',
            // 'condiciones',
            // 'ubicacion',
             ['attribute'=>'activa',
            'value'=>'activaLabel'
                ],

            ['class' => 'yii\grid\ActionColumn',
            'buttons' => ['view' => function ($url,$model) {
                                /** @var ActionColumn $column */
                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('yii', 'Ver'),
                                ]);
                        }

            ,'update' => function ($url,$model) {
                                /** @var ActionColumn $column */
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('yii', 'Editar'),
                                ]);
                        },
            'delete' => function(){
                return '';
            }]
            ],
        ],
    ]); ?>

</div>
