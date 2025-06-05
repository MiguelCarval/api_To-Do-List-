<?php


class Database {
 
    private $host;
    private $user;
    private $pass;
    private $db_name;
    public $conn;

    public function __construct()
    {
        $env = parse_ini_file(__DIR__ . '/.env');

        if(!$env){
            die("Erro ao ler arquivo .env");
        }

        $this->host = $env['DB_HOST'];
        $this->user = $env['DB_USER'];
        $this->pass = $env['DB_PASS'];
        $this->db_name = $env['DB_NAME'];


        $this-> conn = new mysqli($this->host,$this->user,$this->pass,$this->db_name );

        if($this->conn->connect_error){
            die("Erro ao conectar" . $this->conn->connect_error);
        }
    }


    public function getdatabase(){
        return $this->conn;
    }




}

