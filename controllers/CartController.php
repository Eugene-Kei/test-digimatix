<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\services\CartService;
use Yii;
use yii\db\Exception;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;
use yii\web\UnprocessableEntityHttpException;

/**
 * Class CartController
 * @package app\controllers
 */
class CartController extends Controller
{
    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [
            'add-to-cart' => ['POST']
        ];
    }

    /**
     * Add product to cart
     *
     * @return array
     * @throws Exception
     * @throws ServerErrorHttpException
     * @throws UnprocessableEntityHttpException
     */
    public function actionAddToCart()
    {
        $productId = Yii::$app->request->post('product_id');
        if ($productId === null) {
            throw new UnprocessableEntityHttpException('missing parameter product_id');
        }

        $product = Product::find()->where(['and', ['id' => $productId], ['>', 'amount', 0]])->one();
        if (!$product) {
            throw new UnprocessableEntityHttpException('product not found');
        }

        $session = Yii::$app->session;
        $cartService = new CartService(cart: new Cart(), session: $session, product: $product);

        if (!$cartService->addProductToCart()) {
            throw new ServerErrorHttpException('failed to add product to cart');
        }

        $count = Cart::find()->where(['session_id' => $session->getId()])->count();

        Yii::$app->response->statusCode = 201;
        return ['message' => 'product added to cart', 'count' => $count];
    }
}