<header class="container">
    <h5>
        <b><i class="material-icons left padding-right">settings_ethernet</i> <span class="left">Desenvolvimento</span></b>
    </h5>
</header>

<section class="col padding-32 border-bottom">
    <header class="container col">
        <h2>Rotas Aceitas <i class="material-icons" style="cursor: default"
                             title="define quais bibliotecas tem permissão para mostrar conteúdo no sistema (CUIDADO: rotas desconhecidas podem danificar o sistema)">info</i>
        </h2>
    </header>

    <div id="routes-settings">
        {$routesAll}
    </div>
</section>

<script src="{$home}{$vendor}dev-ui/public/assets/rotas.js?v={$version}"></script>