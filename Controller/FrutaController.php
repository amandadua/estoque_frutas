<?php

namespace Controller;

use Model\Fruta;

class FrutaController
{
    public function getFrutas()
    {
        $fruta = new Fruta();
        $frutas = $fruta->getFrutas();

        if ($frutas) {
            header("Content-Type: application/json", true, 200);
            echo json_encode($frutas);
        } else {
            header("Content-Type: application/json", true, 404);
            echo json_encode(["message" => "Nenhuma fruta encontrada"]);
        }
    }

    public function createFruta()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->nome) && isset($data->qtd) && isset($data->valor)) {
            $fruta = new Fruta();
            $fruta->nome = $data->nome;
            $fruta->qtd = $data->qtd;
            $fruta->valor = $data->valor;

            if ($fruta->createFruta()) {
                header("Content-Type: application/json", true, 201);
                echo json_encode(["message" => "Fruta adicionada com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Erro ao adicionar fruta"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "Dados invalidos"]);
        }
    }

    public function updateFruta()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id)) {
            $fruta = new Fruta();
            $fruta->id = $data->id;
            $fruta->nome = $data->nome;
            $fruta->qtd = $data->qtd;
            $fruta->valor = $data->valor;

            if ($fruta->updateFruta()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message" => "Fruta atualizada com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Erro ao atualizar fruta"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "ID invalido"]);
        }
    }

    public function deleteFruta()
    {
        $id = $_GET["id"] ?? null;

        if ($id) {
            $fruta = new Fruta();
            $fruta->id = $id;

            if ($fruta->deleteFruta()) {
                header("Content-Type: application/json", true, 200);
                echo json_encode(["message" => "Fruta excluida com sucesso"]);
            } else {
                header("Content-Type: application/json", true, 500);
                echo json_encode(["message" => "Erro ao excluir fruta"]);
            }
        } else {
            header("Content-Type: application/json", true, 400);
            echo json_encode(["message" => "ID invalido"]);
        }
    }
}
