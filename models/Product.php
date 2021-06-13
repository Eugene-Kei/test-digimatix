<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Products
 * @package yii\app\models
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $category_id
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'products';
    }
}