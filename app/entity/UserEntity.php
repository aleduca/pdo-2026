<?php

namespace app\entity;

use core\entity\AbstractEntity;

class UserEntity extends AbstractEntity
{
	protected array $validAttributes = [
		'id',
		'firstName',
		'lastName',
		'email',
		'ln',
	];
}
