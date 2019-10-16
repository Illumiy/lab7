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
        $model = Test::find()->asArray()->all();
        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return bool|string
     */
    public function actionTestpage()
    {
        $questions = Questions::find()->where(['id_test' => $_GET['test']])->asArray()->all();
        $answers = array();
        foreach ($questions as $question) {
            $a = Answers::find()->where(['id_quest' => $question['id']])->asArray()->all();
            $answers[] = $a;
        }
        if (YII::$app->request->isAjax) {
            $ans = Answers::find()->where(['id' => $_POST['ans'],])->asArray()->one();
//        echo '<pre>';
//        print_r($ans);
//        echo '</pre>';
//        die;
            if ($ans['check_true']==1) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = true;
                return [$c,$_POST['ans']];
            } else {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = false;
                return [$c,$_POST['ans']];
            }
        };

        return $this->render('testpage', ['questions' => $questions, 'answers' => $answers]);

    }

}
