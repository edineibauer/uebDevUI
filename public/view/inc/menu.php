<?php

$tpl = new \Helpers\Template("dashboard");

$menus = [];
if ($_SESSION['userlogin']['id'] === "1")
    $menus = json_decode(file_get_contents(PATH_HOME . VENDOR . "dev-ui/public/view/inc/menuMaster.json"), !0);
elseif ($_COOKIE['setor'] === "admin")
    $menus = json_decode(file_get_contents(PATH_HOME . VENDOR . "dev-ui/public/view/inc/menu.json"), !0);

foreach ($menus as $menu)
    $tpl->show("menu-li", $menu);
