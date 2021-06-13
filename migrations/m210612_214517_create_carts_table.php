<?php

use yii\db\Migration;

/**
 * Handles the creation of table `carts`.
 * Has foreign keys to the tables:
 *
 * - `products`
 */
class m210612_214517_create_carts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('carts', [
            'id' => $this->primaryKey(),
            'session_id' => $this->string()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-carts-product_id',
            'carts',
            'product_id'
        );

        // add foreign key for table `products`
        $this->addForeignKey(
            'fk-carts-product_id',
            'carts',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-carts-product_id',
            'carts'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-carts-product_id',
            'carts'
        );

        $this->dropTable('carts');
    }
}
