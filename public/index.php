<?php

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] !== '/') {
	exit;
}

file_put_contents(
	__DIR__ . '/log.txt',
	$_SERVER['REQUEST_URI'] . PHP_EOL,
	FILE_APPEND
);

try {
	$dsn = 'mysql:host=localhost;dbname=blog_ci;charset=utf8mb4';
	$pdo = new PDO($dsn, 'root', '', [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
	]);
	// PREPARED STATEMENT
	// prepare\execute
	// CRUD - Create(INSERT), Read(SELECT), Update(UPDATE), Delete(DELETE)
	$query = 'INSERT INTO users(firstName,lastName,email,password) VALUES(:firstName,:lastName,:email,:password)';
	// $query = 'DELETE FROM users WHERE id = :id';
	// $query = 'UPDATE users SET firstName = :firstName, lastName = :lastName, email = :email, password = :password WHERE id = :id';
	$prepared = $pdo->prepare($query);
	$prepared->execute([
		'firstName' => 'Alexandre',
		'lastName' => 'Cardoso',
		'email' => 'email@email.com.br',
		'password' => password_hash(123, PASSWORD_DEFAULT),
	]);
	dd($pdo->lastInsertId());
} catch (\Throwable $e) {
	dd('Error ❌ ' . $e->getMessage());
}
