<?php

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] !== '/') {
	exit;
}

// Banco te que ser do tipo InnoDB
// Para mudar para innodb - ALTER TABLE your_table_name ENGINE = innodb;
// Sem a transaction é auto commitado e com ele só o é quando chamo explicitamente o método commit

// $pdo = null;

try {
	$dsn = 'mysql:host=localhost;dbname=blog_ci;charset=utf8mb4';
	$pdo = new PDO($dsn, 'root', '', [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
	// inicia a transaction
	$pdo->beginTransaction();
	// Agora o inTransaction fica como true

	// dd($pdo);

	$pdo->query('DROP TABLE teste');

	$prepared = $pdo->prepare('INSERT INTO users(firstName,lastName,email,password) VALUES(:firstName,:lastName,:email,:password)');
	$prepared->execute([
		'firstName' => 'Alexandre',
		'lastName' => 'Cardoso',
		'email' => 'email@email.com.br',
		'password' => password_hash(123, PASSWORD_DEFAULT),
	]);

	$pdo->query('DELETE FROM teste1');

	$stmtUpdate = $pdo->prepare('UPDATE user SET firstName=:firstName, lastName=:lastName, email=:email, password=:password WHERE id=:id');
	$stmtUpdate->execute([
		'id' => 101,
		'firstName' => 'Alexandre',
		'lastName' => 'Eduardo Cardoso',
		'email' => 'email@email.com.br',
		'password' => password_hash(123, PASSWORD_DEFAULT),
	]);

	// confirma a transaction(transação), executa as queries.
	$pdo->commit();
} catch (\Throwable $e) {
	// Rolls back a transaction - Faz rollback da transaction(transação)
	if ($pdo instanceof PDO && $pdo->inTransaction()) {
		dump('rolling back');
		$pdo->rollBack();

		// dd($pdo);
	}
	dd('Error ❌ ' . $e->getMessage());
}
