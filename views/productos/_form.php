<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Categorias;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<div class="productos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion_corta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion_larga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?= $form->field($model, 'tipo')->dropDownList( ['Normal','Por tiempo','Por stock'],['class'=>'tipoSelected form-control']) ?>
    
    <div class="loadTipo"></div>
    
    <?=   $form->field($model, 'categoria')->dropDownList( ArrayHelper::map(Categorias::find()->All(), 'id', 'nombre')) ?>

    <?= $form->field($model, 'condiciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true]) ?>
    <div id="map-canvas"></div>
    
    <?= $form->field($model, 'activa')->dropDownList( ['Aún no publicada','Publicada']) ?>
    
    
    <?= $form->field($img_model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      center: new google.maps.LatLng(-34.8977714, -56.165),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas,mapOptions);
    
    var markers = [];
    google.maps.event.addListener(map, 'click', function( event ){
        
        document.getElementById('productos-ubicacion').value="Latitud: "+event.latLng.lat()+" "+", Longitud: "+event.latLng.lng();
        var marcador = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
        var marker = new google.maps.Marker({
      position: marcador,
      draggable:true,
      animation: google.maps.Animation.DROP,
      map: map,
      title: ''
  });
  markers.push(marker);
  if(markers.length==1){
      markers[0].setMap(map);
  }else{
      markers[0].setMap(null);
      markers.splice(0,1);
      marker.setMap(map);    
  }
  
        
    });
     
}
   

google.maps.event.addDomListener(window, 'load', initialize);

</script>