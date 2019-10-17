<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Questions */

$this->title = 'Create Questions';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-create">
    <?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ]);
    echo $form->field($model, 'id')->widget(Select2::classname(), [
        'data' => $data,
        'options' => [
                'placeholder' => 'Выберите вопрос',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    if($flag==true){
        echo '<h1>Слишком много вопросов,достпуно только создание ответов</h1>';
    }else{
        echo $form->field($model, 'quest')->textInput()->label('Введите новый вопрос ');
    }

    echo $form->field($modelAns, 'answer')->textInput()->label('Введите ответ на вопрос');
    echo $form->field($modelAns, 'check_true')
    ->radioList([
        '1' => 'Правильный ответ',
        '2' => 'Неправильный',
    ]);
    
    echo Html::submitButton('Создать', ['class' => 'btn btn-primary']);
     ActiveForm::end();
    
    ?>

</div>
