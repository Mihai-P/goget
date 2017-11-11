<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ChangePassword form
 */
class ChangePassword extends Model
{
    public $password;
    public $password_repeat;

    private $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Passwords don't match"],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function changePassword()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->getUser();
        $user->setPassword($this->password);

        return $user->save();
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->user === null) {
            $this->user = User::findOne(Yii::$app->user->identity->id);
        }

        return $this->user;
    }
}
