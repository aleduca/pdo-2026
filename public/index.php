<?php

use app\entity\UserEntity;

require '../vendor/autoload.php';

try {
	$dsn = 'mysql:host=localhost;dbname=blog_ci;charset=utf8mb4';
	$pdo = new PDO($dsn, 'root', '', [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
	// PREPARED STATEMENT
	// prepare\execute
	$query = 'SELECT * FROM users where id > :id';
	$prepared = $pdo->prepare($query);
	$prepared->execute([
		'id' => 50,
	]);

	$prepared->setFetchMode(PDO::FETCH_CLASS, UserEntity::class);
	$user = $prepared->fetchAll();
	dd($user);

	// $userEntity = new UserEntity;
	// $userEntity->age = 43;

	dd($userEntity);
} catch (\Throwable $e) {
	dd('Error ❌ ' . $e->getMessage());
}
