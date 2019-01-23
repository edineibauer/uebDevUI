<?php

use MatthiasMullie\Minify;

if (file_exists(PATH_HOME . "assetsPublic/core.min.css"))
    unlink(PATH_HOME . "assetsPublic/core.min.css");

//gera core novamente
$f = [];
if (file_exists(PATH_HOME . "_config/param.json"))
    $f = json_decode(file_get_contents(PATH_HOME . "_config/param.json"), true);

$list = implode('/', array_unique(array_merge($f['js'], $f['css'])));
$data = json_decode(file_get_contents(REPOSITORIO . "app/library/{$list}"), true);


if ($data['response'] === 1 && !empty($data['data'])) {

    $minifier = new Minify\CSS("");
    foreach ($f['css'] as $item) {
        $datum = array_values(array_filter(array_map(function ($d) use ($item) {
            return $d['nome'] === $item ? $d : [];
        }, $data['data'])))[0];

        if (!empty($datum['arquivos'])) {
            foreach ($datum['arquivos'] as $file) {
                if ($file['type'] === "text/css")
                    $minifier->add($file['content']);
            }
        }
    }

    $minifier->add(PATH_HOME . "public/assets/theme.min.css");
    $minifier->minify(PATH_HOME . "assetsPublic/core.min.css");
}
