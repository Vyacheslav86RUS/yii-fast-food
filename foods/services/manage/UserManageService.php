<?php

namespace foods\services\manage;

use foods\entities\User\User;
use foods\forms\manage\User\UserCreateForm;
use foods\forms\manage\User\UserEditForm;
use foods\repositories\UserRepository;

class UserManageService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserCreateForm $form
     *
     * @return User
     * @throws \yii\base\Exception
     */
    public function create(UserCreateForm $form)
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->repository->save($user);

        return $user;
    }

    public function edit($id, UserEditForm $form)
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->repository->save($user);
    }
}
