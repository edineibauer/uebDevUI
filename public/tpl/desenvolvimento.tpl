<header class="container">
    <h5>
        <b><i class="material-icons left padding-right">settings_ethernet</i> <span class="left">Desenvolvimento</span></b>
    </h5>
</header>

<section class="col padding-32 border-bottom">
    <header class="container col">
        <h2>Desenvolvimento</h2>
    </header>

    <div class="container">
        <div class="left padding-small padding-16">
            <button id="clear-cache" class="btn hover-shadow margin-0 opacity hover-opacity-off">
                <i class="material-icons left padding-right" title="Atualiza a versão do sistema, recarregando arquivos bases como: assets, cores e caches.">info</i>
                <span class="left padding-tiny">Atualizar Sistema</span>
            </button>
        </div>
        <div class="left padding-small padding-16">
            <button id="envelopar-lib" class="btn hover-shadow margin-0 opacity hover-opacity-off">
                <i class="material-icons left padding-right" title="Permite chamar este sistema como uma biblioteca, podendo ser usado seus recursos (views, assets, gets, posts).">info</i>
                <span class="left padding-tiny">Criar Biblioteca do Sistema</span>
            </button>
        </div>
        <div class="left padding-small padding-16">
            <button id="envelopar-system" class="btn hover-shadow margin-0 opacity hover-opacity-off">
                <i class="material-icons left padding-right" title="Permite iniciar este sistema em uma nova instalação, recuperando suas característivas.">info</i>
                <span class="left padding-tiny">Criar Template do Sistema</span>
            </button>
        </div>
    </div>
</section>

<script src="{$home}{$vendor}dev-ui/public/assets/desenvolvimento.js?v={$version}"></script>