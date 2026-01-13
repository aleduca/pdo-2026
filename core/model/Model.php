<?php

namespace core\model;

use core\database\entity\AbstractEntity;
use core\database\Transaction;
use PDO;

abstract class Model
{
	protected string $table;
	protected string $entity;
	protected ?PDO $pdo;

	public function __construct()
	{
		$this->pdo = Transaction::get();
	}

	public function find(int $id):?AbstractEntity
	{
		$stmt = $this->pdo->prepare("SELECT * FROM {$this->table} where id = :id");
		$stmt->execute(['id' => $id]);

		$row = $stmt->fetch();

		return $row ? $this->entity::fromArray($row) : null;
	}

	public function findAll():array
	{
		$stmt = $this->pdo->query("SELECT * FROM {$this->table}");

		$rows = $stmt->fetchAll();

		return !empty($rows) ? $this->entity::fromArrayList($rows) : [];
	}

	public function create(array $data):int
	{
		$fields = array_keys($data);
		$columns = implode(', ', $fields);
		$params = ':' . implode(', :', $fields);

		$stmt = $this->pdo->prepare(
			"INSERT INTO {$this->table} ({$columns}) VALUES ({$params})"
		);

		$stmt->execute($data);

		return (int)$this->pdo->lastInsertId();
	}

	public function update(int $id, array $data):int
	{
		$fields = array_keys($data);
		$set = implode(', ', array_map(fn ($f) => "$f = :$f", $fields));

		$data['id'] = $id;

		$stmt = $this->pdo->prepare("
            UPDATE {$this->table}
            SET {$set}
            WHERE id = :id
        ");

		$stmt->execute($data);

		return (int)$stmt->rowCount();
	}

	public function delete(int $id):int
	{
		$stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");

		$stmt->execute(['id' => $id]);

		return (int)$stmt->rowCount();
	}
}
