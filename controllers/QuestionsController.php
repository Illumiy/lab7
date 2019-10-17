<?php

namespace app\controllers;

use Yii;
use app\models\Questions;
use app\models\Test;
use app\models\Answers;

use app\models\QuestionsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionsController implements the CRUD actions for Questions model.
 */
class QuestionsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Questions;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionTest()//Создание теста
    {
        $model = new Test();
        $data=$model->find()->asArray()->all();
        if(Yii::$app->request->post()){
            $session= Yii::$app->session;
            $session->open();
            $_SESSION['test']=$_POST['Test']['id'];
            return Yii::$app->response->redirect(['/questions/quest']);
        }
        return $this->render('test', [
            'model' => $model,
            'data' => ArrayHelper::map($data,'id','name')
        ]);
    }
    public function actionQuest()//Создание вопроса
    {
        if (empty($_SESSION['test'])) {
            return Yii::$app->response->redirect(['/questions/test']);
        }//Проверка на выбор теста
        $model = new Questions();
        $modelAns = new Answers();
        $data=$model->find()->where(['id_test'=>$_SESSION['test']])->asArray()->all();
        if(Yii::$app->request->post()){ //Приём данных с формы
            if(!empty($_POST['Questions']['quest'])){//Приём на создание нового вопроса
                print_r($model->id);
                die;
                $model->quest=$_POST['Questions']['quest'];
                $model->id_test=$_SESSION['test'];
                $model->save();
                $modelAns->answer=$_POST['Answers']['answer'];
                $modelAns->id_quest=$model->id;
                $modelAns->check_true=$_POST['Answers']['check_true'];
            }elseif(empty($_POST['Questions']['quest'])&& !empty($_POST['Questions']['id'])){//Приём на добавление ответа 
                if(count(Answers::find()->where(['id_quest'=>$_POST['Questions']['id']])->asArray()->all())>=4){//Проверка на кол-во ответов
                    Yii::$app->session->setFlash('error', "Уже создано 4 ответа к этому вопросу ");
                }else{
                    $modelAns->answer=$_POST['Answers']['answer'];
                    $modelAns->id_quest=$_POST['Questions']['id'];
                    $modelAns->check_true=$_POST['Answers']['check_true'];
                    $modelAns->save();
                }
                
            }
            
        }
        if(count($data)>=10){//Проверка на кол-во вопросов в тесте
            $flag=true;
            return $this->render('quest', [
                'flag' => $flag,
                'modelAns' => $modelAns,
                'model' => $model,
                'data' => ArrayHelper::map($data,'id','quest')
            ]);
        }
        return $this->render('quest', [
            'modelAns' => $modelAns,
            'model' => $model,
            'data' => ArrayHelper::map($data,'id','quest')
        ]);
    }

    /**
     * Displays a single Questions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Questions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Questions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
