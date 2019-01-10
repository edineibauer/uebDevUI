<?php

if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['setor'] === "1") {
    $tipos = json_decode(file_get_contents(PATH_HOME . 'entity/cache/usuarios.json'), true);
    $data['data'][] = ["id" => "0", "user" => "Anônimo"];
    foreach ($tipos as $tipo) {
        if ($tipo['column'] === "setor") {
            foreach ($tipo['allow']['options'] as $i => $value) {
                if ($value['option'] !== "1")
                    $data['data'][] = ["id" => $value['option'], "user" => $value['name']];
            }
            break;
        }
    }
}