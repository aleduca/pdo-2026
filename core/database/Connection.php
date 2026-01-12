<?php

namespace core\database;

use PDO;

class Connection
{
	protected static ?PDO $pdo = null;

	public static function open(): ?PDO
	{
		if (is_null(self::$pdo)) {
			self::$pdo = new PDO('mysql:host=localhost;dbname=blog_ci;charset=utf8mb4', 'root', '', [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			]);
		}

		return self::$pdo;
	}

	public static function close()
	{
		if (self::$pdo && self::$pdo instanceof PDO) {
			self::$pdo = null;
		}
	}
}
