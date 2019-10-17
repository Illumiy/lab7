<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Test;
use app\models\Questions;
use app\models\Answers;
use app\models\User;
use app\models\UserAnswers;
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(empty($_SESSION['user'])){
           return Yii::$app->response->redirect(['/site/chooseuser']);
        }
        $model = Test::find()->asArray()->all();
        return $this->render('index', ['model' => $model]);
    }
    public function actionChooseuser(){//Страница выбора пользователя
        $users=User::find()->all();
        if (YII::$app->request->isAjax) {
            if(!empty($_POST['id'])){
                $session= Yii::$app->session;
                $session->open();
                $_SESSION['user']=$_POST['id'];
                return $_POST['id'];
            }else{
                return false;
            }
        }
        return $this->render('user', ['users' => $users]);
    }
    public function actionTestend()
    {// Оценка теста
        if (empty($_SESSION['user'])) {
            return Yii::$app->response->redirect(['/site/chooseuser']);
        }
        $i = 0;
        $q = array();
        $answersU = UserAnswers::find()->where(['id_user' => $_SESSION['user']])->asArray()->all();
        foreach ($answersU as $answer) {
            $que = Questions::find()->where(['id' => $answer['id_quest']])->asArray()->one();
            if ($que['id_test'] == $_GET['test']) {
                $ans = Answers::find()->where(['id' => $answer['id_answer']])->asArray()->one();
                if ($ans['check_true'] == 1) {
                    $i++;
                }
            }
        }

        return $this->render('testend', ['i' => $i]);
    }

    /**
     * @return bool|string
     */
    public function actionTestpage()//Страница теста
    {   
        if(empty($_SESSION['user'])){
            return Yii::$app->response->redirect(['/site/chooseuser']);
         }
        $questions = Questions::find()->where(['id_test' => $_GET['test']])->asArray()->all();
        $answers = array();
        $session= Yii::$app->session;
        $session->open();
        // echo '<pre>';
        // print_r($session['quest_id']);
        // echo '</pre>';
        // die;
        $useranswers=UserAnswers::find()->where(['id_user'=> $session['user']])->indexBy('id_quest')->asArray()->all();
        foreach ($questions as $question) {
            $a = Answers::find()->where(['id_quest' => $question['id']])->asArray()->all();
            $answers[] = $a;
        }
        if (YII::$app->request->isAjax) {// Принимаем аякс
            $answer= new UserAnswers; // Запись ответов
            $answer->id_user=$session['user'];
            $answer->id_quest=$_POST['id'];
            $answer->id_answer=$_POST['ans'];
            $answer->save();
            $ans = Answers::find()->where(['id' => $_POST['ans']])->asArray()->one();
           
            if ($ans['check_true']==1) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = true;
                $session['result']=$session['result']+1;
                return [$c,$_POST['ans'],$session['user']];
            } else {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = false;
                return [$c,$_POST['ans']];
            }
        };

        return $this->render('testpage', ['questions' => $questions, 'answers' => $answers, 'session'=>$session,'useranswers'=>$useranswers]);

    }

}
