<?php

namespace yii2lab\qr\domain\interfaces\repositories;

use yii2rails\domain\BaseEntity;

interface GeneratorInterface {
	
	public function oneByText($text);
    public function insert(BaseEntity $entity);

}