<?php

namespace app\model;

use app\entity\UserEntity;
use core\model\Model;

class User extends Model
{
	protected string $table = 'users';
	protected string $entity = UserEntity::class;
}
