<?php

require '../vendor/autoload.php';

try {
	$dsn = 'mysql:host=localhost;dbname=blog_ci;charset=utf8mb4';
	$pdo = new PDO($dsn, 'root', '', [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
	// PREPARED STATEMENT
	// prepare\execute
	$query = 'SELECT * FROM users where id > :id and firstName = :firstname';
	$prepared = $pdo->prepare($query);
	$prepared->execute([
		'id' => 10,
		'firstname' => 'Alexandre',
	]);

	$users = $prepared->fetchAll();

	dd($users);
} catch (\PDOException $e) {
	dd('Error ❌ ' . $e->getMessage());
}
