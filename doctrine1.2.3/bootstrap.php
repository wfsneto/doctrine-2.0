<?php
// seu_projeto/bootstrap.php

require_once(dirname(__FILE__) . '/lib/Doctrine.php');

spl_autoload_register(array('Doctrine', 'autoload'));
spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));

$manager = Doctrine_Manager::getInstance();

// Configurações do banco de dados. O banco deve ser criado previamente.
$user = 'root';
$password = '';
$host = 'localhost';
$dbname = 'doctrine1.2.3';
$driver = 'mysql';

$conn = Doctrine_Manager::connection($driver.'://'.$user.':'.$password.'@'.$host.'/'.$dbname);
$conn->setOption('username', $user);
$conn->setOption('password', $password);
$manager->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_ALL);
$manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
$manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
$manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);

// Permite o override dos metodos do model.
$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

// Formato das sequências (uso para PostgreSQL)
$manager->setAttribute(Doctrine_Core::ATTR_SEQNAME_FORMAT, '%s_seq');

// Carrega os models da pasta especificada, no caso "models"
Doctrine_Core::loadModels('model');
?>