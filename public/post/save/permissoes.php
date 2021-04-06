<?php

\Config\Config::createFile(PATH_HOME . "_config/permissoes.json", strip_tags(trim(filter_input(INPUT_POST, 'dados', FILTER_DEFAULT))));