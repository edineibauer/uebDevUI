<nav class="sidebar z-depth-2 collapse color-gray-light no-select animate-left dev-nav space-header"
     id="mySidebar">
    <div class="container row padding-4" style="background-color: #e9e9e9">
        <div id="dev-sidebar-imagem" class="col" style="height: 60px; width: 60px"></div>
        <div class="rest padding-left padding-bottom">
            <strong class="col padding-top no-select" id="dev-sidebar-nome"></strong>

            <div class="col">
                <span class="btn-edit-perfil left pointer menu-li padding-small color-gray-light opacity hover-opacity-off hover-shadow radius"
                      data-action="form" data-entity="usuarios"
                      data-atributo="<?= $_SESSION['userlogin']['id'] ?>">
                    <i class="material-icons left font-large">edit</i>
                </span>
            </div>
        </div>
    </div>
    <hr style="margin:0 0 10px 0;border-top: solid 1px #ddd;">
    <div class="bar-block">
        <?php
        require_once 'inc/menu.php';
        ?>
    </div>
</nav>

<div class="main dashboard-main animate-right">
    <div id="dashboard" class="container row"></div>
</div>
<script src="<?= HOME . VENDOR ?>dashboard/public/assets/appCoreDashboard.js" defer></script>

<?php
if (!defined("KEY") && !preg_match('/^http:\/\/(localhost|127.0.0.1)(\/|:)/i', HOME)) {
    ?>
    <div style="position:fixed; z-index: 99999999; bottom:10px;right: 20px;"
         class="padding-medium color-red opacity z-depth-2 radius">
        <i style="color:black">Segurança <b class="color-text-white">DESATIVADA! </b> Ative o software com
            <b>Urgência</b></i>
    </div>
    <?php
}