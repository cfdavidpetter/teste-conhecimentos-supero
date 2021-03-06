<?php
namespace Src\Model;

class Tarefa {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "SELECT * FROM tarefas ORDER BY prioridade;";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {

            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        $statement = "SELECT * FROM tarefas WHERE id = ?;";

        try {

            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {

            exit($e->getMessage());
        }
    }

    public function insert(Array $input)
    {
        $statement = "
            INSERT INTO tarefas
                (titulo, descricao, prioridade)
            VALUES
                (:titulo, :descricao, :prioridade);
        ";

        try {

            $statement = $this->db->prepare($statement);
            $result = $statement->execute(array(
                'titulo' => $input['titulo'],
                'descricao'  => $input['descricao'],
                'prioridade'  => $input['prioridade'],
            ));

            return $this->find($this->db->lastInsertId());
        } catch (\PDOException $e) {

            exit($e->getMessage());
        }
    }

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE tarefas
            SET
                titulo = :titulo,
                descricao  = :descricao,
                prioridade = :prioridade
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'titulo' => $input['titulo'],
                'descricao'  => $input['descricao'],
                'prioridade'  => $input['prioridade'],
            ));
            
            return $this->find($id);
        } catch (\PDOException $e) {

            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM tarefas
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));

            return $statement->rowCount();
        } catch (\PDOException $e) {

            exit($e->getMessage());
        }
    }
}