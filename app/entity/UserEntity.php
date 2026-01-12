<?php

namespace app\entity;

use core\database\entity\AbstractEntity;

class UserEntity extends AbstractEntity
{
	protected ?int $id = null;
	protected ?string $firstName = null;
	protected ?string $lastName = null;
	protected ?string $email = null;
	protected ?string $password = null;
	protected ?string $image = null;
	protected ?string $created_at = null;
	protected ?string $updated_at = null;
}
