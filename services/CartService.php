<?php

namespace app\services;

use app\models\Cart;
use app\models\Product;
use Yii;
use yii\db\Exception;
use yii\web\Session;

/**
 * Class CartService
 * @package app\services
 */
class CartService
{
    /**
     * CartService constructor.
     *
     * @param Cart $cart
     * @param Session $session
     * @param Product $product
     */
    public function __construct(
        private Cart $cart,
        private Session $session,
        private Product $product,
    ) {
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function addProductToCart(): bool
    {
        $this->cart->setAttributes(['product_id' => $this->product->id, 'session_id' => $this->session->id], false);
        --$this->product->amount;

        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->cart->save() || !$this->product->save()) {
            $transaction->rollBack();
            return false;
        } else {
            $transaction->commit();
        }

        $this->cart->refresh();
        $this->addProductToSession();

        return true;
    }

    private function addProductToSession()
    {
        $sessionProducts = $this->session->get('products');
        $sessionProducts[] = ['product_id' => $this->cart->product_id, 'created_at' => $this->cart->created_at];
        $this->session->set('products', $sessionProducts);
    }
}