<?php
/**
 * Welcome to Doctrine 2.
 *
 * This is the index file of the sandbox. The first section of this file
 * demonstrates the bootstrapping and configuration procedure of Doctrine 2.
 * Below that section you can place your test code and experiment.
 */
namespace Sandbox;

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache,
    Entities\User, Entities\Address;

require_once '../../lib/Doctrine/Common/ClassLoader.php';

// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
$classLoader = new ClassLoader('Doctrine\ORM', realpath(__DIR__ . '/../../lib'));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\DBAL', realpath(__DIR__ . '/../../lib'));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\Common', realpath(__DIR__ . '/../../lib'));
$classLoader->register();
//$classLoader = new ClassLoader('Symfony', realpath(__DIR__ . '/../../lib/vendor'));
//$classLoader->register();
$classLoader = new ClassLoader('Entities', __DIR__);
$classLoader->register();
$classLoader = new ClassLoader('Proxies', __DIR__);
$classLoader->register();

// Set up caches
$config = new Configuration;
$cache = new ApcCache;
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/Entities"));
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);

// Proxy configuration
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);

// Database connection information
$connectionOptions = array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'dbname' => 'doctrine2.0',
            'port' => '3306'
);

// Create EntityManager
$em = EntityManager::create($connectionOptions, $config);
//$conn = $em->getConnection();
//
//$sm = $conn->getSchemaManager();
//## PUT YOUR TEST CODE BELOW
//
//$fromSchema = $sm->createSchema();
//$toSchema = clone $fromSchema;
//$toSchema->dropTable('user');
//$sql = $fromSchema->getMigrateToSql($toSchema, $conn->getDatabasePlatform());
//
//$conn->executeQuery($sql);



echo 'Hello World!<hr>';
/* ----------------------------------------------------------------------- */

//$platform = $em->getConnection()->getDatabasePlatform();
//
//$schema = new \Doctrine\DBAL\Schema\Schema();
//
//$tabela = $schema->createTable('teste');
//$tabela->addColumn('id', 'integer', array('unsigned'=> true));
//$tabela->addColumn('nome', 'string', array('length'=> 32));
//$tabela->setPrimaryKey(array('id'));
//
//$queries = $schema->toSql($platform);
//$em->flush();


/* ----------------------------------------------------------------------- */

//for ($i=0; $i<100; $i++) {
//    $usu = new \Entities\Usuario(null, 2, "usuario doctrine $i", "1 2 3 $i");
//    $em->persist($usu);
//}
//$inicio = \microtime(true);
//$em->flush();
//$final = \microtime(true);
//
//echo 'tempo gasto com doctrine: ' ;
//echo $final - $inicio;
//echo '<hr>';



//$con = \mysql_connect('localhost', 'root', '');
//$db = \mysql_select_db('doctrine2.0');
//
//$inicio = \microtime(true);
//for ($i=0; $i<100; $i++) {
//    \mysql_query("INSERT INTO usuarios VALUES ('',2,'usuario tradicional $i','123$i')");
//}
//$final = \microtime(true);
//echo 'tempo gasto metodo tradiconal: ' ;
//echo $final - $inicio;
//echo '<hr>';



/**
 * adicionando registros
 */
//$user = new \Entities\Usuario();
//$user->setName('maria');
//$user->setPerfil(2);
//$user->setPass('123');
//
//$em->persist($user);
//$flush = $em->flush();


/* ----------------------------------------------------------------------- */
echo '<hr>Ok!';
