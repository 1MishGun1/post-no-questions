<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment_admin')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Запретить пост', ['class' => 'btn btn-outline-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
