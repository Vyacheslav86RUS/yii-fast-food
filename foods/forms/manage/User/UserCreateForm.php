<?php

namespace foods\forms\manage\User;

use foods\entities\User\User;
use yii\base\Model;

class UserCreateForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
        ];
    }
}
