<?php


use DAO\Area;

$areas = Area::getInstance()->order('descricao')->getAll();

?>

<?php
if (isset($_SESSION["mensagem"])):
    echo $_SESSION["mensagem"];
    unset($_SESSION["mensagem"]);
endif;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Áreas</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="?path=areas-criar" class="btn btn-info btn-block mb-3">Cadastrar Área</a>
        </div>
        <div class="col-md-4">
            <a href="/" class="btn btn-success btn-block mb-3">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Descrição</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($areas as $area): ?>
                    <tr>
                        <td class="text-center"><?php echo $area->id ?></td>
                        <td class="text-center"><?php echo $area->descricao ?></td>
                        <td class="text-center">
                            <a href="?path=areas-editar&id=<?php echo $area->id ?>" class="btn btn-info">Editar</a>
                            <a href="?path=areas-excluir-post&id=<?php echo $area->id ?>"
                               class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

