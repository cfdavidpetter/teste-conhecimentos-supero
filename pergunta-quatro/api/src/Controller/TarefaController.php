<?php
namespace Src\Controller;

use Src\Model\Tarefa;

class TarefaController {

    private $db;
    private $requestMethod;
    private $id;
    private $tarefa;

    public function __construct($db, $requestMethod, $id)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->id = $id;
        $this->tarefa = new Tarefa($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'OPTIONS':
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                return $response;
                break;
            case 'GET':
                if ($this->id) {
                    $response = $this->find($this->id);
                } else {
                    $response = $this->getAll();
                };
                break;
            case 'POST':
                $response = $this->create();
                break;
            case 'PUT':
                $response = $this->update($this->id);
                break;
            case 'DELETE':
                $response = $this->delete($this->id);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    
    private function getAll()
    {
        $result = $this->tarefa->findAll();

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function find($id)
    {
        $result = $this->tarefa->find($id);
        if (!$result) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function create()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateTarefa($input)) {
            return $this->unprocessableEntityResponse();
        }

        $result = $this->tarefa->insert($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($result[0]);
        return $response;
    }

    private function update($id)
    {
        $result = $this->tarefa->find($id);
        if (!$result) {
            return $this->notFoundResponse();
        }

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateTarefa($input)) {
            return $this->unprocessableEntityResponse();
        }

        $result = $this->tarefa->update($id, $input);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result[0]);
        return $response;
    }

    private function delete($id)
    {
        $result = $this->tarefa->find($id);
        if (!$result) {
            return $this->notFoundResponse();
        }

        $this->tarefa->delete($id);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private function validateTarefa($input)
    {
        if (!isset($input['titulo'])) {
            return false;
        }

        if (!isset($input['descricao'])) {
            return false;
        }

        if (trim($input['titulo']) == '' || trim($input['descricao']) == '') {
            return false;
        }
        
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 500 Internal Server Error';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}