<?php
namespace backend\controllers;

use Yii;
use common\models\AdminUser;
use common\models\AdminUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;




/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends AController
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
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }       

        // if ($model->load(Yii::$app->request->post())) {
            
        //     //改造，使用 User模板
        //     $admin_user = Yii::$app->request->post("AdminUser");
        //     $user_model = new User();
        //     $user_model->username = $admin_user['username'];
        //     $user_model->password = $admin_user['password'];
        //     $user_model->email = $admin_user['email'];
        //     $user_model->status = 10;
        //     $user_model->created_at = time();
        //     $user_model->updated_at = $user_model->created_at;
        //     $user_model->save();            

        //     return $this->redirect(['view', 'id' => $user_model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Updates an existing AdminUser model.
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

        // if ($model->load(Yii::$app->request->post())) {

        //     //改造，使用 User模板
        //     $admin_user = Yii::$app->request->post("AdminUser");
        //     $user_model = User::findOne($id);
        //     $user_model->username = $admin_user['username'];
        //     if ($admin_user['password']) {
        //         $user_model->password = $admin_user['password'];
        //     }       
        //     $user_model->email = $admin_user['email'];
        //     $user_model->status = $admin_user['status'];
        //     $user_model->updated_at = time();
        //     $user_model->save();             

        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing AdminUser model.
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
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 修改自己的密码,需要添加权限
     * @return mixed
     */
    public function actionChangepassword()
    {
        $id = Yii::$app->user->id;
        $password = trim(Yii::$app->request->post("user_password"));
        if (!$id || !$password) {
            echo 'no user';
            exit;
        }
        $model = User::findOne($id);
        $model->password = $password;
        $model->save();

        // Yii::$app->getSession()->setFlash('success', '修改成功');

        //清空cookie
        Yii::$app->user->logout();

        return $this->goHome();

    }


}
