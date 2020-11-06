function postOptions() {
    AJAX.post("updateOptions", {'autosync': $("#autosync").is(":checked"), 'dev': $("#dev").is(":checked"), 'serviceworker': $("#serviceworker").is(":checked"), 'homepage': $("#homepage").is(":checked"), 'limitoffline': $("#limitoffline").val()});
}

$(function () {

    $("#app").off("click", "#clear-cache").on("click", "#clear-cache", function () {
        if(navigator.onLine) {
            $("#app").off("click", "#clear-cache");
            toast("Atualizando Sistema...", 1000000000);
            AJAX.post("updateSystem").then(() => {
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
    }).off("click", "#create-cache-db").on("click", "#create-cache-db", function () {
        if(navigator.onLine) {
            toast("Criando cache do banco", 10000000, "toast-infor");
            AJAX.post("createMaestruCacheDb").then(g => {
                toast("Limpando cache do banco", 1000, "toast-success");
                if (g)
                    toast("Cache do banco limpo", 1000, "toast-success");
                else
                    toast("Algo deu errado", 2000, "toast-warning");
            });
        }
    }).off("click", "#updateAppStore").on("click", "#updateAppStore", function () {
        if(navigator.onLine) {
            AJAX.post("updateAppOnAndroid");
            toast("enviamos uma mensagem para os usuários atualizarem seu app", 3000, "toast-infor");
        }
    });

    $("#autosync, #homepage, #limitoffline, #serviceworker, #dev").off("change keyup").on("change keyup", function() {
        postOptions();
    });
})