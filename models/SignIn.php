<?php 

namespace app\models;

use Yii;
use yii\base\Model;
//use app\models\Users;

class SignIn extends Model
{
    public $username;
    public $nombre;
    public $apellido;
    public $edad;
    public $sexo;
    public $email;
    public $password;
    public $password_repeat;
    
    public function rules()
    {
        return [
            [['username', 'nombre', 'apellido', 'edad', 'sexo', 'email', 'password', 'password_repeat'], 'required', 'message' => 'Campo obligatorio'],
            ['username', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['username', 'username_existe'],
            ['nombre', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['apellido', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['apellido', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato no válido'],
            ['email', 'email_existe'],
            ['password', 'match', 'pattern' => "/^.{4,16}$/", 'message' => 'Mínimo 4 y máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Los passwords no coinciden'],
        ];
    }
    
    public function email_existe($attribute, $params)
    {
      
      //Buscar el email en la tabla
      $table = UsuarioDB::find()->where("email=:email", [":email" => $this->email]);
      
      //Si el email existe mostrar el error
      if ($table->count() == 1)
      {
          $this->addError($attribute, "El email seleccionado existe");
      }
    }
 
    public function username_existe($attribute, $params)
    {
      //Buscar el username en la tabla
      $table = UsuarioDB::find()->where("username=:username", [":username" => $this->username]);
      
      //Si el username existe mostrar el error
      if ($table->count() == 1)
      {
          $this->addError($attribute, "El usuario seleccionado existe");
      }
    }
}