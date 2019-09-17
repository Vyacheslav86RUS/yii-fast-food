<?php

namespace foods\services\auth;

use foods\entities\User\User;
use foods\forms\auth\SignupForm;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function signup(SignupForm $form)
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        if (!$user->save()) {
            throw new \RuntimeException('Не удалось сохранить пользователя.');
        }

        $sent = $this->mailer
            ->compose(
                ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Не получилось отправить письмо');
        }
    }

    public function confirm($token)
    {
        if (empty($token)) {
            throw new \DomainException('Пустой токен');
        }

        $user = User::findOne(['email_confirm_token' => $token]);

        if (!$user) {
            throw new \DomainException('С таким токеном пользователь не найден');
        }

        $user->confirmSignup();

        if (!$user->save()) {
            throw new \RuntimeException('Не получилось сохранить пользователя');
        }
    }

}
