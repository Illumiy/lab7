<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="site-index">
<h1>Выберите пользователя</h1>
    <?php foreach($users as $user){
        echo Html::beginTag('div', ['class'=>'textuser','onclick' => "Sos(".$user['id'].")"]);
        echo Html::beginTag('p');
        echo $user['name'];
        echo Html::endTag('p');
        echo Html::endTag('div');
    };?>

</div>
