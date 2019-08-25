var change = !1;
$(function () {
    $("#reautorar").off("click").on("click", function () {
        post("dev-ui", "settings/autor", {autor: $("#selectReautor").val()}, function (g) {
            toast("Salvo")
        })
    });
    $("#envelopar-lib").off("click").on("click", function () {
        toast("Separando as Entidades...", 2000);
        post("dev-ui", "settings/enveloparBiblioteca", {}, function (g) {
            if (g === "1") {
                toast("Tudo Pronto!", 2000, "toast-success")
            } else {
                toast("Erro ao Processar", 3000, "toast-error")
            }
        })
    });
    $("#envelopar-system").off("click").on("click", function () {
        toast("Salvando Configurações...", 2000);
        post("dev-ui", "settings/enveloparSistema", {}, function (g) {
            if (g === "1") {
                toast("Tudo Pronto!", 2000, "toast-success")
            } else {
                toast("Erro ao Processar", 3000, "toast-error")
            }
        })
    });
    $("#clear-cache").off("click").on("click", function () {
        if(navigator.onLine) {
            toast("Atualizando Sistema...", 100000);
            post("dev-ui", "cache/update", {}, function () {
                updateCache();
            });
        } else {
            toast("Sem Conexão", 2500, "toast-warning");
        }
    });
})