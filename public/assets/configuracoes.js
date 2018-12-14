function updateConfig() {
    toast('Atualizando...', 8000, 'toast-success');
    setTimeout(function () {
        post("dev-ui", "cache/update", function () {
            setTimeout(function () {
                location.reload();
            }, 700)
        })
    }, 500);
}