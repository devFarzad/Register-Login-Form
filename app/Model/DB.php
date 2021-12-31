<?php

namespace App\Model;


use PDO;

class DB
{

    protected $pdo = null;
    protected $host = 'localhost';
    protected $dbname = 'oop';
    protected $username = 'root';
    protected $password = '';
    protected $table;
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create($data)
    {

        $fields = join(',', array_keys($data));

        $arrayParam = array_keys($data);

        $params = array_map(function ($item) {
            return ":{$item}";
        }, $arrayParam);
        $params = join(',', $params);



        $statment = $this->pdo->prepare("INSERT INTO {$this->table} ({$fields}) values ({$params})");
        return $statment->execute($data);
    }
    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id=:id");
        return $statement->execute(['id' => $id]);
    }
    public function update($data, $id)
    {

        $feilds = join(",", array_map(function ($item) {
            return "$item" . "=" . ":$item";
        }, array_keys($data)));

        // array_push($data, ["id" => $id]);
        // var_dump($data);
        // exit;
        $statement = $this->pdo->prepare("UPDATE {$this->table} SET {$feilds} WHERE id={$id}");

        $statement->execute($data);
    }
}
