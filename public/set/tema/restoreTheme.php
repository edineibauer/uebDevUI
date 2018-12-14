<?php
if(file_exists(PATH_HOME . "public/assets/theme-recovery.min.css")) {
    $prev = file_get_contents(PATH_HOME . "public/assets/theme-recovery.min.css");
    $atual = file_get_contents(PATH_HOME . "public/assets/theme.min.css");

    $f = fopen(PATH_HOME . "public/assets/theme.min.css", "w+");
    fwrite($f, $prev);
    fclose($f);

    $f = fopen(PATH_HOME . "public/assets/theme-recovery.min.css", "w+");
    fwrite($f, $atual);
    fclose($f);

    $data['data'] = "ok";

} else {
    $data['data'] = "no";
}