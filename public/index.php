<?php

require '../vendor/autoload.php';

class User
{
	protected int $id;
	protected string $firstName;
	protected string $lastName;
	protected string $email;
	protected string $password;
	protected ?string $image;
	protected ?int $avatar_id;
	protected string $created_at;
	protected string $updated_at;
}

try {
	$dsn = 'mysql:host=localhost;dbname=blog_ci;charset=utf8mb4';
	$pdo = new PDO($dsn, 'root', '', [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
	// PREPARED STATEMENT
	// prepare\execute
	$query = 'SELECT * FROM users where id = :id';
	$prepared = $pdo->prepare($query);
	$prepared->execute([
		'id' => 50,
	]);

	$prepared->setFetchMode(PDO::FETCH_CLASS, User::class);
	$users = $prepared->fetchObject(User::class);

	dd($users);
} catch (\PDOException $e) {
	dd('Error ❌ ' . $e->getMessage());
}
