<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Categorias;
use app\models\Temporales;
use app\models\Stock;
use app\models\Cupones;

/* @var $this yii\web\View */
/* @var $model app\models\Cupones */

$this->title = $producto->nombre;
?>
<style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
      .canvas-container {
  position: relative;
  max-width: 1024px;
  min-width: 320px;
  margin: 0 auto;
}
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
<div class="cupones-view">
    <div class="panel panel-primary  row">
        <div class="panel-heading">
            <h1>Cupon por:  <?=$this->title ?></h1>
        </div>
        <div class="panel-body">
            <section><p>Fecha de compra: <?= $cupon->fecha ?>.    Costo: $<?=$producto->precio ?></p>
                <hr>
                <article>
                    <p>Descripcion</p>
                    <p><?= $producto->descripcion_larga ?></p>
                </article>
                <hr>
                <article>
                    <p>Condiciones</p>
                    <p><?= $producto->condiciones ?></p>
                </article>
                <hr>
                <article>
                    <p>Ubicacion</p>
                    
                    <div id="map-canvas"></div>
                    
                </article>
            </section>
        
        </div>
    

</div>
<?php $ubicacion = $producto->ubicacion;
    $arreglo = explode(',', $ubicacion);
    $latitud = explode(':',$arreglo[0]);
    $longitud = explode(':',$arreglo[1]);
?>
<input type='hidden' value='<?= $latitud[1] ?>'  id='latitud'/>
<input type='hidden' value='<?= $longitud[1] ?>' id='longitud' />
<script>
function initialize() {
    var latitud=document.getElementById('latitud').value;
    var longitud=document.getElementById('longitud').value;
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      center: new google.maps.LatLng(latitud,longitud),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(mapCanvas,mapOptions);
    google.maps.event.addListener(map, 'click', function( event ){
        document.getElementById('productos-ubicacion').value="Latitud: "+event.latLng.lat()+" "+", Longitud: "+event.latLng.lng();
});
    var marcador = new google.maps.LatLng(latitud,longitud);
    var marker = new google.maps.Marker({
      position: marcador,
      map: map,
      title: ''
  });
  marker.setMap(map);
}



google.maps.event.addDomListener(window, 'load', initialize);


</script>