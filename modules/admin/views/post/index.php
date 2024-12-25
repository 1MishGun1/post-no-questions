<?php

use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\admin\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Панель администратора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Список пользователей', ['/admin-panel/user'], ['class' => 'btn btn-outline-primary']) ?>

    <?php Pjax::begin(); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "\n<div class=\"d-flex justify-content-center flex-wrap gap-2\">{items}</div>\n{pager}",
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
