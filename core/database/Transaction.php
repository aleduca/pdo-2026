<?php

namespace core\database;

use PDO;

class Transaction
{
	protected static ?PDO $pdo = null;

	public static function open():void
	{
		self::$pdo ??= Connection::open();
		self::$pdo->beginTransaction();
	}

	public static function inTransaction():bool
	{
		return self::$pdo instanceof PDO && self::$pdo->inTransaction();
	}

	public static function get()
	{
		if (!self::inTransaction()) {
			self::$pdo = Connection::open();
		}

		return self::$pdo;
	}

	public static function close()
	{
		if (self::inTransaction()) {
			self::$pdo->commit();
		}
	}

	public static function rollback()
	{
		if (self::inTransaction()) {
			self::$pdo->rollBack();
			dd(self::$pdo);
		}
	}
}
