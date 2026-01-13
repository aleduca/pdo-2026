<?php

namespace app\model;

use app\entity\UserEntity;
use core\database\model\Model;

class User extends Model
{
	protected string $table = 'users';
	protected string $entity = UserEntity::class;
}
