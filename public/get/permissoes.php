<?php


if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['setor'] === "1") {
    $data['data'] = [];
    if (file_exists(PATH_HOME . "_config/permissoes.json")) {
        $permit = json_decode(file_get_contents(PATH_HOME . "_config/permissoes.json"), true);

        //convert true string para true boolean
        foreach ($permit as $setor => $datum) {
            foreach ($datum as $entity => $dados) {
                foreach ($dados as $action => $value)
                    $data['data'][$setor][$entity][$action] = $value === "true";
            }
        }

    } else {

        //obtém as entidades de sistema
        $entitySystem = [];
        foreach (\Helpers\Helper::listFolder(PATH_HOME . "entity/cache/info") as $item) {
            if (preg_match('/.json$/i', $item)) {
                $e = json_decode(file_get_contents(PATH_HOME . "entity/cache/info/{$item}"), true);

                if (!empty($e['entity_type']) && $e['entity_type'] === "system" && !in_array($item, $entitySystem))
                    $entitySystem[] = $item;
            }
        }

        //obtém as entidades
        $entidades = [];
        foreach (\Helpers\Helper::listFolder(PATH_HOME . "entity/cache") as $item) {
            $entity = str_replace('.json', '', $item);
            if (preg_match('/.json$/i', $item) && !in_array($item, $entitySystem) && !in_array($entity, $entidades))
                $entidades[] = $entity;
        }

        foreach ($entidades as $entidade)
            $data['data']["0"][$entidade] = ['menu' => false, 'read' => false, 'create' => false, 'update' => false, 'delete' => false];

        //obtem os tipos de usuário
        $tipos = json_decode(file_get_contents(PATH_HOME . 'entity/cache/usuarios.json'), true);
        foreach ($tipos as $tipo) {
            if ($tipo['column'] === "setor") {
                foreach ($tipo['allow']['values'] as $i => $value) {
                    if ($value !== "1"){
                        foreach ($entidades as $entidade)
                            $data['data'][$value][$entidade] = ['menu' => false, 'read' => false, 'create' => false, 'update' => false, 'delete' => false];
                    } else {
                        foreach ($entidades as $entidade)
                            $data['data'][$value][$entidade] = ['menu' => true];
                    }
                }
                break;
            }
        }
    }
}