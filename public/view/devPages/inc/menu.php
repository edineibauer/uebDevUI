<?php

$tpl = new \Helpers\Template("dashboard");

$menus = json_decode(file_get_contents(PATH_HOME . VENDOR . "dev-ui/public/view/devPages/inc/menu.json"), true);

foreach ($menus as $menu)
    $tpl->show("menu-li", $menu);
