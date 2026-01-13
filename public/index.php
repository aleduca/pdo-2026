<?php

use app\model\User;
use core\database\Transaction;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] !== '/') {
	exit;
}

try {
	// ✅Classe Conexão
	// ✅Transaction
	// ✅Model - Regras de Negócio
	// ✅Model Abstrato - Regras da aplicação
	// ✅Retorno de entidades nos SELECTS
	// ✅Prepared Statement sempre que precisar
	// ✅Um método para cada ação do CRUD - No Model Abstrato

	Transaction::open();
	$user = new User;
	$insertId = $user->create([
		'firstName' => 'Alexandre',
		'lastName' => 'Cardoso',
		'email' => 'email@email.com.br',
		'password' => password_hash(123, PASSWORD_DEFAULT),
	]);

	$updated = $user->update($insertId, [
		'lastName' => 'Eduardo Cardoso',
	]);

	Transaction::close();
} catch (\Throwable $e) {
	Transaction::rollback();
	dd($e);
}
