<header class="container">
    <h5 class="left">
        <b><i class="material-icons left padding-right">block</i> <span class="left">Gerenciamento de Permissões CRUD para Usuários</span></b>
    </h5>
    <div class="right padding-large padding-16">
        <button class="btn theme opacity hover-opacity-off hover-shadow" id="newUserType">
            Novo Tipo de Usuário
        </button>
    </div>
</header>

<section class="col padding-32 border-bottom">
    <div class="container">
        <div class="left margin-right" id="permissao-container">
            <div class="col padding-right" style="width: 170px">
                <div class="col card">
                    <header class="container color-gray-light" style="height: 106px;">
                        <h1 class="font-large">Entidades</h1>

                        <div class="container padding-0 padding-12" style="padding-bottom: 17px!important;">
                            Permissões
                        </div>
                    </header>

                    <div id="list-entity"></div>
                </div>
            </div>

            <div class="col padding-right" style="width: 75px">
                <div class="col card">
                    <header class="col padding-small color-gray-light" style="height: 106px;padding-top: 0!important;">
                        <h1 class="font-large">DEV</h1>

                        <div class="container padding-0" style="padding-left: 5px!important;">
                            <div title="menu" class="padding-tiny left">
                                <i class="material-icons">menu</i>
                            </div>
                        </div>
                    </header>

                    <div class="col" id="adm-allow-menu"></div>
                </div>
            </div>

            <div class="rest" id="permissao"></div>
        </div>
    </div>
</section>

<script src="<?=HOME . VENDOR?>dev-ui/public/assets/permissoes.js"></script>