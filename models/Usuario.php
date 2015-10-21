<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $id
 * @property string $username
 * @property string $nombre
 * @property string $apellido
 * @property string $edad
 * @property string $sexo
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $activate
 *
 * @property Cupones[] $cupones
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nombre', 'apellido', 'edad', 'sexo', 'email', 'password'], 'required'],
            [['edad'], 'safe'],
            [['nombre'], 'string', 'max' => 50],
            [['apellido'], 'string', 'max' => 50],
            [['sexo'], 'string', 'max' => 20],
            [['email', 'password'], 'string', 'max' => 100],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'edad' => 'Edad',
            'sexo' => 'Sexo',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCupones()
    {
        //return $this->hasMany(Cupones::className(), ['idusuario' => 0]);
        $id = \Yii::$app->user->identity->id;
        $cupones = Cupones::find()->where(["idusuario" => $id])->all();
        return $cupones;
    }
}
