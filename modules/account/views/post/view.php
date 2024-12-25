<?php

use app\models\Post;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Post $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('<-', ['index'], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить данный пост?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <p class="mt-3 mb-3">Дата публикации: <?= Yii::$app->formatter->asDatetime($model->create_at, "php:d.m.Y H:i:s") ?></p>
    <img class="w-100 post__img" src="/img/<?= $model->photo ?? Post::NO_PHOTO ?>" alt="image" />
    <p class="post__description w-50 mt-2">
        <?= $model->description ?>
    </p>

    <h4>Комментарии:</h4>

    <!-- <= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'preview',
            'description:ntext',
            'user_id',
            'category_id',
            'status_id',
            'like',
            'dislike',
            [
                'attribute' => 'photo',
                'value' => Html::img("/img/" . ($model->photo ?? Post::NO_PHOTO), ['class' => 'w-25', 'alt' => 'image']),
                'format' => 'raw',
            ],
            'create_at',
            'comment_admin',
            'comment_id',
        ],
    ]) ?> -->

</div>
