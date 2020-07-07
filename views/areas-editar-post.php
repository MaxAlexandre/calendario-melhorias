<?php

use DAO\Area;

try {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];

    $area = new Area();
    $area->alterar($id, $descricao);

    require_once('views/areas.php');
    exit;


} catch (Exception $e) {
    echo $e->getMessage();
}
