<?php
require_once('bootstrap.php');
/**
 * As próximas 2 linhas abaixo não conseguir fazer-la funcionar,
 * mas provavelmente deve ter alguma ultilidade.
 */
//Doctrine_Core::dropDatabases();
//Doctrine_Core::createDatabases();

// esta linha cria os modelos abaixo cria os modelos através deste yml na pasta model
Doctrine_Core::generateModelsFromYaml('schema.yml', 'model');


//e esta linha cria as tabelas no banco de acordo com os modelos criada pela linha anterior
Doctrine_Core::createTablesFromModels('model');
?>
