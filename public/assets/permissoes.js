function loadResource(url) {
    return getJSON(HOME + "get/" + url);
}

$(function () {

    $("#permissao-container").off("change", ".allow-menu-session").on("change", ".allow-menu-session", function () {
        let user = $(this).attr("data-user");
        let entity = $(this).attr("data-entity");
        let tipo = $(this).attr("data-tipo");
        permit.permissoes[user][entity][tipo] = $(this).prop("checked");

        $.ajax({type: "POST", url: HOME + 'set', data: {lib: 'dev-ui', file: 'save/permissoes', dados: permit.permissoes}, dataType: "json"})
    });

    var permit = {
        users: {},
        entidades: {},
        permissoes: {}
    };

    //carrega os recursos
    let pp = loadResource('permissoes');
    let pe = loadResource('entidades');
    let pt = loadResource('tipos_de_usuarios');

    Promise.all([pp, pe, pt]).then(r => {
        if(typeof r[0].data.js === "undefined" && typeof r[1].data.js === "undefined" && typeof r[2].data.js === "undefined") {
            permit.users = r[2].data;
            permit.entidades = r[1].data;
            permit.permissoes = preenchePermissoesNaoDefinidas(r[0].data);

            //show list entity
            getJSON(HOME + "get/tpl/allow-list-entity").then(tpl => {
                $("#list-entity").html(
                    Mustache.render(
                        tpl.data['allow-list-entity'],
                        {
                            entidades: permit.entidades,
                            familyName: function () {
                                return function (text, render) {
                                    return render(text).replaceAll('_', ' ');
                                }
                            }
                        }
                    )
                );
            });

            //show adm menu options
            getJSON(HOME + "get/tpl/allow-entity-menu").then(tpl => {
                let entidades = [];
                $.each(permit.entidades, function (i, e) {
                    entidades.push({entity: e, checked: permit.permissoes[1][e].menu});
                });
                $("#adm-allow-menu").html(Mustache.render(tpl.data['allow-entity-menu'], {entidades: entidades}));
            });

            //show list user
            $.each(permit.users, function (a, u) {
                u.entitys = [];
                $.each(permit.entidades, function (i, e) {
                    let ee = {entity: e, permissoes: []};
                    $.each(['menu', 'read', 'create', 'update', 'delete'], function (b, t) {
                        ee.permissoes.push({tipo: t, checked: permit.permissoes[u.id][e][t]});
                    });
                    u.entitys.push(ee);
                });
            });

            //show users entity permissions
            getJSON(HOME + "get/tpl/allow-user-table").then(tpl => {
                $("#permissao").html(Mustache.render(tpl.data['allow-user-table'], {users: permit.users}));
            });
        } else {
            toast("Falha na Conexão", 2000, "toast-warning");
        }
    });

    function preenchePermissoesNaoDefinidas(permissoes) {

        //menu adm
        if(typeof permissoes[1] === "undefined")
            permissoes[1] = {};

        $.each(permit.entidades, function (b, e) {
            if(typeof permissoes[1][e] === "undefined")
                permissoes[1][e] = {};
            permissoes[1][e]['menu'] = false;
        });

        //demais usuários
        $.each(permit.users, function (a, u) {
            if(typeof permissoes[u.id] === "undefined")
                permissoes[u.id] = {};

            $.each(permit.entidades, function (b, e) {
                if(typeof permissoes[u.id][e] === "undefined") {
                    permissoes[u.id][e] = {};

                    $.each(['menu', 'read', 'create', 'update', 'delete'], function (b, t) {
                        permissoes[u.id][e][t] = false;
                    });
                }
            });
        });

        return permissoes;
    }

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