<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->username;
//$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/css/usuariosView.css" type="text/css"/>

<div class="usuario-view col-sm-12">
    <div id="titulo">
        <h1 class="text-capitalize"><span class="glyphicon glyphicon-user"></span> <?= Html::encode($this->title) ?></h1>
        <hr>
    </div>
    <div id="cuadro" class="row col-sm-12">
    
        
        
        <?php $loggedId = \Yii::$app->user->identity->id;
        if($loggedId == 0){ if($model->id != 0){ ?>
            <p>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => 'Seguro que desea eliminar este usuario?','method' => 'post', ], ]) ?>
            </p>
        <?php } } ?>
    
        <div id="datosPersonales" class="col-sm-8">
            <div>
                <h3>
                    <strong>Nombre: </strong><?php echo ucwords($model->nombre); ?>
                </h3>
            </div>
            <div>
                <h3>
                    <strong>Apellido: </strong>
                <?php echo ucwords($model->apellido); ?>
                </h3>
            </div>
            <div>
                <h3>
                    <strong>Edad: </strong>
                <?php $f_nacimiento = new DateTime($model->edad);
                        $hoy = new DateTime(date("Y-m-d"));
                        $edad = $hoy->diff($f_nacimiento);
                        echo  $edad->y ; ?>
                </h3>
            </div>
            <div>
                <h3>
                    <strong>Sexo: </strong>
                <?php
                    if($model->sexo == 0)
                        echo 'Hombre';
                    elseif($model->sexo == 1)
                        echo 'Mujer';
                ?>
                </h3>
            </div>
            <div>
                <h3>
                    <strong>Email: </strong>
                    <?php echo $model->email; ?>
                </h3>
            </div>
            <hr>
            <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <hr>
        </div>
    </div>
    
    <div id="cupones" class="row">
        
        <div id="titulo" class="col-sm-12">
            <h1><span class="glyphicon glyphicon-credit-card"></span> Cupones</h1>
        </div>
        <div id="tablaCupones" class="col-sm-12 table-responsive">
            <table class="table">
                <tr>
                    <td>
                        <h3>Id de Cupón</h3>
                    </td>
                    <td>
                        <h3>Nombre de Artículo</h3>
                    </td>
                    <td>
                        <h3>Fecha Compra</h3>
                    </td>
                    <td>
                        <h3>Descripción</h3>
                    </td>
                    <td>
                        <h3>Precio</h3>
                    </td>
                </tr>
                
                <?php foreach($model->getCupones() as $cupon){ 
                ?>
                <tr>
                    <td>
                        <a href="https://obligatoriophp-lordnicus.c9.io/index.php?r=cupones%2Fview&id=<?=$cupon->id ?>"><?=$cupon->id ?></a>
                    </td>
                    <td>
                        <a href="https://obligatoriophp-lordnicus.c9.io/index.php?r=productos%2Fverproducto&id=<?=$cupon->idproducto ?>"><?= $cupon->getIdproducto0()->one()->nombre ?> </a>
                    </td>
                    <td>
                        <p><?= $cupon->fecha ?></p>
                    </td>
                    <td>
                        <p><?= $cupon->getIdproducto0()->one()->descripcion_corta ?></p>
                    </td>
                    <td>
                        <p><?= $cupon->getIdproducto0()->one()->precio ?></p>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
    
</div>