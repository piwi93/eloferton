<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
    
    <label>Fecha de nacimiento</label>
  <div class="form-group field-usuario-edad required">
      <div class='input-group date' id='datetimepicker'>
        <input id="usuario-edad" class="form-control" type="text" name="Usuario[edad]" value="<?=$model->edad?>" />
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

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
