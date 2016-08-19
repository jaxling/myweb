<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "admin_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class AdminUser extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;    

    //public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','email', 'branch', 'work_status'], 'required'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['work_status', 'branch'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            //'password' => '密码',
            'status' => '状态，默认10',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'branch' => '部门',
            'work_status' => '在职状态',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
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
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }  


    public static function itemAlias ($type, $code = NULL)
    {
        $_items = [
            'branch' => [
                ''  =>'部门',
                '1' => "技术部",              
                '2' => "运营部",
                '3' => "市场部",
                '4' => "人事部",
                '5' => "财务部",
                '6' => "客服部",              
                '99' => "其它",   
                             
            ],
            'work_status' => [
                ''  =>'状态',
                '1' => "发布",              
                '2' => "草稿",
                '3' => "删除",                
            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }



    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //是否是新添加
            if($this->isNewRecord) {
                //密码
                $admin_user = Yii::$app->request->post("AdminUser");
                if (isset($admin_user['password']) && $admin_user['password']) {
                    $this->password = trim($admin_user['password']);
                } 
            }else{
                //密码
                $admin_user = Yii::$app->request->post("AdminUser");
                if (isset($admin_user['password']) && $admin_user['password']) {
                    $this->password = trim($admin_user['password']);
                }                
            }
            return true;
        } else {
            return false;
        }
    } 

    /**
     *  @DESC 查看用户具有哪些权限
     *  需要查用户所在角色的权限和单独分配的权限
     */
    public static function UserAuth ()
    {
        $uid = Yii::$app->user->id;
        $auth = Yii::$app->cache->get('user_auth_'.$uid); //缓存了每个人的权限
        if ($auth === FALSE)
        {
            $db = Yii::$app->db;
            $uid = Yii::$app->user->id;
            $sql = "SELECT `t`.`item_name`, `t2`.`type`, `t3`.`child`
                    FROM `auth_assignment` `t` 
                    LEFT JOIN `auth_item` `t2` ON `t`.`item_name` = `t2`.`name`
                    LEFT JOIN `auth_item_child` `t3` ON `t`.`item_name` = `t3`.`parent`
                    WHERE `user_id` = {$uid}";
            $res = $db->createCommand($sql)->queryAll();
            if (!$res)
                return false;

            $auth = [];
            foreach ($res as $k => $v)
            {
                if ($v['type'] == 1) //角色 ＝2为权限
                {
                    $sql = "SELECT `child` FROM `auth_item_child` WHERE `parent` = \"{$v['child']}\"";
                    $r = $db->createCommand($sql)->queryAll();
                    // if ($r)
                    // {
                    //     $temp = [];
                    //     foreach ($r as $_v) 
                    //     {
                    //         $temp[] = $_v['child'];
                    //     }
                    // }
                    // $res[$k]['child'] = ['item_name' => $v['child'], 'child' => $temp];
                    if ($r)
                    {
                        foreach ($r as $_v) 
                        {
                            if (substr($_v['child'], -1) == '*') //拥有所有的权限时
                            {
                                $t = substr_replace(substr($_v['child'], 1), '', -2);
                            }
                            else //有某个单独的权限时
                            {
                                $t = explode('/', $_v['child']);
                                $t = $t[1];
                            }
                            // $t = substr_replace(substr($_v['child'], 1), '', -2);
                            if (!in_array($t, $auth))
                                $auth[] = $t;
                            // if (!in_array($_v['child'], $auth))
                            //     $auth[] = $_v['child'];
                        }
                    }
                }
                elseif ($v['type'] == 2)
                {
                    if (substr($v['child'], -1) == '*') //拥有所有的权限时
                    {
                        $t2 = substr_replace(substr($v['child'], 1), '', -2);
                    }
                    else //有某个单独的权限时
                    {
                        $t2 = explode('/', $v['child']);
                        $t2 = $t2[1];
                    }
                    // $t2 = substr_replace(substr($v['child'], 1), '', -2);
                    if (!in_array($t2, $auth))
                        $auth[] = $t2;
                    // if (!in_array($v['child'], $auth))
                    //     $auth[] = $v['child'];
                    
                }
            }

            Yii::$app->cache->set('user_auth_'.$uid, $auth);
        }
        

        return $auth;
        
    }

}
