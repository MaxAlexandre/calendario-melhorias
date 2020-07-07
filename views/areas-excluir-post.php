<?php

use DAO\Area;

try {
    $id = $_GET['id'];
    $area = new Area();
    $area->deletar($id);

    require_once('views/areas.php');
} catch (Exception $e) {
    Erro::trataErro($e);
}
