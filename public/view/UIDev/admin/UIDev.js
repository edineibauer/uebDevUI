function hide_sidebar_small() {
    if (screen.width < 993) {
        $("#myOverlay, #mySidebar").css("display", "none")
    }
}

function mainLoading() {
    $(".main").loading();
    hide_sidebar_small();
    closeSidebar();
}

function devSidebarInfo() {
    if (USER.imagem === "" || USER.imagem === "null" || isEmpty(USER.imagem)) {
        document.querySelector("#dev-sidebar-imagem").innerHTML = "<i class='material-icons font-jumbo'>people</i>"
    } else {
        document.querySelector("#dev-sidebar-imagem").innerHTML = "<img src='" + decodeURIComponent(JSON.parse(USER.imagem)[0]['urls'][100]) + "' height='60' width='60'>"
    }
    document.querySelector("#dev-sidebar-nome").innerHTML = USER.nome;

    $("#core-sidebar-edit")
        .removeClass("hide")
        .off("click")
        .on("click", function () {
            if (document.querySelector(".btn-edit-perfil") !== null) {
                document.querySelector(".btn-edit-perfil").click();
            } else {
                mainLoading();
                app.loadView(HOME + "dashboard");
                toast("carregando perfil...", 1300, "toast-success");
                let ee = setInterval(function () {
                    if (document.querySelector(".btn-edit-perfil") !== null) {
                        setTimeout(function () {
                            document.querySelector(".btn-edit-perfil").click();

                        }, 1000);
                        clearInterval(ee);
                    }
                }, 100);
            }
        });
}

$(function () {
    devSidebarInfo();
    $("body").off("click", ".menu-li:not(.not-menu-li)").on("click", ".menu-li:not(.not-menu-li)", function () {
        let action = $(this).attr("data-action");
        mainLoading();

        lastPositionScroll = 0;
        sentidoScrollDown = !1;
        $("#core-header").css({"position": "fixed", "top": 0});

        if (action === "table") {
            $("#dashboard").html("").grid($(this).attr("data-entity"))
        } else if (action === 'form') {
            let id = !isNaN($(this).attr("data-atributo")) && $(this).attr("data-atributo") > 0 ? parseInt($(this).attr("data-atributo")) : null;
            $("#dashboard").html("").form($(this).attr("data-entity"), id, typeof $(this).attr("data-fields") !== "undefined" ? JSON.parse($(this).attr("data-fields")) : "undefined")
        } else if (action === 'page') {
            AJAX.view($(this).attr("data-atributo")).then(data => {
                if (typeof (data.content) === "string") {
                    if (data.content === "no-network") {
                        $("#dashboard").html("Ops! Conexão Perdida");
                    } else {
                        $("#dashboard").html(data.content);
                        if (data.js.length)
                            $.cachedScript(data.js);
                        if (data.css.length)
                            $("#core-style").prepend(data.css);
                    }
                }
            })
        }
    });

    $("#app, #core-applications").off("click", ".close-dashboard-note").on("click", ".close-dashboard-note", function () {
        let $this = $(this);
        post('dev-ui', 'dash/delete', {id: $this.attr("id")}, function (data) {
            $this.closest("article").parent().remove()
        })
    });
    setTimeout(function () {
        post("dev-ui", "panel", {}, function (data) {
            $("#dashboard").html(data);
        })
    }, 300)
})