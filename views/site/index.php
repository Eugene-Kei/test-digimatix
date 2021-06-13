<?php

use app\assets\ProductsAsset;
use app\models\Category;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var Category[] $categories
 */

$this->title = 'TEST DIGIMATIX';

ProductsAsset::register($this);
?>
<div class="site-index">
    <?php Pjax::begin(['id' => 'pjax-products']) ?>
    <div class="row">
        <?php
        if ($categories) : ?>
            <?php
            foreach ($categories as $category) : ?>
                <div class="col-xs-12">
                    <h2><?= Html::encode($category->name) ?></h2>

                    <?php
                    if ($category->products) : ?>
                        <?php
                        foreach ($category->products as $product) : ?>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>Наименование: <strong><?= Html::encode($product->name) ?></strong></p>
                                            <p>В наличии: <strong><?= $product->amount ?></strong></p>
                                        </div>
                                        <?php if ($product->amount > 0) : ?>
                                        <div class="col-sm-4 text-right">
                                            <a
                                                    href="#"
                                                    class="btn btn-primary add-to-cart"
                                                    data-product_id="<?= $product->id ?>"
                                            >В корзину</a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>Нет продуктов для отображения</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php
            endforeach; ?>
        <?php
        else : ?>
            <div class="col-xs-12">
                <p>Нет категорий для отображения</p>
            </div>
        <?php
        endif; ?>
    </div>
    <?php Pjax::end() ?>
</div>
