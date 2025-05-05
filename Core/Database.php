<?php

namespace Core;

use PDO;

class Database {

public $connection;
public $statement;
    public function __construct($config){

    $dsn = 'mysql:'. http_build_query($config, '',';');

        // $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
        
        $this->connection = new PDO($dsn, 'ibrahim', 'P@ssw0rd', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $prams = []){  
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($prams);
        
        return $this;
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function get(){
        return $this->statement->fetchAll();
    }

    public function findOrFaile(){
        $result = $this->find();
        if(! $result){
            abort();
        }
        return $result;
    }

}