function postOptions() {
    post("config", "updateOptions", {'autosync': $("#autosync").is(":checked"), 'dev': $("#dev").is(":checked"), 'serviceworker': $("#serviceworker").is(":checked"), 'homepage': $("#homepage").is(":checked"), 'limitoffline': $("#limitoffline").val()});
}

$(function () {
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

    $("#autosync, #homepage, #limitoffline, #serviceworker, #dev").off("change keyup").on("change keyup", function() {
        postOptions();
    });
})