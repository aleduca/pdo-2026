<?php

namespace core\database\entity;

use Exception;

abstract class AbstractEntity
{
	protected function hydrate(array $data):void
	{
		foreach ($data as $key => $value) {
			if (is_null($value)) {
				continue;
			}

			if (!property_exists($this, $key)) {
				continue;
			}

			$this->$key = is_string($value) ? trim($value) : $value;
		}
	}


	public static function fromArray(array $data)
	{
		$instance = new static;

		$instance->hydrate($data);

		return $instance;
	}

	public static function fromArrayList(array $data)
	{
		$entities = [];

		foreach ($data as $value) {
			if (!is_array($value)) {
				throw new Exception('Please use the fetchAll method');
			}

			$entities[] = static::fromArray($value);
		}

		return $entities;
	}
}
