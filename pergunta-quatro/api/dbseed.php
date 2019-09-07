<?php
require 'bootstrap.php';

$statement = "
    CREATE TABLE tarefas (
        id INT(11) NOT NULL AUTO_INCREMENT,
        titulo VARCHAR(100) NOT NULL,
        descricao TEXT NULL,
        prioridade INT(1) NOT NULL DEFAULT '1',
        PRIMARY KEY (`id`)
    );

    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Phasellus feugiat', 'Phasellus feugiat mi sed sodales iaculis. Nunc massa erat, aliquet scelerisque varius eget, mattis ac justo.', 1);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Viverra', 'Nam aliquet velit nisi, sed blandit justo interdum a.', 1);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Dignissim', 'Pellentesque pretium semper finibus.', 2);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Phasellus feugiat', 'Pellentesque vitae odio sed quam sagittis aliquam et a neque.', 3);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Etiam sem mi', 'Nulla quis finibus magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 3);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Phasellus feugiat', 'Pellentesque pretium semper finibus.', 1);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Nullam vitae venenatis', 'Phasellus feugiat mi sed sodales iaculis. Nunc massa erat, aliquet scelerisque varius eget, mattis ac justo.', 3);
    INSERT INTO tarefas (titulo, descricao, prioridade) VALUES ('Sristique senectus et netus', 'Sed dignissim quis felis nec bibendum.', 2);
";

try {
    $createTable = $dbConnection->exec($statement);
    echo "Sucesso!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}
?>