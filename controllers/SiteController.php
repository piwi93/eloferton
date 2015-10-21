<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\Temporales;
use app\models\ContactForm;
use app\models\SignIn;
use app\models\UsuarioDB;
use app\models\Productos;
use app\models\ProductosSearch;


//prueba
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{

    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
    
    public function actionConfirm()
    {
        $table = new UsuarioDB;
        if (Yii::$app->request->get())
        {
            //Obtenemos el valor de los parámetros get
            $id = Html::encode($_GET["id"]);
            $authKey = $_GET["authKey"];
        
            if ((int) $id)
            {
                //Realizamos la consulta para obtener el registro
                $model = $table
                ->find()
                ->where("id=:id", [":id" => $id])
                ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
     
                //Si el registro existe
                if ($model->count() == 1)
                {
                    $activar = UsuarioDB::findOne($id);
                    $activar->activate = 1;
                    if ($activar->update())
                    {
                        echo "Felicidades, tu registro se ha llevado a cabo correctamente, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                    }
                    else
                    {
                        echo "Ha ocurrido un error al realizar el registro, redireccionando ...";
                        echo "<meta http-equiv='refresh' content='8; ".Url::toRoute("site/login")."'>";
                    }
                 }
                else //Si no existe redireccionamos a login
                {
                    return $this->redirect(["site/login"]);
                }
            }
            else //Si id no es un número entero redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
    }

    
    public function actionSign_in()
    {
      $this-> layout = 'frontoffice';
      //Creamos la instancia con el model de validación
      $model = new SignIn();
       
      //Mostrará un mensaje en la vista cuando el usuario se haya registrado
      $msg = null;
       
      //Validación mediante ajax
      if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
       
      //Validación cuando el formulario es enviado vía post
      //Esto sucede cuando la validación ajax se ha llevado a cabo correctamente
      //También previene por si el usuario tiene desactivado javascript y la
      //validación mediante ajax no puede ser llevada a cabo
      if ($model->load(Yii::$app->request->post()))
      {
       if($model->validate())
       {
        //Preparamos la consulta para guardar el usuario
        $table = new UsuarioDB;
        $table->username = $model->username;
        $table->nombre = $model->nombre;
        $table->apellido = $model->apellido;
        $table->edad = $model->edad;
        $table->sexo = $model->sexo;
        $table->email = $model->email;
        
        //Encriptamos el password
        $table->password = crypt($model->password, Yii::$app->params["salt"]);
        
        //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
        //clave será utilizada para activar el usuario
        $table->authKey = $this->randKey("abcdef0123456789", 200);
        //Creamos un token de acceso único para el usuario
        $table->accessToken = $this->randKey("abcdef0123456789", 200);
         
        //Si el registro es guardado correctamente
        if ($table->insert())
        {
         //Nueva consulta para obtener el id del usuario
         //Para confirmar al usuario se requiere su id y su authKey
         $user = $table->find()->where(["email" => $model->email])->one();
         $id = urlencode($user->id);
         $authKey = urlencode($user->authKey);
          
         $subject = "Confirmar registro - El Oferton!";
         $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
         $body .= "<a href='http://obligatoriophp-lordnicus.c9.io/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";

         //Enviamos el correo
         Yii::$app->mailer->compose()
         ->setTo($user->email)
         ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
         ->setSubject($subject)
         ->setHtmlBody($body)
         ->send();
         
         $model->username = null;
         $model->nombre = null;
         $model->apellido =  null;
         $model->edad = null;
         $model->sexo = 0;
         $model->email = null;
         $model->password = null;
         $model->password_repeat = null;
         
         $msg = "Felicidades, ahora sólo falta que confirmes tu registro en tu cuenta de correo";
        }
        else
        {
         $msg = "Ha ocurrido un error al llevar a cabo tu registro";
        }
         
       }
       else
       {
        $model->getErrors();
       }
      }
      return $this->render('signIn',['model'=>$model, "msg" => $msg]);
      //return $this->render("register", ["model" => $model, "msg" => $msg]);
    }



    //public $layout = 'frontoffice';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this-> layout = 'frontoffice';
        $parametro=date('Y-m-d');
        $lista = Temporales::find()->where(['fecha' => $parametro ])->all();
        return $this->render('index',['model' => $lista]);
    }

    public function actionLogin()
    {
        $this-> layout = 'frontoffice';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if($model->username === 'admin'){
                $this->redirect(array("site/backoffice"));
            }
            else{
                return $this->goBack();
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }



    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $this-> layout = 'frontoffice';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['admincorreo'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    
      public function actionBackoffice()
    {
        $query = ProductosSearch::getTop10();
        return $this->render('backoffice', ['query' => $query]);
    }

    public function actionAbout()
    {
        $this-> layout = 'frontoffice';
        return $this->render('about');
    }
    
    public function actionPerfil()
    {
        $this->layout="frontoffice";
        return $this->render("perfil");
    }
    
    public function actionSearch()
    {
        $this->layout="frontoffice";
        $parametro = Yii::$app->request->post('nombre');
        $lista = Productos::find()->where(['like','nombre', $parametro ])->orWhere(['like','descripcion_corta',$parametro])->andWhere(['activa' => true])->all();
        return $this->render('search',["model" => $lista]);
        
    }
    
}