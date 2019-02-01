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

function requestDashboardContent(file) {
    view(file, function (data) {
        setDashboardContent(data.content)
    })
}

function requestDashboardEntity(entity) {
    post("table", "api", {entity: entity}, function (data) {
        setDashboardContent(data)
    })
}

function setDashboardContent(content) {
    if (typeof(content) === "string")
        $("#dashboard").html(content === "no-network" ? "Ops! Conexão Perdida" : content)
}

$(function () {
    $("#core-content, #core-applications").off("click", ".menu-li").on("click", ".menu-li", function () {
        let action = $(this).attr("data-action");
        mainLoading();
        if (action === "table") {
            requestDashboardEntity($(this).attr("data-entity"))
        } else if (action === 'form') {
            let id = !isNaN($(this).attr("data-atributo")) && $(this).attr("data-atributo") > 0 ? parseInt($(this).attr("data-atributo")) : null;
            $("#dashboard").html("").form($(this).attr("data-entity"), id);
        } else if (action === 'page') {
            requestDashboardContent($(this).attr("data-atributo"))
        } else if (action === 'link') {
        }
    }).off("click", ".close-dashboard-note").on("click", ".close-dashboard-note", function () {
        let $this = $(this);
        post('dev-ui', 'dash/delete', {id: $this.attr("id")}, function (data) {
            $this.closest("article").parent().remove()
        })
    });
    setTimeout(function () {
        view("devPages/panel", function (data) {
            $("#dashboard").html(data.content);
            spaceHeader()
        })
    }, 300)
})