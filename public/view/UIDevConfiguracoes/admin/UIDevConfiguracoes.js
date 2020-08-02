function postOptions() {
    AJAX.post("updateOptions", {'autosync': $("#autosync").is(":checked"), 'dev': $("#dev").is(":checked"), 'serviceworker': $("#serviceworker").is(":checked"), 'homepage': $("#homepage").is(":checked"), 'limitoffline': $("#limitoffline").val()});
}

$(function () {

    $("#app").off("click", "#clear-cache").on("click", "#clear-cache", function () {
        if(navigator.onLine) {
            toast("Atualizando Sistema...", 1000000000);
            AJAX.post("updateSystem", {pass: senha}).then(g => {
                    if(typeof sseSource !== "undefined" && navigator.onLine && typeof (EventSource) !== "undefined")
                        sseSource.close();

                    localStorage.removeItem('update');
                    checkUpdate().then(() => {
                        location.href = HOME + "dashboard";
                    })
            });
        } else {
            toast("Sem Conexão", 2500, "toast-warning");
        }
    }).off("click", "#create-bundle").on("click", "#create-bundle", function () {
        if(navigator.onLine) {
            AJAX.post("createMaestruBundle").then(g => {
                if (g)
                    toast("App criado na pasta `bundle/`", 3000, "toast-success");
                else
                    toast("Algo deu errado", 2000, "toast-warning");
            });
        }
    });

    $("#autosync, #homepage, #limitoffline, #serviceworker, #dev").off("change keyup").on("change keyup", function() {
        postOptions();
    });
})