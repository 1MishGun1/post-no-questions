<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="d-flex align-items-end gap-2">
        <?= $form->field($model, 'title') ?>
    
        <?= $form->field($model, 'category_id')->dropDownList($carTitle, ['prompt' => 'Выберите категорию']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
