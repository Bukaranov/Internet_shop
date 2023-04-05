<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Goods;
use app\models\GoodsSearch;
use app\models\ImageUpload;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(['access' => [
            //Ограничения доступа
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['index2'],
                    'allow' => true,
                    'roles' => ['?'] // Тільки не автентифіковані користувачі можуть отримати доступ до цих дій
                ],
                [
                    'actions' => ['index2','single'],
                    'allow' => true,
                    'roles' => ['@'], // Лише автентифіковані користувачі можуть отримати доступ до цих дій
                ],
                [
                    'actions' => ['index', 'index2', 'create', 'update', 'delete', 'view', 'set-category', 'set-image'],
                    'allow' => true,
                    'matchCallback' => function ($rule, $action) {
                        return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin;
                    } // Тільки адміністрація може отримати доступ до цих дій
                ],
            ],
        ],
        ],
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Goods models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2($category_id = 'all', $brand_id = 'all')
    {
        //Передача category_id $brand_id для вывода елементов этой категории
        $query = Goods::find()
            ->andFilterWhere(['category_id' => $category_id == 'all' ? null : $category_id])
            ->andFilterWhere(['brand_id' => $brand_id == 'all' ? null : $brand_id]);

//        $query = Goods::find()->where(['category_id' => $category_id, 'brand_id' => $brand_id]);
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>4]);
        $goods = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index2', [
            'goods' => $goods,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload();

        //получение изображение
        if (Yii::$app->request->isPost)
        {
            $goods = $this->findModel($id);
            //возврат файла
            $file = UploadedFile::getInstance($model, 'image');
            //сохранение и загрузка картинки на сервер
           if ( $goods->saveImage( $model->aploadFile($file, $goods->image)))
           {
               $this->redirect(['view', 'id'=>$goods->id]);
           }
        }
        return $this->render('image', ['model' => $model]);
    }

    public function actionSingle($id)
    {
        $goods = Goods::findOne($id);
//        $popular = Article::getPopular();
//        $recent = Article::getRecent();
//        $categories = Category::getAll();
        return $this->render('single', [
            'goods' => $goods,
//            'popular' => $popular,
//            'recent' => $recent,
//            'categories' => $categories
        ]);
    }
}
