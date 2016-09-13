<?php

namespace frontend\controllers;

use frontend\models\UsersInfo;
use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $modelProfile = UsersInfo::findOne($id);

        $model->age = $modelProfile->age;
        $model->city = $modelProfile->city;
        $model->phone_number = $modelProfile->phone_number;
        $model->address = $modelProfile->address;
        $model->country = $modelProfile->address;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $userInfo = new UsersInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $userInfo->user_id = $model->id;
            $userInfo->age = $_POST['User']['age'];
            $userInfo->address = $_POST['User']['address'];
            $userInfo->city = $_POST['User']['city'];
            $userInfo->country = $_POST['User']['country'];
            $userInfo->phone_number = $_POST['User']['phone_number'];
            $userInfo->save();

            if (!$userInfo->validate())
            {
                User::findOne($model->id)->delete();

            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelInfo = UsersInfo::findOne($id);
        $model->age = $modelInfo->age;
        $model->address = $modelInfo->address;
        $model->city = $modelInfo->city;
        $model->country = $modelInfo->country;
        $model->phone_number = $modelInfo->phone_number;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            UsersInfo::updateAll(array(
                'age' => $_POST['User']['age'],
                'address'=> $_POST['User']['address'],
                'city'=> $_POST['User']['city'],
                'country' =>$_POST['User']['country'],
                'phone_number'=>$_POST['User']['phone_number'],
            ), 'user_id=:user_id', array(':user_id'=> $model->id));

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
