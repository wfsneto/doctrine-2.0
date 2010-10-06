<?php

namespace lib;
/**
 * Requisição da classe base para toda a biblioteca Doctrine
 */
require LIB . DS . 'Doctrine' . DS . 'Common' . DS . 'ClassLoader.php';

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

        /**
         * Carrega informações de configuração a partir do controlador principal do Framework (Singleton)
         */
        $database = Controll::getControll()->getConfig('database');
        /**
         * Conexão com a base de dados MySQL
         */
        $connectionOptions = array(
            'driver' => 'pdo_' . $database['sgbd'],
            'host' => $database['host'],
            'user' => $database['usuario'],
            'password' => $database['senha'],
            'dbname' => $database['database'],
            'port' => $database['porta']
        );

        $this->em = EntityManager::create($connectionOptions, $this->config);
//		$cli = new \Doctrine\ORM\Tools\Cli();
//		$cli->run($argv = array("", "schema-tool", "--create", "--config", ""));
//		var_dump($argv);
//		$u = new \modelo\Usuario2();
//		$u->setNome("Né mintira nao");
//		$this->em->persist($u);
//		$this->em->flush();
//		$u = $this->em->createQuery("Select u from modelo\Usuario u where u.id = 1")->getSingleResult();
//		var_dump($u->getComentarios());
//		$com = new \modelo\Comentario();
//		$arr = array($com);
//		$arr[0]->setTexto("Um texto");
//		$u->setComentarios($arr);
//		$this->em->persist($com);
//		$this->em->flush();
    }

    public function getEm() {
        return $this->em;
    }

}

?>