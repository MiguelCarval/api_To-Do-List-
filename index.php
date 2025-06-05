<?php
require_once("tarefas.php");
require_once("conn.php");



header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$metodo = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

$tarefa = new Tarefas($conn);
$conn = (new Database) ->getdatabase();

switch($metodo){
    case "GET":
    $tarefa ->listar();

    break;

    case "POST":
    if (!isset($data['titulo']) || !isset($data['descricao'])) {

        http_response_code(400);
        echo json_encode(["Erro" => "Preencha os campos obrigatorios (título e descrição)"]);
        exit;
    }

    $titulo = $data['titulo'];
    $descricao = $data['descricao'];


    $tarefa ->adicionarTarefas($titulo, $descricao);
    break;

    case "PUT":
        
        if(!isset($data['id'])){

            http_response_code(400);
            echo json_encode(["Erro" => "Preencha campo obrogatorio (id)"]);
            exit;

        }
         
        $id = (int)$data['id'];
        $titulo = $data['titulo'] ?? null;
        $descricao = $data['descricao'] ?? null;

        $tarefa ->editar($id, $titulo, $descricao);
        break;

    case "DELETE":

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(["Erro" => "Preencha o campo obrigatorio (id)"]);
            exit;
        }

        $id = (int)$data['id'];
        $tarefa ->deletar($id);
    break;


    default:

    http_response_code(500);
    echo json_encode(["Erro" => "metodo invalido"]);

    break;


    

}



?>