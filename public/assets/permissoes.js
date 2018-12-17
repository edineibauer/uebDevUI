function loadResource(url) {
    return getJSON(HOME + "get/" + url);
}

$(function () {

    var permit = new Vue({
        el: '#permissao',
        data: {
            tipos: {},
            entidades_do_sistema: {},
            entidades: {},
            permissoes: {}
        }
    });

    permit.$watch('permissoes', function (novo, velho) {
        console.log(novo);
        post('dev-ui', 'save/permissoes', {dados: novo}, function (g) {
            console.log(g);
        });
        console.log(novo);
    }, {deep: true});

    //carrega os recursos
    loadResource('tipos_de_usuarios').then(t => {
        permit.tipos = t.data;
    });

    loadResource('permissoes').then(t => {
        permit.permissoes = t.data
    });

    loadResource('entidades').then(t => {
        permit.entidades = t.data;
    });

    //listra zebra na tabela
    $("#permissao").off("mouseover", ".stripp").on("mouseover", ".stripp", function () {
        $(".stripp[rel='" + $(this).attr("rel") + "']").addClass("color-gray-light");
    }).off("mouseleave", ".stripp").on("mouseleave", ".stripp", function () {
        $(".stripp").removeClass("color-gray-light");
    });

    //Adiciona novo tipo de usuário
    $("#newUserType").off("click").on("click", function () {
        let userType = prompt("Dê um nome ao novo tipo de usuário", "ex: Funcionário");
        if (userType != null)
            permit.permissoes[userType] = 'teste';
    });
});