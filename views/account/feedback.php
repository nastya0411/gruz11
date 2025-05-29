<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">
    <h1>Оставить отзыв</h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'feedback')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-outline-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
