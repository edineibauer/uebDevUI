<?php

use Helpers\Helper;

$data['data'] = "0";
try {
//copia entidades
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

        //remove template de sistema
        if(file_exists(PATH_HOME . "public/_config")) {
            foreach (Helper::listFolder(PATH_HOME . "public/_config") as $item)
                unlink(PATH_HOME . "public/_config/{$item}");

            unlink(PATH_HOME . "public/_config");
        }

        $data['data'] = "1";
    }
} catch (Exception $e) {

}