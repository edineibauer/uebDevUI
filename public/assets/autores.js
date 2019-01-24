$(function () {
    let dicionarios = dbLocal.exeRead("__dicionario", 1);
    let tpl = dbLocal.exeRead("__template", 1);
    Promise.all([dicionarios, tpl]).then(r => {
        dicionarios = r[0];
        tpl = r[1];

        let entitys = [];
        let classe = 'color-gray-light';
        $.each(dicionarios, function (entity, meta) {
            classe = (classe === 'color-white' ? 'color-gray-light' : 'color-white');
            entitys.push({class: classe, entity: entity});
        })

        $("#autor-list-dev").html(Mustache.render(tpl['autor-list-entity'], {entidades: entitys}));
    });

    $("#autor-list-dev").off("click", ".btn-edit-autor").on("click", ".btn-edit-autor", function () {
        $("#autor-list-dev").html("").grid($(this).attr("rel"), [], {autor: !0, create: !1, update: !1, delete: !1, status: !1})
    });
});