$(document).ready(function () {
    var today = new Date();
    $('.edit-datepicker').datepicker({
        language: 'pt-BR',
        format: 'dd/mm/yyyy',
        endDate: "31/12/" + today.getFullYear(),
        startDate: $(this).val()
    });

    $('.add-datepicker').datepicker({
        language: 'pt-BR',
        format: 'dd/mm/yyyy',
        endDate: "31/12/" + today.getFullYear(),
        startDate: new Date().toLocaleDateString("pt-BR")
    });

})

function validar() {
    // pegando o valor do nome pelos ids
    var descricao = document.getElementById("descricao");
    var area = document.getElementById("area");
    var prazo_acordado = document.getElementById("prazo_acordado");
    var urgencia = document.getElementById("urgencia");

    // verificar se o nome está vazio
    if (descricao.value == "") {
        alert("descricao não informada");

        // Deixa o input com o focus
        descricao.focus();
        // retorna a função e não olha as outras linhas
        return;
    }
    if (area.value == "") {
        alert("Área não informada");
        area.focus();
        return;
    }
    if (prazo_acordado.value == "") {
        alert("Prazo acordado não informado");
        prazo_acordado.focus();
        return;
    }
    if (urgencia.value == "") {
        alert("Urgência não informada");
        urgencia.focus();
        return;
    }

    formulario.submit();
}
