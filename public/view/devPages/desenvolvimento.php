<?php

$tpl = new \Helpers\Template("dev-ui");
$read = new \Conn\Read();

$dados['version'] = VERSION;

//Reautorar Conteúdo
$dados['reautor'] = "";
$read->exeRead("usuarios", "ORDER BY setor,nivel,nome DESC LIMIT 50");
if ($read->getResult()) {
    foreach ($read->getResult() as $log)
        $dados['reautor'] .= "<option value='{$log['id']}'>{$log['nome']}</option>";
}

$tpl = new \Helpers\Template("dev-ui");
$data['data'] = $tpl->getShow("desenvolvimento", $dados);