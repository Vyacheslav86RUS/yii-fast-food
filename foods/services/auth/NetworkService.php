<?php

namespace foods\services\auth;

use foods\entities\User\User;
use foods\repositories\UserRepository;

class NetworkService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param $network
     * @param $identity
     *
     * @return array|User|\yii\db\ActiveRecord|null
     * @throws \yii\base\Exception
     */
    public function auth($network, $identity)
    {
        if ($user = $this->users->findByNetworkIdentity($network, $identity)) {
            return $user;
        }

        $user = User::signupByNetwork($network, $identity);
        $this->users->save($user);

        return $user;
    }

    public function attach($id, $network, $identity)
    {
        if ($this->users->findByNetworkIdentity($network, $identity)) {
            throw new \DomainException('Социальная сеть уже существует.');
        }

        $user = $this->users->get($id);
        $user->attachNetwork($network, $identity);
        $this->users->save($user);
    }
}
