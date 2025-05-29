<?php

use app\models\Status;
use app\models\Type;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Заявка № ' . $model->id . ' от ' .
    Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i.s');
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index', 'id' => $model->id], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'status_id',
                'value' => Status::getStatuses()[$model->status_id]
            ],
            [
                'attribute' => 'date',
                'value' => Yii::$app->formatter->asDate($model->date, 'php:d.m.Y')
            ],
            [
                'attribute' => 'time',
                'value' => Yii::$app->formatter->asTime($model->time, 'php:H:i.s')
            ],

            'weight',
            'size',
            'address_dispatch',
            'address_delevery',
            [
                'attribute' => 'type_id',
                'value' => Type::getTypes()[$model->type_id]
            ],
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i.s')
            ],
            [
                'attribute' => 'feedback',
                'format' => 'ntext',
                'visible' => !empty($model->feedback),
                'value' => $model->feedback
            ]

        ],
    ]) ?>

</div>