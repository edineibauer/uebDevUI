<?php

if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['setor'] === "1") {
    $tipos = json_decode(file_get_contents(PATH_HOME . 'entity/cache/usuarios.json'), true);
    $data['data'] = ["0" => "Anônimo"];
    foreach ($tipos as $tipo) {
        if ($tipo['column'] === "setor") {
            foreach ($tipo['allow']['values'] as $i => $value) {
                if ($value !== "1")
                    $data['data'][$value] = $tipo['allow']['names'][$i];
            }
            break;
        }
    }
}