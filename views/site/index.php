<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Пост не вопрос!</h1>
    </div>

    <div class="body-content text-center">
        <?= Html::a('Все посты', ['/post'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>
