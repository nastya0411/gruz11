<?php

use app\models\Status;
use app\models\Type;
use yii\bootstrap5\Html;
?>
<div class="card mb-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Заявка № <?= $model->id . ' от ' .
                                            Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i.s') ?> </h5>
        <div>
            <div>
                Статус: <?= Status::getStatuses()[$model->status_id]  ?>
            </div>
            <div>
                Тип груза: <?= Type::getTypes()[$model->type_id]  ?>
            </div>
            <div>
                Дата: <?= Yii::$app->formatter->asDate($model->date, 'php:d.m.Y')   ?>
            </div>
            <div>
                Время: <?= Yii::$app->formatter->asTime($model->time, 'php:H:i.s')  ?>
            </div>
        </div>
        <div class="d-flex gap-2">
            <div>
                <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-success mt-2']) ?>
            </div>
            <div>
                <?= Html::a('Оставить отзыв', ['feedback', 'id' => $model->id], ['class' => 'btn btn-outline-info mt-2', 'data-method' => 'post', 'data-pjax' => 0]) ?>
            </div>
        </div>
    </div>
</div>