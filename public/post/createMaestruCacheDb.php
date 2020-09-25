<?php

$data['data'] = 1;
$sql = new \Conn\SqlCommand();

/**
 * Para cada entidade no sistema, cria o cache
 */
foreach (\Helpers\Helper::listFolder(PATH_HOME . "entity/cache") as $entity) {
    if(pathinfo($entity, PATHINFO_EXTENSION) === "json") {
        $entity = str_replace(".json", "", $entity);

        /**
         * Delete cached database
         * Create cached database if not exist
         */
        $sql->exeCommand(
            "DROP TABLE IF EXISTS " . PRE . "wcache_" . $entity . ";"
                . "CREATE TABLE IF NOT EXISTS `" . PRE . "wcache_" . $entity . "` (`id` INT(11) NOT NULL, `system_id` INT(11) DEFAULT NULL, `data` longtext DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
                . "ALTER TABLE `" . PRE . "wcache_" . $entity . "` ADD PRIMARY KEY (`id`), MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
    }
}