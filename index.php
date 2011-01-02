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
$classLoader = new ClassLoader('Proxies', __DIR__ . '/proxies');
$classLoader->register();
/**/

// Set up caches
$config = new Configuration;
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . "/Entities"));
$config->setMetadataDriverImpl($driverImpl);
//$cache = new ApcCache();
//$config->setMetadataCacheImpl($cache);
//$config->setQueryCacheImpl($cache);
// Proxy configuration
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
//$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
// Database connection information
$connectionOptions = array(
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => 'umdoistres',
    'dbname' => 'test',
    'port' => '3306'
);

include_once 'crud/doctrine2.0.php';

// Create EntityManager
$em = EntityManager::create($connectionOptions, $config);

echo '<h1>Doctrine Evolution!</h1><pre>';
echo '<h2>CRUD</h2>';
echo "<ol>";


$insert = new \Entities\Usuario(null,"1","Walmir Neto");
$usu_insert = insert ($insert, $em);
echo '
<li><h3>insert: <b>C</b>reate.</h3>
<div id=\'codigo\'>
$insert = new \Entities\Usuario(null,"1","Walmir Neto");
$usu_insert = insert ($insert, $em); //
</div>
<h4>Resultado de print_r($usu_insert): </h4>
</li>';

print_r($usu_insert);
echo "<hr>";

$select = new \Entities\Usuario($usu_insert->getId());
$usu_select = select ($select, $em);
echo '
<li><h3>select: <b>R</b>etrieve (<b>R</b>ead)</h3>
<div id=\'codigo\'>
$insert = new \Entities\Usuario(null,"1","Walmir Neto");
$usu_insert = insert ($insert, $em); //
</div>
<h4>Resultado de print_r($usu_select): </h4>
</li>';
print_r($usu_select);
echo "<hr>";



$update = new Usuario($usu_insert->getId(), 2, "Wolverine Valadao");

$usu_update = update ($update, $em);
echo '
<li><h3>update: <b>U</b>pdate</h3>
<div id=\'codigo\'>
$update = new Usuario($usu_insert->getId(), 2, "Wolverine Valadao");
$usu_update = update ($update, $em);
</div>
<h4>Resultado de print_r($usu_update): </h4>
</li>';
print_r($usu_update);
echo "<hr>";



$update = new Usuario($usu_insert->getId());
$usu_update = delete ($update, $em);
echo '
<li><h3>delete: <b>D</b>estroy (<b>D</b>elete)</h3>
<div id=\'codigo\'>
$update = new Usuario($usu_insert->getId());
$usu_update = delete ($update, $em);
</div>
<h4>Resultado de print_r($usu_update): </h4>
</li>';
print_r($usu_update);
echo "<hr>";


echo "</ol>";
echo '<hr><hr>';



########################################################################################
########################################################################################
########################################################################################
########################################################################################
echo '</pre><h1>Hello Doctrine!</h1><pre><ol>';

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

$em->beginTransaction();
$em->close();
/**/
echo '<hr>';

$params = array(
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => 'umdoistres',
    'dbname' => 'test',
);

$conn = \Doctrine\DBAL\DriverManager::getConnection($params);
$sm = $conn->getSchemaManager();
echo "<pre>";
print_r("");
echo "</pre>";

$columns = array(
    "id" => array(
        "type" => \Doctrine\DBAL\Types\Type::getType("integer"),
        "autoincrement" => true,
        "primary" => true,
        "notnull" => true
    ),
    "name" => array(
        "type" => \Doctrine\DBAL\Types\Type::getType("string"),
        "length" => 255
    ),
);

//$sm->dropAndCreateTable("test", $columns);
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
?>
<style type="text/css">
    h1 {
        font-size: 19px;
    }
    * {
        font-family: monaco, consolas;
        font-size: 13px;
    }
    #codigo {
        font-size: 17px;
        color: #0f1cf4;
        margin-bottom: 20px;
        margin: 0;
        padding: 0
    }
    h1,h2,h3,h4,h5,h6 {
        margin: 0;
        padding: 0
    }
    b {
        color: blue;
        font-size: 19px
}
</style>