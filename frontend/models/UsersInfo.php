<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users.info".
 *
 * @property integer $user_id
 * @property integer $age
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $phone_number
 *
 * @property User $user
 */
class UsersInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users.info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'age'], 'integer'],
            [['age'], 'required'],
            [['address', 'city', 'country'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 30],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'age' => 'Age',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'phone_number' => 'Phone Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
