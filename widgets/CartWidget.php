<?php

namespace app\widgets;

use app\models\Cart;
use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;

/**
 * Class CartWidget
 * @package app\widgets
 */
class CartWidget extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $sessionId = Yii::$app->session->getId();
        $count = Cart::find()->where(['session_id' => $sessionId])->count();

        return Html::tag(
            'div',
            Html::icon('shopping-cart') . Html::tag('span', $count, ['id' => 'cart-positions-count']),
            ['class' => 'navbar-brand']
        );
    }
}
