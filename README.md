## API DE To-Do List (Lista de Tarefas)
Essa é um api simples para usar em aplicações de lista de tarefas

## Funcionalidades
Adiciona tarefas

Edita tarefas

Lista tarefas

Deleta tarefas

## Como usar
Requisitos
PHP 8+

Composer (para instalar PHPUnit)

Servidor local (como XAMPP, WAMP, ou Apache/Nginx)

## endpoint 
http://localhost/nova/api_lista/index.php

Listar
usa o endpoint

Adiconar
{
        "titulo": "exemplo",
        "descricao": "exemplo",
        
      }

Editar
{        
        "id" = 1
        "titulo": "exemplo",
        "descricao": "exemplo",
        
      }

Deletar
{        
        "id" = 1
    
        
      }





## teste pelo composer
vendor/bin/phpunit --bootstrap tarefas.php testes.php

## Sobre
Este projeto foi para praticar:

APIs REST com PHP puro

Banco de dados

Programação orientada a objetos (POO)

Testes unitários com PHPUnit

Criado por : Miguel Carvalho

## obs
 Falta testar algumas coisas ainda

