<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property Goods[] $goods
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 245],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва категорії',
            'description' => 'Опис',
        ];
    }

    /**
     * Gets query for [[Goods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::class, ['category_id' => 'id']);
    }

    /**
     *
     * @return array
     */
    public static function getCategoriesLinks()
    {
        $items[] = [
            'label' => 'Всі',
            'url' => ['/goods/index2', 'category_id' => 'all', 'brand_id' => Yii::$app->request->get('brand_id')]
        ];
        foreach (self::find()->all() as $model) {
            $items[] = [
                'label' => $model->name,
                'url' => ['/goods/index2', 'category_id' => $model->id, 'brand_id' => Yii::$app->request->get('brand_id')]
            ];
        }

        return $items;
    }
}
