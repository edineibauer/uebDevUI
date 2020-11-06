<?php

$content = '<img data-id="' . strtotime('now') . '" src="' . HOME . 'public/assets/img/lights.png" style="height:auto;position: absolute;z-index:3;width: 160%;left: -30%;top: -55px;transform:rotate(90deg)">'
    . '<lottie-player src="' . HOME . 'public/assets/lottie/update.json" style="margin-top: -25px" background="transparent" speed="1" loop autoplay></lottie-player>'
    . '<div style="position: relative;z-index: 11;text-align: center;font-size: 16px;line-height: 21px;margin-top: 50px;">atualize para continuar usando o PayGas!<a target="_blank" href="market://details?id=paygas.com.br" onclick="closeUpdateApp()" class="btn btn-primary py-4 pl-4 pr-4 font-weight-bold" style="position: fixed;bottom: 20px;left: 10%;width: 80%;text-transform: uppercase">atualizar</a></div>';

$content .= "<style>.btn-primary[data-dismiss='modal'] {display: none}</style>";
$content .= "<script>function closeUpdateApp() {window.onpopstate = maestruHistoryBack; $(\".btn-primary[data-dismiss='modal']\").trigger('click')} $(function() {window.onpopstate = null;});</script>";

$read = new \Conn\Read();
$read->exeRead("clientes", "WHERE ativo = 1");
if($read->getResult()) {
    $create = new \Conn\Create();
    foreach ($read->getResult() as $item)
        $create->exeCreate("popup", ["titulo" => "Atualização necessária", "descricao" => $content, "data_de_exibicao" => date("Y-m-d H:i:s"), "ownerpub" => $item['usuarios_id']]);
}
