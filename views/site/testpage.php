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
        $quest=$questions[$_GET['Question']];
        echo '<div class="test"><div id="question" class="question">' .$quest['quest']. '</div>';
        $a = $answers[$_GET['Question']];
        // echo '<pre>';
        // print_r($questions);
        // echo '</pre>';
        if($useranswers[$quest['id']]['id_quest']==$quest['id']){ // Проверка на существование ответа от этого пользователя
            foreach ($a as $answer) {
                if($useranswers[$quest['id']]['id_answer']==$answer['id']){
                    if($answer['check_true']==1){
                        echo '<div class="TestRight">' . $answer['answer'] . '</div>';
                    }else{
                        echo '<div class="TestWrong">' . $answer['answer'] . '</div>';
                    }
                }else{
                    echo '<div class="TestUnClick">' . $answer['answer'] . '</div>';
                }
            }
        }else{
            foreach ($a as $answer) {
                echo '<div id="Test' . $answer['id'] . '" onclick="CheckIfRight('.$answer['id'].','.$_GET['Question'].','.$quest['id'].')" class="TestUnClick">' . $answer['answer'] . '</div>';
            }
        }
        if (($_GET['Question']) < (count($questions)-1)) {
            echo '<a href="' . Url::to(['site/testpage', 'test' => $_GET['test'], 'Question' => $_GET['Question'] + 1]) . '" class="kek">Следующий вопрос</a>';
        }else{
            echo '<a href="' . Url::to(['site/testend', 'test' => $_GET['test']]). '" class="kek">Завершить тест</a>';
        }
        echo '<br><a href="index">Вернуться к выбору теста</a></div>';
    }else{
        echo'Такого вопроса нет!';
    }?>

    </div>
</div>