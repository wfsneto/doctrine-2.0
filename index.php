<?php

/**
 * Arquivo de Início
 * Chamada aos arquivos básicos do Framework para que tudo comece a funcionar
 * ATENÇÃO: só mexer se desejar alterar o funcionamento do framework
 * @author Idealizza
 */

/**
 * Incluíndo o arquivo de Constantes
 */
include_once('config/constantes.php');
/**
 * Carregando o Autoload das Classes
 */
require_once(LIB . DS . "Autoload.php");
/**
 * Iniciando a sessão
 */
session_start();
/**
 * Incluíndo o Arquivo de Funções
 */
include_once(LIB . DS . "Functions.php");
/**
 * Recuperando a Instância do controlador
 */
$controll = Controll::getControll();
/**
 * Disparando o Controlador
 */
$controll->disparar();
?>