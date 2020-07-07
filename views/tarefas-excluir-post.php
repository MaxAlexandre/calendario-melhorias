<?php

use DAO\Melhoria;

try {
    $id = $_GET['id'];
    $melhoria = new Melhoria();
    $melhoria->deletar($id);

    require_once('views/tarefas.php');
} catch (Exception $e) {
    Erro::trataErro($e);
}
