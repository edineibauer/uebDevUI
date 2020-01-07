<?php
$conf = json_decode(file_get_contents(PATH_HOME . "_config/config.json"), true);

?>
<div class="col padding-12">
    <div class="left container">
        <label class="col card padding-medium padding-16">
            <input type="checkbox" class="left margin-left" id="homepage"
                   value="<?= $conf['homepage'] ?>" <?= ($conf['homepage'] ? "checked='checked'" : "") ?>/>
            <div class="font-medium left padding-8 padding-right pointer">Página Inicial Admin</div>
        </label>
    </div>
    <div class="left container">
        <label class="col card padding-medium padding-16">
            <input type="checkbox" class="left margin-left" id="dev"
                   value="<?= $conf['dev'] ?>" <?= ($conf['dev'] ? "checked='checked'" : "") ?>/>
            <div class="font-medium left padding-8 padding-right pointer">Desenvolvimento</div>
        </label>
    </div>
    <div class="left container">
        <label class="col card padding-medium padding-16">
            <input type="checkbox" class="left margin-left" id="serviceworker"
                   value="<?= $conf['serviceworker'] ?>" <?= ($conf['serviceworker'] ? "checked='checked'" : "") ?>/>
            <div class="font-medium left padding-8 padding-right pointer">ServiceWorker</div>
        </label>
    </div>
    <div class="left container">
        <label class="col card padding-medium" style="padding-bottom: 0!important;width: 160px;">
            <span class="col align-left">Limite de Registros Offline</span>
            <input type="number" step="50" class="left" id="limitoffline" value="<?= $conf['limitoffline'] ?>"/>
            <span class="input-bar"></span>
        </label>
    </div>
</div>

<script>
    function postOptions() {
        post("config", "updateOptions", {'autosync': $("#autosync").is(":checked"), 'dev': $("#dev").is(":checked"), 'serviceworker': $("#serviceworker").is(":checked"), 'homepage': $("#homepage").is(":checked"), 'limitoffline': $("#limitoffline").val()});
    }

    $("#autosync, #homepage, #limitoffline, #serviceworker, #dev").off("change keyup").on("change keyup", function() {
        postOptions();
    });
</script>
