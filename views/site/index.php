<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php foreach($model as $test){
        //echo '<p >'.$test['name'].'</p>';
        echo Html::beginTag('p');
        echo Html::beginTag('a', ['href' => Url::toRoute('site/testpage/?id='.$test['id'])]);
        echo $test['name'];
        echo Html::endTag('a');
        echo Html::endTag('p');
    };?>

</div>
