<?php

function select($object, $em) {

    $criteria = array();

    $reflectionClass = new \ReflectionClass($object);

    foreach ($reflectionClass->getProperties() as $key => $property) {
        $get = "get" . ucfirst($property->getName());
        $value = $object->$get();
        $campo = $property->getName();

        if ($value != '') {
            $criteria[$campo] = $value;
        }
    }
    $select = $em->getRepository($reflectionClass->getName())->findBy($criteria);

    return $select;
}

function insert($object, $em) {

    $em->persist($object);
    // salvando na base de dados
    $insert = $em->flush();
    // limpando o EntityManager
    $em->clear();
    // retornando Boolean
    return $object;
}

function update($object, $em) {

    $reflectionClass = new \ReflectionClass($object);

    $update = $em->find($reflectionClass->getName(), $object->getId());

    foreach ($reflectionClass->getProperties() as $key => $property) {
        $get = "get" . ucfirst($property->getName());
        $set = "set" . ucfirst($property->getName());
        $value = $object->$get();

        if ($value != '') {
            $update->$set($value);
        }
    }
    
    $em->persist($update);
    // salvando na base de dados
    $update = $em->flush();
    // retornando Objeto
    return $object;
}

function delete ($object, $em) {

    $select = select($object, $em);
    // pesistindo o objeto //
    $em->remove($select[0]);
    // executando a ação
    $remove = $em->flush();
    // limpando o EntityManager
    $em->clear();
    // retornando Boolean
    return $remove;
}

?>
