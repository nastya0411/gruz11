<?php

use app\models\Type;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="d-flex gap-3 justify-content-start">
        <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

        <?= $form->field($model, 'time')->textInput(['type' => 'time']) ?>
    </div>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_dispatch')->textInput() ?>

    <?= $form->field($model, 'address_delevery')->textInput() ?>

    <?= $form->field($model, 'type_id')->dropDownList(Type::getTypes(),['prompt' => 'Выберете тип груза']) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>