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
?>
<div class="col padding-medium font-medium" id="config-form-dev"></div>
<script>$("#config-form-dev").form("config",1)</script>
