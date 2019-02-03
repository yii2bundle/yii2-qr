<?php

namespace yii2lab\qr\domain\interfaces\repositories;

use yii2rails\domain\BaseEntity;

interface CacheInterface {
	
	public function oneByText($text);
	public function insert(BaseEntity $entity);

}