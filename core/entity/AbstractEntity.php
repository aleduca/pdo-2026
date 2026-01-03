<?php

namespace core\entity;

use core\exception\AttributeNotFoundException;

abstract class AbstractEntity
{
	protected array $attributes = [];
	protected array $validAttributes = [];

	public function __set(string $key, mixed $value)
	{
		if (!array_key_exists($key, $this->attributes) && in_array($key, $this->validAttributes)) {
			$this->attributes[$key] = $value;
		}
	}

	public function __get(string $key)
	{
		throw new AttributeNotFoundException("Please use the get method for $key");
	}

	public function get(string $key)
	{
		if (!array_key_exists($key, $this->attributes)) {
			throw new AttributeNotFoundException("Attribute {$key} doesn not exist");
		}

		return $this->attributes[$key];
	}
}
