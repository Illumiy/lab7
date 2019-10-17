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
//     echo '<pre>';
//     print_r($model);
//     echo '</pre>';
//
//    echo '<pre>';
//    print_r($data);
//    echo '</pre>';
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
    echo $form->field($model, 'quest')->textInput()->label('Введите новый вопрос ');
    echo Html::submitButton('Клек', ['class' => 'btn btn-primary']);
     ActiveForm::end()
    ?>

</div>
