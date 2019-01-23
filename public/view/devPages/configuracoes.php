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
        "logo" => defined('LOGO') && !empty(LOGO) ? '[{"url": "' . LOGO . '", "name": "", "size": 1078, "type": "image/png"}]' : null,
        "favicon" => defined('FAVICON') && !empty(FAVICON) ? '[{"url": "' . FAVICON . '", "name": "", "size": 1078, "type": "image/png"}]' : null,
    ];

    $d = new \Entity\Dicionario("config");
    $d->setData($criarData);
    $d->save();
}
?>
<header class="container padding-bottom">
    <h5>
        <b><i class="material-icons left padding-right">settings</i> <span class="left">Configurações</span></b>
    </h5>
</header>

<div class="col s12 padding-small">
    <section class="card padding-8 border-bottom">
        <header class="container col">
            <h2>Informações do Site</h2>
        </header>

        <div class="col padding-medium font-medium" id="config-form-dev">
        </div>
    </section>
</div>
<script src="<?= HOME ?>assetsPublic/view/configuracoes.min.js" defer></script>
