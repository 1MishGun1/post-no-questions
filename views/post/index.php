<?php

use app\models\Category;
use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Все посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex justify-content-between">
        <div>
            <?= $dataProvider->sort->link('id', ['class' => 'btn btn-outline-secondary']) ?> | <?= 
                $dataProvider->sort->link('category_id', ['class' => 'btn btn-outline-info']) ?> | <?= 
                $dataProvider->sort->link('create_at', ['class' => 'btn btn-outline-warning']) ?> | <?= 
                Html::a('Сбросить', ['index'], ['class' => 'btn btn-outline-primary']) 
            ?>
        </div>
        <div class="d-flex">
            <?= $this->render('_search', ['model' => $searchModel, 'carTitle' => Category::getCategoryTitle()]); ?> 
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <!-- <php echo $this->render('_search', ['model' => $searchModel]); ?> -->

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'layout' => "\n<div class=\"d-flex justify-content-center flex-wrap gap-2\">{items}</div>\n{pager}",
        'itemView' => 'item',
    ]) ?>

    <?php Pjax::end(); ?>

</div>
