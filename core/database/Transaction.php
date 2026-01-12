<?php

namespace core\database;

use PDO;
use Throwable;

class Transaction
{
	protected static ?PDO $pdo = null;

	public static function open(): void
	{
		self::$pdo = Connection::open();
		self::$pdo->beginTransaction();
	}

	public static function get(): ?PDO
	{
		if (!self::$pdo && !self::$pdo?->inTransaction()) {
			return Connection::open();
		}

		return self::$pdo;
	}

	public static function rollback():void
	{
		if (self::$pdo?->inTransaction()) {
			self::$pdo->rollBack();
		}
	}

	public static function exception(Throwable $e):string
	{
		return "❌ Error: {$e->getMessage()}";
	}

	public static function close()
	{
		self::$pdo->commit();
		Connection::close();
	}
}
