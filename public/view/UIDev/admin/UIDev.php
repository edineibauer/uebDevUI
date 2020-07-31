<nav class="sidebar z-depth-2 collapse color-gray-light no-select animate-left dev-nav space-header"
     id="mySidebar">
    <div class="bar-block" style="padding-top: 20px">
        <?php
        require_once 'inc/menu.php';
        ?>
    </div>
</nav>

<div class="main dashboard-main animate-right">
    <div id="dashboard" class="container row"></div>
</div>

<?php
/*if (!defined("KEY") && !preg_match('/^http:\/\/(localhost|127.0.0.1)(\/|:)/i', HOME)) {
    */?><!--
    <div style="position:fixed; z-index: 99999999; bottom:10px;right: 20px;"
         class="padding-medium color-red opacity z-depth-2 radius">
        <i style="color:black">Segurança <b class="color-text-white">DESATIVADA! </b> Ative o software com
            <b>Urgência</b></i>
    </div>
    --><?php
/*}*/