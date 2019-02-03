<?php

namespace yii2lab\qr\domain\repositories\file;

use yii2rails\domain\BaseEntity;
use yii2rails\extension\flySystem\repositories\base\BaseFlyRepository;
use yii2rails\extension\common\helpers\TempHelper;
use yii2rails\extension\yii\helpers\FileHelper;
use yii2lab\qr\domain\entities\QrEntity;
use yii2rails\domain\repositories\BaseRepository;
use dosamigos\qrcode\lib\Enum;
use dosamigos\qrcode\QrCode;
use yii2lab\qr\domain\interfaces\repositories\GeneratorInterface;
use yii2lab\qr\domain\enums\SummaryEnum;
use yii2rails\app\domain\helpers\EnvService;

class GeneratorRepository extends BaseFlyRepository implements GeneratorInterface {
	
	public $size = 5;
	public $margin = 1;
	public $level = Enum::QR_ECLEVEL_L;
	public $format = 'png';

    private $isDirectoryExists = false;

    public function oneByText($text) {
		$entity = $this->forgeEntity([
		    'text' => $text,
            'format' => $this->format,
        ]);
		return $entity;
	}

    public function insert(BaseEntity $entity) {
        if($this->hasFile($entity->path)) {
            return;
        }
        $content = $this->generateImage($entity);
        $this->writeFile($entity->path, $content);
    }

    private function generateImage($entity) {
        $tmpFile = TempHelper::fullName($entity->path);
        QrCode::encode($entity->text, $tmpFile, $this->level, $this->size, $this->margin);
        $content = FileHelper::load($tmpFile);
        return $content;
    }

    /**
     * @param $data
     * @param null $class
     * @return QrEntity
     */
	public function forgeEntity($data, $class = null) {
		return parent::forgeEntity($data, QrEntity::class);
	}

}
