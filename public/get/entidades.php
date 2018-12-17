<?php

if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['setor'] === "1") {
    $entitySystem = [];

    $data['data'] = [];
    foreach (\Helpers\Helper::listFolder(PATH_HOME . "entity/cache") as $item) {
        $entity = str_replace('.json', '', $item);
        if (preg_match('/.json$/i', $item) && !in_array($item, $entitySystem) && !in_array($entity, $data['data']))
            $data['data'][] = $entity;
    }
}