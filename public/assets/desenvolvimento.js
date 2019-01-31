var change = !1;
$(function () {
    $("#reautorar").off("click").on("click", function () {
        post("dev-ui", "settings/autor", {autor: $("#selectReautor").val()}, function (g) {
            toast("Salvo")
        })
    });
    $("#envelopar-lib").off("click").on("click", function () {
        toast("Envelopando...", 3000);
        post("dev-ui", "settings/enveloparBiblioteca", {}, function (g) {
            if (g === "1") {
                toast("Tudo Pronto!", 2000, "toast-success")
            } else {
                toast("Erro ao envelopar", 3000, "toast-error")
            }
        })
    });
    $("#clear-cache").off("click").on("click", function () {
        post('route', 'internet', {}, function (g) {
            if(g === 1) {
                toast("Atualizando Sistema...", 7000);
                post("dev-ui", "cache/update", {}, function () {
                    toast("Recarregando Arquivos...", 3000);
                    location.reload()
                })
            }
        })
    });
})