<?php

namespace app\model;

use app\entity\UserEntity;
use core\database\model\AbstractModel;

class User extends AbstractModel
{
	protected string $table = 'users';
	protected string $entity = UserEntity::class;
}
