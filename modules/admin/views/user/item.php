<?php

use app\models\Status;
use yii\bootstrap5\Html;

?>
<div class="card" style="width: 24rem;">
<img src="/img/<?= $model->avatar ?? $model::NO_PHOTO ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h6 class="card-text">Фамилия: <?= $model->surname ?></h6>
    <h6 class="card-text">Имя: <?= $model->name ?></h6>
    <h6 class="card-text">Отчество: <?= $model->patronymic ?></h6>
    <h6 class="card-text">Логин: <?= $model->login ?></h6>
    <h6 class="card-text">Дата создания: <?= $model->create_at ?></h6>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100']) ?>
  </div>
</div>