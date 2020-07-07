<?php

use DAO\Area;

$id = $_GET['id'];

$area = Area::getInstance()->filtrarPorId($id);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 m-3">
            <a href="?path=areas" class="btn btn-success btn-block mb-3">Voltar</a>
        </div>
        <div class="col-md-12">
            <h2>Editar Área</h2>
        </div>
    </div>

    <form action="?path=areas-editar-post" method="post">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="nome">Nome da Área</label>
                    <input type="hidden" name="id" value="<?php echo $area->id ?>">
                    <input name="descricao" value="<?php echo $area->descricao ?>" type="text" class="form-control"
                           placeholder="Nome da Área">
                </div>
                <input type="submit" class="btn btn-success btn-info" value="Salvar">
            </div>
        </div>
    </form>
</div>
