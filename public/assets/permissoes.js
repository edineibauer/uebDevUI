var change = false;

$(function () {
    $(".allow-session").off("change").on("change", function () {
        post("dev-ui", "permissoes/sessionAllow", {
            session: $(this).attr("rel"),
            entity: $(this).val(),
            action: $(this).prop("checked")
        }, function () {
        });
    });

    $(".allow-menu-session").off("change").on("change", function () {
        post("dev-ui", "permissoes/sessionMenuAllow", {
            session: $(this).attr("rel"),
            entity: $(this).val(),
            action: $(this).prop("checked")
        }, function () {
        });
    });
});