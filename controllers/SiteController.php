<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Test;
use app\models\Questions;
use app\models\Answers;
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model=Test::find()->asArray()->all();
        return $this->render('index', [ 'model' => $model]);
    }
    public function actionTestpage(){

        $questions = Questions::find()->where(['id_test' => $_GET['test']])->asArray()->all();
        $answers = array();
        foreach ($questions as $question){
            $a = Answers::find()->where(['id_quest' => $question['id']])->asArray()->all();
            $answers[]=$a;
        }
        if (YII::$app->request->isAjax){
               echo '<pre>';
        print_r($questions[$_POST['answer']]);
        echo '</pre>';
        die;
            if ($_POST['ans'] == $questions[$_POST['que']]){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = true;
                return $c;
            }else{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = false;
                return $c;
            }
            };

        return $this->render('testpage', ['questions' => $questions, 'answers' => $answers]);
    }

}
