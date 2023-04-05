<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            //Валидация формата
            [['image'], 'file', 'extensions' => 'jpg,png,svg']
        ];
    }

    /**
     * Получение файла изображения
     * @param UploadedFile $file
     * @param $currentImage
     * @return string|void
     */
    public function aploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if ($this->validate())
        {

            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
    }

    private function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    /**
     * присвоение уникального имени
     * Генерация имени
     * @return string
     */
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    /**
     * Удаление уже загруженой картинки
     * @param $currentImage
     * @return void
     */
    public function deleteCurrentImage($currentImage)
    {
        //Условие удаляющаяя картинку в том случаее если она существует на сервере
        if($this->fileExist($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
    }

    /**
     * Проверка на существование файла
     * @param $currentImage
     * @return bool|void
     */
    public function fileExist($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
    }

    /**
     * Загрузка картинки
     * @return string
     */
    public function saveImage()
    {
        $filename = $this->generateFilename();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}