function updateConfig() {
    toast('Atualizando...', 8000, 'toast-success');
    setTimeout(function () {
        post("dev-ui", "cache/update", function () {

            //delete service workers
            navigator.serviceWorker.getRegistrations().then(function (registrations) {
                for (let registration of registrations) {
                    registration.unregister()
                }
            });

            //delete caches
            caches.keys().then(cacheNames => {
                return Promise.all(cacheNames.map(cacheName => {
                    return caches.delete(cacheName)
                }))
            });

            setTimeout(function () {
                location.reload();
            }, 700);
        })
    }, 500);
}