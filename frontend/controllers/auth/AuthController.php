<?php

namespace frontend\controllers\auth;

use Yii;
use foods\forms\auth\LoginForm;
use foods\services\auth\AuthService;
use yii\web\Controller;

class AuthController extends Controller
{
    private $service;

    public function __construct($id, $module, AuthService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * Logs in a user.
     *
     * @param AuthController $authController
     *
     * @return mixed
     */
    public function actionLogin(AuthController $authController)
    {
        if (!Yii::$app->user->isGuest) {
            return $authController->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->login()) {
            try {
                $user = $this->service->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);

                return $authController->goBack();
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $authController->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
