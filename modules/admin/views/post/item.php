<?php

use app\models\Status;
use yii\bootstrap5\Html;

?>
<div class="card" style="width: 24rem;">
<img src="/img/<?= $model->photo ?? $model::NO_PHOTO ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $model->title ?></h5>
    <h6 class="card-text">Пользователь: <?= $model->user->name ?></h6>
    <h6 class="card-text">Превью: <?= $model->preview ?></h6>
    <h6 class="card-text">Категория: <?= $model->category?->title ?></h6>
    <h6 class="card-text">Статус: <?= $model->status->title ?></h6>
    <h6 class="card-text">Дата создания: <?= $model->create_at ?></h6>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger w-100 mt-2',
            'data' => [
                'confirm' => 'Вы точно хотите удалить данный пост?',
                'method' => 'post',
            ],
        ]) ?>
    <?= $model->status_id == Status::getStatusId('Редактирование') ? Html::a('Одобрить', ['approve', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100 mt-2']) : '' ?>
    <?= $model->status_id == Status::getStatusId('Одобрен')
        ? Html::a('Запретить', ['cancel', 'id' => $model->id], ['class' => 'btn btn-outline-danger w-100 mt-2']) 
        : '' 
    ?>
  </div>
</div>