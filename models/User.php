<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $username
 * @property string $password
 * @property int $is_admin
 * @property string $created_at
 * @property string $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    private $auth_key = null;

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
            [
                ['username', 'password'],
                'required',
                'message' => 'فیلد {attribute} نمیتواند خالی باشد.'
            ],
            [['is_admin'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password'], 'string', 'max' => 255],
            [
                ['username'],
                'unique',
                'message' => 'این نام کاربری قبلا استفاده شده است.'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'شناسه کاربر',
            'username' => 'نام کاربری',
            'password' => 'رمزعبور',
            'is_admin' => 'آیا ادمین میباشد؟',
            'created_at' => 'ایجاد شده در تاریخ',
            'updated_at' => 'Updated At',
        ];
    }

    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
        // throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // $this->generateAuthKey();
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password, $hash)
    {
        try {
            return Yii::$app->security->validatePassword($password, $hash);
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates password hash from password
     *
     * @param string $password
     * @return string $password_hash
     */
    public function password_hash($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Do some functionalities before saving a model
     * This method is called at the beginning of inserting or updating a record.
     *
     * @param yii\base\ModelEvent $insert
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->user_id = $this->random12();
                $this->access_token = $this->user_id . '_token';

                if ($this->is_admin){
                    $auth = Yii::$app->authManager;
                    $role = $auth->getRole('admin');
                    $auth->assign($role, $this->user_id);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Generates 12 digits length number
     * 
     * @return string $number
     */
    public function random12() {
        $number = "";
        for($i=0; $i<12; $i++) {
          $number .= mt_rand(1,9);
        }
        return $number;
    }
}
