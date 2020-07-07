<?php

use DAO\Melhoria;

try {
    $melhoria = new Melhoria();

    $descricao = $_POST['descricao'];
    $area = $_POST['area'];
    $prazo_acordado = $_POST['prazo_acordado'];
    $prazo_legal = $_POST['prazo_legal'];
    $gravidade = $_POST['gravidade'];
    $urgencia = $_POST['urgencia'];
    $tendencia = $_POST['tendencia'];
    $demanda_legal = $_POST['demanda_legal'];

    $melhoria->inserir($descricao,
        $demanda_legal,
        $prazo_legal,
        $prazo_acordado,
        $gravidade,
        $urgencia,
        $tendencia,
        $area
    );

    require_once('views/tarefas.php');
    exit;
} catch (Exception $e) {
    echo $e;
}
