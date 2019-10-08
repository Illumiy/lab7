<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_answers".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_quest
 * @property int $id_answer
 *
 * @property Answers $answer
 * @property Questions $quest
 * @property User $user
 */
class UserAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_quest', 'id_answer'], 'required'],
            [['id_user', 'id_quest', 'id_answer'], 'integer'],
            [['id_answer'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['id_answer' => 'id']],
            [['id_quest'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['id_quest' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_quest' => 'Id Quest',
            'id_answer' => 'Id Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answers::className(), ['id' => 'id_answer']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
