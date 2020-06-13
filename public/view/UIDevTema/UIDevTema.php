<?php
$dados['optionsTheme'] = "";
foreach (\Helpers\Helper::listFolder(PATH_HOME . VENDOR . "dev-ui/public/themes") as $theme) {
    $dados['optionsTheme'] .= "<option value='{$theme}' " . (!empty($dados['config']['theme']) && $dados['config']['theme'] === $theme ? "selected='selected'" : "") . ">" . ucwords(str_replace(["theme-", ".css", "-", "_"], ["", "", " ", " "], $theme)) . "</option>";
}

$tpl = new \Helpers\Template("dev-ui");
$data['data'] = $tpl->getShow('tema', $dados);