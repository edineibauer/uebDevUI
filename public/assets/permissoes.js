$(function () {

    $("#permissao-container").off("change", ".allow-menu-session").on("change", ".allow-menu-session", function () {
        let user = $(this).attr("data-user");
        let entity = $(this).attr("data-entity");
        let tipo = $(this).attr("data-tipo");
        permit.permissoes[user][entity][tipo] = $(this).prop("checked");

        $.ajax({
            type: "POST",
            url: HOME + 'set',
            data: {lib: 'dev-ui', file: 'save/permissoes', dados: permit.permissoes},
            async: !1,
            dataType: "json"
        });

        //atualiza lista de permissões
        get("allow").then(allow => {
            dbLocal.clear('__allow').then(() => {
                dbLocal.exeCreate("__allow", allow);
            });
        });

        setUpdateVersion();
    });

    var permit = {
        users: {},
        entidades: {},
        permissoes: {}
    };

    //carrega os recursos
    let pp = dbLocal.exeRead('__allow', 1);
    let pe = dbLocal.exeRead('__dicionario', 1);
    let pt = get('tipos_de_usuarios');

    Promise.all([pp, pe, pt]).then(r => {
        permit.users = r[2];
        let dicionarios = r[1];
        permit.entidades = [];
        for(let k in dicionarios)
            permit.entidades.push(k);

        permit.permissoes = preenchePermissoesNaoDefinidas(r[0]);

        //show list entity
        dbLocal.exeRead("__template", 1).then(tpl => {
            $("#list-entity").html(
                Mustache.render(
                    tpl['allow-list-entity'],
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

            //show adm menu options
            let entidades = [];
            $.each(permit.entidades, function (i, e) {
                entidades.push({entity: e, checked: permit.permissoes[1][e].menu});
            });
            $("#adm-allow-menu").html(Mustache.render(tpl['allow-entity-menu'], {entidades: entidades}));

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
            $("#permissao").html(Mustache.render(tpl['allow-user-table'], {users: permit.users}));
            $("#permissao-container").width($("#permissao").width() + 245 + "px");
        });
    });

    function preenchePermissoesNaoDefinidas(permissoes) {
        //menu adm
        if (typeof permissoes[1] === "undefined")
            permissoes[1] = {};

        $.each(permit.entidades, function (b, e) {
            if (typeof permissoes[1][e] === "undefined") {
                permissoes[1][e] = {};
                permissoes[1][e]['menu'] = false;
            }
        });

        //demais usuários
        $.each(permit.users, function (a, u) {
            if (typeof permissoes[u.id] === "undefined" || permissoes[u.id] === "")
                permissoes[u.id] = {};

            $.each(permit.entidades, function (b, e) {
                if (typeof permissoes[u.id][e] === "undefined") {
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