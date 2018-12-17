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
        <div class="left margin-right" id="permissao">
            <div class="col padding-right" style="width: 200px">
                <div class="col card">
                    <header class="container color-gray-light">
                        <h1 class="font-large">Entidades</h1>

                        <div class="container padding-0 padding-12" style="padding-bottom: 17px!important;">
                            Permissões
                        </div>
                    </header>

                    <div v-for="(entity, i) in entidades" class="container padding-0" style="height: 38.4px; overflow: hidden">
                        <div class="font-medium container padding-8 padding-right stripp" :rel="entity">
                            {{ entity.replace('_', ' ').replace('_', ' ').replace('_', ' ') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col padding-right" style="width: 95px">
                <div class="col card">
                    <header class="container color-gray-light">
                        <h1 class="font-large">ADM</h1>

                        <div class="container padding-0" style="padding-left: 5px!important;">
                            <div title="menu" class="padding-small left">
                                <i class="material-icons">menu</i>
                            </div>
                        </div>
                    </header>

                    <div v-for="(e, i) in entidades" class="container padding-0" style="height: 38.4px;">
                        <div class="font-medium container padding-right stripp" :rel="e">
                            <input type="checkbox" class="left margin-left allow-menu-session" v-model="permissoes[1][e]['menu']" :rel="e"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col padding-right" style="width: 270px" v-for="(tipo, i) in tipos">
                <div class="col card">
                    <header class="container color-gray-light">
                        <h1 class="font-large">{{ tipo }}</h1>

                        <div class="container padding-0" style="cursor: default;">
                            <div title="menu" class="padding-small left"
                                 style="padding-left: 12px!important; padding-right: 12px!important;">
                                <i class="material-icons">menu</i>
                            </div>
                            <div title="ler" class="padding-small left padding-right">
                                <i class="material-icons">chrome_reader_mode</i>
                            </div>
                            <div title="criar" class="padding-small left">
                                <i class="material-icons">edit</i>
                            </div>
                            <div title="atualizar" class="padding-small left">
                                <i class="material-icons">cached</i>
                            </div>
                            <div title="excluir" class="padding-small left" style="padding-left: 12px!important;">
                                <i class="material-icons">delete</i>
                            </div>
                        </div>
                    </header>

                    <div v-for="(e, j) in entidades" class="container padding-0" style="height: 38.4px;">
                        <div class="font-medium container padding-right stripp" :rel="e">
                            <input type="checkbox" class="left margin-left allow-menu-session" v-model="permissoes[i][e]['menu']" :rel="e"/>
                            <input type="checkbox" class="left margin-left allow-menu-session" v-model="permissoes[i][e]['read']" :rel="e"/>
                            <input type="checkbox" class="left margin-left allow-menu-session" v-model="permissoes[i][e]['create']" :rel="e"/>
                            <input type="checkbox" class="left margin-left allow-menu-session" v-model="permissoes[i][e]['update']" :rel="e"/>
                            <input type="checkbox" class="left margin-left allow-menu-session" v-model="permissoes[i][e]['delete']" :rel="e"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?=HOME . VENDOR?>dev-ui/public/assets/permissoes.js"></script>