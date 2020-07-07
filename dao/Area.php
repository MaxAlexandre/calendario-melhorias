<?php

namespace DAO;

class Area extends Database
{

    const TABLE = 'area';
    protected static $oInstance;


    public function inserir($descricao = null)
    {
        try {

            $result = $this->filtrarPorDescricao($descricao);
            if (!empty($result)) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área já existente</b></div>");
            }
            $stmt = $this->db->prepare("INSERT INTO " . self::TABLE . "(descricao) values (:descricao)");
            if (!$stmt->execute(array(':descricao' => $descricao))) {
                throw new \Exception("Erro ao salvar área");
            }
            $_SESSION["mensagem"] = "<div class=\"alert alert-success text-center\" role=\"alert\"><b>Área cadastrada com sucesso!</b></div>";
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

    }

    private function validarId($id)
    {
        if ($id = null || !is_numeric($id)) {
            throw new \Exception("Id inválido");
        }
    }


    public function tarefas($idArea)
    {

        $stmt = $this->db->prepare("SELECT * FROM melhorias where area = :id;");
        if ($stmt->execute(array(":id" => $idArea))) {
            return $stmt->fetchAll();
        }
        return false;


    }

    public function alterar($id = null, $descricao = null)
    {
        try {

            $this->validarId($id);
            $area = $this->filtrarPorId($id);
            if (empty($area)) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área não encontrada</b></div>");
            }

            if ($this->tarefas($id)) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área relacionada a uma tarefa</b></div>");
            }

            if ($area->descricao != $descricao) {
                $result = $this->filtrarPorDescricao($descricao);
                if (!empty($result)) {
                    throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área já existente</b></div>");
                }

            }


            $stmt = $this->db->prepare("UPDATE " . self::TABLE . " SET descricao = :descricao WHERE id = :id");
            if (!$stmt->execute(array(
                ':id' => $id,
                ':descricao' => $descricao
            ))
            ) {
                throw new \Exception("Erro ao salvar área");
            }
            $_SESSION["mensagem"] = "<div class=\"alert alert-success text-center\" role=\"alert\"><b>Área editada com sucesso!</b></div>";

        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

    }

    public function deletar($id)
    {
        try {

            $this->validarId($id);

            $area = $this->filtrarPorId($id);
            if (empty($area)) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área não encontrada</b></div>");
            }

            if($this->tarefas($id)){
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área relacionada a uma tarefa</b></div>");
            }

            $stmt = $this->db->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
            if (!$stmt->execute(array(
                ':id' => $id,
            ))
            ) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Área relacionada a uma tarefa</b></div>");
            }
            $_SESSION["mensagem"] = "<div class=\"alert alert-success text-center\" role=\"alert\"><b>Área deletada com sucesso!</b></div>";
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }

    }


}
