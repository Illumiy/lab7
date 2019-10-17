<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property string $answer
 * @property int $id_quest
 * @property int $check_true
 *
 * @property Questions $quest
 * @property UserAnswers[] $userAnswers
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answer', 'id_quest', 'check_true'], 'required'],
            [['id_quest', 'check_true'], 'integer'],
            [['answer'], 'string', 'max' => 255],
            [['id_quest'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['id_quest' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Answer',
            'id_quest' => 'Id Quest',
            'check_true' => 'Правильность ответа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuest()
    {
        return $this->hasOne(Questions::className(), ['id' => 'id_quest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAnswers()
    {
        return $this->hasMany(UserAnswers::className(), ['id_answer' => 'id']);
    }
}
