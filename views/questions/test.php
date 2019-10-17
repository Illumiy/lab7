<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Questions */
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
            'placeholder' => 'Выберите тест',

        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    echo Html::submitButton('Продолжить', ['class' => 'btn btn-primary']);
    ActiveForm::end()
    ?>

</div>
