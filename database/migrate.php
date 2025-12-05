<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

try {
    $sql = file_get_contents(__DIR__ . '/schema.sql');

    if ($sql === false) {
        throw new Exception("No se pudo leer el archivo schema.sql");
    }

    $pdo = Database::getInstance()->getConnection();
    $pdo->exec($sql);

    echo "✅ Migración ejecutada exitosamente.\n";
} catch (PDOException $e) {
    echo "❌ Error de base de datos: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "⚠️ Error: " . $e->getMessage() . "\n";
}