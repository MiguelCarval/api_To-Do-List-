<?php

use PHPUnit\Framework\TestCase;

require_once 'conn.php';
require_once 'tarefas.php';

class Testes extends TestCase
{
    public function testAdicionarTarefa()
    {
        $conn = (new Database)->getdatabase();
        $tarefas = new Tarefas($conn);

        ob_start();
        $tarefas->adicionarTarefas("PHPUnit Teste", "Descrição simples");
        $json = ob_get_clean();

        $resposta = json_decode($json, true);

        $this->assertIsArray($resposta);
        $this->assertArrayHasKey("status", $resposta);
        $this->assertTrue($resposta["status"]);
    }

    
}

