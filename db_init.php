<?php

function initializeDatabase() {
    $DB_NAME = 'mvc_db';
    $DB_USER = 'root';
    $DB_PASSWORD = 'root';
    $DB_HOST = 'db'; // Nome do serviço no Docker
    $DB_PORT = 3306;

    $retryCount = 10; // Número de tentativas
    while ($retryCount > 0) {
        try {
            $pdo = new PDO("mysql:host=$DB_HOST;port=$DB_PORT", $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Criação do banco de dados se não existir
            $pdo->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME");
            echo "Banco de dados '$DB_NAME' criado ou já existente.\n";

            // Seleciona o banco de dados
            $pdo->exec("USE $DB_NAME");

            // Criação da tabela se não existir
            $createTableSQL = "
            CREATE TABLE IF NOT EXISTS `users` (
                `nis` varchar(11) NOT NULL,
                `name` text NOT NULL,
                PRIMARY KEY (`nis`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            ";

            $pdo->exec($createTableSQL);
            echo "Tabela 'users' criada ou já existente.\n";
            break; // Sai do loop se tudo foi bem-sucedido

        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage() . "\n";
            sleep(5); // Aguarda 5 segundos antes de tentar novamente
            $retryCount--; // Decrementa o contador de tentativas
        }
    }

    if ($retryCount == 0) {
        die("Falha ao conectar ao banco de dados após várias tentativas.\n");
    }
}

// Executa a função ao rodar o script
initializeDatabase();