<?php
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 use yii\jui\DatePicker;
 use yii\web\View;
 
 $this->title = "Nuevo Usuario";
?>
<style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
<script src="https://maps.googleapis.com/maps/api/js"></script>

<link rel="stylesheet" href="/css/register.css" type="text/css"/>

<?php if(!isset($msg)){ ?>
 <div class="form-registro">
  <h1>Nuevo Usuario</h1>
  
  <?php $form = ActiveForm::begin([
      'method' => 'post',
       'id' => 'formulario',
       'enableClientValidation' => false,
       'enableAjaxValidation' => true,
      ]);
  ?>
  
  <div class="form-group">
   <?= $form->field($model, "username")->input("text") ?>   
  </div>
  
  <div class="form-group">
   <?= $form->field($model, "nombre")->input("text") ?>   
  </div>
  
  <div class="form-group">
   <?= $form->field($model, "apellido")->input("text") ?>   
  </div>
  
  <label>Fecha de nacimiento</label>
  <div class="form-group field-signin-edad required">
      <div class='input-group date' id='datetimepicker'>
        <input id="signin-edad" class="form-control" type="text" name="SignIn[edad]" />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar">
            </span>
        </span>
      </div>
      <div class="help-block"></div>
 </div>
 
  <div class="form-group">
   <?=$form->field($model, 'sexo')->dropDownList([Hombre, Mujer]) ?>
  </div>
  
  <div class="form-group">
   <?= $form->field($model, "email")->input("email") ?>   
  </div>
  
  <div class="form-group">
   <?= $form->field($model, "password")->input("password") ?>   
  </div>
  
  <div class="form-group">
   <?= $form->field($model, "password_repeat")->input("password") ?>   
  </div>
  
  <!--p>O registrese con un servicio externo</p>
 <span id="signinButton">
   <span
     class="g-signin"
     data-callback="signinCallback"
     data-clientid="722315234599-b63o4nggljm5hm17qhj45hoibsk24usl.apps.googleusercontent.com"
     data-cookiepolicy="single_host_origin"
     data-requestvisibleactions="http://schemas.google.com/AddActivity"
     data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email">
   </span>
 </span-->
  
  <?= Html::submitButton("Registrarse", ["class" => "btn btn-primary"]) ?>
 </div>
<?php $form->end() ?>

<?php } else{ ?>
 <div id="form-msg" class="form-registro">
   <h3 id="msg"><?php echo $msg; ?></h3>
 </div>
<?php } 
    $this->registerJsFile('/js/moment.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/moment-whth-locales.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
    $this->registerJsFile('/js/bootstrap-datetimepicker.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerJsFile('/js/calendario.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
?>

<link rel="stylesheet" href="/css/bootstrap-datetimepicker.css" />

<!--
<script type="text/javascript">
      (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client:plusone.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
     
     function signinCallback(authResult) {
  if (authResult['access_token']) {
     getEmail(); 
     
    // Autorizado correctamente
    // Oculta el botón de inicio de sesión ahora que el usuario está autorizado, por ejemplo:
    document.getElementById('signinButton').setAttribute('style', 'display: none');
    
  } else if (authResult['error']) {
    // Se ha producido un error.
    // Posibles códigos de error:
    //   "access_denied": el usuario ha denegado el acceso a la aplicación.
    //   "immediate_failed": no se ha podido dar acceso al usuario de forma automática.
    // console.log('There was an error: ' + authResult['error']);
  }
}
function getEmail(){
    // Carga las bibliotecas oauth2 para habilitar los métodos userinfo.
    gapi.client.load('oauth2', 'v2', function() {
          var request = gapi.client.oauth2.userinfo.get();
          request.execute(getEmailCallback);
        });
  }

  function getEmailCallback(obj){
    var el = document.getElementById('email');
    var email = '';

    if (obj['email']) {
      email = 'Email: ' + obj['email'];
    }

    //console.log(obj);   // Sin comentario para inspeccionar el objeto completo.

    el.innerHTML = email;
    toggleElement('email');
  }
    </script>
-->