<?php

if (file_exists(PATH_HOME . "_config/updates/version.txt"))
    unlink(PATH_HOME . "_config/updates/version.txt");

new \Config\UpdateSystem();