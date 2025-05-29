<?php

use app\models\Status;
use app\models\Type;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AdminSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'status_id')->dropDownList(Status::getStatuses(),['prompt' => 'Выберете статус']) ?>

    <?= $form->field($model, 'type_id')->dropDownList(Type::getTypes(),['prompt' => 'Выберете тип груза']) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сброс',['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
