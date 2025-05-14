<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'registration_number', 'password', 'role'], 'required'],
            ['name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Apenas letras são permitidas.'],
            ['email', 'email'],
            ['email', 'unique'],
            ['registration_number', 'match', 'pattern' => '/^[0-9]+$/', 'message' => 'Apenas números são permitidos.'],
            ['registration_number', 'unique'],
            ['password', 'string', 'length' => [6, 255]],
            ['role', 'in', 'range' => ['admin', 'user']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || $this->password !== $this->getOldAttribute('password')) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    // Métodos de IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // Não implementado
    }

    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username]); // Usamos email como username
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null; // Não usamos authKey por enquanto
    }

    public function validateAuthKey($authKey)
    {
        return false; // Não usamos authKey
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}