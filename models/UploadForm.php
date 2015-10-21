<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Fotos;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file_name = date('Y-m-d H:i:s') . "_" . $file->baseName . '.' . $file->extension;
                $file->saveAs('assets/imgOfertas/' . $file_name);
                $foto = new Fotos();
                $foto->idProducto = $id;
                $foto->url = $file_name;
                $foto->save();
            }
            return true;
        } else {
            return false;
        }
    }
}
?>