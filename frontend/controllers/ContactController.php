<?php

namespace frontend\controllers;

use Yii;
use foods\forms\ContactForm;
use foods\services\ContactService;
use yii\web\Controller;

class ContactController extends Controller
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $form = new ContactForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Благодарим Вас за обращение к нам. Мы ответим как можно скорее');

                return $this->goHome();
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Произошла ошибка в процессе отправки сообщения');
            }

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }
}
