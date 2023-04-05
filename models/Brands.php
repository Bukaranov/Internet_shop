<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property int $id
 * @property string $name
 * @property string|null $descriptionBrands
 *
 * @property Goods[] $goods
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'descriptionBrands'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва бренду',
            'descriptionBrands' => 'Опис',
        ];
    }

    /**
     * Gets query for [[Goods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::class, ['brand_id' => 'id']);
    }

    public static function getBrandsLinks()
    {
        $items[] = [
            'label' => 'Всі',
            'url' => ['/goods/index2',  'brand_id' => 'all', 'category_id' => Yii::$app->request->get('category_id')]
        ];
        foreach (self::find()->all() as  $model){
            $items[] = [
                'label' => $model->name,
                'url' => ['/goods/index2', 'brand_id' => $model->id, 'category_id' => Yii::$app->request->get('category_id')]
            ];
        }
        return $items;
    }
}
