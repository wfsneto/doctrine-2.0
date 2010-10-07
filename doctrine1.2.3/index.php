<?php
/**
 *
 * @copyright Cubo7 - Framework
 *
 * Descrição para index
 *
 * @author Walmir Neto <wfsneto@gmail.com>
 * @link http://cubo7.ismywebsite.com
 *
 * Criado em: 07/10/2010, 09:57:13
 */

require_once('bootstrap.php');
/**
 * gera os modelos atravez do [schema.yml] na pasta model
 */
Doctrine_Core::generateYamlFromModels('schema.yml', 'model');


?>
