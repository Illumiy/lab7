<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Круды для тз</h1>

    
    <?= '<p><a href="' . Url::to(['test/index']) .'">Круд тестов</a></p>'?>
    <?= '<p><a href="' . Url::to(['useranswers/index']) .'">Круд ответов пользователей</a></p>'?>


</div>
