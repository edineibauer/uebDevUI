function updateConfig() {
    post('dev-ui', 'cache/updateConfig', function (g) {
        if(g === 'ok') {
            toast('Salvo! recarregando...', 3500, 'toast-success');

            post("dev-ui", "cache/update", {}, function () {
                setTimeout(function () {
                    location.reload()
                }, 700)
            })
        }
    });
}