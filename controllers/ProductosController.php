<?php

namespace app\controllers;

use Yii;
use app\models\Productos;
use app\models\Temporales;
use app\models\Stock;
use app\models\ProductosSearch;
use app\models\CategoriasSearch;
use app\models\Fotos;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productos model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $temporal=Temporales::findOne($id);
        if($temporal!=null){
            return $this->render('temporal',['temporal' => $temporal, 'model' => $model,]);
        }else{
            $stock=Stock::findOne($id);
            if($stock != null){
                return $this->render('stock',['stock' => $stock, 'model' => $model,]);
            }
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionVerproducto($id)
    {
        $this-> layout = 'frontoffice';
        $model=$this->findModel($id);
        $temporal=Temporales::findOne($id);
        if($temporal!=null){
            return $this->render('verProducto',['temporal' => $temporal, 'model' => $model,]);
        }else{
            $stock=Stock::findOne($id);
            if($stock != null){
                return $this->render('verProducto',['stock' => $stock, 'model' => $model,]);
            }
        }
        return $this->render('verProducto', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionGet_tipo($id)
    {
        return $this->renderPartial('_getTipo', [
            'model' => $id
        ]);
    }

    /**
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productos();
        $fotos= new UploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $request = Yii::$app->request;
            $fotos->imageFiles = UploadedFile::getInstances($fotos, 'imageFiles');
            if ($fotos->upload($model->id)) {
                // file is uploaded successfully
               
            }
            if($model->tipo==0){
                return $this->redirect(['view', 'id' => $model->id]);
            }else if($model->tipo==1){
                $porTiempo = new Temporales();
                $porTiempo->fecha=$request->post('fecha');
                $porTiempo->idproducto = $model->id;
                $porTiempo->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $stock = new Stock();
                $cantidad=$request->post('cant');
                $stock->stock=$cantidad;
                $stock->idproducto=$model->id;
                $stock->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $img_model = new UploadForm();
            $searchModel = new CategoriasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('create', [
                'model' => $model,'categorias' => $dataProvider, 'img_model' => $img_model
            ]);
        }
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $img_model = new UploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $request = Yii::$app->request;
            $id_producto = $model->id;
            $fotos = Fotos::find()->where(['idProducto'=> $id_producto])->all();
            foreach($fotos as $foto){
                Fotos::deleteFoto($foto);
            }
            $img_model->imageFiles = UploadedFile::getInstances($img_model, 'imageFiles');
            if($img_model->upload($model->id)){
                if($model->tipo==0){
                return $this->redirect(['view', 'id' => $model->id]);
            }else if($model->tipo==1){
                $porTiempo = Temporales::find()->where(['idproducto' => $model->id])->one();
                $porTiempo->fecha=$request->post('fecha');
                $porTiempo->idproducto = $model->id;
                $porTiempo->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $stock = Stock::find()->where(['idproducto'=> $model->id])->one();
                $cantidad=$request->post('cant');
                $stock->stock=$cantidad;
                $stock->idproducto=$model->id;
                $stock->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
                'img_model' => $img_model
            ]);
        }
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('update', ['model' => $model]);
    }
    public function actionActivacion(){
        $request= Yii::$app->request;
        $producto = Productos::find()->where(['id' => $request->get('id')])->one();
        if($producto->activa == 0){
            $producto->activa = 1;
            $producto->update();
        }
        else{
            $producto->activa = 0;
            $producto->update();
        }
        return $this->redirect(['view', 'id' => $producto->id]);
    }
    
}
