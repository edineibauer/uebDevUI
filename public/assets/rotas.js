var change = !1;
$(function () {
    $("#routes-settings").off("change", "input[type=checkbox]").on("change", "input[type=checkbox]", function () {
        var routeNew = [];
        $.each($("#routes-settings").find("input[type=checkbox]"), function () {
            if ($(this).prop("checked"))
                routeNew.push($(this).val())
        });
        if (!change) {
            change = !0;
            post('dev-ui', 'settings/route', {route: routeNew}, function () {
                change = !1
            })
        }
    });
});