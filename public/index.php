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
	$rows = $user->findAll();

	dd($rows[0]->fullName());

	Transaction::close();
} catch (\Throwable $e) {
	dd($e);
}
