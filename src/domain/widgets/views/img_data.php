<?php

/**
 * @var $url string
 * @var $qr \yii2lab\qr\domain\entities\QrEntity
*/

use yii2rails\extension\widget\Img;

?>

<?= Img::widget([
	'type' => Img::TYPE_IMG_DATA,
	'file' => $qr->path,
]) ?>
