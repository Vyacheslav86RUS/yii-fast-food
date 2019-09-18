<?php

namespace foods\repositories;

use foods\entities\User\User;

class UserRepository
{
    public function findByUsernameOrEmail($value)
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }
    public function findByNetworkIdentity($network, $identity)
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }
    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }
    public function getByEmailConfirmToken($token)
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }
    public function getByEmail($email)
    {
        return $this->getBy(['email' => $email]);
    }
    public function getByPasswordResetToken($token)
    {
        return $this->getBy(['password_reset_token' => $token]);
    }
    public function existsByPasswordResetToken(string $token)
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    /**
     * @param User $user
     */
    public function save($user)
    {
        if (!$user->save()) {
            throw new \RuntimeException('Ошибка сохранения пользователя.');
        }
    }

    /**
     * @param array $condition
     *
     * @return array|\yii\db\ActiveRecord|null
     */
    private function getBy($condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Пользователь не найден.');
        }
        return $user;
    }
}
