<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php Pjax::begin([
        'id' => 'category-pjax',
        'enablePushState' => false,
        'enableReplaceState' => false,
        'timeout' => 5000,
    ]) ?>

    <?php $form = ActiveForm::begin([
        'id' => 'form-pjax',
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categoryTitle, ['prompt' => 'Выберите тему', 'disabled' => (bool)$model->check]) ?>

    <?= $form->field($model, 'check')->checkbox() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true, 'disabled' => !(bool)$model->check]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Создать пост', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJsFile('/js/category.js', ['depends' => YiiAsset::class]);
?>
