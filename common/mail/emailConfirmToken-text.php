<?php

/* @var $this yii\web\View */
/* @var $user foods\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'token' => $user->email_confirm_token]);
?>
    Привет <?= $user->username ?>,

    Перейдите по ссылке, что бы подтвердить свою почту:

<?= $confirmLink ?>