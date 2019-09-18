<?php

namespace foods\services\auth;

use Yii;
use foods\entities\User\User;
use foods\forms\auth\PasswordResetRequestForm;
use foods\forms\auth\ResetPasswordForm;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param PasswordResetRequestForm $form
     *
     * @throws \yii\base\Exception
     */
    public function request(PasswordResetRequestForm $form)
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $form->email,
        ]);

        if (!$user) {
            throw new \DomainException('User is not found.');
        }
        $user->requestPasswordReset();

        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/reset/confirm-html', 'text' => 'auth/reset/confirm-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }

    /**
     * @param $token
     */
    public function validateToken($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!User::findByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password reset token.');
        }
    }

    /**
     * @param string $token
     * @param ResetPasswordForm $form
     *
     * @throws \yii\base\Exception
     */
    public function reset($token, ResetPasswordForm $form)
    {
        $user = User::findByPasswordResetToken($token);

        if (!$user) {
            throw new \DomainException('User is not found.');
        }
        $user->resetPassword($form->password);

        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
