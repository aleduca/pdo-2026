<?php

namespace core\utils;

use BadMethodCallException;
use Exception;

class Hydrator
{
	public static function hydrate(string $class, array $data)
	{
		if (!class_exists($class)) {
			throw new Exception("Class {$class} does not exist");
		}

		$class = new $class;

		foreach ($data as $key => $value) {
			if (is_null($value)) {
				continue;
			}

			if (!property_exists($class, $key)) {
				continue;
			}

			$setterMethod = 'set' . ucFirst($key);

			if (!method_exists($class, $setterMethod)) {
				throw new BadMethodCallException("Method {$setterMethod} does not exist");
			}

			$class->$setterMethod(is_string($value) ? trim($value) : $value);
		}

		return $class;
	}

	public static function hydrateMany(string $class, array $data)
	{
		$entities = [];

		foreach ($data as $value) {
			if (!is_array($value)) {
				throw new Exception('Please use the fetchAll method');
			}

			$entities[] = self::hydrate($class, $value);
		}

		return $entities;
	}
}
