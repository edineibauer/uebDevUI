var change = !1;
$(function () {
    $("#reautorar").off("click").on("click", function () {
        post("dev-ui", "settings/autor", {autor: $("#selectReautor").val()}, function (g) {
            toast("Salvo")
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