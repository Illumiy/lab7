<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Test;
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
    public function actionTestpage($id){

        $model=Test::findOne($id);
        return $this->render('testpage', [ 'model' => $model]);
    }

}
