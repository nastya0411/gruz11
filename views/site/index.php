<?php

/** @var yii\web\View $this */

use yii\web\JqueryAsset;

$this->title = 'Грузовозофф';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4 main-text"></h1>
        <h2>Вам везет, если мы вам везем!</h2>
    </div>
    <div class="body-content">

        <div class="row text-center mt-5 bg-success rounded-4 p-5 bg-opacity-50 text-white">
            <div class="col-lg-4 mb-3 ">
                <img src="/web/img/1.png" class="img-style">
                <h2 class="mt-3">Быстрые перевозки</h2>

            </div>
            <div class="col-lg-4 mb-3">
                <img src="/web/img/2.png" class="img-style">
                <h2 class="mt-3">Надежное качество</h2>
            </div>
            <div class="col-lg-4">
                <img src="/web/img/3.png" class="img-style">
                <h2 class="mt-3">Выгодная цена</h2>
            </div>
        </div>
    </div>
</div>

<?php 
    $this->registerJsFile("/js/animation.js", ["depends" => JqueryAsset::class])
?>