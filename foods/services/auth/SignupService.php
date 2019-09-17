<?php

namespace foods\services\auth;

use foods\entities\User\User;
use frontend\models\SignupForm;

class SignupService
{
    public function signup(SignupForm $form)
    {
        $user = User::signup(
            $form->username,
            $form->email,
            $form->password
        );

        if (!$user->save()) {
            throw new \RuntimeException('Не удалось сохранить пользователя.');
        }

        return $user;
    }
}
