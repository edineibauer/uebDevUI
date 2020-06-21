function postOptions() {
    post("config", "updateOptions", {'autosync': $("#autosync").is(":checked"), 'dev': $("#dev").is(":checked"), 'serviceworker': $("#serviceworker").is(":checked"), 'homepage': $("#homepage").is(":checked"), 'limitoffline': $("#limitoffline").val()});
}

$(function () {
    $("#clear-cache").off("click").on("click", function () {
        if(navigator.onLine) {
            if(senha = prompt("Senha:")) {
                toast("Atualizando Sistema...", 100000);
                post("config", "updateSystem", {pass: senha}, function (g) {
                    if(g) {
                        location.href = HOME + "dashboard";
                    } else {
                        toast("Senha inválida", 2000, "toast-warning");
                    }
                })
            }
        } else {
            toast("Sem Conexão", 2500, "toast-warning");
        }
    });

    $("#autosync, #homepage, #limitoffline, #serviceworker, #dev").off("change keyup").on("change keyup", function() {
        postOptions();
    });
})