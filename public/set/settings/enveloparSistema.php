<?php

use Helpers\Helper;

$data['data'] = "0";
try {
    \Helpers\Helper::createFolderIfNoExist(PATH_HOME . "public/_config");

    if(file_exists(PATH_HOME . "_config/config.json"))
        copy(PATH_HOME . "_config/config.json", PATH_HOME . "public/_config/config.json");

    if(file_exists(PATH_HOME . "_config/param.json"))
        copy(PATH_HOME . "_config/param.json", PATH_HOME . "public/_config/param.json");

    if(file_exists(PATH_HOME . "_config/permissoes.json"))
        copy(PATH_HOME . "_config/permissoes.json", PATH_HOME . "public/_config/permissoes.json");

    if(file_exists(PATH_HOME . "_config/route.json"))
        copy(PATH_HOME . "_config/route.json", PATH_HOME . "public/_config/route.json");

    if(file_exists(PATH_HOME . "uploads/site/favicon.png"))
        copy(PATH_HOME . "uploads/site/favicon.png", PATH_HOME . "public/_config/favicon.png");

    if(file_exists(PATH_HOME . "uploads/site/logo.png"))
        copy(PATH_HOME . "uploads/site/logo.png", PATH_HOME . "public/_config/logo.png");

    $data['data'] = "1";
} catch (Exception $e) {
}