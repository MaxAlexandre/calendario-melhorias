<?php

namespace DAO;

class Melhoria extends Database
{

    const TABLE = 'melhorias';
    protected static $oInstance;


    public function inserir($descricao = null, $demanda_legal = null, $prazo_legal = null, $prazo_acordado = null, $gravidade = null, $urgencia = null, $tendencia = null, $area = null)
    {
        try {

            if (!is_null($prazo_acordado)) {
                $dataformat1 = $prazo_acordado;
                $DFm = explode("/", $dataformat1);
                $dataformat1 = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
            }

            if (!is_null($prazo_legal)) {
                $dataformat2 = $prazo_legal;
                $DFm = explode("/", $dataformat2);
                $dataformat2 = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
            }

            $result = $this->filtrarPorDescricao($descricao);
            if (!empty($result)) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Tarefa já existente</b></div>");
            }
            $sql = "INSERT INTO " . self::TABLE . "(tarefa,descricao,demanda_legal,prazo_legal,prazo_acordado,gravidade,urgencia,tendencia,area) 
            values (:tarefa,:descricao, :demanda_legal, :prazo_legal,:prazo_acordado, :gravidade, :urgencia, :tendencia, :area)";
            $stmt = $this->db->prepare($sql);
            if (!$stmt->execute(array(
                ':tarefa' => $descricao,
                ':descricao' => $descricao,
                ':demanda_legal' => $demanda_legal,
                ':prazo_legal' => ($dataformat2 ? $dataformat2 : null),
                ':prazo_acordado' => $dataformat1,
                ':gravidade' => ($gravidade ? $gravidade : null),
                ':urgencia' => ($urgencia ? $urgencia : null),
                ':tendencia' => ($tendencia ? $tendencia : null),
                ':area' => $area
            ))) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Erro ao salvar tarefa</b></div>");

            }
            $_SESSION["mensagem"] = "<div class=\"alert alert-success text-center\" role=\"alert\"><b>Tarefa cadastrada com sucesso!</b></div>";
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

    public function alterar($id = null, $descricao = null, $demanda_legal = null, $prazo_legal = null, $prazo_acordado = null, $gravidade = null, $urgencia = null, $tendencia = null, $area = null)
    {

        try {
            if (!is_null($prazo_acordado)) {
                $dataformat1 = $prazo_acordado;
                $DFm = explode("/", $dataformat1);
                $dataformat1 = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
            }

            if (!is_null($prazo_legal)) {
                $dataformat2 = $prazo_legal;
                $DFm = explode("/", $dataformat2);
                $dataformat2 = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
            }

            $this->validarId($id);
            $tarefa = $this->filtrarPorId($id);
            if (empty($tarefa)) {
                throw new \Exception("Tarefa não encontrada");
            }

            $sql = "UPDATE " . self::TABLE . " SET tarefa =  :tarefa 
            ,descricao = :descricao
            ,demanda_legal = :demanda_legal
            ,prazo_legal = :prazo_legal
            ,prazo_acordado = :prazo_acordado
            ,gravidade= :gravidade
            ,urgencia=:urgencia
            ,tendencia=:tendencia
            ,area=:area
              WHERE
                  id = :id
            ";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute(array(
                ":id" => $id,
                ':tarefa' => $descricao,
                ':descricao' => $descricao,
                ':demanda_legal' => $demanda_legal,
                ':prazo_legal' => ($dataformat2 ? $dataformat2 : null),
                ':prazo_acordado' => $dataformat1,
                ':gravidade' => ($gravidade ? $gravidade : null),
                ':urgencia' => ($urgencia ? $urgencia : null),
                ':tendencia' => ($tendencia ? $tendencia : null),
                ':area' => $area
            ));
            if (!$result) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Erro ao alterar tarefa</b></div>");

            }
            $_SESSION["mensagem"] = "<div class=\"alert alert-success text-center\" role=\"alert\"><b>Tarefa alterada com sucesso!</b></div>";

        } catch (\Exception $ex) {
            echo $ex;
        }

    }

    public function deletar($id)
    {
        try {

            $this->validarId($id);
            $tarefa = $this->filtrarPorId($id);
            if (empty($tarefa)) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Tarefa não encontrada</b></div>");
            }
            $stmt = $this->db->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
            if (!$stmt->execute(array(
                ':id' => $id,
            ))
            ) {
                throw new \Exception("<div class=\"alert alert-danger text-center\" role=\"alert\"><b>Erro ao excluir tarefa</b></div>");
            }
            $_SESSION["mensagem"] = "<div class=\"alert alert-success text-center\" role=\"alert\"><b>Tarefa excluída com sucesso!</b></div>";
        } catch (\Exception $ex) {
            echo $ex;
        }
    }




public function filtrarPorUrgencia($urgencia, $fields = null)
    {
        if (is_array($urgencia)) {
            return $this->filtrar('urgencia IN (' . implode(', ', $urgencia) . ')', null, $fields);
        }

        $whereValues = [];

        $where = 'urgencia = :urgencia';
        $whereValues['urgencia'] = $urgencia;

        return $this->filtrar($where, $whereValues, $fields);
    }
}
