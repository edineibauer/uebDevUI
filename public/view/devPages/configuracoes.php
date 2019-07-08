<?php
//Garante criação dos dados de configuração caso não exista
$read = new \Conn\Read();
$read->exeRead(PRE . "config", "WHERE id=1");
if (!$read->getResult()) {
    $criarData = [
        "nome_do_site" => defined('SITENAME') && !empty(SITENAME) ? SITENAME : "",
        "subtitulo" => defined('SITESUB') && !empty(SITESUB) ? SITESUB : "",
        "descricao" => defined('SITEDESC') && !empty(SITEDESC) ? SITEDESC : "",
        "https" => defined('PROTOCOL') && !empty(PROTOCOL) && PROTOCOL === "https://" ? 1 : 0,
        "www" => defined('WWW') && !empty(WWW) && WWW === "www" ? 1 : 0,
        "logo" => defined('LOGO') && !empty(LOGO) ? '[{"url": "' . LOGO . '", "name": "logo", "nome": "logo", "size": 66582, "type": "png", "image": "' . LOGO . '", "fileType": "image/png", "sizeName": "66KB"}]' : null,
        "favicon" => defined('FAVICON') && !empty(FAVICON) ? '[{"url": "' . FAVICON . '", "name": "favicon", "nome": "favicon", "size": 66582, "type": "png", "image": "' . FAVICON . '", "fileType": "image/png", "sizeName": "66KB"}]' : null,
    ];

    $d = new \Entity\Dicionario("config");
    $d->setData($criarData);
    $d->save();
}

$conf = json_decode(file_get_contents(PATH_HOME . "_config/config.json"), true);

?>
<div class="col padding-medium font-medium" id="config-form-dev"></div>

<div class="col padding-12">
    <div class="left container">
        <label class="col card padding-medium padding-16">
            <input type="checkbox" class="left margin-left" id="autosync"
                   value="<?= $conf['autosync'] ?>" <?= ($conf['autosync'] ? "checked='checked'" : "") ?>/>
            <div class="font-medium left padding-8 padding-right pointer">Sincronização Automática</div>
        </label>
    </div>
    <div class="left container">
        <label class="col card padding-medium padding-16">
            <input type="checkbox" class="left margin-left" id="homepage"
                   value="<?= $conf['homepage'] ?>" <?= ($conf['homepage'] ? "checked='checked'" : "") ?>/>
            <div class="font-medium left padding-8 padding-right pointer">Página Inicial Admin</div>
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
    $("#config-form-dev").form("config", 1, ["nome_do_site", "subtitulo", "descricao"]);

    function postOptions() {
        post("config", "updateOptions", {'autosync': $("#autosync").is(":checked"), 'homepage': $("#homepage").is(":checked"), 'limitoffline': $("#limitoffline").val()});
    }

    $("#autosync, #homepage, #limitoffline").off("change keyup").on("change keyup", function() {
        postOptions();
    });
</script>
