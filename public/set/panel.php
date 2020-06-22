<?php

$tpl = new \Helpers\Template("dev-ui");
$data = ["response" => 1, "data" => "<div style='float: left; width: 100%; padding: 40px 5px'>", "error" => ""];
$menus = [];

if ($_SESSION['userlogin']['id'] === "1")
    $menus = json_decode(file_get_contents(PATH_HOME . VENDOR . "dev-ui/public/view/UIDev/inc/menuMaster.json"), !0);
elseif ($_SESSION['userlogin']['setor'] === "admin")
    $menus = json_decode(file_get_contents(PATH_HOME . VENDOR . "dev-ui/public/view/UIDev/inc/menu.json"), !0);

foreach ($menus as $menu)
    $data['data'] .= $tpl->getShow("menu-card", $menu);

$data['data'] .= "</div>";