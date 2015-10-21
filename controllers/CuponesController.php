<?php

namespace app\controllers;

use Yii;
use app\models\Cupones;
use app\models\Productos;
use app\models\Temporales;
use app\models\Stock;
use app\models\CuponesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuponesController implements the CRUD actions for Cupones model.
 */
class CuponesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cupones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuponesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cupones model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $cupon=$this->findModel($id);
        $this-> layout = 'frontoffice';
        $producto=Productos::findOne($cupon->idproducto);
        return $this->render('view', ['producto' => $producto,'cupon' => $cupon ]);

    }

    /**
     * Creates a new Cupones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cupones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionGenerarcupon($id){
        $cupon = new Cupones();
        $request = Yii::$app->request;
        $cupon->idusuario= \Yii::$app->user->identity->id;
        $cupon->idproducto = $id;
        $hoy= date('Y-m-d');
        $cupon->fecha = $hoy;
        $producto = Productos::findOne($id);
        $producto->vendidos += 1;
        $cupon->save();
        $producto->update();
        $Models= Stock::findOne( $id);
        if($Models!=null){
            $Models->stock --;
            if($Models==0){
                $producto=Productos::findOne($id);
                $producto->activo=0;
            }
            $Models->save();
        }
        return $this->redirect(['view', 'id' => $cupon->id]);
    }
    
    /**
     * Updates an existing Cupones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cupones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cupones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cupones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cupones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
