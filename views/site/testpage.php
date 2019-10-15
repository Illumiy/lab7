<?php
use yii\helpers\Url;
?>
<div class="site-index">
<div class="body-content">
<?php
    if ($questions == null) {
        echo 'Тест пустой!';
    }elseif ($_GET['Question'] <= (count($questions)-1)){
        echo '<div class="test"><div id="question" class="question">' .$questions[$_GET['Question']]['quest']. '</div>';
        $a = $answers[$_GET['Question']];
        // echo '<pre>';
        // print_r($answer['answer']);
        // echo '</pre>';
        foreach ($a as $answer) {
            echo '<div id="Test' . $answer['id'] . '" onclick="CheckIfRight('.$answer['answer'].','.$_GET['Question'].','.$_GET['test'].')" class="TestUnClick">' . $answer['answer'] . '</div>';
        }
        echo '<br><a href="index">Go back</a></div>';
        if (($_GET['Question']) < (count($questions)-1)) {
            echo '<a href="' . Url::to(['site/testpage', 'test' => $_GET['test'], 'Question' => $_GET['Question'] + 1]) . '">Next</a>';
        }
    }else{
        echo'Такого вопроса нет!';
    }?>

    </div>
</div>