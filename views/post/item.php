<?php

use app\models\Post;
use app\models\Status;
use yii\bootstrap5\Html;

?>
<div class="card" style="width: 24rem;">
<img src="/img/<?= $model->photo ?? $model::NO_PHOTO ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $model->title ?></h5>
    <h6 class="card-text">Автор: <?= $model->user->login ?></h6>
    <h6 class="card-text">Превью: <?= $model->preview ?></h6>
    <h6 class="card-text">Категория: <?= $model->category->title ?></h6>
    <h6 class="card-text">Дата создания: <?= $model->create_at ?></h6>
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-primary w-100']) ?>
        <?= Html::a('👍' . "<span>$model->like</span>", ['index', 'id' => $model->id, 'like' => 1], ['class' => 'text-decoration-none']) ?>
        <?= Html::a('👎' . "<span>$model->dislike</span>", ['index', 'id' => $model->id, 'like' => -1], ['class' => 'text-decoration-none']) ?>
  </div>
</div>