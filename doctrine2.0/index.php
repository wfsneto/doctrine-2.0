<?php
require_once 'lib/DoctrinePlugin.php';
$cli = new \Doctrine\ORM\Tools\Cli();
$cli->run($argv = array("", "schema-tool", "--create", "--config", ""));
var_dump($argv);
//$u = new \modelo\Usuario2();
//$u->setNome("Né mintira nao");
//$this->em->persist($u);
//$this->em->flush();
//$u = $this->em->createQuery("Select u from modelo\Usuario u where u.id = 1")->getSingleResult();
//var_dump($u->getComentarios());
//$com = new \modelo\Comentario();
//$arr = array($com);
//$arr[0]->setTexto("Um texto");
//$u->setComentarios($arr);
//$this->em->persist($com);
//$this->em->flush();

