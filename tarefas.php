<?php

require_once('conn.php');

header("Content-Type: application/json");

$conn = (new Database) ->getdatabase();

class Tarefas{

   private $conn;


   public function __construct($conn)
   {
    $this->conn = $conn;
   }

   public function listar(){
    $sql = "SELECT * FROM lista";
    $query = $this->conn -> query($sql);

    if(!$query){

        echo json_encode(["Erro"=> "Erro na query" . mysqli_error($query)]);
        exit;
    }

    $lista = [];

    while($row = mysqli_fetch_assoc($query)){
        $lista[] = $row;
    }

    echo json_encode($lista);
    exit;


   }


    public function adicionarTarefas($titulo, $descricao){

        $stmt = $this-> conn ->prepare('INSERT INTO lista (titulo, descricao) VALUES(?,?)');
        $stmt ->bind_param("ss", $titulo,$descricao);
        $result = $stmt->execute();

        if(!$result){
           echo json_encode([

                "status" => false,
                "mensagem" => "Erro ao adicionar tarefas" . $stmt->error
            
            
            ]);

        }else{

          echo json_encode([

                "status" => true,
                "mensagem" => "Tarefa adicionada com sucesso"
            ]);

        }
        

    }



    public function editar($id, $titulo, $descricao) {
    $stmt = $this->conn->prepare("UPDATE lista SET titulo = ?, descricao = ? WHERE id = ?");
    
    if (!$stmt) {
        echo json_encode([
            "status" => false,
            "erro" => "Erro ao preparar statement: " . $this->conn->error
        ]);
        return;
    }

    $stmt->bind_param("ssi", $titulo, $descricao, $id);

    if (!$stmt->execute()) {
        echo json_encode([
            "status" => false,
            "erro" => "Erro ao executar: " . $stmt->error
        ]);
        return;
    }

    if ($stmt->affected_rows === 0) {
        echo json_encode([
            "status" => false,
            "mensagem" => "Nenhuma tarefa encontrada com esse ID"
        ]);
    } else {
        echo json_encode([
            "status" => true,
            "mensagem" => "Tarefa editada com sucesso"
        ]);
    }

    $stmt->close();
}




    public function deletar($id) {
    $stmt = $this->conn->prepare("DELETE FROM lista WHERE id = ?");
    
    if (!$stmt) {
        echo json_encode([
            "status" => false,
            "erro" => "Erro ao preparar statement: " . $this->conn->error
        ]);
        return;
    }

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        echo json_encode([
            "status" => false,
            "erro" => "Erro ao executar: " . $stmt->error
        ]);
        return;
    }

    if ($stmt->affected_rows === 0) {
        echo json_encode([
            "status" => false,
            "mensagem" => "Nenhuma tarefa encontrada com esse ID"
        ]);
    } else {
        echo json_encode([
            "status" => true,
            "mensagem" => "Tarefa deletada com sucesso"
        ]);
    }

    $stmt->close();
}


}





?>