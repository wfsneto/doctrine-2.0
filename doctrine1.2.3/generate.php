<?php
/**
 *
 * @copyright Cubo7 - Framework
 *
 * Descrição para generate
 *
 * @author Walmir Neto <wfsneto@gmail.com>
 * @link http://cubo7.ismywebsite.com
 *
 * Criado em: 07/10/2010, 10:02:33
 */
// seu_projeto/generate.php
require_once('bootstrap.php');
/**
 * Remova as próximas 2 linhas caso não queira remover e criar seu banco a cada execução.
 */
Doctrine_Core::dropDatabases();
Doctrine_Core::createDatabases();
Doctrine_Core::generateModelsFromYaml('schema.yml', 'models');
Doctrine_Core::createTablesFromModels('models');
?>
