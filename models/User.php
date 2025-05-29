<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $role_id
 * @property string $login
 * @property string $password
 * @property string $full_name
 * @property string $auth_key
 * @property string $phone
 * @property string $email
 *
 * @property Order[] $orders
 * @property Role $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'login', 'password', 'full_name', 'auth_key', 'phone', 'email'], 'required'],
            [['role_id'], 'integer'],
            [['email'], 'email'],
            [['login'], 'unique'],
            [['login', 'password', 'full_name', 'auth_key', 'phone', 'email'], 'string', 'max' => 255],
            [['login', 'password'], 'string', 'min' => 6],
            ['login', 'match', 'pattern' => '/^[а-яё]+$/ui', 'message' => 'Только кириллица'],
            ['full_name', 'match', 'pattern' => '/^[а-яё\s]+$/ui', 'message' => 'Только кириллица и пробелы'],
            ['phone', 'match', 'pattern' => '/^\+7\([\d]{3}\)-[\d]{3}-[\d]{2}-[\d]{2}$/', 'message' => 'Телефон в формате +7(XXX)-XXX-XX-XX'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'full_name' => 'ФИО',
            'auth_key' => 'Auth Key',
            'phone' => 'Телефон',
            'email' => 'Адрес электронной почты',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    public static function findByUsername($login): User|null
    {
        return self::findOne(['login' => $login]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getIsAdmin()
    {
        return $this->role_id === Role::getRoleId('admin');
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
