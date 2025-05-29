<?php

namespace app\models;

use FFI;
use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status_id
 * @property string $date
 * @property string $time
 * @property string $weight
 * @property string $size
 * @property int $address_dispatch
 * @property int $address_delevery
 * @property int $type_id
 * @property string $created_at
 * @property string|null $feedback
 *
 * @property Status $status
 * @property Type $type
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{

    const FEEDBACK = 'FEEDBACK';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status_id', 'date', 'time', 'weight', 'size', 'address_dispatch', 'address_delevery', 'type_id'], 'required'],
            [['user_id', 'status_id', 'address_dispatch', 'address_delevery', 'type_id'], 'integer'],
            [['date', 'time', 'created_at'], 'safe'],
            [['feedback'], 'string'],
            [['weight', 'size'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['feedback'], 'required', 'on' => self::FEEDBACK ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Заявка',
            'user_id' => 'Пользователь',
            'status_id' => 'Статус',
            'date' => 'Дата',
            'time' => 'Время',
            'weight' => 'Вес',
            'size' => 'Габариты',
            'address_dispatch' => 'Адрес отправления',
            'address_delevery' => 'Адрес доставки',
            'type_id' => 'Тип груза',
            'created_at' => 'Дата и время создания',
            'feedback' => 'Отзыв',
        ];
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
