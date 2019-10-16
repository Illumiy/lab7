<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

 ?>
<div class="site-index">
<div class="body-content">

<?php
    if ($questions == null) {
        echo 'Тест пустой!';
    }elseif ($_GET['Question'] <= (count($questions)-1)){

        echo '<div class="test"><div id="question" class="question">' .$questions[$_GET['Question']]['quest']. '</div>';
        $a = $answers[$_GET['Question']];
        $form = ActiveForm::begin();
//         echo '<pre>';
//         print_r($_GET['Question']);
//         echo '</pre>';
//         die;
//        echo $form->field($answers[$_GET['Question']], 'state_1')->widget(Select2::classname(), [
//            'data' => $data,
//            'options' => ['placeholder' => 'Select a state ...'],
//            'pluginOptions' => [
//                'allowClear' => true
//            ],
//        ]);
        foreach ($a as $answer) {
            echo '<div id="Test' . $answer['id'] . '" onclick="CheckIfRight('.$answer['id'].','.$_GET['Question'].')" class="TestUnClick">' . $answer['answer'] . '</div>';
        }
        echo '<br><a href="index">Go back</a></div>';
        if (($_GET['Question']) < (count($questions)-1)) {
            echo '<a href="' . Url::to(['site/testpage', 'test' => $_GET['test'], 'Question' => $_GET['Question'] + 1]) . '">Next</a>';
        }
        ActiveForm::end();
    }else{
        echo'Такого вопроса нет!';
    }?>

    </div>
</div>