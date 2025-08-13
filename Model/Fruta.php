<?php

namespace Model;

use PDO;
use Model\Connection;

class Fruta
{
    private $conn;

    public $id;
    public $nome;
    public $qtd;
    public $valor;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function getFrutas()
    {
        $sql = "SELECT * FROM frutas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createFruta()
{
    $sql = "INSERT INTO frutas (nome, qtd, valor) VALUES (:nome, :qtd, :valor)";
    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
    $stmt->bindParam(":qtd", $this->qtd, PDO::PARAM_INT);
    $stmt->bindParam(":valor", $this->valor);

    return $stmt->execute();
}


    public function updateFruta()
    {
        $sql = "UPDATE frutas SET nome = :nome, qtd = :qtd, valor = :valor WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":qtd", $this->qtd, PDO::PARAM_INT);
        $stmt->bindParam(":valor", $this->valor);

        return $stmt->execute();
    }

    public function deleteFruta()
    {
        $sql = "DELETE FROM frutas WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
