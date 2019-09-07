<?php
require 'bootstrap.php';

$statement = '';

try {
    $createTable = $dbConnection->exec($statement);
    echo "Sucesso!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}
?>