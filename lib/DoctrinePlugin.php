<?php

namespace lib;

/**
 * Requisição da classe base para toda a biblioteca Doctrine
 */
require 'Doctrine/Common/ClassLoader.php';
require 'IPlugin.php';

use \Doctrine\Common\ClassLoader;
use \Doctrine\ORM\Configuration;
use \Doctrine\ORM\EntityManager;
use \Doctrine\Common\Cache\ApcCache;
use \Doctrine\DBAL\Logging\EchoSQLLogger;

/**
 * Classe plugin para carregar a biblioteca Doctrine
 */
class DoctrinePlugin implements IPlugin {

    /**
     *
     * @var \Doctrine\Common\ClassLoader
     */
    private $classLoader;
    /**
     * @var \Doctrine\ORM\Configuration
     */
    private $config;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Método para carregar o plugin da biblioteca Doctrine
     *
     */
    public function carregar() {
        // Criando o objeto que vai carregar as demais classes do Doctrine
        // Ou seja, a classe que terá o __autoload() do Doctrine registrado
        // via spl_autoload_register()
        // Os parâmetros são para definindo o diretório onde está o Doctrine
        $this->classLoader = new ClassLoader('Doctrine', LIB);
        // Registrar o classloader no spl_autoload_register()
        $this->classLoader->register();

        $this->config = new Configuration();
        $cache = new ApcCache();
        $driver = $this->config->newDefaultAnnotationDriver(MODELO);
        $this->config->setMetaDataDriverImpl($driver);
        $this->config->setMetadataCacheImpl($cache);
        $this->config->setQueryCacheImpl($cache);
        $this->config->setProxyDir(TMP);
        $this->config->setProxyNamespace('doctrine\proxy');
        $this->config->setSQLLogger(new EchoSQLLogger());

        $dados = \controlador\Controlador::getDadosIni();
        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'dbname' => 'doctrine2.0',
            'port' => '3306'
        );

        $this->em = EntityManager::create($connectionOptions, $this->config);
    }

    public function getEm() {
        return $this->em;
    }

}

?>