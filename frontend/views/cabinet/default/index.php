<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit Profile', ['cabinet/profile/edit'], ['class' => 'btn btn-primary']) ?>
    </p>

    <p>Hello!</p>

    <h2>Привязать профиль</h2>
    <?= AuthChoice::widget([
        'baseAuthUrl' => ['cabinet/network/attach'],
    ]) ?>
</div>
