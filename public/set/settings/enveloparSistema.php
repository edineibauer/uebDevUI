<?php

use Helpers\Helper;

$data['data'] = "0";
try {

    Helper::createFolderIfNoExist(PATH_HOME . "public/_config");

    //copia as entidades
    if (file_exists(PATH_HOME . "entity/cache")) {

        Helper::createFolderIfNoExist(PATH_HOME . "public/entity");
        Helper::createFolderIfNoExist(PATH_HOME . "public/entity/cache");
        Helper::createFolderIfNoExist(PATH_HOME . "public/entity/cache/info");

        foreach (Helper::listFolder(PATH_HOME . "entity/cache") as $entity) {
            if (preg_match('/\.json$/i', $entity)) {

                //Para cada Entidade
                $isMyEntity = true;
                foreach (Helper::listFolder(PATH_HOME . VENDOR) as $lib) {
                    if ($isMyEntity && file_exists(PATH_HOME . VENDOR . "{$lib}/public/entity/cache/{$entity}"))
                        $isMyEntity = false;
                }

                if ($isMyEntity) {
                    copy(PATH_HOME . "entity/cache/{$entity}", PATH_HOME . "public/entity/cache/{$entity}");
                    copy(PATH_HOME . "entity/cache/info/{$entity}", PATH_HOME . "public/entity/cache/info/{$entity}");
                }
            }
        }
    }

    if(file_exists(PATH_HOME . "_config/config.json"))
        copy(PATH_HOME . "_config/config.json", PATH_HOME . "public/_config/config.json");

    if(file_exists(PATH_HOME . "_config/param.json"))
        copy(PATH_HOME . "_config/param.json", PATH_HOME . "public/_config/param.json");

    if(file_exists(PATH_HOME . "_config/permissoes.json"))
        copy(PATH_HOME . "_config/permissoes.json", PATH_HOME . "public/_config/permissoes.json");

    if(file_exists(PATH_HOME . "_config/route.json"))
        copy(PATH_HOME . "_config/route.json", PATH_HOME . "public/_config/route.json");

    if(file_exists(PATH_HOME . FAVICON))
        copy(PATH_HOME . FAVICON, PATH_HOME . "public/_config/favicon." . pathinfo(FAVICON, PATHINFO_EXTENSION));

    if(file_exists(PATH_HOME . LOGO))
        copy(PATH_HOME . LOGO, PATH_HOME . "public/_config/logo." . pathinfo(LOGO, PATHINFO_EXTENSION));

    if(file_exists(PATH_HOME . "entity/general/general_info.json"))
        copy(PATH_HOME . "entity/general/general_info.json", PATH_HOME . "public/_config/general_info.json");

    $data['data'] = "1";
} catch (Exception $e) {
}