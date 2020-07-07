<?php

use DAO\Area;

try {
    $area = new Area();
    $descricao = $_POST['descricao'];
    $area->inserir($descricao);

    require_once('views/areas.php');
    exit;
} catch (Exception $e) {
    echo $e;
}
