<?php

$tpl = new \Helpers\Template("dev-ui");
$read = new \Conn\Read();

$routesAll = [DOMINIO];
foreach (\Helpers\Helper::listFolder(PATH_HOME . VENDOR) as $item)
    $routesAll[] = $item;

$dados['routes'] = json_decode(file_get_contents(PATH_HOME . "_config/route.json"), true);
$dados['routesAll'] = "";
foreach ($routesAll as $item) {
    $dataRoute = [
        "item" => $item,
        "nome" => ucwords(str_replace(["_", "-", "  "], [" ", " ", " "], $item)),
        "value" => in_array($item, $dados['routes']),
        "disable" => in_array($item, ["login", "dev-ui", "dashboard", "route", "entity-ui"])
    ];
    $dados['routesAll'] .= $tpl->getShow("checkbox", $dataRoute);
}

$dados['version'] = VERSION;

$tpl = new \Helpers\Template("dev-ui");
$data['data'] = $tpl->getShow("rotas", $dados);