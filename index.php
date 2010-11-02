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
    Entities\Usuario, Entities\Perfil;

require_once 'lib/Doctrine/Common/ClassLoader.php';

// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
$classLoader = new ClassLoader('Doctrine\ORM', realpath(__DIR__ . '/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\DBAL', realpath(__DIR__ . '/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\Common', realpath(__DIR__ . '/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Entities', __DIR__ . '/sandbox');
$classLoader->register();
$classLoader = new ClassLoader('Proxies', __DIR__ .  '/proxies');
$classLoader->register();

// Set up caches
$config = new Configuration;
$cache = new ApcCache();
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/Entities"));
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);

// Proxy configuration
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache());

// Database connection information
$connectionOptions = array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'umdoistres',
            'dbname' => 'test',
            'port' => '3306'
);

// Create EntityManager
$em = EntityManager::create($connectionOptions, $config);

echo '<h1>Hello Doctrine!</h1><pre><ol>';

$usuario = $em->createQueryBuilder()
              ->select('u')
              ->from('Entities\Usuario', 'u')
              ->where("u.id = 7")->getQuery()->execute();

echo "<li>SELECT * FROM usuarios WHERE id = 7;</li>
        <div id='codigo'>\$em->createQueryBuilder()
            ->select('u')
            ->from('Entities\Usuario', 'u')
            ->where('u.id = 7')->getQuery()->execute();</div>";

echo "<li>Ou assim:</li>
        <div id='codigo'>\$em->find(\"Entities\Usuario\", 7);</div>Resultado:";
print_r($usuario);
echo '<hr>';

echo "<li>SELECT * FROM usuarios WHERE id = 5 OR nome = 'dayana';</li>
        <div id='codigo'>\$em->createQueryBuilder()
            ->select('u')
            ->from('Entities\Usuario', 'u')
            ->where('u.id = 5')
            ->where(\"u.nome = 'dayana'\")->getQuery()->execute();</div>Resultado:";
$usuario = $em->createQueryBuilder()
                ->select('u')
                ->from('Entities\Usuario', 'u')
                ->where('u.id = 5')
                ->where("u.nome = 'dayana'")->getQuery()->execute();
print_r($usuario);

echo "<li>SELECT * FROM usuarios WHERE id = 7 AND nome = 'walmir';</li>
        <div id='codigo'>\$em->createQueryBuilder()
            ->select('u')
            ->from('Entities\Usuario', 'u')
            ->where('u.id = 7')
            ->andWhere(\"u.nome = 'walmir'\")->getQuery()->execute();</div>";

echo "<li>Ou assim:</li>
        <div id='codigo'>\$em->createQueryBuilder()
            ->select('u')
            ->from('Entities\Usuario', 'u')
            ->where(\"u.id = 7 AND u.nome = 'walmir'\")->getQuery()->execute();</div>Resultado:";
$usuario = $em->createQueryBuilder()
                ->select('u')
                ->from('Entities\Usuario', 'u')
                ->where("u.nome = 'walmir'")
                ->andWhere("u.id = 7")
                ->getQuery()->execute();
print_r($usuario);
echo '<hr>';


echo '<li>SELECT * FROM usuarios;</li>
        <div id=\'codigo\'>$em->getRepository("Entities\Usuario")->findAll();</div>Resultado:';
$usuario = $em->getRepository("Entities\Usuario")->findAll();

print_r($usuario);
echo '</ol><hr>';

echo 'Ok!';

/* ----------------------------------------------------------------------- */
$em->beginTransaction();
//for ($i=0; $i<100; $i++) {
//    $usu = new \Entities\Usuario(0, "1 2 3 $i", "usuario doctrine $i");
//    $em->persist($usu);
//}
//$inicio = \microtime(true);
//$em->flush();
//$final = \microtime(true);
//
//echo 'tempo gasto com doctrine: ' ;
//echo $final - $inicio;
//echo '<br>';

/* ----------------------------------------------------------------------- */

//$con = \mysql_connect('localhost', 'root', 'umdoistres');
//$db = \mysql_select_db('test');
//
//$inicio = \microtime(true);
//for ($i=0; $i<100; $i++) {
//    \mysql_query("INSERT INTO usuarios VALUES ('',2,'usuario tradicional $i','123$i')");
//}
//$final = \microtime(true);
//echo 'tempo gasto metodo tradiconal: ' ;
//echo $final - $inicio;
//echo '<hr>';

/* ----------------------------------------------------------------------- */

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


//$user = new \Entities\Usuario();
//$user->setName('Garfield');
//$user->setPass('Garfield171
//$user = new \Entities\Usuar');
//$user->setPerfil(2);
//$em->persist($user);
//$em->flush();
$em->rollback();
?>
<style type="text/css">
    h1 {
        font-size: 19px;
    }
    * {
        font-family: consolas;
        font-size: 13px;
    }
    #codigo {
        font-size: 17px;
        color: #0f1cf4;
        margin-bottom: 20px;
    }
</style>