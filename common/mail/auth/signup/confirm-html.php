<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user foods\entities\User\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Привет <?= Html::encode($user->username) ?>,</p>

    <p>Перейдите по ссылке, что бы подтвердить свою почту:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>